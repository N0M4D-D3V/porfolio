---
title: Proceso de Importación
description: "A continuación describo algunos de los principales retos técnicos que abordé durante el proyecto."
image: ""
imageAlt: ""
pubDate: 2025-11-18
modDate: 2025-11-18
---

Un reto importante fue diseñar el **proceso de importación de datos**. Yo definí la primera versión del flujo, que luego fue creciendo hasta convertirse casi en un subsistema complejísimo.

Con el tiempo, el sistema de importación fue incorporando más tipos de datos, más reglas de validación y más pasos intermedios. Mi aportación evolucionó hacia **refactorizar y aplicar principios SOLID**: separar responsabilidades, aislar reglas de negocio y hacer que la lógica fuese más legible, testeable y sencilla de extender a futuro, sin tener que reescribir el núcleo cada vez que entraba un nuevo requisito.

---

## Importación local

Con el tiempo, todo aquel primer flujo de importación acabó cristalizando en un servicio orquestador: el `LocalUpdateService`. Su misión es clara: **tomar un ZIP entregado por el cliente, instalar todos los datos nuevos y dejar la app en un estado coherente… o volver exactamente al punto anterior si algo falla**.

### Visión General

A alto nivel, el proceso completo sigue estos pasos:

1. **Proteger el estado actual**  
   Antes de tocar nada, el sistema elimina backups anteriores y crea uno nuevo de todos los datos locales. Si algo sale mal en cualquier punto, se puede hacer rollback completo y dejar la app tal y como estaba.

2. **Trabajo en una zona segura (directorio temporal)**  
   El ZIP que trae la actualización se copia a un directorio temporal y se descomprime ahí, nunca directamente sobre los datos activos.  
   Primero se extrae el paquete principal y después se recorren sus subdirectorios, donde cada fichero ZIP interno representa una “carga” distinta (por ejemplo, una combinación de _part number_ + funcionalidad).  
   Cada una de esas cargas se desempaqueta en su propia carpeta y se guarda su información básica (identificador, tamaño, etc.) en una lista interna.

3. **Inicialización en el orden correcto**  
   No todas las cargas son independientes: algunas dependen de que otras estén listas antes (por ejemplo, ciertos módulos necesitan que el rendimiento de la aeronave esté inicializado antes de poder calcular peso y centrado).  
   Por eso, el servicio ordena primero las cargas y luego las inicializa una a una mediante un servicio especializado.  
   Esa inicialización incluye, entre otras cosas, el trabajo que contábamos antes: parsear XML, construir los modelos en memoria, volcar JSON, preparar SQLite, etc.

4. **Validación estricta de los datos y de la licencia**  
   Una vez inicializadas, entra en juego el servicio de validación:
   - Comprueba que el **dataset mínimo** está presente (no falta ninguna pieza crítica).
   - Verifica que la **licencia** es válida.
   - Ejecuta validaciones específicas por carga (coherencia entre datos, estructuras esperadas, integridad de ficheros, etc.).  
     Si algo no cuadra, se corta el proceso y se activa el rollback.

5. **Promoción a “entorno actual” y cache**  
   Solo si todo lo anterior ha ido bien se pasa a la fase de “promoción”:
   - Se limpia el directorio actual de datos.
   - Se copian desde el directorio temporal únicamente las carpetas correspondientes a las cargas válidas.
   - Se guardan copias en una **capa de caché**, para acelerar futuros accesos o restauraciones ligeras.

6. **Limpieza y flags de configuración**  
   Tras completar la importación, se eliminan los temporales y el backup (ya no es necesario, el nuevo estado es el bueno) y se limpian ciertas flags internas de configuración que solo tenían sentido mientras no había datos reales o se trabajaba en modo mock.

7. **Rollback automático si algo falla**  
   Si cualquier paso de la cadena falla, entra el plan B:
   - Se restaura el backup completo.
   - Se eliminan los restos temporales.
   - Se informa al usuario de que la importación ha fallado y que se ha aplicado un rollback.

> Un detalle adicional que es puramente de experiencia de usuario pero crítico en este contexto: durante todo el proceso se mantiene el dispositivo “despierto” (sin apagar pantalla ni suspender), para evitar que un corte a mitad de actualización deje los datos en un estado inconsistente.

### Resumen

En conjunto, el resultado es un algoritmo de actualización local que:

- Trata cada importación como una **transacción completa**: o se instala bien, o se vuelve al estado anterior.
- Aísla la lógica compleja en servicios especializados (backup, zip, validación, inicialización, caché…), haciendo que el orquestador sea fácil de seguir y de mantener.
- Permite evolucionar el formato de los datos o añadir nuevas cargas sin reescribir el núcleo del flujo.

Es la pieza que cierra el círculo: desde los datos legacy en XML/SQLite hasta el estado final que consume la app, pasando por validación, licencias y resiliencia ante errores.

<p align="right"><a href="#top">(Ir arriba)</a></p>

---

## Importación remota

Hasta ahora hemos visto cómo funciona la **actualización local** a partir de un ZIP: todo ocurre dentro del dispositivo, en un entorno controlado.  
El siguiente paso lógico fue permitir que el propio sistema pudiera **conectarse a un servidor central**, descargar los datos necesarios y actualizarse de forma casi autónoma.

Ahí entra en juego el `RemoteUpdateService`: la pieza que orquesta la **importación remota vía SFTP**.

> Objetivo: llevar el mismo modelo transaccional al mundo remoto

La idea no era “bajar archivos por SFTP y ya está”, sino replicar los principios del proceso local:

- Cada actualización debe ser **todo o nada**: o se instala completamente y validada, o se hace rollback.
- El sistema debe ser **consciente de la versión** instalada y de la versión disponible en el servidor..
- El usuario debe tener **visibilidad y control**: ver qué versión se va a instalar, cuánto ocupa y poder cancelar.
- El proceso debe funcionar tanto en **iPad** como en **Windows (Electron)**.

Sobre esa base se construyó la importación remota.

### Visión general

A alto nivel, el proceso de actualización remota hace esto:

1. Mantiene el dispositivo despierto durante toda la operación.
2. Lee la **configuración actual** del dispositivo (qué cargas tiene instaladas y sus part numbers).
3. Se conecta al servidor SFTP configurado para ese cliente.
4. Descubre qué **cargas remotas** hay disponibles
5. Compara lo remoto con lo local para decidir:
   - Qué hay que **descargar** (toGet),
   - Qué se puede **mantener** (toKeep),
   - Qué habría que **retirar** (toRemove).
6. Descarga solo lo necesario, reutilizando la **caché local** cuando es posible.
7. Desempaqueta, valida y prepara los datos en un directorio temporal.
8. Hace **backup** del estado actual y promueve el nuevo dataset a “estado activo”.
9. Inicializa los datos (importación de XML, SQLite, config, documentación, etc.).
10. Envía un **informe** al servidor SFTP.
11. Si algo falla en cualquier punto crítico, se ejecuta un **rollback completo**.

Todo esto se va notificando al frontend mediante un observable (`UpdateStatus`), que indica en qué fase está el proceso, qué está ocurriendo y el progreso de descarga.

### Control de estado

Durante todo el proceso:

- El servicio va **emitiendo estados de progreso** (`INIT`, `CONNECT`, `CHECK`, `DOWNLOADING`, `DEPLOYING`, `FEEDBACK`, `DISCONNECT`, `FINISHED`, `ERROR`) con el paso actual y el total.
- Existe un método de **cancelación** que:
  - Marca el proceso como cancelado.
  - Envía una orden de cancelación al plugin SFTP.
  - Lanza un rollback completo.
  - Notifica al usuario que la actualización se ha abortado.

De esta forma, el usuario nunca se queda “a medias” sin saber qué ha pasado, y el estado de la app siempre vuelve a ser consistente.

---

### Resumen

La importación remota con SFTP no es solo “descargar unos zips”:

- Descubre qué hay en el servidor,
- Lo compara con lo que ya tiene el dispositivo,
- Respeta el modelo transaccional (backup + temporales + validación + promoción),
- Integra licencia, versión y validaciones específicas por tipo de carga,
- Expone el proceso a la UI mediante un canal de progreso,
- Y cierra el ciclo informando de vuelta al servidor.

En esencia, es el mismo concepto que la actualización local, pero llevado a un entorno **cliente–servidor**, con control de versiones, seguridad y resiliencia ante errores o cancelaciones.

<p align="right"><a href="#top">(Ir arriba)</a></p>
