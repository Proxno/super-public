const defaultOptions = {};
defaultOptions.controls = [
    'play-large',
    'play',
    'fast-forward',
    'progress',
    'current-time',
    'duration',
    'mute',
    'volume',
    'settings',
    'pip',
    'fullscreen'
];

defaultOptions.settings = [
    'captions',
    'quality',
    'speed',
    'loop'
];

defaultOptions.tooltips = {
    controls: true,
    seek : true
};

defaultOptions.keyboard = {
    global: true
};

defaultOptions.storage = {
    enabled: false,
    key: 'plyr'
};

defaultOptions.captions = {
    active: true,
    language: '<?php echo $selsub; ?>',
    update: true
};

defaultOptions.quality = {
    default: parseInt(getCookie("preferred_quality")),
    options: availableQualities.reverse(),
    forced: true,
    onChange: (e) => updateQuality(e),
};

defaultOptions.i18n = {
    captions: 'Source',
    play : "Play (K)",
    pause : "Pause (K)",
    mute : "Mute (M)",
    unmute : "Unmute (M)",
    enterFullscreen : "Enter fullscreen (F)",
    exitFullscreen : "Exit fullscreen (F)",
    qualityLabel : {
        0 : "Auto"
    }
};

defaultOptions.seekTime = 5;

defaultOptions.fullscreen = {
    iosNative : true
};