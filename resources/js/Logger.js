export default class Logger {

    constructor(name){
        this.name = name;
    }

    log(...args){
        console.log(`[${this.name}]`, ...args)
    }

}