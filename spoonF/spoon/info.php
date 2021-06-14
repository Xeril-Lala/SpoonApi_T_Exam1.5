<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style/info.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="icon" href="images/nya.svg">
    <title>Recipe information</title>
</head>
<body>
<section>
    <div class="header">
          <div class="header">
              <form action="search.php" method="POST">
              <img class="logo" src="images/nya.svg">  <span class="pname">SpoonAPI</span>
                    <input placeholder="Hungry? look for something!" type="text" id="keywords" name="keywords" size="60" maxlength="100%">
              <img class="logo2" src="images/lupa.png">

          </div>
              </form>
          </div> 

        <?php
            $keySpoon='f3e60a4b55c4424fbaa3b0a215eb6715';
            $keyYoutube="AIzaSyBbrBo8cUYySdTP_I-2r78Ckz6i8I3ZxBw"; //Llave para autorizar la api
            $idRecipe =$_GET['id'];

            $urlInfo ='https://api.spoonacular.com/recipes/'.$idRecipe.'/information'.'?apiKey='.$keySpoon;
            $urlEquipment = 'https://api.spoonacular.com/recipes/'.$idRecipe.'/equipmentWidget.json?apiKey='.$keySpoon;
            
            $arrayInfo = json_decode(file_get_contents($urlInfo));
            $arrayEquipment = json_decode(file_get_contents($urlEquipment));

            $urlImage=$arrayInfo->image;
            $summWoTag= strip_tags($arrayInfo->summary);

            echo '<div class="titleRecipe">'.$arrayInfo->title.'</div>';
            echo '<div class="timeServings">';
            echo '<div class="infoicon"><img class="icon" src="images/clock.svg"> '.$arrayInfo->readyInMinutes.' minutes </div>';  
            echo '<div class="infoicon"><img class="icon" src="images/bowl.svg"> '.$arrayInfo->servings.' servings </div>';
            echo '</div>';
            echo '<img class="mainImage" src="'.$urlImage.'">';
            echo '<div class="titleDescription">Description</div>';
            echo '<p class="description">'.'    '.$summWoTag.'</p>';
            echo '<div class="mainContRecipe">';
            $searchEquipment=$arrayEquipment->equipment;
            if(!empty($searchEquipment)){
            echo '<div class="listEquipment">';
            echo '<div class="subtitle">Equipment</div>';
            echo '<hr  class="lineIngredient">';
            foreach($arrayEquipment->equipment as $equipment){
                $urlImageEquipment="https://spoonacular.com/cdn/equipment_100x100/".$equipment->image;
                echo '<div class="rowEquipment">';    
                echo '<div class="contImageEquipment"><img class="imageEquipment" src="'.$urlImageEquipment.'"></div><br>';
                echo '<div class="text">'.$equipment->name.'</div><br><br>';
                echo '</div>';
            }
            echo '</div>';  
            }
            echo '<div class="listaIngredientes">';
            echo '<div class="subtitle">Ingredients</div>';
            foreach($arrayInfo->extendedIngredients as $ingredients) {
                $urlImageIngredient="https://spoonacular.com/cdn/ingredients_100x100/".$ingredients->image;
                echo '<div class="rowIngredient">';
                echo '<div class="contImageIngredient"><img class="imageIngredient" src="'.$urlImageIngredient.'"></div><br>';
                echo '<div class="text">'.$ingredients->amount.' '.$ingredients->unit.'   '.$ingredients->name.'</div><br><br>';
                echo '</div><hr class="subLinea">';
            }
            echo '</div>';

            echo '<div class="contInstrucciones">';
            echo '<div class="subtitle">Instructions</div>';
            echo '<hr  class="lineInstruction">';
            foreach($arrayInfo->analyzedInstructions as $instructions) {
                foreach($instructions->steps as $stepsInstructions){
                   
                    echo '<div class="instructions">'.$stepsInstructions->number.': '.$stepsInstructions->step.'<br><br> </div>';
                }
            }
            echo '</div>';
            $title = str_replace(" ","+",$arrayInfo->title);
            $urlYoutube='https://www.googleapis.com/youtube/v3/search?'.'key='.$keyYoutube.'&q="'.$title.'"&part=snippet,id&order=date&maxResults=1';
            $arrayYoutube = json_decode(file_get_contents($urlYoutube));
            
            echo '<div class="subtitleVideo"> Youtube recomended video: </div>'; 
            foreach($arrayYoutube->items as $videos)
            {
               $urlVideo="https://www.youtube.com/embed/".$videos->id->videoId; //embed para traer el video
               echo "<div>".'<iframe src="'.$urlVideo.'" allowfullscreen></iframe>'."</div>"; //mostrar el video a partir de un iframe
           }
        ?>
    </section>
    </body>
<footer>
<div class="patas">

<a> </a>
</div>

</footer>
</body>
</html>