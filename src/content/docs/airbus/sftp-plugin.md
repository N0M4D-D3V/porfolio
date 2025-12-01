---
title: EFB SFTP Plugin
description: "Implementación nativa del protocolo SFTP (SSH File Transfer Protocol), con integraciones para Electron e iOS (iPad)."
image: ""
imageAlt: ""
pubDate: 2025-11-18
modDate: 2025-11-18
---

Para poder actualizar la app en entornos militares sin acceso a internet “normal”, necesitábamos hablar con un **servidor SFTP**: descargar cargas de datos, subir reportes de configuración y hacerlo todo de forma controlada.

Capacitor no trae nada de esto de serie.

La solución fue crear un **plugin SFTP propio**, con implementación nativa en **iOS/iPad (Swift + NMSSH)** y su equivalente para **Electron (Node + ssh2-sftp-client)**.

Ambas comparten la misma idea: ofrecer una **API única hacia el frontend** (Angular/Capacitor), para que el código de negocio no tenga que preocuparse de si está en un iPad o en un portátil con Windows.

---

### Objetivo: misma experiencia en todas las plataformas

Desde el punto de vista de la app, el plugin expone siempre los mismos “bloques” funcionales:

- `connect / disconnect` → abrir y cerrar la sesión SFTP.
- `list` → listar ficheros y carpetas en un path remoto.
- `checkPath` → comprobar que una ruta remota existe y es válida.
- `download` → descargar un fichero desde el servidor al dispositivo.
- `upload` → subir un fichero desde el dispositivo al servidor.
- `cancel` → poder abortar una descarga en curso.
- `progress` → notificar al frontend **cuánto** se ha descargado.

El código Angular que orquesta las actualizaciones (local/remote) trabaja siempre contra esa API. Lo que cambia por debajo es el “driver”: NMSSH en iOS, `ssh2-sftp-client` en Electron.

> En iOS, el plugin es un `CAPPlugin` nativo que envuelve NMSSH.
>
> Con esto, en iPad tenemos un **cliente SFTP completo**, integrado con el sistema de ficheros local y con eventos de progreso que el frontend puede consumir fácilmente.

> En Electron, la implementación sigue el mismo concepto, pero usando Node. La clase `SFTP` extiende `EventEmitter` y mantiene un `main_path` local para saber dónde guardar los ficheros descargados.
>
> El resultado es que en Windows podemos descargar y subir cargas (perfo, WB, AODB, docs, etc.) con el mismo modelo mental que en iPad, y con **eventos de progreso en tiempo real**.

### Resumen

Este plugin no es “solo” un cliente SFTP: Es la **puerta de entrada** de todas las actualizaciones remotas del sistema.

- Está alineado con el modelo de **transacción** del pipeline de datos:
  - Se descarga al área temporal,
  - Se valida,
  - Se promueve o se hace rollback.
- Encapsula toda la complejidad de: conexiones, paths, cancelaciones, informes de configuración, diferencias entre iOS y Electron.

Para el equipo, la ventaja es clara: el código que decide **qué** descargar y **cuándo** (RemoteUpdateService) no se preocupa de **cómo** se habla con el servidor.

Eso está encapsulado aquí, en un plugin SFTP propio, diseñado para un entorno donde la fiabilidad, la trazabilidad y el control de la versión son tan importantes como los propios cálculos que hace la app.
