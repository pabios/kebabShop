document.addEventListener("DOMContentLoaded", function(){
    console.log('marche stp') 
    let buttons = document.querySelectorAll('.button');
    let nb = document.querySelector('#qty');
    console.log(buttons);
    let qty = document.querySelectorAll('.qty');
    console.log(qty);

    function setQuantity(){
        let qantite =0;
        for(let qt of qty){
            qantite += parseInt(qt.value);
        }
        console.log(qantite)
        nb.innerHTML = qantite;
    }

    setQuantity();

    for(let button of buttons){
        button.addEventListener("click", function(e){
            e.preventDefault();
            console.log(this.id);
            fetch('http://127.0.0.1:8003/addToCart/'+this.id+"?quantity="+document.querySelector("#quantity"+this.id).value)
            setQuantity();

        });
    }
});

// bouton.addEventListener("click",function(){
//     fetch('post/api/'+number)
// .then(function(response){
//     return response.text();
// }).then(function(html){
//     posts.innerHTML+=html;
//     number+=5;
//     console.log(html);
// });