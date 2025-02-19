

class App {
    constructor() {
        // hier Instanzen initiieren.
        console.log("Hello App!");
        let appDiv = this.find("app");
        if (appDiv) {
            appDiv.innerHTML = "<b>Gefunden!</b>";
        }
    }

    find = (elementId) => {
        return  document.getElementById(elementId);
    }

    findByClassName = (className) => {
        return  document.getElementsByClassName(className);
    }

}

const app = new App();