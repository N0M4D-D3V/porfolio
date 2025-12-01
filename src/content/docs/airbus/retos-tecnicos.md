---
title: Retos Técnicos
description: "A continuación describo algunos de los principales retos técnicos que abordé durante el proyecto."
image: ""
imageAlt: ""
pubDate: 2025-11-18
modDate: 2025-11-18
---

## Arquitectura técnica de tests E2E

Uno de los problemas históricos del proyecto era que las pruebas de regresión se hacían casi siempre a mano, tanto por parte del equipo técnico como por los especialistas en operaciones de vuelo. Eran procesos largos, repetitivos y con mucha exposición al error humano.

Quise atacar este problema por mi cuenta y, durante mi tiempo libre, estuve investigando herramientas hasta dar con una combinación viable: **Appium + WebdriverIO**, ejecutando tests sobre la app real en iPad y en entorno de escritorio. Monté la base del proyecto en **TypeScript + Jasmine** para no sacar al equipo de su zona de confort.

El reto más delicado fue conseguir que los tests corrieran en **dispositivos iOS** sin disponer de cuenta de pago de Apple, lo que implicó varios workarounds y un procedimiento muy concreto. Documenté todo el proceso en una guía interna para que el resto del equipo pudiera replicarlo sin problemas.

A partir de ahí diseñé la arquitectura técnica con una idea clara: **los tests debían poder ser definidos por personal no técnico**.

La solución fue basarlos en **ficheros CSV**:

- Cada fila del CSV representa un caso de prueba, con entradas y salidas esperadas.
- El sistema lee el CSV, genera los tests de forma dinámica y ejecuta los cálculos en la app nativa.
- Los resultados que aparecen en la pantalla de la app se comparan automáticamente con los valores esperados y se marcan como OK/KO.

Con este modelo, los especialistas en operaciones de vuelo pueden crear y mantener sus baterías de pruebas directamente desde Excel, sin tocar código. Solo con esto ya conseguimos reducir de forma muy clara el tiempo dedicado a testing manual y eliminar gran cantidad de trabajo mecánico.

Para que también aportara valor a perfiles de gestión y certificación, evolucioné la solución con:

- **Generación automática de informes**, con un dashboard donde se ve el número de casos ejecutados, porcentaje de éxito y detalle de los fallos.
- **Capturas de pantalla y vídeos** de cada ejecución, configurables, que sirven como evidencia para auditorías y para los procesos de subida a producción.

En la práctica, el sistema permite:

1. Cargar un CSV exportado desde Excel.
2. Lanzar una campaña de tests sobre la app real.
3. Obtener un informe visual con resultados, métricas y evidencias (imágenes/vídeo).

Esto tuvo un impacto directo en el equipo de operaciones de vuelo: pasaron de tener que validar a mano, caso a caso, durante horas o días, a poder lanzar campañas completas de pruebas en cadena y revisarlas de forma mucho más ágil y fiable, varias veces al mes.

> Toda esta arquitectura fue iniciativa personal, desarrollada completamente en mi tiempo libre antes de presentarla al equipo.

<p align="right"><a href="#top">(Ir arriba)</a></p>

---

## Comunicaciones multicapa

Este fue uno de los retos más duros del proyecto. El objetivo era claro pero nada trivial: **conectar la app híbrida con el motor de cálculo en C (CAPS) y entender cómo alimentar y leer esa “caja negra”**.

La documentación era muy mínima y las primeras pruebas no funcionaban. Durante un tiempo dependimos de un plugin Cordova legacy que “misteriosamente” hacía las llamadas correctas, pero sin explicar cómo. A partir de ahí tocó hacer ingeniería inversa y reconstruir la lógica con algo más sostenible.

Cuando el proyecto maduró y ya conocíamos mejor el sistema, pudimos avanzar:

- Para **Windows (Electron)** se generó una versión del motor como `.dll` y se creó una capa nativa específica que hacía de puente con esa librería: recibía los parámetros desde la app, llamaba a la DLL y devolvía los resultados.
- En **Angular**, la app usaba servicios distintos según la plataforma (Electron | iPad), seleccionados mediante un patrón tipo _Factory_, de forma que el resto del código no tuviera que preocuparse de los detalles de cada entorno.
- El motor trabajaba con un **array de números plano**, donde cada posición correspondía a una variable. Ese mapping se hizo prácticamente “a mano”: había parámetros obligatorios incluso cuando no aplicaban a ciertos cálculos y valores especiales que había que respetar para que el motor no fallase.
- La salida funcionaba igual: otro array donde cada índice tenía un significado concreto. Hasta que no descubrías qué representaba cada posición, era imposible interpretar los resultados.

Todo esto se hizo con documentación muy limitada y fragmentada, apoyándonos en el comportamiento del plugin antiguo y en muchas pruebas controladas. Fue un proceso largo, pero permitió que la app híbrida hablara de forma fiable con un motor crítico que nadie quería tocar, y sentó las bases para poder mantenerlo a futuro sin depender de “magia negra”.

<p align="right"><a href="#top">(Ir arriba)</a></p>

## Importación de datos

Otro reto importante fue diseñar el **proceso de importación de datos**. Yo definí la primera versión del flujo, que luego fue creciendo hasta convertirse casi en un subsistema complejísimo.

El problema, en resumen, era este:

- Cargar una lista de aeropuertos y sus propiedades desde un **XML** generado por un software legacy.
- Cargar y validar una **base de datos SQLite** con la información técnica necesaria para los cálculos: fases del vuelo, características de la flota, configuración específica de cada avión, modificaciones, etc.
- Detectar y corregir datos incoherentes (pistas con orientaciones > 360º, pistas invertidas, valores imposibles, etc.).
- Dejarlo todo en un formato que la aplicación pudiera consumir de forma rápida y consistente.

Para el XML diseñé un flujo de importación muy orientado a objetos:

1. El XML se parseaba a un objeto intermedio.
2. Ese objeto alimentaba una clase `AirportList`.
3. Cada aeropuerto se construía como instancia de `Airport`.
4. Cada aeropuerto creaba a su vez sus pistas (`Runway[]`), ajustando y corrigiendo datos en el propio constructor.

Al final del proceso teníamos en memoria un modelo limpio y coherente, que se volcaba a un único fichero JSON local. Este enfoque tenía varias ventajas:

- Podíamos **validar y limpiar** los datos antes de escribir nada en disco.
- En caso de fallo durante la importación, la app seguía funcionando con la lista anterior.
- La persistencia se reducía a un solo “commit” final, simple y fácil de razonar.

El flujo de **SQLite** era diferente:

- Primero se copiaba la base de datos a nivel de fichero usando el plugin de FileSystem de Ionic.
- Después se verificaba su integridad y coherencia frente a los datos de aeropuertos importados desde el XML.

Con el tiempo, el sistema de importación fue incorporando más tipos de datos, más reglas de validación y más pasos intermedios. Mi aportación evolucionó hacia **refactorizar y aplicar principios SOLID**: separar responsabilidades, aislar reglas de negocio y hacer que la lógica fuese más legible, testeable y sencilla de extender a futuro, sin tener que reescribir el núcleo cada vez que entraba un nuevo requisito.

<p align="right"><a href="#top">(Ir arriba)</a></p>

## Ciberataque

Pocos meses después de incorporarme, un ciberataque tumbó todos los repositorios y sistemas de la empresa (Akkodis, antes Akka Consulting). Nuestro equipo quedó sin herramientas para coordinarse ni para trabajar con el código.

Hablando con mi Team Lead buscamos una solución para **restaurar la continuidad de desarrollo**:

- En un equipo disponible monté un servidor Linux con arranque dual Windows / Linux.
- Instalé **Ubuntu Server** con un entorno gráfico ligero (XFCE).
- Desplegué una instancia de **GitLab Community**.
- Publiqué el servicio a través de mi red doméstica, abriendo los puertos necesarios para acceso externo.

De esta forma el equipo volvió a tener un repositorio remoto desde el que trabajar mientras los sistemas corporativos estaban caídos. Más adelante, mi Team Lead se hizo cargo de la máquina y le asignó una DNS adecuada para disponer de un entorno más seguro hasta que todo volvió a la normalidad.

No era mi especialidad, pero me permitió aprender y, sobre todo, evitar que el proyecto se quedara bloqueado.

---

## Transmisión y propagación

Uno de los primeros problemas a resolver fue la **comunicación de datos entre los distintos módulos** de la aplicación. En ese momento todavía tenía experiencia limitada, pero gracias a proyectos personales pude aplicar un modelo de transmisión basado en observables.

El enfoque fue:

- Diseñar una **clase abstracta** que implementase la lógica básica con Observable y BehaviorSubject<T>.
- Hacer que cada servicio de datos heredase de esta clase abstracta, añadiendo los métodos específicos y snapshots cuando eran necesarios.
- Orientar toda la comunicación entre módulos a flujos reactivos, logrando una experiencia mucho más fluida y responsive.
- Permitir persistencia local en fichero JSON en caso de requerirlo.

Este es el código documentado de la clase abstracta (implementación sencilla pero efectiva). En proyectos posteriores evolucioné este modelo hacia una implementación tipo Redux ligera, más dinámica que NgRx, pero eso ya no aplica a este proyecto en concreto.

```ts
import { JsonFileService } from "@services/file/json-file.service";
import { BehaviorSubject, Observable } from "rxjs";
import { Directory } from "efb-filesystem-plugin";
import { distinctUntilChanged } from "rxjs/operators";

/**
 * Used for preventing the observable to emit the same value twice at
 * {@link AbstractMenuController}
 */
const isDistinct: <T>(prev: T, curr: T) => boolean = (prev, curr) =>
  JSON.stringify(prev) === JSON.stringify(curr);

export abstract class AbstractObservableService<T> {
  public isChanged: boolean = false;
  public get value(): T[] {
    return this.bs.getValue();
  }

  protected bs: BehaviorSubject<T[]> = new BehaviorSubject<T[]>([]);
  protected observable: Observable<T[]> = this.bs.asObservable();

  /**
   * Optional. Filepath including filename. Only required if the
   * service will use read/write operations (json).
   */
  protected filePath?: string;

  /**
   * Optional. Default file to read data. If is not provided, then
   * charges an empty array. Just used in I/O operations.
   */
  protected defaultFile?: T[];

  /**
   * Optional. Directory where is the file. Default value is Directory.Documents.
   */
  protected directory: Directory = Directory.Documents;

  constructor(protected readonly jsonFileService?: JsonFileService) {}

  public emit(): void {
    const values: T[] = this.bs.getValue();
    this.bs.next(values);
  }

  /**
   * Loads input data into Observable. If {isFileWriteable()} then it will
   * write in json provided file.
   *
   * @param values {T[] | T}
   */
  public async updateObservable(values: T[] | T): Promise<void> {
    if (!Array.isArray(values)) values = [values];
    this.bs.next([]);
    values.forEach((value: T) => this.bs.getValue().push(value));
    this.bs.next(this.bs.getValue());

    if (this.isFileWriteable())
      await this.jsonFileService.write(values, this.filePath, this.directory);
  }

  /**
   * Returns all stored airfields as observable.
   *
   * @returns {Observable<T[]>}
   */
  public getObservable(): Observable<T[]> {
    return this.observable;
  }

  /**
   * Clears all on-memory stored items and the json file too.
   * If {isFileWriteable()} then it will write in json provided file.
   */
  public clearObservable(): void {
    this.bs.next([]);
    if (this.isFileWriteable())
      this.jsonFileService.write([], this.filePath, this.directory);
  }

  /**
   * Loads data from a file. Needs to be used on extender class.
   *
   * Updates the observable with data stored in file. If data not available,
   * then uses a default file provided. If no default file provided, then
   * uses an empty array as data.
   *
   * If service is not writeable throws an error.
   */
  protected async loadFromFile(): Promise<void> {
    if (!this.isFileWriteable())
      throw new Error(
        "Service is not writable! You can not load data from a file."
      );
    const exists: boolean = await this.jsonFileService.exists(
      this.filePath,
      "",
      this.directory
    );
    if (exists) {
      const response = await this.jsonFileService.read(
        this.filePath,
        this.directory
      );
      await this.updateObservable(response);
    } else {
      await this.updateObservable(this.defaultFile || []);
    }
  }

  /**
   * Checks if service should write into a json provided file.
   * If no filename or jsonFileService provided then it does not
   * write into file.
   *
   * @returns {boolean} True if isFileWriteable.
   */
  private isFileWriteable(): boolean {
    return this.filePath !== undefined && this.jsonFileService !== undefined;
  }
}
```
