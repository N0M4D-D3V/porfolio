---
title: EFB Filesystem Plugin
description: "Developed the application from scratch, making key decisions regarding the technical architecture and communication between modules."
image: ""
imageAlt: ""
pubDate: 2025-11-18
modDate: 2025-11-18
---

Uno de los problemas recurrentes en este proyecto era que **queríamos tratar el sistema de ficheros igual en iPad y en Windows (Electron)**, pero el plugin oficial de Filesystem no cubría bien el caso desktop. Eso nos obligaba a escribir código condicional y ramas específicas por plataforma, justo lo contrario a lo que quieres en una app crítica.

Para solucionarlo, propuse un **fork del plugin oficial de Filesystem de Ionic** y añadimos una implementación específica para Electron. El objetivo era muy simple:

> Desde el punto de vista del código de negocio, trabajar con ficheros debe ser igual en iOS que en Electron.

## Idea central

Para Electron, el plugin define un **directorio raíz de trabajo** sobre el que se hacen todas las operaciones. Ese path se puede configurar con `setPath()`, incluyendo placeholders como `{username}` para adaptarlo al usuario de la máquina.

A partir de ahí, todos los `readFile`, `writeFile`, `copy`, `mkdir`, etc. se hacen **siempre colgando de ese root**. Tampoco se trabaja nunca con rutas absolutas sueltas, lo que simplifica la migración entre entornos y facilita el soporte.

En otras palabras, tienes una especie de **“sandbox lógico”** para la app en Electron.

## API

El plugin ofrece una API parecida a la del Filesystem oficial, pero adaptada al uso real que teníamos. El enfoque está puesto en **hacer trivial guardar y leer datos de negocio (JSON, binarios, docs…) sin que el equipo tenga que estar pensando en los detalles de Node, fs, etc.**

Para trabajar con estructuras de carpetas, el plugin añade:

- `mkdir` y `rmdir`: Crean o eliminan directorios de forma recursiva usando `fs-extra`.
- `readdir`: Lee un directorio y devuelve una lista de `FileInfo`. Puede trabajar en modo recursivo, explorando subdirectorios.

El plugin también implementa las operaciones típicas de mantenimiento:

- `stat`: Devuelve metadata de un fichero o directorio (tipo, tamaño, fechas…).
- `rename`: Renombra ficheros o carpetas. Evita sobrescribir un destino ya existente, salvo que se lo indiques explícitamente.
- `copy`: Copia tanto archivos como directorios.
- `deleteFile` / `rmdir`: Eliminan ficheros o carpetas de forma recursiva.

La idea es que **todas las operaciones habituales de mantenimiento** puedan hacerse desde una API consistente y conocida por el equipo, en lugar de que cada desarrollador empiece a tirar de `fs` por su cuenta.

## Unificar el modelo mental del equipo

Aunque el código por debajo usa Node, `fs-extra` y `path`, el valor real de este plugin no está en los detalles de implementación, sino en lo que consigue a nivel de uso:

- La misma lógica de **importaciones, backups, caché, logs, etc.** funciona igual en iPad y en Electron.
- El equipo tiene un **único contrato de Filesystem** que respeta en todas las plataformas.
- La capa de dominio no se llena de `if (platform === 'electron')` ni de hacks puntuales.

> Para un proyecto donde el **sistema de ficheros es literalmente el corazón de la app** (datos aeronáuticos, licencias, configuraciones, logs de test, etc.), tener este plugin estable y bien definido fue clave para poder escalar la funcionalidad sin que la base se volviera incontrolable.
