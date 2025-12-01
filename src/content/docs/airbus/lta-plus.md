---
title: "LTA+ Hybrid Application"
description: "Developed the application from scratch, making key decisions regarding the technical architecture and communication between modules."
image: ""
imageAlt: ""
pubDate: 2025-11-18
modDate: 2025-11-18
---

Aplicación de cálculo aeroespacial para operaciones militares, diseñada para funcionar en entornos aislados y de baja conectividad.

Fue un proyecto técnicamente exigente en el que asumí un diferentes roles, desarrollé **plugins nativos a medida**, implementé **automatizaciones** clave y definí **protocolos de seguridad**.

Participé en la aplicación desde sus primeras fases, tomando decisiones sobre la **arquitectura técnica** y la comunicación entre módulos.

---

## Rol

Mi rol fue evolucionando a lo largo del proyecto.

Al inicio, era el único desarrollador del equipo junto con mi Team Lead. Yo llegaba con un perfil centrado en Angular y heredamos una aplicación legacy con código espagueti, difícil de mantener y tecnológicamente obsoleta. Tras varios intentos de iterar sobre esa base, llegamos a la conclusión de que sería más eficiente sustituirla por un nuevo desarrollo desde cero.

En unos 3 meses conseguimos una réplica funcional de la aplicación original, pero con un código mucho más escalable y mantenible. La nueva implementación mejoró notablemente la capacidad de respuesta de la app y permitió una UX/UI más dinámica y moderna.

Con el tiempo fueron incorporándose nuevos compañeros que también aportaron mucho al producto. En paralelo, mi rol fue cambiando: pasé de desarrollador frontend especializado en Angular a desarrollador de aplicaciones híbridas (Ionic + Capacitor), y me convertí en uno de los desarrolladores de referencia del equipo. Mis compañeros solían plantearme cuestiones sobre implementaciones y de temas técnicos.

Mi Team Lead empezó a consultarme de forma recurrente sobre problemas técnicos, alternativas de software e incluso algunas cuestiones de organización del equipo. En la fase final del proyecto llegué a cubrir su rol durante su baja por paternidad. En ese periodo seguí siendo principalmente un perfil técnico, pero también asumí responsabilidades de coordinación: organización del trabajo, reparto de tareas (sobre todo de soporte y mantenimiento) y soporte al equipo en la toma de decisiones.

<p align="right"><a href="#top">(Ir arriba)</a></p>

---

## Overview Tecnológico

La aplicación se construyó principalmente para funcionar en iPads. Posteriormente, se dio soporte a sistemas Windows. Los dispositivos soportados son:

- <strong>iPad, iPad Pro y iPad Mini.</strong> Se hicieron pruebas en en entorno <strong>macOS</strong> de escritorio con éxito, pero nunca se llevó a producción para estos dispositivos.
- <strong>Microsoft Surface</strong>
- <strong>Dispositivos Windows</strong> en general

En cuanto al software, la aplicación se construyó utilizando estas tecnologías principales:

- <strong>Ionic, Angular, Capacitor y TypeScript</strong> para el frontal y la capa híbrida.
- <strong>Swift (iOS) y Node.js (Windows)</strong> para el desarrollo de plugins nativos.
- <strong>Python</strong> para scripts de automatización y procesos de encriptación.

Durante el desarrollo también fue necesario trabajar con **C/Objective-C**, ya que el motor de cálculo estaba escrito originalmente en Fortran y transpilado a C. Uno de nuestros plugins propios ejecutaba estas funciones en C desde Swift. No fue necesario programar C, pero sí entender lo suficiente el código como para mapear correctamente los parámetros desde el plugin hacia el motor de cálculo. Esto lo explicaré con más detalle en la sección de retos técnicos.

<p align="right"><a href="#top">(Ir arriba)</a></p>

---

## Arquitectura

La aplicación sigue una **arquitectura monolítica multi-capa** que se ejecuta íntegramente en local. Excepcionalmente, el proceso de importación ejecuta operaciones SFTP contra sistemas externos, alojados en redes locales (para que nos entendamos, no puedes llegar si no estás en la base militar presencialmente).

En cuanto a la arquitectura, a más bajo nivel se encuentra el **motor de cálculo aeronáutico** (llamado CAPS), desarrollado originalmente en Fortran y transpilado a C. A partir de ahí se compila como librería estática/dinámica (.a/.dll para iOS/Windows). Un plugin de Capacitor se encarga de mapear y lanzar a las operaciones a través de Node.js y Swift/Objective-C.

En la capa intermedia, **Capacitor** actúa como wrapper entre el frontal (Angular) y las implementaciones nativas. Gracias a esto, la misma base de código funciona tanto en **Electron (Windows)** como en **iPad (iOS)**.

Al tratarse de una aplicación militar, debe operar en entornos hostiles, con conectividad limitada o directamente sin conexión. Por eso:

- Toda la lógica se ejecuta en local.
- La aplicación mantiene una base de datos local.
- La carga de datos se realiza previamente “en tierra”, en entornos seguros, mediante **SFTP**.
- Tras un proceso de importación complejo, la información se almacena en:
  - Ficheros JSON
  - Base de datos **SQLite**
  - Base de datos **DexieJS**

La arquitectura fue evolucionando de forma orgánica, condicionada por los requerimientos específicos del proyecto y, sobre todo, por el motor de cálculo heredado: una evolución de un motor aeronáutico utilizado en aviones de los años 70 y 80, que imponía muchas restricciones sobre cómo debíamos diseñar el resto de capas.

<p align="right"><a href="#top">(Ir arriba)</a></p>

---

## Testing

El testing tradicional en Angular (Jasmine/Karma) se aplicó solo a módulos y funcionalidades críticas.

La validación funcional de los cálculos y la operativa recaía en un **equipo técnico aeronáutico**, ya que muchos detalles escapaban al conocimiento del equipo de desarrollo.

Durante mi etapa final en el proyecto y por iniciativa propia, diseñé y desarrollé una **arquitectura técnica** basada en Appium + WebdriverIO, que permitía:

- Definir tests a partir de ficheros CSV.
- Ejecutar automáticamente los cálculos.
- Obtener evidencias (vídeo/foto).
- Generar reportes de errores.

En la práctica, esto supuso:

- Reducir significativamente el tiempo de testing manual.
- Ahorrar, de facto, el equivalente a varios salarios dedicados exclusivamente a pruebas repetitivas.
- Reducir el riesgo de error humano y liberar a otros compañeros de tareas mecánicas de validación.

> Puedes encontrar más detalles de esta arquitectura en la sección de _Retos Técnicos_ y _Arquitectura de Test E2E_.

<p align="right"><a href="#top">(Ir arriba)</a></p>

---

## Seguridad y datos

Siendo una aplicación militar, la seguridad era un requisito central. Por ello, el software funciona **solo en entorno local**, sin conexiones externas durante la operación normal.

La carga de datos se realiza exclusivamente en entornos seguros, mediante **SFTP**. Para ello se desarrolló un **plugin de Capacitor específico para SFTP**, con cierta complejidad añadida por la falta de librerías maduras y documentación clara en iOS.

Además, se implantó un **formato de datos estricto**, alineado con estándares aeronáuticos, lo cual hizo el proceso de importación más complejo a la par que muy eficaz para detectar inconsistencias en los datos entrantes.

El proceso de importación valida el formato de cada campo, verifica su correcta estructura y garantiza un almacenamiento coherente en la app.

Para la **validación de licencias** de clientes se diseñó un sistema basado en ficheros de licencia encriptados con variantes de algoritmos estándar + codificación Base64. Se utiliza un script de Python para generar licencias. En la app, un servicio de desencriptado (Angular) para validar las licencias en tiempo de ejecución.

En cuanto a la ingestión de datos desde SFTP:

- Se descarga un fichero comprimido protegido por contraseña.
- El usuario introduce la contraseña previo a proceder con la importación:
  1. Descompresión
  2. Validación
  3. Ingestión de datos

Una vez validados, los datos se reparten entre:

- Ficheros JSON estáticos
- Una base de datos **SQLite** consumida mediante un plugin de Ionic
- Y una **Inner DB en Angular** consumida con una implementación propia basada en **DexieJS + observables**, asegurando reactividad en la lectura de datos.

> Puedes encontrar una explicación más detallada en la sección de _Data & Security_.

<p align="right"><a href="#top">(Ir arriba)</a></p>

---

## Metodología y documentación

El equipo seguía una adaptación propia de **SCRUM**, ajustada a las particularidades de Airbus y al tipo de software. Se utilizaban sprints de un mes, lo que ayudaba a proteger al equipo del goteo continuo de requerimientos informales y aglutinar los nuevos requisitos para planificar el siguiente sprint con cabeza.

Fue un enfoque propuesto por el Team Lead que funcionó especialmente bien en este contexto.

En cuanto a **documentación**, no existía un proceso formal y exhaustivo. La mayor parte de la documentación se centraba en código y en operativa compleja, creada por iniciativa de los propios desarrolladores. Algunos flujos críticos, como la **arquitectura de testing E2E**, quedaron documentados con alto grado de detalle.

> Personalmente, **abogo por evitar la sobredocumentación**: documentar lo crítico, lo contraintuitivo y lo que aporta valor real al mantenimiento, pero no convertir cada detalle del código en
> papeleo que encarece el desarrollo sin aportar retorno.

<p align="right"><a href="#top">(Ir arriba)</a></p>

---

## Conclusiones

Si tuviera que resumir este proyecto en una frase, sería algo así como: **un motor de cálculo de los 70 incrustado en una app híbrida moderna, con requisitos militares, mucha restricción y cero margen para hacer el tonto.**

No fue un proyecto _“de libro”_: hubo mucho código legacy, herramientas rotas, ciberataques, documentación muy escasa y decisiones que había que tomar con información incompleta. Pero precisamente por eso fue clave para mí.

Me obligó a **salir mi rol** de “frontend Angular” y **pensar en el sistema completo**: motor heredado, plugins nativos, seguridad, flujo de datos, UX real de los usuarios.

Aprendí a **tomar ownership** cuando nadie te da el manual: montar infra improvisada, diseñar procesos de importación, proponer una arquitectura técnica E2E ante un problema que lleva años enquistado.

Confirmé que prefiero **resolver problemas reales** (aunque estén llenos de barro) antes que vivir en entornos perfectos (SPOILER: no existen).

¿Repetiría todo tal cual? No. Hoy plantearía algunos bloques de otra forma, modularizaría antes ciertas partes y atacaría la automatización de testing mucho antes en el ciclo de vida del proyecto. Pero este trabajo marcó un antes y un después en cómo entiendo mi papel: no solo como alguien que escribe código, sino como alguien que **arma soluciones complejas**, con restricciones reales y responsabilidad sobre lo que llega al usuario final.
