<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style/search.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="icon" href="images/nya.svg">
    <title>Search</title>
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
            error_reporting(0);
            $query = str_replace(" ","%20",$_POST['keywords']);
            $keySpoon='f3e60a4b55c4424fbaa3b0a215eb6715';

            $title = ucfirst($query);
            echo '<div class="titleSearch">Recipe results for '.$title.'</div>';

            echo '<div class="contFilter">';
            echo '<div class="titleFilter">Filters</div>';
            echo '<hr class="lineFilter">';
            echo '<form action="search.php" method="POST" class="mainFilter">';
            echo '<p class="labelFilter">Recipe</p>';
            echo '<input type="text" class="filterBox" name="filterSearch" size="60" maxlength="100%" value="'.$query.'">';
            echo '<p class="labelFilter">Include Ingredient</p>';
            echo '<input type="text" class="filterBox" name="includeIngredient" size="60" maxlength="100%" >';
            echo '<p class="labelFilter">Exclude Ingredient</p>';
            echo '<input type="text" class="filterBox" name="excludeIngredient" size="60" maxlength="100%" >';
            echo '<input type="submit" class="filterButton" value="Enviar">';
    
            echo '</form>';
            echo '</div> ';
            if (isset($_POST['keywords'])) {
                $_POST['filterSearch'] = $query;
            }
            $query =  $_POST['filterSearch'];
            $includeIngredient = str_replace(" ","%20",$_POST['includeIngredient']);
            $excludeIngredient = str_replace(" ","%20",$_POST['excludeIngredient']);
            $urlSearch = 'https://api.spoonacular.com/recipes/complexSearch?apiKey='.$keySpoon.'&query='.$query.'&number=4&includeIngredients='.$includeIngredient.'&excludeIngredients='.$excludeIngredient;
            $arraySearch = json_decode(file_get_contents($urlSearch));

            echo '<div class="contRecipes">';
            foreach ($arraySearch->results as $searchResults){
                $idRecipe = $searchResults->id;
                $urlInfo = 'https://api.spoonacular.com/recipes/'.$idRecipe.'/information?apiKey='.$keySpoon;
                $arrayInfo = json_decode(file_get_contents($urlInfo));
                
                $urlImage=$arrayInfo->image;
                echo '<div class="contRowRecipe">';
                echo '<div><a href="info.php?id='.$idRecipe.'"> <img class="imagePreview" src="'.$urlImage.'"></a></div>';
                echo '<div class="contText">';
                echo '<div class="title">'.$arrayInfo->title.'</div>';
                echo '<div class="contTimeServing">';
                echo '<div class="icontxt"><img class="icon" src="images/clock.svg">'.$arrayInfo->readyInMinutes.' minutes</div>';
                echo '<div class="icontxt"><img class="icon" src="images/bowl.svg">'.$arrayInfo->servings.' minutes</div>';
                echo '</div>';
                if( strlen( $arrayInfo->summary ) > 50 ) {
                    $preview = substr( $arrayInfo->summary, 0, 390 ) . '...';
                 }
                echo '<div class="preview">'.$preview.'</div>';
                echo '</div>';//contText
                echo '</div>';//contRowRecipe
                echo '<hr class="line">';
            } 
            
            
            echo '</div>'; //contRecipes
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