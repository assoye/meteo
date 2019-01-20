<?php

include("./include.php"); //include were we can find the fonctions

    $city = !empty($_GET['city']) ? $_GET['city'] : 'Paris'; // variable to get the city that the user will return
    $country = !empty($_GET['country']) ? $_GET['country'] : '';
    $url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20u='c'%20and%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22".urlencode($city)."%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys"; // Yahoo API 'urlencode' = allows to take into account the names cities that have spaces         
                                                                                                       
    $path = './cache/'.md5($url);


    if(file_exists($path) && time() - filemtime($path) < 10)
    {
        $forecast = json_decode(file_get_contents($path));
    }
    else
    {
        $forecast = json_decode(file_get_contents($url));
        file_put_contents($path, json_encode($forecast));
    }
  

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="reset.css">
  <link href="fontawesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
  <title>Document</title>
</head>

<body>

<span>
    <img src="images/logo.svg" class="logo"></span>
  <nav class="header">
    <ul class="menu">
      <li>
      <a href="./currentWeather.php?city=<?= $city ?>" > Actuelle </a> <!-- Actual prevision -->
      </li>
    </ul>
  </nav>
 
  <div class="cityPrevisions"><?= $city ?></div> <!-- The city that the user has entered in the form -->

  <div class="weatherpurpleBackground"> 

  <?php $inc = 0; foreach($forecast->query->results->channel->item->forecast as $_day): ?>
<?php if($inc < 6){  // code to only see the weather for the next 6 days
  
  $weatherCode = $_day->code; //Way to get the weather code and replace it with icons 
  $pathImgIcon = returnPathWeatherIconYahooAPI($weatherCode);
  
  ?>
    <div class="forecastInfos">
     <div class="datePrevisions"> <?= $_day->date ?></div> <!--Date-->
        <div class="minPrevisions"> <?= $_day->low; ?>°   /</div> <!--Minimum-->
        <div class="maxPrevisions"><?= $_day->high; ?>°</div> <!--MAximum-->
        </div>
       
        <div class="imgPrevisions">
        <img  src="images/iconsPrevisions/<?= $pathImgIcon?>" alt="" /></div> <!--Icons according to the weather --> 
        
<?php } ?>
        <?php $inc = $inc + 1; ?>
<?php endforeach; ?>

<a href="./currentWeather.php?city=<?= $city ?>" class="buttonActualWeather"> Météo actuelle </a> <!--Button to see the actual weather --> 
</div>
