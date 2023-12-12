<?php
/*
    Dans ce fichier, on écrira des fonctions "outils" qui réaliseront chacune des
    opérations spécifiques sur la base de données.
    C'est depuis le fichier script.php qu'on appelera telle ou telle fonction "outil"
    en fonction de la requête HTTP à traiter. C'est pour cela que le fichier model.php
    est inclus dans le fichier script.php : pour pouvoir appeler les fonctions "outils".
*/



function getMovies(){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("select * from Movies");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}


function addMovie($t, $r, $a, $ua, $ut, $ic){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("insert into Movies set titre='$t', realisateur='$r', annee_sortie='$a', url_affiche='$ua', url_trailer='$ut', id_category='$ic'");
    $res = $answer->rowCount();
    return $res;
}

function getMovie($if){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("select * from Movies where id_film='$if'");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getCategory($c){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("SELECT id_film, titre, realisateur, annee_sortie, url_affiche FROM Movies where id_category = '$c'");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getCategories(){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("SELECT * FROM Category");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getProfiles(){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("SELECT * FROM UserProfile");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function addProfile($np){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("insert into UserProfile set name_profile='$np'");
    $res = $answer->rowCount();
    return $res;
}


function addToPlaylist($if, $ip){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("insert into Playlist set id_film='$if', id_profile='$ip'");
    $res = $answer->rowCount();
    return $res;
}

function getPlaylist($ip){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("SELECT * FROM Movies INNER JOIN Playlist ON Movies.id_film = Playlist.id_film WHERE Playlist.id_profile = '$ip'");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}


function removeFromPlaylist($if, $ip){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("DELETE FROM Playlist WHERE id_film='$if' AND id_profile='$ip'");
    $res = $answer->rowCount();
    return $res;
}

function deleteProfile($ip){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("DELETE FROM UserProfile WHERE id_profile='$ip'");
    $res = $answer->rowCount();
    return $res;
}

function getPromotion(){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("SELECT * FROM Movies WHERE promotion=1");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function addPromotion($if){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "robin", "robinho0413");
    $answer = $cnx->query("update Movies set promotion=1 where id_film='$if'");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}