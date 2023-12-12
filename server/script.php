<?php

/*

  Dans ce fichier, on se charge de répondre aux requêtes HTTP émises par les applications
  front vitrine et back office.
  Le traitement de la requête, la réponse à retourner est fonction des valeurs paramètres présents
  dans la requête.

*/

require("model.php");

if ( isset($_REQUEST['action']) && $_REQUEST['action'] =='getmovies'){
  if ( isset($_REQUEST['id_category'])) {
    $cat = getCategory($_REQUEST['id_category']);
    echo json_encode($cat);
    exit();
  }
  else {
    $film = getMovies();
    echo json_encode($film);
    exit();
  }
}


if ( isset($_REQUEST['action']) && $_REQUEST['action']=='addmovie'){
  $titre = $_REQUEST['titre'];
  $realisateur = $_REQUEST['realisateur'];
  $annee_sortie = $_REQUEST['annee_sortie'];
  $url_affiche = $_REQUEST['url_affiche'];
  $url_trailer = $_REQUEST['url_trailer'];
  $id_category = $_REQUEST['id_category'];
  $ok = addMovie($titre, $realisateur, $annee_sortie, $url_affiche, $url_trailer, $id_category);
  if ($ok>0){
    echo "Le film a bien été ajouté";
  }
  else{
    echo "un problème est survenu";
  }
  exit();
}


if ( isset($_REQUEST['action']) && $_REQUEST['action'] =='getmovie'){
  $id_film = $_REQUEST['id_film'];
  $film = getMovie($id_film);
  echo json_encode($film);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] =='getcategory'){
  $cat = getCategories();
  echo json_encode($cat);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] =='getprofiles'){
  $prof = getProfiles();
  echo json_encode($prof);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='addprofile'){
  $name_profile = $_REQUEST['name_profile'];
  $ok = addProfile($name_profile);
  if ($ok>0){
    echo "Le profil a bien été ajouté";
  }
  else{
    echo "un problème est survenu";
  }
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='addtoplaylist'){
  $id_film = $_REQUEST['id_film'];
  $id_profile = $_REQUEST['id_profile'];
  $ok = addToPlaylist($id_film, $id_profile);
  if ($ok>0){
    echo "Le film a bien été ajouté à la playlist";
  }
  else{
    echo "un problème est survenu";
  }
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] =='getplaylist'){
  $id_profile = $_REQUEST['id_profile'];
  $pl = getPlaylist($id_profile);
  echo json_encode($pl);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='removefromplaylist'){
  $id_film = $_REQUEST['id_film'];
  $id_profile = $_REQUEST['id_profile'];
  $ok = removeFromPlaylist($id_film, $id_profile);
  if ($ok>0){
    echo "Le film a bien été supprimé de la playlist";
  }
  else{
    echo "un problème est survenu";
  }
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='deleteprofile'){
  $id_profile = $_REQUEST['id_profile'];
  $ok = deleteProfile($id_profile);
  if ($ok>0){
    echo "Le profil a bien été supprimé";
  }
  else{
    echo "un problème est survenu";
  }
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] =='getpromotion'){
  $promotion = getPromotion();
  echo json_encode($promotion);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='addpromotion'){
  $promotion = $_REQUEST['promotion'];
  $ok = addPromotion($promotion);
  if ($ok>0){
    echo "Le film a bien été promu";
  }
  else{
    echo "un problème est survenu";
  }
  exit();
}


/* 
    Si on atteint la fin du script sans avoir répondu à la requête, on
    répond un 404 (not found) par défaut
*/
http_response_code(404);

?>