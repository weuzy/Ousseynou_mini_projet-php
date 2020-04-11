<?php

   $firstname = $name = $email = $phone = $message = "";
   $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
   $is_success = false;
   $emailto = "diopp1017@gmail.com";
   if ($_SERVER['REQUEST_METHOD'] == 'POST') 
   {
      $firstname = verifyInput($_POST['firstname']);
      $name = verifyInput($_POST['name']);
      $email = verifyInput($_POST['email']);
      $phone = verifyInput($_POST['phone']);
      $message = verifyInput($_POST['message']);
       $is_success = true;
       $emailText = "";

      if (empty($firstname)) 
      {
           $firstnameError = "Je veux connaitre ton prénom";
           $is_success = false;
      }
      else 
      {
           $emailText .= "firstname: $firstname\n";
      }
      if (empty($name)) 
      {
           $nameError = " Et oui je veux tout savoir. Meme ton nom";
           $is_success = false;
      }
      else 
      {
           $emailText .= "name: $name\n";
      }
      if (empty($message)) 
      {
           $messageError = "Qu'est-ce que tu veux me dire ?";
           $is_success = false;
      }
      else 
      {
           $emailText .= "message: $message\n";
      }
      if (!is_email($email)) 
      {
           $emailError = "Tu essaies de me rouler? C'est pas un email ça!";
           $is_success = false;
      }
      else 
      {
           $emailText .= "email: $email\n";
      }
      if (!is_phone($phone)) 
      {
            $phoneError = "Que des chiffres et des espaces, svp...";
            $is_success = false;
      }
      else 
      {
           $emailText .= "phone: $phone\n";
      }
      if (is_success) 
      {
            $headers = "From: $firstname $name <$email>\r\nReply-To: $email";
            mail($emailto, "Un message de votre site", $emailText, $headers);
            $firstname = $name = $email = $phone = $message = "";
      }
      
   }
   function is_email($var)
   {
       return filter_var($var, FILTER_VALIDATE_EMAIL);
   }
   function is_phone($var)
   {
         return preg_match("#^[0-9 ]*$#", $var);
   }
   function verifyInput($var)
   {
         $var = trim($var);
         $var = stripslashes($var);
         $var = htmlspecialchars($var);
         return $var;
   }



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contactez-moi</title>
    <script
     src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
    </script>
    <link rel="stylesheet"
     href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
            </script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
    </script>
            <link rel="stylesheet" href="http://fonte.googleapis.com/css?family=lato" type="text/css">
            <link rel="stylesheet" href="css/style.css">
 </head>
  <body>
     <div class="container">
        <div class="divider"></div>
        <div class="heading">
           <h2>contactez-moi</h2>
        </div>
        <div class="row">
             <div class="col-lg-10 col-lg-offset-1">
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="contact-form" method="post" role="form">
                         <div class="row">

                               <div class="col-md-6">
                                     <label for="firstname">Prénom<span class="blue"> *</span></label>
                                     <input type="text" id="firstname" name="firstname"  class="form-control" placeholder="Votre prénom" value="<?php echo $firstname;?>"> 
                                     <p class="comments"><?php echo $firstnameError;?></p> 
                               </div>

                               <div class="col-md-6">
                                     <label for="name">Nom<span class="blue"> *</span></label>
                                     <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value="<?php echo $name;?>">
                                     <p class="comments"><?php echo $nameError;?></p>
                               </div>

                               <div class="col-md-6">
                                     <label for="email">Email<span class="blue"> *</span></label>
                                     <input type="text" id="email" name="email" class="form-control" placeholder="Votre email" value="<?php echo $email;?>">
                                     <p class="comments"><?php echo $emailError;?></p>
                               </div>

                               <div class="col-md-6">
                                     <label for="phone">Téléphone</label>
                                     <input type="text" id="phone" name="phone" class="form-control" placeholder="Votre téléphone" value="<?php echo $phone;?>">
                                     <p class="comments"><?php echo $phoneError;?></p>
                               </div>

                               <div class="col-md-12">
                                     <label for="message">Message<span class="blue"> *</span></label>
                                     <textarea name="message"  id="message" class="form-control" rows="4" value="<?php echo $message;?>"></textarea>
                                     <p class="comments"><?php echo $messageError;?></p>
                               </div>

                               <div class="col-md-12">
                               <p class="blue"><strong>* Ces informations sont réquises</strong></p>
                               </div>

                               <div class="col-md-12">
                               <input type="submit" classe="button1" value="envoyer">
                               </div>

                         </div>
                         <p class="thank-you" style="display:<?php if($is_success) echo 'block'; else echo 'none';?>">Votre message a bien été envoyé. Merci de m'avoir contacter :) </p>
                  </form>
             </div>
        </div>
     </div>
  </body>
</html>