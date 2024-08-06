import Kotlin from "@/icons/skills/Kotlin.astro";
import Angular from "@/icons/skills/Angular.astro";
import Apple from "@/icons/skills/Apple.astro";
import Capacitor from "@/icons/skills/Capacitor.astro";
import Docker from "@/icons/skills/Docker.astro";
import ElectronJs from "@/icons/skills/ElectronJs.astro";
import Git from "@/icons/skills/Git.astro";
import HTML from "@/icons/skills/HTML.astro";
import Ionic from "@/icons/skills/Ionic.astro";
import Java from "@/icons/skills/Java.astro";
import Linux from "@/icons/skills/Linux.astro";
import NestJS from "@/icons/skills/NestJS.astro";
import Python from "@/icons/skills/Python.astro";
import Spring from "@/icons/skills/Spring.astro";
import SQL from "@/icons/skills/SQL.astro";
import Windows from "@/icons/skills/Windows.astro";
import Node from "@/icons/skills/Node.astro";
import CSS from "@/icons/skills/CSS.astro";
import Web from "./common/Web.astro";
import Hybrid from "./common/Hybrid.astro";
import Multi from "./common/Multi.astro";
import Bootstrap from "./skills/Bootstrap.astro";

// QA & Automation
import Jasmine from "@/icons/skills/Jasmine.astro";
import Appium from "@/icons/skills/Appium.astro";
import WDIO from "@/icons/skills/WDIO.astro";

export const SKILLS_ICONS: Record<any, any> = {
  // common
  Multi,
  Web,
  Hybrid,
  Git,
  Docker,

  // OS
  Linux,
  Apple,
  Windows,

  // Tech
  Angular,
  Ionic,
  ElectronJs,
  Node,
  NestJS,
  Capacitor,
  Java,
  Python,
  Kotlin,
  CSS,
  HTML,
  Spring,

  // QA & Automation
  Jasmine,
  Appium,
  WDIO,
  
  // Styling
  Bootstrap,
  Material: Angular,

  // Databases
  SQL,
};
