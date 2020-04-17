Joueur
<?php
is_connect();

     echo @$_SESSION['user']['prenom'];
     echo @$_SESSION['user']['nom'];
     echo @$_SESSION['user']['login'];
     echo @$_SESSION['user']['profil'];
     echo @$_SESSION['user']['photo'];

?>
<br>
<a href="index.php?statut=logout">Deconnexion</a>


<div class="on">
    <div class="on-header">
        <div class="onside">s'inscrire</div>
        <b>Pour tester votre niveau de culture générale</b>
        <div class="file"></div>
        <div class="img-form1">
            <div class="img1"></div>
            <h5> Avatar du Joueur</h5>
        </div>
    </div>
    <div class="on-body">
            <form action="" method="POST" id="">
            <div class="on-form">
              <div class="direct1"> Prénom</div>
              <input type="text" class="on-control" name="Prenom" id="" > 
            </div>
            <div class="on-form">
            <div class="direct1"> Nom</div>
              <input type="text" class="on-control" name="Nom" id="" > 
            </div>   
            <div class="on-form">
            <div class="direct1"> Login</div>
              <input type="text" class="on-control" name="Login" id="" > 
            </div>   
            <div class="on-form">
            <div class="direct1"> Password</div>
              <input type="password" class="on-control" name="Password" id="" > 
            </div>   
            <div class="on-form">
            <div class="direct1"> Confirmer Password</div>
              <input type="password" class="on-control" name="Confirmer Password" id="" > 
            </div> 
            <h5>Avatar</h5>
            <div><button type="submit" class="fich1" name="btn_submit" id="" value="">
                 <a href="" class="dec">Choisir un fichier</a></button></div> 
            <div><button type="submit" class="compte1" name="btn_submit" id="" value="">
                 <a href="" class="dec">Créer compte</a></button></div>     
            </form>
    </div>
</div>



