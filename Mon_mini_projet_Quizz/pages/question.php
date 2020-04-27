<?php
$message_error = "";
$questions = json_decode(file_get_contents('./data/question/question.json'),true);
if(isset($_POST['erg'])){
    $enonce = $_POST['enonce'];
    $points = $_POST['points'];
    $type = $_POST['type'];
    $reponses = []; $reponsesVraies=[]; 
    for($i=1; isset($_POST["rep$i"]); $i++){
        $reponses[] = $_POST["rep$i"];
        if(isset($_POST["cb$i"])){
            $reponsesVraies[] = $_POST["cb$i"];
        }elseif (isset($_POST["rd$i"])) {
            $reponsesVraies[] = $_POST["rd$i"];
        }
    }
    if (!empty($enonce && $points && $type) && ($reponses)) 
    {
        if (in_array($type,['qcm','qcs','text'])) 
        {
            if (count($reponsesVraies) > 0) 
            {
               if ($type == 'qcm' || (in_array($type,['qcs','text']) && count($reponsesVraies) == 1)) 
               {
                 $questions['enonce'][] = $enonce;
                 $questions['points'][] = (int)$points;
                 $questions['type'][] = $type;
                 $questions['reponses'][] = $reponses;
                 $questions['reponsesVraies'][] = $reponsesVraies;
                 file_put_contents('./data/question/question.json',json_encode($questions,JSON_PRETTY_PRINT));
               }else{
                 $message_error = "La réponse doit être unique pour les questions de type choix simple ou texte";
               }
            }else{
                $message_error = "on doit au moins avoir une réponse vraie";
              }
        }else{
            $message_error = "cet type de réponse  est invalide";
          }
    }else{
        $message_error = "remplissage des champs est obligatoire";
      }
}
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .input-validation
    {
		position: relative;
		font-size: 80%;
		left: 20%;
		color: red;
	}
</style>

<body>
<div id="questions">
    <div class="questions-header">paramétrer votre question</div>
        <div class="questions-border">
            <form id="formQst" method="post"> 
                <div class="qst">
                    <label for="">Questions</label>
                    <input name="enonce" error="error-1">
                    <div class="input-validation" id="error-1"></div>
                </div>
                <div class="point">
                    <label for="">Nbr de points</label>
                    <input min="1" name="points" error="error-2" type="number">
                    <div class="input-validation" id="error-2"></div>
                </div>
                <div class="typrep">
                    <label for="">Type de réponse</label>
<select name="type"id="fall" size=1.5 style="width:15rem; height:2rem; background:rgb(230, 230, 230);" onchange="ifchange()">
                        <option value="qcm">Choix multiple</option>
                        <option value="text">Champ texte</option>
                        <option value="qcs">choix simple</option>
                    </select>
                    <input id="plus" name="plus" type="button" error="error-3" value="+" onclick="reponse()">
                    <div class="input-validation" id="error-3"></div>
                </div>
                <div id="reponses">
                </div>
                <div><button type="submit" name="erg" class="erg">Enregistrer</button></div>
                <p><?= $message_error ?></p>
            </form>
       </div>  
</div>
</body>
<script>
    const inputs= document.getElementsByTagName("input");
    for(input of inputs)
    {
        input.addEventListener("keyup",function(e)
        {
            if (e.target.hasAttribute("error"))
            {
                var idDivError=e.target.getAttribute("error");
                document.getElementById(idDivError).innerText=""
            }
        })
    }
    document.getElementById("formQst").addEventListener("submit",function(e)
    {
        const inputs = document.getElementsByTagName("input");
        var error = false;
        for(input of inputs)
        {
            if(input.hasAttribute("error"))
            {
			  var idDivError=input.getAttribute("error");
              if(!input.value)
                {
                    document.getElementById(idDivError).innerText="Ce champ est obligatoire"
                    error=true;
				}
			}
        }
        if(error)
        {
			e.preventDefault();
			return false;
		}
    })

function reponse()
    {
        let x = document.getElementsByClassName('rpn').length, type = document.getElementById('fall').value;
        if (type=='text') {
            document.getElementById('reponses').innerHTML ='<div class="rpn" id="rpn"><label for="" > Reponse</label><input  size=1 style="width:12rem; height:2rem; margin-top:1.5rem; background: rgb(230, 230, 230)" name="rep" type="text"></div>';
        }else if(type=='qcs')  
        {
            document.getElementById('reponses').innerHTML +='<div class="rpn" id="rpn'+(x+1)+'"><label for="" > Reponse'+(x+1)+'</label><input  size=1 style="width:12rem; height:2rem; margin-top:1.5rem; background: rgb(230, 230, 230)" name="rep'+(x+1)+'" type="text"><input type="radio" style="width: 2rem; height: 1.7rem; position:relative; top: .6rem" name="cb'+(x+1)+'" id=""><input type="button" style="width:2rem; height:1.9rem; font-size:1.5em; position:relative; top:.4rem; border:none; color:red; background: rgb(230, 230, 230)" value="🗑" name="rd'+(x+1)+'" onclick="supprime('+(x+1)+')" id=""></div>';
        }else if(type=='qcm')  
        {
            document.getElementById('reponses').innerHTML +='<div class="rpn" id="rpn'+(x+1)+'"><label for="" > Reponse'+(x+1)+'</label><input  size=1 style="width:12rem; height:2rem; margin-top:1.5rem; background: rgb(230, 230, 230)" name="rep'+(x+1)+'" type="text"><input type="checkbox" style="width: 2rem; height: 1.7rem; position:relative; top: .6rem" name="cb'+(x+1)+'" id=""><input type="button" style="width:2rem; height:1.9rem; font-size:1.5em; position:relative; top:.4rem; border:none; color:red; background: rgb(230, 230, 230)" value="🗑" name="rd'+(x+1)+'" onclick="supprime('+(x+1)+')" id=""></div>';
        }
    }
function supprime(n)
    {
        document.getElementById('rpn'+(n)).remove();
    }
function ifchange()
    {
        type = document.getElementById('fall').value; 
    }

</script>
</html>