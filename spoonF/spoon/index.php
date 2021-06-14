<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="icon" href="images/nya.svg">
    <title>Home</title>
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

    $key='f3e60a4b55c4424fbaa3b0a215eb6715';
    $localtime = localtime();

    $hour =  $localtime[2]-9; if($hour <=0) {$hour = 24+$hour;}
            if ($hour>=7 && $hour<10){

                $category = "breakfast";
            }
            elseif ($hour>=10 && $hour<12){

                $category = "snack";
            }
            elseif ($hour>=12 && $hour<17){
                $category = "lunch";
            }
            elseif ($hour>=17 && $hour<20){
                $category = "dinner";
            }
            else {$category = "dessert";}
            //Salas Hernandez Ivan, Lopez Lopez Abel Eduardo, Ramos Hernandez Luis Francisco
            $urlCategory='https://api.spoonacular.com/recipes/random?apiKey='.$key.'&number=5&tags='.$category;
            
            $arrayCategory=json_decode(file_get_contents($urlCategory));
            
            $titleCategory = ucfirst($category);
            echo '<a class="titlec">Here are a few '.$titleCategory.' options for you</a>';
            echo '<div class="container">';

    foreach($arrayCategory->recipes as $recipe){
        
            echo '<div class="kpi3">';
        
        $idRecipe = $recipe->id;
        
        $urlInfo='https://api.spoonacular.com/recipes/'.$idRecipe.'/information'.'?apiKey='.$key;
            echo '<a href="info.php?id='.$idRecipe.'"> <img class="imagePreview2" src="'.$recipe->image.'"></a>';

        $array2 = json_decode(file_get_contents($urlInfo));

            echo '</div>';
    }
            echo'</div>';


//General Overview of lower part

    echo '<a class="titlec2">Here are a few suggestions for you</a>';
    echo'<div class="container2">';
    $urlRandom='https://api.spoonacular.com/recipes/random?apiKey='.$key.'&number=10';
    $arrayRandom=json_decode(file_get_contents($urlRandom));
    foreach($arrayRandom->recipes as $random){
        $idRandom = $random->id;
        echo '<div class="kpi"><a href="info.php?id='.$idRandom.'"> <img class="imagePreview" src="'.$random->image.'"></a>';
        echo '<a class="title">'.$random->title.'</a></div>';
    }   
    echo'</div>';
        ?>
    </section>
</body>
<footer>
<div class="patas">

<a> </a>
</div>

</footer>
</html>