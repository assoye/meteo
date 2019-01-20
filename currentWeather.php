<?php
//contains most the PHP 
include("./include.php");

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
    <link rel="stylesheet" href="./css/weather.css">
    <script src="https://use.fontawesome.com/db84e84968.js"></script>
    <title> soundMETEO </title>
  </head>

  <body>

    <span>
      <img src="images/logo.svg" class="logo">
    </span>

    <nav class="header">
      <ul class="menu">
        <li>
          <a href="./previsions.php?city=<?= $city ?>">Prévisions </a> <!-- Previsions of the next 6 daysthe city corresponds to the one the user has chosen -->
        </li>
      </ul>
    </nav>

    <form action="#" method="get" class="formLocation"> <!-- Form that the user has to fill in to get the weather of a city -->
      <input class="enterLocation" type="text" value="<?= $city; ?>" name="city">
      <input class="enterButton" type="submit">
    </form>


  <div class="container">
    <div class="Design">
      <div class="<?= $classIconCurrentWeather ?>"> </div> <!-- Weather design  -->
    </div>

    <div class="temperature">
     <p><?php echo intval ($forecast->list[0]->main->temp); ?>°</p>
                           <!--path to get the temperature-->

       <div class="climat">
        <p><?=$classWeatherSentence?></p> <!-- Weather indications  -->
       </div>

       <div class="city">
          <p><?= $city?><p> <!-- City  -->
       </div>

       <div class="humidity">
        <img class="iconimgHum" src="images/humidity.svg"><?php echo $forecast->list[0]->main->humidity;?> % 
       </div> <!--Humidity-->

        <div class="feeling">
          <?php echo $forecast->list[0]->wind->speed;?> km/h 
        </div> <!-- Wind s-->
        
         <span class="tempMin">min:
          <?php echo intval($forecast->list[0]->main->temp_min);?>°</span> <!--Temp minimum-->
         <span class="tempMax">max:
          <?php echo intval($forecast->list[0]->main->temp_max);?>°</span> <!--Temp maximum-->

      </div>
  
    <div class="whiteBackground">

<?php

$weatherCode = $forecast->list[0]->weather[0]->icon; // Path to get weather information every 3h
$pathImgIcon = returnPathWeatherIcon($weatherCode);

?>
   
       <div class="hour1">
         <span class="date"> <?= gmdate(' H:i', $forecast->list[0]->dt); ?> H</span> <!--Date-->
           <img src="images/weatherIcons/<?= $pathImgIcon?>" alt="" class="img" /> <!--Icons according to the weather-->
          <span class="hoursTemps"> <?php echo intval($forecast->list[0]->main->temp); ?>°</span> <!-- path to recover the data temp -->
        </div>

<?php

 $weatherCode = $forecast->list[1]->weather[0]->icon; // Path to get weather information every 3h
 $pathImgIcon = returnPathWeatherIcon($weatherCode);

?>

        <div class="hour2">
         <span class="date"> <?= gmdate(' H:i', $forecast->list[1]->dt); ?> H</span> <!--Date-->
           <img src="images/weatherIcons/<?= $pathImgIcon?>" alt="" class="img" /> <!--Icons according to the weather-->
         <span class="hoursTemps"> <?php echo intval($forecast->list[1]->main->temp); ?>°</span> <!-- path to recover the data temp -->
        </div>

<?php

 $weatherCode = $forecast->list[2]->weather[0]->icon; // Path to get weather information every 3h
 $pathImgIcon = returnPathWeatherIcon($weatherCode);

?>
        
        <div class="hour3">
         <span class="date"> <?= gmdate(' H:i', $forecast->list[2]->dt); ?> H</span> <!--Date-->
           <img src="images/weatherIcons/<?= $pathImgIcon?>" alt="" class="img" /> <!--Icons according to the weather-->
         <span class="hoursTemps"> <?php echo intval($forecast->list[2]->main->temp); ?>°</span> <!-- path to recover the data temp -->
        </div>

<?php

$weatherCode = $forecast->list[4]->weather[0]->icon; // Path to get weather information every 3h
$pathImgIcon = returnPathWeatherIcon($weatherCode);

?>

        <div class="hour5">
         <span class="date"> <?= gmdate(' H:i', $forecast->list[4]->dt); ?> H</span> <!--Date-->
           <img src="images/weatherIcons/<?= $pathImgIcon?>" alt="" class="img" /> <!--Icons according to the weather-->
         <span class="hoursTemps"> <?php echo intval($forecast->list[4]->main->temp); ?>°</span> <!-- Temperatutre -->
        </div>

<?php

$weatherCode = $forecast->list[3]->weather[0]->icon; // Path to get weather information every 3h


$pathImgIcon = returnPathWeatherIcon($weatherCode);

?>

        <div class="hour4">
         <span class="date"> <?= gmdate(' H:i', $forecast->list[3]->dt); ?> H</span> <!--Date-->
           <img src="images/weatherIcons/<?= $pathImgIcon?>" alt="" class="img" /> <!--Icons according to the weather-->
         <span class="hoursTemps"> <?php echo intval($forecast->list[3]->main->temp); ?>°</span> <!--Temperature-->
        </div>


      </div>
</div> <!-- container end-->

 <a href="./previsions.php?city=<?= $city ?>" class="buttonPrevision"> Prévisions sur 5 jours </a> <!-- Button to see the previsions-->

  <div class="player"> <!-- Player for the deezer API-->
    <div class="diskColor"></div>
    <div class="diskWhite"></div>
    <!-- ontimeupdate="update();" -->
      <audio id="audioPlayer" ontimeupdate="majInfoLectureEnCours();" autoplay loop onended="loopIfRequired();">
       <source class="mp3AudioSource" src="<?= $weatherDeezerTrack->preview ?>" type="audio/mpeg"> <!--Path to get the music from the deezer API-->
      </audio>

    <div class="timeline">
     <div class="current_time">00:00</div>
     <div class="duration">00:00</div>
     <div class="progressBarAudio">
     <div class="progressBarValue"></div>
     </div>
    </div>

     <a href="#" id="toggle_play" onclick="playMyPlayer()">
      <span class="play">
        <i class="fa fa-play fa-2x"></i>
      </span>
      <span class="pause">
        <i class="fa fa-pause pause fa-2x" aria-hidden="true"></i>
      </span></a>

       <button id="btn_vol_up" onclick="setVolume('up')">+</button>
       <button id="btn_vol_down" onclick="setVolume('down')">-</button>
  </div>

 </body>
  
<script src="main.js"></script>

</html>