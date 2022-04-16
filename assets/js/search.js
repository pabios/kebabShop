document.addEventListener("DOMContentLoaded", function(){

      let resultat = document.querySelector('#resultat');
      let leInput = document.querySelector('#form');
      let datalist = document.querySelector('#datalist');

      // console log resultat apiSearch
      fetch('http://localhost:8003/apiSearch')
          .then(res => {
              if(res.ok){
                  return res.json()
              }
          })
          .then(data =>{
              // console.log(data)
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
              .then(datas =>{
                  console.log(datas)
                  console.log('est le resultat a suggerer ');

                  //var aBlock = doc.createElement('block').appendChild(doc.createElement('b'));
                    datalist.innerHTML = '';
                    for(let data of datas){
                        //resultat.innerHTML +=`<p> ${dat}</p>`
                        datalist.innerHTML+=`<option value="${data}">${data}</option>`
                    }
                  }
            )
            .catch(e => {
                console.log('erreur de lecture api'+e);
            })
        }
        leInput.addEventListener('keyup',search,false)


          // debut submit
        function searchSubmit(e){
          e.preventDefault();
            fetch('http://localhost:8003/apiSearchSubmit')
            .then(res => {
                if(res.ok){
                  return res.json()
                }
            })
            .then(data =>{
              console.log('est le resultat a afficher ');

                console.log(data)

              //var aBlock = doc.createElement('block').appendChild(doc.createElement('b'));
              //datalist.innerHTML = '';
                  for(let dat of data){
                      resultat.innerHTML +=`<p> ${dat}</p>`
                  }
                }
          )
          .catch(e => {
              console.log('erreur de lecture api'+e);
          })
      }
      form.addEventListener('submit',searchSubmit,false)
});