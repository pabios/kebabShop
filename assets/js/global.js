document.addEventListener("DOMContentLoaded", function(){
    console.log('marche ') 
    const buttons = document.querySelectorAll('.button');
    const nb = document.querySelector('#qty');
    console.log(buttons);
    const qty = document.querySelectorAll('.qty');
    console.log(nb);
    console.log('est le nb');

    let info = document.querySelector('#info');
    let voir = document.querySelector('#voir');
    let vider = document.querySelector('#vider');
    
    
    fetch('http://127.0.0.1:8003/quantity/')
    .then(res => {
        if(res.ok){
            return res.json()
        }
    })
    .then(data =>{
          console.log(data)
          nb.innerHTML += data;
          if(data >0){
             info.innerHTML = `<p> votre panier contient ${data} kebab </p>`;
             voir.innerHTML = `<p class="badge bg-secondary">voir</p>`
             vider.innerHTML = `  <p class="badge bg-secondary">vider</p>`
          }else{
            info.innerHTML = `<p> votre panier est vide </p>`;
          } 
        }
    )

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