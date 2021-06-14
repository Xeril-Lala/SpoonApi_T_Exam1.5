<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style/category.css">
    <link rel="stylesheet" href="style/nav.css">
    <title>Category</title>
</head>
<body>
<div class="header">
          <div class="header">
              <form action="index.php" method="POST" class="barra ">
              <img class="logo" src="images/nya.svg">  <span class="pname">spoon</span>
                    <input placeholder="Hungry? look for something!" type="text" id="keywords" name="keywords" size="60" maxlength="100%">
              <img class="logo2" src="images/chika-open.png"> 
              <img class="logo2" src="images/chika-png.png"> 
            <!--
            <div class="header-right">
              <a href="#home"></a>
              <a href="#contact" ></a>
              <a href="#about" ></a>
            </div>
            -->
          </div>
              </form>
          </div> 
    <?php
    $keySpoon="ea7e73093c614f058111ade17e11fe4b";
    $localtime = localtime();
    $hour =  $localtime[2]-9; if($hour <=0) {$hour = 24+$hour;}
    $category = "dessert";
    if ($hour>=9 && $hour<=12){
        $category = "breakfast";
    }
    elseif ($hour>=12 && $hour<=18){
        $category = "lunch";
    }
    elseif ($hour>=18 && $hour<=22){
        $category = "dinner";
    }

    $urlCategory='https://api.spoonacular.com/recipes/random?apiKey='.$keySpoon.'&number=3&tags='.$category;
    $arrayCategory=json_decode(file_get_contents($urlCategory));
    $titleCategory = ucfirst($category);
    echo '<div class="titleCategory">'.$titleCategory.'</div>';
    echo '<div class="contRecetas">';
    foreach($arrayCategory->recipes as $recipe){
        $urlImage=$recipe->image;
        $idRecipe = $recipe->id;
        $urlInfo='https://api.spoonacular.com/recipes/'.$idRecipe.'/information'.'?apiKey='.$keySpoon;
        echo '<div class="contFilaReceta">';
        echo '<div><a href="info.php?id='.$idRecipe.'"> <img class="imagePreview" src="'.$urlImage.'"></a></div>';
        echo '<div class="contTexto">';
        echo '<div class="title">'.$recipe->title.'  (´｡• ω •｡`)</div>'; 
        $arrayInfo = json_decode(file_get_contents($urlInfo));
        echo '<div class="icontxt"><img class="icon" src="images/clock.svg">'.$arrayInfo->readyInMinutes.' minutes</div>';
        echo '<div class="icontxt"><img class="icon" src="images/bowl.svg">'.$arrayInfo->servings.' servings</div><br><br>';

        if( strlen( $arrayInfo->summary ) > 50 ) {
            $preview = substr( $arrayInfo->summary, 0, 390 ) . '...';
         }
            echo '<div class="preview">'.$preview.'</div>'; 
            echo '</div>'; //ContTexto
            
        echo '</div>'; //ContFilaReceta'
        echo '<hr class="line">';
    }
 
    echo '</div>'; //ContRecetas
    ?>
</body>
</html>