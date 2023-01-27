<?php
$co = 0;
foreach ($json['streams'] as $fstream) {
    $Lstream = $fstream['url'];
    $audio_locale = $fstream['audio_locale'];
    $hard_locale = $fstream['hardsub_locale'];

    if($hard_locale == ""){
        echo '
        const track' . $co . ' = video.addTextTrack("subtitles", convertLocale("' .$audio_locale . '") + " Audio", convertLocaleF("' .$audio_locale . '"));
        track' . $co . '.addCue(new VTTCue(0, 3, ""));';
    } else {
        echo '
        const track' . $co . ' = video.addTextTrack("subtitles", convertLocale("' .$audio_locale . '") + " Audio", convertLocaleF("' .$hard_locale . '"));
        track' . $co . '.addCue(new VTTCue(0, 3, ""));';
    }
    $co += 1;
}
?>    