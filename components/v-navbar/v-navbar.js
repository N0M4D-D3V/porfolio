export class VNavbar extends HTMLElement {
  _id = "v-navbar";

  constructor() {
    super();

    // Create a shadow DOM for the component
    this.attachShadow({ mode: "open" });
    const template = document.createElement("template");
    //add css
    template.innerHTML = `<link rel="stylesheet" href="./components/${this._id}/${this._id}.css">`;
    //add html
    template.innerHTML += `
    <nav id="${this._id}">
        <div class="container">
            <a id="menu-button">
                <img id="favicon" src="../../assets/icon/favicon.svg" alt="favicon" width="30" height="24">
            </a>
            <div id="search-container">
                <button id="search-button">S</button>
                <input type="text" id="search-input" placeholder="Search...">
            </div>
        </div>
    </nav>
      `;

    // Clone the template content into the shadow DOM
    this.shadowRoot.appendChild(template.content.cloneNode(true));

    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", this.afterDOMLoaded());
  }

  afterDOMLoaded() {
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
  }
}

// Define the custom element
customElements.define("v-navbar", VNavbar);
