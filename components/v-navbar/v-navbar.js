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
            <div id="menu" class="menu">
              <div class="menu-item">Blog</div>
              <div class="menu-item">Portfolio</div>
              <div class="menu-item">Contacto</div>
            </div>
            <div id="search-container">
                <button id="search-button"><img src='../../assets/icon/search.svg'alt='search' width='30' height='24' /></button>
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

  afterDOMLoaded() {}
}

// Define the custom element
customElements.define("v-navbar", VNavbar);
