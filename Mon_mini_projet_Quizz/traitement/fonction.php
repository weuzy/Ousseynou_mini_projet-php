<?php

function connexion($login,$pwd){
    $user = getData();
    foreach ($users as $key => $users) {
              if($users["login"] === $login && $users["password"] === $pwd){
                  $_SESSION['users'] = $users;
                  $_SESSION['statut'] = "login";
                  if ($user["profil"] === "admin") {
                      return "accueil";
                  }else {
                      return "jeux";
                  }
              }
    }
    return "error";
}
function is_connect(){
    if (!isset( $_SESSION['statut'])) {
        header("location:index.php");
    }
}

function deconnexion(){
        unset( $_SESSION['users']);
        unset( $_SESSION['statut']);
        session_destroy();
}

function getData($file = "utilisateur"){
            $data = file_get_contents("./data/".$file.".json");
            $data = json_decode($data,true);
            return $data;
}
?>
