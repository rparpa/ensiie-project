module.exports = class  {
    constructor(url) {
        this.url = url;
    }

    fetch (path, options) {
        return fetch(this.url + path, options).then(response => response.json());
    }
    
};