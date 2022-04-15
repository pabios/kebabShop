let resultat = document.querySelector('#resultat');
let form = document.querySelector('#form');
let datalist = document.querySelector('#datalist');


fetch('http://localhost:8003/apiSearch')
    .then(res => {
        if(res.ok){
            return res.json()
        }
    })
    .then(data =>{
          console.log(data)

          for(rep of data){
            //resultat.innerHTML += `<p> ${rep} </p>`;
          } 
          /*nb.innerHTML += data;
          if(data >0){
             info.innerHTML = `<p> votre panier contient ${data} kebab </p>`;
             voir.innerHTML = `<p class="badge bg-secondary">voir</p>`
             vider.innerHTML = `  <p class="badge bg-secondary">vider</p>`
          }else{
            info.innerHTML = `<p> votre panier est vide </p>`;
          } */
          return data;
        }
    )

     

    function search(){
      //e.preventDefault();
        fetch('http://localhost:8003/apiSearch')
        .then(res => {
            if(res.ok){
               return res.json()
            }
        })
        .then(data =>{
            console.log(data)

            //var aBlock = doc.createElement('block').appendChild(doc.createElement('b'));
          datalist.innerHTML = '';
            for(let dat of data){
                //resultat.innerHTML +=`<p> ${dat}</p>`
                datalist.innerHTML+=`<option value="${dat}">${dat}</option>`
            }
            }
       )
       .catch(e => {
           console.log('erreur de lecture api'+e);
       })
   }
   form.addEventListener('keyup',search,false)