<?php
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
        <title>devoir</title>
    </head>

    <body>

        <div class="form">
            <p class="welcomeSentence"> Bienvenue sur soundMETEO ! De qu'elle ville souhaitez-vous connaître la météo?
                <p>
                    <img class="formBackground" src="/images/formbackground.svg" />
                    <form action="./currentWeather.php" method="get" class="formStart">
                        <input class="findCity" placeholder="Entrer une ville..." type="text" value="" name="city" required>
                        <input class="validationButton" type="submit">
                    </form>
       </div>

   </body>
   </html>
