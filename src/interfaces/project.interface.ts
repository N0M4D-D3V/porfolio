export interface Project {
  url: string;
  description: string;
  highlights: string[];
  name: string;
  isActive?: boolean;
  github?: string;
  image?: string;

  children?: Project[];
}
