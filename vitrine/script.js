/*
  Placez dans ce fichier le code Javascript nécessaire au fonctionnement de l'application vitrine
*/

let requestMovies = async function(){
  let response = await fetch("../server/script.php?action=getmovies");
  let data = await response.json();
  if (data.length>0){
    renderTemplate('.movies-template', data, '#movies');
  }
}




let requestTrailer = async function(idf){
  let response = await fetch("../server/script.php?action=getmovie&id_film=" + idf);
  let data = await response.json();
  if (data.length>0){
    renderTemplate('.movie-trailer-template', data, '#movies');
  }

}


let requestCategory = async function(){
  let response = await fetch("../server/script.php?action=getcategory");
  let data = await response.json();
  if (data.length>0){
    renderTemplate2('.movie-category-template', data, '#category__container');
  }
}

let requestMovieCategory = async function(c){
  if (c == 0) {
    requestMovies();
  }
  else {
    let response = await fetch("../server/script.php?action=getmovies&id_category=" + c);
    let data = await response.json();
    if (data.length>0){
      renderTemplate('.movies-template', data, '#movies');
    }
  }
}

requestMovies();
requestCategory();


let requestProfile = async function(){
  let response = await fetch("../server/script.php?action=getprofiles");
  let data = await response.json();
  if (data.length>0){
    renderTemplate('.profile-template', data, '#profile__container');
  }
}

requestProfile();


let requestAddToPlaylist = async function(idf, idp){
  await fetch("../server/script.php?action=addtoplaylist&id_film=" + idf + "&id_profile=" + idp);
}

let requestPlaylist = async function(idp){
  let response = await fetch("../server/script.php?action=getplaylist&id_profile=" + idp);
  let data = await response.json();
  renderTemplate('.movies-playlist-template', data, '#movies');

}

let requestRemoveFromPlaylist = async function(idf, idp){
  await fetch("../server/script.php?action=removefromplaylist&id_film=" + idf + "&id_profile=" + idp);
}

let requestPromotion = async function(){
  let response = await fetch("../server/script.php?action=getpromotion");
  let data = await response.json();
  if (data.length>0){
    renderTemplate('.movies-promotion-template', data, '#movies-promotion');
  }
}

requestPromotion();



/* Fonction renderTemplate (c'est cadeau)

   Sous certaines conditions, cette fonction est capable de formater n'importe quel
   template avec n'importe quelles données. Une sorte de rendu de template "universelle".
   A condition que :
    - les données sont structurées dans des objets avec des propriétés qui sont des chaines ou des nombres
      Si vous avez des propriétés qui sont des tableaux ou des sous-objets ça ne marchera pas.
    - les tags dans le template à formater sont les noms des propriétés des objets encadrées de {{ et }}

    Rôle des paramètre : 
    tpl : le selecteur CSS du template à utiliser
    data : un tableau d'objets (chaque objet sera rendu avec le template tpl)
    where : le selecteur CSS de l'élément "conteneur" ou les templates formatés doivent apparaître dans la page

    Note : data est forcément un tableau d'objets. Si vous n'avez qu'un seul objet pour formater, data 
    devra quand même être un tableau avec ce seul objet dedans.

*/

let renderTemplate = function(tpl, data, where)
{
    let template = document.querySelector(tpl);
    let res = "";
    for(let elem of data)
    {
      let html = template.innerHTML;
      for(let prop in elem)
      {
        html = html.replaceAll("{{"+prop+"}}", elem[prop]);
      }
      res += html;
    }
    document.querySelector(where).innerHTML = res;
}

let renderTemplate2 = function(tpl, data, where)
{
    let template = document.querySelector(tpl);
    let res = "";
    for(let elem of data)
    {
      let html = template.innerHTML;
      for(let prop in elem)
      {
        html = html.replaceAll("{{"+prop+"}}", elem[prop]);
      }
      res += html;
    }
    document.querySelector(where).insertAdjacentHTML("beforeend", res);
}