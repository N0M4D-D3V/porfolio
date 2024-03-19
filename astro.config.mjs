import { defineConfig } from "astro/config";
import svelte from "@astrojs/svelte";
import mdx from "@astrojs/mdx";
import tailwind from "@astrojs/tailwind";
import remarkGfm from "remark-gfm";
import remarkSmartypants from "remark-smartypants";
import rehypeExternalLinks from "rehype-external-links";

// https://astro.build/config
export default defineConfig({
  site: "https://gg-victor.dev",
  integrations: [mdx(), svelte(), tailwind()],
  markdown: {
    shikiConfig: {
      theme: "nord",
    },
    remarkPlugins: [remarkGfm, remarkSmartypants],
    rehypePlugins: [
      [
        rehypeExternalLinks,
        {
          target: "_blank",
        },
      ],
    ],
  },
});
