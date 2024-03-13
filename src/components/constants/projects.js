import { LINKS } from "./resources";

export const PROJECTS = [
  {
    name: "Blazebooks",
    isActive: true,
    description:
      "In Blazebooks, you'll immerse yourself in stories where every choice you make impacts the plot development and the fate of the characters.",
    url: `${LINKS.github}/YandrosChaos`,
    github: `${LINKS.github}/blazebooks`,
    highlights: ["Angular", "Capacitor"],
  },
  {
    name: "Blazebooks Server",
    isActive: true,
    description:
      "NodeJS/NestJS server for blazebooks. User, files and database management.",
    url: `${LINKS.github}/YandrosChaos`,
    github: `${LINKS.github}/blazebooks-server`,
    highlights: ["NestJS and NodeJS"],
  },
  {
    name: "Demiurge",
    isActive: true,
    description:
      "The word 'demiurge' is a word derived form of the Greek dēmiourgós. It was a noun meaning 'craftsman' or 'artisan', but gradually came to mean 'producer' and eventually 'creator'.",
    url: `${LINKS.github}/YandrosChaos`,
    github: `${LINKS.github}/demiurge`,
    highlights: ["Custom Angular library"],
  },
];
