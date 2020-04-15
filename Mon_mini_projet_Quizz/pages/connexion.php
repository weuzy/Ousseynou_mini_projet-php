<?php
     if (isset($_POST['btn_submit'])) {
        $login = $_POST['login'];
        $pwd = $_POST['pwd'];
        $result = connexion($login,$pwd);
        if ($result="error") {
           echo "Login ou Mot de Passe Incorrect";
        }else {
            header("location:index.php?lien=".$result);
        }
     }

?>



<div class="container">
<div class="container-header">
<div class="title">Login Form</div>
</div>
<div class="container-body">
        <form action="" method="post" id="form-connexion">

          <div class="input-form">
              <div class="icon-form icon-form-login"></div>
              <input type="text" class="form-control" error="error-1" name="login" id="" placeholder="Login">
              <div class="error-form" id="error-1"></div>
          </div>    
          <div class="input-form">
              <div class="icon-form icon-form-pwd"></div>
              <input type="password" class="form-control" error="error-2" name="pwd" id="" placeholder="Password">
              <div class="error-form" id="error-2"></div>
          </div> 
          <div class="input-form">
             
             <button type="submit" class="btn-form" name="btn_submit" id="">connexion</button>
             <a href="" class="link-form">s'inscrire pour jouer ?</a>
         </div>           
        </form>

    </div>
</div>

<script>
     const inputs = document.getElementsByTagName("input");
     for(input of inputs){
         input.addEventListener("keyup",function(e){
             if(e.target.hasAttribute("error")){
                var idDivError = e.target.getAttribute("error");
                document.getElementById(idDivError).innerText =""
              }
         })
    }



document.getElementById("form-connexion").addEventListener("submit",function(e){
   const inputs = document.getElementsByTagName("input");
    var error = false;
   for(input of inputs){
         if(input.hasAttribute("error")){
           var idDivError = input.getAttribute("error");
         if(!input.value){
               document.getElementById(idDivError).innerText = "Ce champ est obligatoire"
               error = true
            }
             
         }
     }
     
if(error){
    e.preventDefault();
     return false;
}
   
  
})



</script>
