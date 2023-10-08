export class MyComponent extends HTMLElement {
  name = "my-component";

  constructor() {
    super();

    // Create a shadow DOM for the component
    this.attachShadow({ mode: "open" });
    const template = document.createElement("template");
    template.innerHTML = `
        <link rel="stylesheet" href="./components/my-component/my-component.css">
        <nav id='${this.name}'>
        <div class="container">
          <a id='menu-button'>
            <img id='favicon' src="../../assets/icon/favicon.svg" alt="favicon" width="30" height="24">
          </a>
        </div>
      </nav>
      `;

    // Clone the template content into the shadow DOM
    this.shadowRoot.appendChild(template.content.cloneNode(true));

    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", () => {
      const favicon = this.shadowRoot.getElementById("favicon");
      const menuButton = this.shadowRoot.getElementById("menu-button");

      menuButton.addEventListener("click", () => {
        // Add the 'rotated' class to trigger the rotation animation
        favicon.classList.add("rotated");

        // Remove the 'rotated' class after the animation completes
        setTimeout(() => {
          favicon.classList.remove("rotated");
        }, 500); // Adjust the time to match the animation duration (0.5s in this case)
      });
    });
  }
}

// Define the custom element
customElements.define("my-component", MyComponent);
