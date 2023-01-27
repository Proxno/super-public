player.on('languagechange', () => {
    if(player.currentTrack != -1){
        let freezeClic = true;
        shownotif("Reloading page for selected source. Please wait.", 8000);
        player.pause();
        setCookie("preferred_locale", video.textTracks[player.currentTrack].language, 365);
        window.location.href = window.location.href;
    }
});

player.on('ready', (event) => {
    const instance = event.detail.plyr;
    var seen_data = <?php echo json_encode($seen_data); ?>

    let searchEles = document.getElementById("epslistplace").children;

    for(let i = 0; i < searchEles.length; i++) {
        var episode_number = searchEles[i].href.split("&ep=")[1].split("&s")[0];
        for (let e = 0; e < seen_data.length; e++) {
            if(seen_data[e] == episode_number){
                searchEles[i].style.opacity = "0.4";
            }
        }
    }
});

player.on('timeupdate', () => {
    if(inittime == 0){
        console.log("1");
        var seen_data = <?php echo json_encode($seen_data); ?>;
        let searchEles = document.getElementById("epslistplace").children;
        for(let i = 0; i < searchEles.length; i++) {
            var episode_number = searchEles[i].href.split("&ep=")[1].split("&s")[0];
            for (let e = 0; e < seen_data.length; e++) {
                if(seen_data[e] == episode_current){
                    console.log("up");
                    player.currentTime = <?php 
                    $ep_data = cookie_progress_episode_current($mal['id'], $identifier_episode_current);
                    if($ep_data != ""){
                        echo cookie_progress_episode_current($mal['id'], $identifier_episode_current)['time']; 
                    } else {
                        echo 0;
                    }
                    ?>;
                }
            }
        }
        inittime = 1;
    }
    var todo = [ 
        {
            "id"    : malid,
            "title" : season_title,
            "episodes" : [
                {
                    "episode" : episode_current,
                    "time"  : player.currentTime,
                    "seen"  : true
                }
            ]
        }
    ];
    if (getCookie('progress') !== undefined) {
        var storage = JSON.parse(getCookie('progress'));
        
        var idfound = false;
        var episodefound = false;

        for (let i = 0; i < storage.length; i++) {
            if(storage[i].id == malid){
                idfound = true;
                for (let e = 0; e < storage[i].episodes.length; e++) {
                    if(storage[i].episodes[e].episode == episode_current){
                        episodefound = true;
                        storage[i].episodes[e].time = player.currentTime;
                        storage[i].episodes[e].seen = true;
                        
                        setCookie('progress', JSON.stringify(storage), 365); 
                    }
                }
            }
        }
        if(!episodefound && idfound){
            for (let i = 0; i < storage.length; i++) {
                if(storage[i].id == malid){
                    episodefound = true;
                    storage[i].episodes.push({
                        "episode" : episode_current,
                        "time"  : player.currentTime,
                        "seen"  : true
                    });
                    setCookie('progress', JSON.stringify(storage), 365); 
                }
            }
        }
        if(!idfound){
            idfound = true;
            storage.push({
                "id"    : malid,
                "title" : season_title,
                "episodes" : [
                    {
                        "episode" : episode_current,
                        "time"  : player.currentTime,
                        "seen"  : true
                    }
                ]
                });
                setCookie('progress', JSON.stringify(storage), 365); 
        }
    } else {
        setCookie('progress', JSON.stringify(todo), 365);  
    }
    
});

function on(selector, type, callback) {
    document.querySelector(selector).addEventListener(type, callback, false);
}

on('.js-fullscreen', 'click', () => {
    player.fullscreen.enter();
});

on('.js-reload', 'click', () => {
    player.restart();
});
<?php if(!isset($mp)) { echo "});"; } ?>
if(getCookie("show_hot_girlo") == "true"){
video.setAttribute('poster', '/assets/thumbnail.webp');
} else {
//video.setAttribute('poster', '<?php echo $identifier_episode_thumbnail; ?>');
video.setAttribute('poster', '/assets/thumbnail2.webp');
}

function updateQuality(newQuality) {
    if(!mp){
        if(initplyr < 2) { initplyr += 1; }
        window.hls.levels.forEach((level, levelIndex) => {
            if (level.height === newQuality) {
                window.hls.currentLevel = levelIndex;
                if(initplyr >= 2){
                    setCookie("preferred_quality", level.height, 365);
                }
            }
        });
    }
}