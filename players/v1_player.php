<?php

?>
<script>
var mp = false;
var initplyr = 0;
var inittime = 0;

document.addEventListener("DOMContentLoaded", () => {
    shownotif("Loading Internal Player.");

    const video = document.querySelector("video");
    const source = '<?php
    $video_url = base64_encode($stream);
    $proxied_url = $m3u8_proxy . '/' . $video_url . '.m3u8';
    echo $proxied_url;
    ?>';

    if (mp !== true) {
        const hls = new Hls();

        if(getCookie("dev") == "true"){

        }else { hls.loadSource(source); }
        hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
            const availableQualities = hls.levels.map((l) => l.height)
            <?php include 'players/v_player_options.php'; ?>
            <?php include 'players/v1_player_locale.php'; ?>

            player = new Plyr(video, defaultOptions);

            <?php include 'players/v_player_listeners.php'; ?>
        hls.attachMedia(video);
        window.hls = hls;
    }
});
</script>
