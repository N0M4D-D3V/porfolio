---
title: Portfolio
description: Rogue Syntax's projects and programs.

projects:
  - title: "Codere NEWCO"
    link: https://www.grupocodere.com/
    technologies:
      - "Hybrid Apps"
      - "Angular"
      - "Ionic"
      - "Capacitor"
      - "Electron"
      - "Java/Swift"
      - "Push Notifications"
      - "NgRx/RxJs"
      - "I+D+i"
    content:
      - Responsible for developing applications for the loyalty club. We use a powerful architecture (ARCA) to encapsulate REDUX. I integrated the core part of this architecture myself. I also kept dependencies up to date and integrated native functionalities into plugins to ensure clean and structured code.
      - <strong>· Spain Appset:</strong> Improved overall performance using @defer and independent loaders. The app features a communication layer with Electron, reusable components, and animation implementations using CSS, Ionic Animations, and Angular Animations.
      - <strong>· LATAM Appset:</strong> The apps are built on a robust architecture that unifies code across multiple applications in Latin America, making maintenance easier, improving scalability, and reducing development time. Successfully handled push notifications across all scenarios and systems.
      - <strong>· Push Agent:</strong> Developed a push notification management system. It includes a custom-built server, an internal database (Derby), and a mechanism for sending push notifications at no cost. The system uses its own internal communication protocol and exposes endpoints, WebSockets, and file ingestion for integration with external systems.
      - <strong>· ARCA:</strong> The Automatic REDUX Core Architecture (ARCA) is a technical framework that encapsulates NgRx. I extracted the software into a standalone library and replaced NgRx dependencies with a custom REDUX implementation, making it significantly lighter and faster.
      - <strong>· CMS Administrator:</strong> I participated in migrating the corporate websites into the new CMS, LifeRay.
  - title: "Airbus Defence & Space"
    link: https://www.airbus.com/en
    technologies:
      - "Hybrid Apps"
      - "Angular"
      - "Ionic"
      - "Capacitor"
      - "Electron"
      - "Appium/Jasmine/WebDriverIO"
      - "Python"
      - "I+D+i"
    content:
      - Aerospace calculation application for military operations. A technical challenge that led me to take on a leadership role, create custom plugins, develop automation scripts, and implement file security measures.
      - <strong>· LTA+:</strong> Developed the application from scratch, making key decisions regarding the technical architecture and communication between modules.
      - <strong>· E2E Testsuit:</strong> Own initiative. End-to-end (E2E) testing architecture for iOS applications. Dynamically builds tests based on an Excel file, allowing non-technical staff to modify tests easily.
      - <strong>· Filesystem Fork:</strong> Fork of the official Ionic Filesystem plugin with added support for Electron. The project required file operations on Windows and iOS. Since no suitable alternatives were available, we iterated on the official plugin and added additional functionality.
      - <strong>· EFB SFTP:</strong> Native implementation of the SFTP (SSH File Transfer Protocol), integrated for both Electron and iOS.
      - <strong>· EFB ZIP:</strong> Native plugin for file compression and decompression operations. Supports password management and is implemented for Electron and iOS.
  - title: "AutoTrade — SaaS Desktop Solution for Automated Trading"
    link: https://autotrade-pro.com
    technologies:
      - "Desktop App"
      - "Python"
      - "Angular"
      - "NodeJS"
      - "Webhooks"
      - "Sockets"
      - "Architecture"
      - "I+D+i"
    content:
      - "Launched in early August 2025, AutoTrade is a SaaS desktop platform that enables users to deploy and run their algorithms across any market, saving time and energy while scaling operations without manual intervention."
      - <strong>· Stripe & Firebase Integraton:</strong> AutoTrade uses Stripe for payment processing and Firebase for account management. Both platforms are synchronized through internal events and webhooks, ensuring that databases remain up-to-date in real time.
      - <strong>· Software Architecture:</strong> One of the project’s most significant achievements is its architecture. It functions similarly to an Electron app but is built entirely in pure Python with a modular design. Modules are separated into backend (Flask), automation engine, scheduler, SSCA (Socket Communication Agent) and webhook (Node.js). All modules communicate via local sockets using a proprietary protocol (SSCA & CSCA).
      - <strong>· Backend Module:</strong> Built with Flask and running on a dedicated thread, the backend serves the Angular-based frontend and handles OS-level communication with the user.
      - <strong>· Automation Engine:</strong> Stays idle until triggered from the main thread, at which point it spawns secondary threads. This module is responsible for executing, saving, and deleting click automation routines — the core functionality of AutoTradePro. Automations can be triggered manually, via scheduled tasks, local sockets, or webhooks, providing maximum connectivity and integration.
      - <strong>· Scheduler Module:</strong> Runs in its own thread and enables the scheduling of automations for specific dates or at recurring intervals (e.g., every 15 minutes).
      - <strong>· SSCA (Server Socket Communication Agent):</strong> Serves as the core communication layer between threads. Its custom implementation can also be accessed by external systems.
      - <strong>· Webhook Module:</strong> The only Node.js-based component, this module connects AutoTrade to external systems over the network (e.g., TradingView). Compiled into a binary, it runs in parallel whenever the user’s subscription includes webhook capabilities.
  - title: "Fitness Hub"
    link: https://play.google.com/store/apps/details?id=app.fitness.hub
    github: https://github.com/N0M4D-D3V
    technologies:
      - "Hybrid Apps"
      - "Angular"
      - "Ionic"
      - "Capacitor"
      - "DexieJS"
      - "Chart.js"
      - "Java"
    content:
      - Tracks your water intake, steps, weight, and supplements. Free, ad-free, and 100% offline. Make fitness an easy and accessible habit! Hybrid tracking, fitness, and health app. I handled the entire process—from design to architecture, including publishing on the app stores. Additionally, I developed a strategy to grow the user base, scale the business, and implement monetization.
      - <strong>· Pedometer:</strong> Custom plugin for native layer interaction. Manages step counting (Android-only).
  - title: "P4RZ1V4L & L4NC4L0T"
    github: https://github.com/N0M4D-D3V
    technologies:
      - "Python"
      - "Quant"
      - "Algorithmic Trading"
      - "Linux"
      - "I+D+i"
    content:
      - "Automation bots for trading strategies."
      - <strong>· P4RZ1V4L:</strong> Terminal-based environment for backtesting trading bots. Includes genetic algorithms and other systems to fine-tune input parameters. Uses an architecture that abstracts the backtesting process.
      - <strong>· L4NC3L0T:</strong> Automated trading bot. Executes trading strategies autonomously within a terminal environment.
  - title: "Demiurge"
    github: https://github.com/N0M4D-D3V
    technologies:
      - "Angular"
      - "Python"
      - "Selenium"
    content:
      - "The word 'Demiurge' comes from the Greek 'dēmiourgós' meaning 'maker,' 'artisan,' 'producer,' and ultimately, 'creator.' Demiurge is a set of utilities designed to streamline my workflows and automate processes."
      - <strong>· Demiurge:</strong> Component library to accelerate Angular application development, specifically tailored for hybrid applications.
      - <strong>· Youtube2ivooX:</strong> Automation of the process for downloading and extracting audio from YouTube, then uploading it to iVoox.
  - title: "Blazebooks"
    github: https://github.com/N0M4D-D3V
    technologies:
      - "Hybrid Apps"
      - "Native Apps"
      - "Angular"
      - "Ionic"
      - "Capacitor"
      - "NodeJS"
      - "NestJS"
      - "Kotlin/Java"
    content:
      - "Dive into interactive stories where every choice impacts the plot and character behavior."
      - <strong>· Blazebook Mobile App:</strong> Mobile and web application for reading interactive books. Features a technical architecture designed to interpret interactive stories in an abstract way.
      - <strong>· Blaze server:</strong> NodeJS/NestJS server that manages users, handles files, and administers the database. Hosted on a dedicated local PC, separate from the frontend.
      - <strong>· Blazebooks (old):</strong> Old application. Native. It was my final degree project. I received top honors.
  - title: "Old projects"
    github: https://github.com/N0M4D-D3V
    technologies:
      - "Angular"
      - "Ionic"
      - "Python"
      - "Firebase"
      - "Bootstrap"
      - "PhaserJS"
    content:
      - "Collection of old, unrelated projects. Some of them were very useful for building certain architectural components and acquiring new knowledge."
      - <strong>· Dropsher:</strong> A tech entrepreneurship initiative focused on developing a drag-and-drop platform for creating no-code applications. While the project was ultimately discontinued, it provided valuable experience in collaboration, leadership, and people management.
      - <strong>· Rainclouds Web:</strong> Website for the Atmospheric Black Metal band RAZAK. It was in production for several years.
      - <strong>· Retro Games:</strong> Retro arcade game application. The goal was to offer a collection of classic games optimized for mobile devices. To integrate Phaser with Angular, I had to build an architecture component based on RXJS. This component has remained a core part of all the systems I've integrated since, due to its usefulness and versatility.
      - <strong>· Stoic Manager:</strong> Personal management application inspired by Stoic principles. Designed to help users organize their daily tasks.
      - <strong>· Battle Of Numbers:</strong> Terminal-based game. Developed using Termux on a mobile phone. It has no dependencies.
---
