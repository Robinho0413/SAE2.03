
let requestCategory = async function(){
    let response = await fetch("../server/script.php?action=getcategory");
    let data = await response.json();
    if (data.length>0){
      renderTemplate('.movie-category-template', data, '#category__container');
    }
}


let requestProfile = async function(){
  let response = await fetch("../server/script.php?action=getprofiles");
  let data = await response.json();
  if (data.length>0){
    renderTemplate('.profile-template', data, '#profile__container');
  }
}

requestProfile();


let requestMovies = async function(){
  let response = await fetch("../server/script.php?action=getmovies");
  let data = await response.json();
  if (data.length>0){
    renderTemplate('.movies-promotion-template', data, '#promotion__container');
  }
}

requestMovies();



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

requestCategory();