<?php

$mp = true;

?>
<script>
var mp = true;
var initplyr = 0;
var inittime = 0;

document.addEventListener("DOMContentLoaded", () => {
    shownotif("Loading Internal Player.");

    const video = document.querySelector("video");
    const availableQualities = [720];

    <?php include 'players/v_player_options.php'; ?>

    player = new Plyr(video, defaultOptions);

    <?php include 'players/v_player_listeners.php'; ?>

    window.player = player;
});
</script>
