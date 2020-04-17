
<?php
is_connect();

     echo @$_SESSION['user']['prenom'];
     echo @$_SESSION['user']['nom'];
     echo @$_SESSION['user']['login'];
     echo @$_SESSION['user']['profil'];
     echo @$_SESSION['user']['photo'];

?>



<div class="wrapper">
    <div class="wrapper-header">
        <div class="up-title">créer et paramètrer vos quizz</div>
        <div>
        <div><button type="submit" class="btn-position deconnexion" name="btn_submit" id="" value=""><a href="index.php?statut=logout" class="dec">Deconnexion</a></button></div>
        </div>
    </div>
    <div class="wrapper-body">
      <div class="create">
          <div class="create-header">
              <div class="picture-form">
                  <div class="picture"></div>
              </div>
          </div>
          <div class="list">
              <nav class="list-form">
                <ul>
                <div class="liste-icon-form l1"></div>
                <li><a href="">Liste Questions</a></li>
                <div class="liste-icon-form l2"></div>
                <li><a href="index.php?lien=accueil&page=inscription">Créer Admin</a></li>
                <div class="liste-icon-form l3"></div>
                <li><a href="index.php?lien=accueil&page=joueur">Liste Joueurs</a></li>
                <div class="liste-icon-form l4"></div>
                <li><a href="">Créer Questions</a></li>  
                </ul>
              </nav> 
         </div>
      </div>
      
 </div>   
</div>

<?php

if ($_GET['page'] == 'joueur') 
    {
        include("Joueur.php");
    }
elseif ($_GET['page'] == 'inscription') 
    {
        include("Inscription.php");
    }    



?>
