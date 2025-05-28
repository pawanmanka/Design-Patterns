class Singleton {
    constructor(){
        if(Singleton.instance){
            return Singleton.instance;
        }
        this.timestamp = new Date().toISOString();
        Singleton.instance = this;
    }
    log(){
        console.log('Singleton instance at:', this.timestamp);
    }
}
const a = new Singleton();
const b = new Singleton();

a.log();
b.log();
setTimeout(()=>b.log(),5000);