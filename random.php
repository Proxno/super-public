<?php
$response = file_get_contents("https://animixreplay.xyz:3000/meta/anilist/random-anime");
$json = json_decode($response, true);

$mal_id = $json['malId'];
$url = "https://animixreplay.to/anime/$mal_id";
header( "Location: $url" );

?>
