class Singleton {
    constructor(){
        const instance = this.constructor.instance;
        if(instance){
            return instance;
        }
        this.constructor.instance = this;
    }
    businessLogic(){
        console.log("Here we implement business logic like Database.");
    }
}
let s1 = new Singleton();
let s2 = new Singleton();
console.log(s1==s2);
s1.businessLogic();
s2.businessLogic();