$(document).ready(function () {
  var options = {
    tab: "left",
    className: "checkmark",
    slideImageIndexPage: 1,
    slideImageIndexPageHome: 1,
    showMenuSlider: true,
    showMenuAtStart: false,
    startPage: "menu",
  };

  var slide = [
    {
      image: "media/image/background/01.svg",
      title:
        '<span class="supersized-caption-title">Angular<br/>Framework</span><br/><br/> Angular is a widely popular and powerful front-end framework for building dynamic web applications.<br/><br/> These key features and aspects of Angular contribute to its popularity and make it a versatile framework for developing modern web applications. Whether you\'re building a small project or a large-scale enterprise application, Angular provides a solid foundation for creating dynamic and scalable front-end solutions.<br/><br/><a href="https://angular.io/" target="_blank">Website</a>',
    },
    {
      image: "media/image/background/02.svg",
      title:
        '<span class="supersized-caption-title">Ionic<br/>Framework</span><br/><br/>Ionic is a powerful and popular framework for building cross-platform mobile applications.<br/><br/> Ionic is a versatile framework that combines the power of web technologies with the ability to create native-like mobile apps. Whether you\'re a beginner or an experienced developer, Ionic provides the tools and resources necessary to build high-quality cross-platform applications efficiently.<br/><br/><a href="https://ionicframework.com/" target="_blank">Website</a>',
    },
    {
      image: "media/image/background/03.svg",
      title:
        '<span class="supersized-caption-title">Capacitor<br/>Framework</span><br/><br/> Capacitor offers a powerful solution for hybrid mobile app development, providing access to native device functionality, cross-platform compatibility, and a familiar web-based development experience. By leveraging Capacitor, developers can efficiently build mobile applications that deliver a native-like experience while maximizing code reusability across different platforms.<br/><br/><a href="https://capacitorjs.com/" target="_blank">Website</a>',
    },
    {
      image: "media/image/background/04.svg",
      title:
        '<span class="supersized-caption-title">Electron<br/>Framework</span><br/><br/>Electron is a powerful framework for building cross-platform desktop applications. Understanding these key aspects of Electron can help developers leverage its capabilities to build powerful and cross-platform desktop applications using familiar web technologies.<br/><br/><a href="https://www.electronjs.org/" target="_blank">Website</a>',
    },
    {
      image: "media/image/background/05.svg",
      title:
        '<span class="supersized-caption-title">Typescript<br/>Programming Language</span><br/><br/> TypeScript is a powerful programming language that offers several key advantages for software development. By leveraging TypeScript\'s strong typing, IDE support, modern JavaScript features, code maintainability, and the thriving community, developers can create robust and scalable applications with improved productivity and fewer errors.<br/><br/><a href="https://www.typescriptlang.org/" target="_blank">Website</a>',
    },
    // {
    //   image: "media/image/background/06.svg",
    //   title:
    //     '<span class="supersized-caption-title">Bekohlicious!<br/>By 55Laney69</span><br/><br/>Canon 550D + Canon 50mm F1.8 EF II @F1.8 :). Cross Processed with Alien Skin Exposure<br/><br/><a href="http://www.flickr.com/photos/hansel5569/6001781706/in/photostream/">Author Website</a>',
    // },
  ];

  var audio = [{ mp3: "media/audio/Kondor-Love-Your-Life-Outro-track.mp3" }];

  var page = {
    "about.html": {
      tab: "left",
      className: "checkmark",
      slideImageIndexPage: 1,
    },
    "services.html": {
      tab: "right",
      className: "features",
      slideImageIndexPage: 2,
    },
    "portfolio.html": {
      tab: "left",
      className: "image",
      slideImageIndexPage: 3,
    },
    "contact.html": { tab: "left", className: "mail", slideImageIndexPage: 5 },
  };

  $("#nostalgia").nostalgia(options, page, slide, audio, config, configDefault);
});
