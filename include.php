<?php

// Initialization of the API OpenWeatherMap and the different variables for the page 'index.php'  
$city = !empty($_GET['city']) ? $_GET['city'] : 'Paris'; // variable to get the city that the user will return
$country = !empty($_GET['country']) ? $_GET['country'] : '';
$url = 'http://api.openweathermap.org/data/2.5/forecast?q='.urlencode($city).'&units=metric&appid=a297d343cd0f12bce612e66f1fa9aa19'; // OpenWeatherMap API
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



<?php
// Initialization of the API OpenWeatherMap, the Dezeer API and the different variables for the page 'currentWeather.php'  
$city = !empty($_GET['city']) ? $_GET['city'] : 'Paris'; // variable to get the city that the user will return
$country = !empty($_GET['country']) ? $_GET['country'] : 'France';
$url = 'http://api.openweathermap.org/data/2.5/forecast?q='.$city.','.$country.'&units=metric&appid=a297d343cd0f12bce612e66f1fa9aa19'; // OpenWeatherMap API
 $localisation = !empty($_GET['city']) ? $_GET['city']  : '';
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

// Creation of the variable $weatherCode we are gonna use to recover the right icon at the right place
$weatherCode = $forecast->list[0]->weather[0]->icon;

$weatherIDTrack  = "106877662";
// Creation of the variable $weatherIDTrack we are gonna use to recover the right song with the good temp (use for the API deezer)
  switch ($weatherCode) { // function switch to turn API icons into Deezer sound
   
  //SUNNY
   case "01d":
   $weatherIDTrack = "106877662"; // The numbers corresponding to the identifier of the chosen music on the deezer API
   break;
    
  //SUNNY WITH CLOUDS
   case "02d":
   $weatherIDTrack = "37612051";
   break;

   //CLOUDS
   case "03d":
   $weatherIDTrack = "472271772";
   break;
   
  //PREVAILING CLOUDS
   case "04d":
   $weatherIDTrack = "472271772";
   break;

  //RAIN
   case "09d":
   $weatherIDTrack = "12303973";
   break;
  
  // RISK OF RAIN
   case "10d":
   $weatherIDTrack = "37612051";
   break;
  
  //STORM
   case "11d":
   $weatherIDTrack = "44848951";
   break;
  
   //SNOW
   case "13d":
   $weatherIDTrack = "37612091";
   break;
 
   // PREVAILING CLOUDS
   case "50d":
   $weatherIDTrack = "472271772";
   break;

   //NIGHT CLEAR
   case "01n":
   $weatherIDTrack = "60954667";
   break;
   
   //MOON WITH CLOUDS
   case "02n":
   $weatherIDTrack = "60954667";
   break;

  //CLOUDS
   case "03n":
   $weatherIDTrack = "472271772";
   break;

   //PREVAILING CLOUDS
   case "04n":
   $weatherIDTrack = "472271772";
   break;

   //RAIN
   case "09n":
   $weatherIDTrack = "12303973";
   break;

   //RISK OF RAIN
   case "10n":
   $weatherIDTrack = "12303973";
   break;

  //STORM
   case "11n":
   $weatherIDTrack = "44848951";
   break;

  //SNOW
   case "13n":
   $weatherIDTrack = "37612091";
   break;
  
   //PREVAILING CLOUD
   case "50n":
   $weatherIDTrack = "472271772";
   break;
   
    default:
    $weatherIDTrack ="106877662";
 }


 $url = 'https://api.deezer.com/track/'.$weatherIDTrack; // Deezer API
 $path = './cache/'.md5($url);
 
 if(file_exists($path) && time() - filemtime($path) < 10)

 {
   $weatherDeezerTrack = json_decode(file_get_contents($path));
 }

 else

 {
   $weatherDeezerTrack = json_decode(file_get_contents($url));
   file_put_contents($path, json_encode($weatherDeezerTrack));
 }
 
?>     


<?php 

$classIconCurrentWeather = "sunDesign";

 switch ($weatherCode) { // function switch to turn API icons SVG designs
 
  //SNOW
  case "13d":
  $classIconCurrentWeather = "snowDesign";
  break;
  
  //RAIN
  case "09d":
  $classIconCurretnWeather = "rainDesign";
  break;

  //SUN
  case "01d":
  $classIconCurrentWeather = "sunDesign";
  break;

  //SUN WITH CLOUDS
  case "02d":
  $classIconCurrentWeather = "sunCloudsDesign";
  break;
  
  //CLOUDS
  case "03d":
  $classIconCurrentWeather = "cloudsDesign";
  break;
  
  //PREVAILING CLOUDS
  case "04d":
  $classIconCurrentWeather = "prevailingCloudsDesign";
  break;

   //RISK OF RAIN
  case "10d":
  $classIconCurrentWeather = "sunCloudsDesign";
  break;
  
   //STORM
  case "11d":
  $classIconCurrentWeather = "stormDesign";
  break;

  //PREVAILING CLOUDS 
  case "50d":
  $classIconCurrentWeather = "prevailingCloudsDesign";
  break;

  // NIGHT CLAIR
  case "01n":
  $classIconCurrentWeather = "nightDesign";
  break;

  //MOON WITH CLOUDS
  case "02n":
  $classIconCurrentWeather = "nightCloudsDesign";
  break;

  //PREVAILING CLOUDS
  case "04n":
  $classIconCurrentWeather = "prevailingNightCLouds";
  break;

  //CLOUDS
  case "03n":
  $classIconCurrentWeather = "prevailingNightCLouds";
  break;

   //RAIN
  case "09n":
  $classIconCurrentWeather = "nightCLoudsRain";
  break;

  //RISK OF RAIN
  case "10n":
  $classIconCurrentWeather = "nightCLoudsRain";
  break;
  
  //STORM
  case "11n":
  $classIconCurrentWeather = "stormDesign";
  break;

  //SNOW
  case "13n":
  $classIconCurrentWeather = "nightSnow";
  break;

   //PREVAILING CLOUDS
  case "50n":
  $classIconCurrentWeather = "prevailingNightCLouds";
  break;
          
  default:
 $classIconCurrentWeather ="sunDesign";
}

?>

<?php 

$classWeatherSentence= "";

 switch ($weatherCode) {  // function switch to turn API icons into words 

  
 //LIKE THE TWO OTHER SWITCH
  case "01d":
  $classWeatherSentence = "ensoleillé";
  break;

  case "09d":
  $classWeatherSentence = "pluie";
  break;

  case "13d":
  $classWeatherSentence = "neige";
  break;

  case "02d":
  $classWeatherSentence = "Belles éclaicies";
  break;

  case "03d":
  $classWeatherSentence = "Quelques nuages";
  break;

  case "04d":
  $classWeatherSentence= "Nuages prédominants";
  break;

  case "10d":
  $classWeatherSentence = "Risque de pluie";
  break;

  case "11d":
  $classWeatherSentence = "Orage";
  break;

  case "50d":
  $classWeatherSentence = "Nuageux";
  break;

  case "01n":
  $classWeatherSentence = "Nuit clair";
  break;

  case "02n":
  $classWeatherSentence = "Quelques nuages";
  break;

  case "04n":
  $classWeatherSentence = "Nuageux";
  break;

  case "03n":
  $classWeatherSentence= "Quelques nuages";
  break;

  case "09n":
  $cclassWeatherSentence= "Pluie";
  break;

  case "10n":
  $classWeatherSentence = "Pluie";
  break;

  case "11n":
  $classWeatherSentence = "Orage";
  break;

  case "13n":
  $classWeatherSentence = "Neige";
  break;

  case "50n":
  $classWeatherSentence = "Nuageux";
  break;
          
  default:$classWeatherSentence="ensoleillé";

}

?>

<?php



function returnPathWeatherIconYahooAPI($weatherCodeValue)
{

$pathImgIconValue = "";

 switch ($weatherCodeValue) {
    case 3: case 12:  case 6:   case 11:
    $pathImgIconValue = "rainPrevisions.svg";
    break;

    case 26: case 32: case 36: case 44:
    $pathImgIconValue = "sunPrevisions.svg";
    break;

    case 5 :   case 7 :   case 8 :   case 9 :   case 10 :   case 13 :  case 15 :   case 16 :   case 17 :   case 18 :   case 23:   case 24 :   case 25 :   case 35:   case 41 :   case 42:   case 43 :   case 46:
    $pathImgIconValue = "snowPrevisions.svg";
    break;

    case 31 :  case 33 :  case 36:
    $pathImgIconValue = "moonPrevisions.svg";
    break; 

    case 27 :  case 29:
    $pathImgIconValue = "moonCloudsPrevisions.svg";
    break; 

 
   case 19 :   case 20 :   case 21 :   case 22 :   case 23 :   case 24: case 30:
    $pathImgIconValue = "cloudsPrevisions.svg";
    break;

    case 0 :   case 1:   case 2 : case 14 : case 28: case 45 :  
    $pathImgIconValue = "prevailingRainPrevisions.svg";
    break;
    

    case 4 :   case 37 :   case 38 :   case 39 : case 47:
  $pathImgIconValue = "stormPrevisions.svg";
      break;

      


  default:
  
  $pathImgIconValue ="sunPrevisions.svg";
}

return $pathImgIconValue;

}

  
?>

     <?php

function returnPathWeatherIcon($weatherCodeValue)
{

$pathImgIconValue = "";

 switch ($weatherCodeValue) {
  case "01d":
    $pathImgIconValue = "sun.svg";
    break;

    case "02d":
    $pathImgIconValue = "sun.svg";
    break;

    case "09d": 
    $pathImgIconValue = "rain.svg";
    break;

    case "10d":
    $pathImgIconValue = "rain.svg";
    break; 

    case "09n":
    $pathImgIconValue = "rain.svg";
    break;

    case "10n":
    $pathImgIconValue = "rain.svg";
    break;

  case "11d" :
  $pathImgIconValue = "storm.svg";
      break;

      case "11n" :
      $pathImgIconValue = "storm.svg";
      break;


  case "13d":
    $pathImgIconValue = "snow.svg";
    break;

    case "13n":
    $pathImgIconValue = "snow.svg";
    break;

  case "03d":
    $pathImgIconValue = "cloud.svg";
    break;

    case "03n":
    $pathImgIconValue = "cloud.svg";
    break;

    
  case "04d":
  $pathImgIconValue = "prevalingRain.svg";
      break;

      case "04n":
      $pathImgIconValue = "prevalingRain.svg";
          break;

      case "01n":
      $pathImgIconValue = "moon.svg";
          break;

          case "02n":
      $pathImgIconValue = "moonClouds.svg";
          break;

         


  default:
  
  $pathImgIconValue ="sun.svg";
}

return $pathImgIconValue;

}


?>


