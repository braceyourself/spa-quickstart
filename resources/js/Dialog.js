export default new class {
    constructor(name){

    }
    ask(question){
        Vue.$modal.show('dialog',{
            title:question,
        })
    }

    showDialog(text) {
    }
}
