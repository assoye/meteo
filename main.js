const $btnPlayPause = document.getElementById("toggle_play")
const $btnPause = $btnPlayPause.querySelector(".pause")
const $btnPlay = $btnPlayPause.querySelector(".play")
const $audioPlayer = document.getElementById("audioPlayer")

// Play music - parameters : audio player, html interactive tag to toggle
function playMyPlayer() {
    
	// If music is in paused state...
    if ($audioPlayer.paused) {
        $audioPlayer.play();

        $btnPause.style.display = "inline-block";
        $btnPlay.style.display = "none";

    } else {
        $audioPlayer.pause();
        
        $btnPause.style.display = "none";
        $btnPlay.style.display = "inline-block";
    }
}

function StopPlayer() {

    $audioPlayer.pause();
    $audioPlayer.currentTime = 0;
    $btnPause.style.display = "none";
    $btnPlay.style.display = "inline-block";


}

function majInfoLectureEnCours() {
    const duration = $audioPlayer.duration;    // Durée totale
    const time     = $audioPlayer.currentTime; // Temps écoulé
    const fraction = time / duration;
    const percent  = Math.ceil(fraction * 100);

    const $progress = document.querySelector('.progressBarValue');
	
    $progress.style.width = percent + '%';
	
    document.querySelector(".current_time").textContent = formatTime(time);  // ex : 02:12:06
    document.querySelector(".duration").textContent = formatTime(duration);
}

function formatTime(time) {
    var hours = Math.floor(time / 3600);
    var mins  = Math.floor((time % 3600) / 60);
    var secs  = Math.floor(time % 60);
	
    if (secs < 10) {
        secs = "0" + secs;
    }

    /* 
    1:05:56
    5:56
    */
    
    if (hours) {
        if (mins < 10) {
            mins = "0" + mins;
        }
		
        return hours + ":" + mins + ":" + secs; // hh:mm:ss
    } else {
        return mins + ":" + secs; // mm:ss
    }
}

let isMusicToLoop = false;




let volumeSonore = 50;

function setVolume(action)
{
    if(action == "down")
    {
        if(volumeSonore > 0)
        {
          volumeSonore -= 10 ; // volumeSonore = volumeSonore - 10
        }
    }
    else if(action == "up")
    {
        if(volumeSonore < 100)
        {
            volumeSonore += 10 ;
        }
    }

    volumeSonore = volumeSonore / 100;

    $audioPlayer.volume = volumeSonore;

    volumeSonore = volumeSonore * 100;
}

