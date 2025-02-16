<script>
  const rootEl = typeof document !== 'undefined' ? document.documentElement : null;
  const themes = ['light', 'dark'];
  let theme = ''

  if (typeof localStorage !== 'undefined' && localStorage.getItem('theme')) {
    theme = localStorage.getItem('theme');
  } else if (typeof window !== 'undefined' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    theme = 'dark';
  }

  function handleChange(event) {
    theme = event.target.value;
    localStorage.setItem('theme', theme);
  }

  $: if (rootEl && theme === 'light') {
    rootEl.classList.remove('theme-dark');
  } else if (rootEl && theme === 'dark') {
    rootEl.classList.add('theme-dark');
  }

  const icons = [
    `<svg 
      xmlns="http://www.w3.org/2000/svg" 
      fill="currentColor" 
      width="24"
      height="24"
      viewBox="0 0 24 24"
      >
        <path 
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M13 0h-2v4h2V0ZM0 11v2h4v-2H0Zm24 0v2h-4v-2h4ZM13 24h-2v-4h2v4ZM8 6h8v2H8V6ZM6 8h2v8H6V8Zm2 10v-2h8v2H8Zm10-2h-2V8h2v8Zm2-14h2v2h-2V2Zm0 2v2h-2V4h2Zm2 18h-2v-2h2v2Zm-2-2h-2v-2h2v2ZM4 2H2v2h2v2h2V4H4V2ZM2 22h2v-2h2v-2H4v2H2v2Z"/> 
    </svg>`,
    `
    <svg 
      xmlns="http://www.w3.org/2000/svg" 
      fill="currentColor" 
      width="24"
      height="24"
      viewBox="0 0 24 24"
    >
        <path 
        fill-rule="evenodd"
        clip-rule="evenodd"
        d="M6 2h8v2h-2v2h-2V4H6V2ZM4 6V4h2v2H4Zm0 10H2V6h2v10Zm2 2H4v-2h2v2Zm2 2H6v-2h2v2Zm10 0v2H8v-2h10Zm2-2v2h-2v-2h2Zm-2-4v-2h2v-2h2v8h-2v-4h-2Zm-6 0h6v2h-6v-2Zm-2-2h2v2h-2v-2Zm0 0V6H8v6h2Zm8-10h2v2h2v2h-2v2h-2V6h-2V4h2V2Z"/>
    </svg>`,
  ];
</script>


<div class="theme-toggle">
  {#each themes as t, i}
    <label class={theme === t ? 'checked' : ''}>
      {@html icons[i]}
      <input
        type="radio"
        name="theme-toggle"
        checked={theme === t}
        value={t}
        title={`Use ${t} theme`}
        aria-label={`Use ${t} theme`}
        on:change={handleChange}
      />
    </label>
  {/each}
</div>
