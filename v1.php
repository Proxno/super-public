<?php

$title                     = "Unknown";
$description               = "Unknown";
$genres                    = "Unknown";
$status                    = "Unknown";
$max_episode               = 0;
$streamtype                = "Unknown";
$currentep                 = 0;
$episode_title             = "";
$stream                    = NULL;
$captions                  = NULL;
$json                      = NULL;
$selsub                    = "";
$streamtype                = "ROLL";
$json                      = NULL;
$makeurl                   = "";
$subindex                  = 0;
$identifier_streamid       = "";
$conn                      = dbanime();
$identifier_slugtitle      = $_GET['name'];
$identifier_slugtitle_full = $_GET['name'];
$identifier_dub            = "";

if(strpos($identifier_slugtitle, "-dub-")){
    $args = explode("-dub-", $identifier_slugtitle);
    $identifier_slugtitle = $args[0];
    $identifier_dub = $args[1];
}


$result = /*REMOVED SQL CODE | https://i.imgur.com/BjE5Fql.png */

foreach($result as $row){
    $identifier_streamid = $row['stream_id'];
}

$identifier_season              = $_GET['s'];
$identifier_season_title        = "";
$identifier_season_id           = "";
$identifier_episode             = $_GET['ep'];
$identifier_episode_id          = "";
$identifier_episode_current     = 0;
$identifier_episode_slugtitle   = "";
$identifier_episode_title       = "";
$identifier_episode_thumbnail   = "";

$json_episodes           = json_decode(str_replace("crunchyroll\n{", "{", get_episodes("roll", $identifier_streamid)), true);
$episode_count           = 1;
$generated_episodes_html = "";

$episode_list = array();

foreach ($json_episodes['items'] as $season) {
    if($identifier_dub == ""){
        if(!strpos(strtolower($season['title']), "dub")){
            $season_number = $season['season_number'];
            if($season_number == $identifier_season){
                foreach($season['episodes'] as $season_episode){
                    if($episode_count == $identifier_episode){
                        $identifier_episode_thumbnail = $season_episode['images']['thumbnail'][7]['source'];
                        $identifier_episode_id = $season_episode['id'];
                        $identifier_season_id = $season_episode['season_id'];
                        $identifier_episode_current = $episode_count;
                        $identifier_episode_title = $season_episode['title'];
                        $paramurl = "/v1/$identifier_slugtitle_full/ep$episode_count/s$identifier_season";
                        if($season_episode['is_clip'] == 1 || $season_episode['episode'] == "OVA"){
                            if($season_episode['episode'] == "OVA"){
                                $generated_episodes_html .= '<a class="playbutton btn btn-primary no-click" disabled href="'. $paramurl .'">'. 'OVA'  . ' </a>';
                                $episode_data = array(
                                    "URL" => $paramurl,
                                    "OVA" => true,
                                    "PV" => false, 
                                    "episode_number" => $episode_count, 
                                    "sequence_number" => $season_episode['sequence_number'],
                                    "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                                );
                                array_push($episode_list, $episode_data);
                            } else {
                                $generated_episodes_html .= '<a class="playbutton btn btn-primary no-click" disabled href="'. $paramurl .'">'. 'PV'  . ' </a>';
                                $episode_data = array(
                                    "URL" => $paramurl,
                                    "OVA" => false,
                                    "PV" => true, 
                                    "episode_number" => $episode_count, 
                                    "sequence_number" => $season_episode['sequence_number'],
                                    "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                                );
                                array_push($episode_list, $episode_data);
                            } 
                        } else {
                            $generated_episodes_html .= '<a class="playbutton btn btn-primary no-click" disabled href="'. $paramurl .'">'. $episode_count  . ' </a>'; 
                            $episode_data = array(
                                "URL" => $paramurl,
                                "OVA" => false,
                                "PV" => false, 
                                "episode_number" => $episode_count, 
                                "sequence_number" => $season_episode['sequence_number'],
                                "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                            );
                            array_push($episode_list, $episode_data);
                        }
                        $identifier_episode_slugtitle = $season_episode['season_slug_title'];
                        $identifier_season_title = $season_episode['season_title'];
                    } else {
                        $paramurl = "/v1/$identifier_slugtitle_full/ep$episode_count/s$identifier_season";
                        if($season_episode['is_clip'] == 1 || $season_episode['episode'] == "OVA"){
                            if($season_episode['episode'] == "OVA"){
                                $generated_episodes_html .= '<a class="playbutton btn btn-primary" href="'. $paramurl .'">'. 'OVA'  . ' </a>'; 
                                $episode_data = array(
                                    "URL" => $paramurl,
                                    "OVA" => true,
                                    "PV" => false, 
                                    "episode_number" => $episode_count, 
                                    "sequence_number" => $season_episode['sequence_number'],
                                    "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                                );
                                array_push($episode_list, $episode_data);
                            } else {
                                $generated_episodes_html .= '<a class="playbutton btn btn-primary" href="'. $paramurl .'">'. 'PV'  . ' </a>'; 
                                $episode_data = array(
                                    "URL" => $paramurl,
                                    "OVA" => false,
                                    "PV" => true, 
                                    "episode_number" => $episode_count, 
                                    "sequence_number" => $season_episode['sequence_number'],
                                    "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                                );
                                array_push($episode_list, $episode_data);
                            }
                        } else {
                            $generated_episodes_html .= '<a class="playbutton btn btn-primary" href="'. $paramurl .'">'. $episode_count  . ' </a>'; 
                            $episode_data = array(
                                "URL" => $paramurl,
                                "OVA" => false,
                                "PV" => false, 
                                "episode_number" => $episode_count, 
                                "sequence_number" => $season_episode['sequence_number'],
                                "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                            );
                            array_push($episode_list, $episode_data);
                        }
                    }
                    $episode_count += 1;
                }
            }
        } else {}
    } else {
        if(strpos(strtolower($season['title']), $identifier_dub)){
            $season_number = $season['season_number'];
            if($season_number == $identifier_season){
                foreach($season['episodes'] as $season_episode){
                    if($episode_count == $identifier_episode){
                        $identifier_episode_thumbnail = $season_episode['images']['thumbnail'][7]['source'];
                        $identifier_episode_id = $season_episode['id'];
                        $identifier_season_id = $season_episode['season_id'];
                        $identifier_episode_title = $season_episode['title'];
                        $identifier_episode_current = $episode_count;
                        $paramurl = "/v1.php?name=$identifier_slugtitle_full&ep=$episode_count&s=$identifier_season";
                        if($season_episode['is_clip'] == 1 || $season_episode['episode'] == "OVA"){
                            if($season_episode['episode'] == "OVA"){
                                $generated_episodes_html .= '<a class="playbutton btn btn-primary no-click" disabled href="'. $paramurl .'">'. 'OVA'  . ' </a>'; 
                                $episode_data = array(
                                    "URL" => $paramurl,
                                    "OVA" => true,
                                    "PV" => false, 
                                    "episode_number" => $episode_count, 
                                    "sequence_number" => $season_episode['sequence_number'],
                                    "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                                );
                                array_push($episode_list, $episode_data);
                            } else {
                                $generated_episodes_html .= '<a class="playbutton btn btn-primary no-click" disabled href="'. $paramurl .'">'. 'PV'  . ' </a>'; 
                                $episode_data = array(
                                    "URL" => $paramurl,
                                    "OVA" => false,
                                    "PV" => true, 
                                    "episode_number" => $episode_count, 
                                    "sequence_number" => $season_episode['sequence_number'],
                                    "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                                );
                                array_push($episode_list, $episode_data);
                            }
                        } else {
                            $generated_episodes_html .= '<a class="playbutton btn btn-primary no-click" disabled href="'. $paramurl .'">'. $episode_count  . ' </a>'; 
                            $episode_data = array(
                                "URL" => $paramurl,
                                "OVA" => false,
                                "PV" => false, 
                                "episode_number" => $episode_count, 
                                "sequence_number" => $season_episode['sequence_number'],
                                "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                            );
                            array_push($episode_list, $episode_data);
                        }
                        $identifier_episode_slugtitle = $season_episode['season_slug_title'];
                        $identifier_season_title = $season_episode['season_title'];
                    } else {
                        $paramurl = "/v1/$identifier_slugtitle_full/ep$episode_count/s$identifier_season";
                        if($season_episode['is_clip'] == 1 || $season_episode['episode'] == "OVA"){
                            if($season_episode['episode'] == "OVA"){
                                $generated_episodes_html .= '<a class="playbutton btn btn-primary" href="'. $paramurl .'">'. 'OVA'  . ' </a>'; 
                                $episode_data = array(
                                    "URL" => $paramurl,
                                    "OVA" => true,
                                    "PV" => false, 
                                    "episode_number" => $episode_count, 
                                    "sequence_number" => $season_episode['sequence_number'],
                                    "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                                );
                                array_push($episode_list, $episode_data);
                            } else {
                                $generated_episodes_html .= '<a class="playbutton btn btn-primary" href="'. $paramurl .'">'. 'PV'  . ' </a>'; 
                                $episode_data = array(
                                    "URL" => $paramurl,
                                    "OVA" => false,
                                    "PV" => true, 
                                    "episode_number" => $episode_count, 
                                    "sequence_number" => $season_episode['sequence_number'],
                                    "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                                );
                                array_push($episode_list, $episode_data);
                            }
                        } else {
                            $generated_episodes_html .= '<a class="playbutton btn btn-primary" href="'. $paramurl .'">'. $episode_count  . ' </a>'; 
                            $episode_data = array(
                                "URL" => $paramurl,
                                "OVA" => false,
                                "PV" => false, 
                                "episode_number" => $episode_count, 
                                "sequence_number" => $season_episode['sequence_number'],
                                "air_date" => strtotime(str_replace('Z', "", str_replace('T', " ", $season_episode['episode_air_date']))),
                            );
                            array_push($episode_list, $episode_data);
                        }
                    }
                    $episode_count += 1;
                }
            }
        }
    }
}

//echo '<pre>' . var_export($episode_list, true) . '</pre>';


$episode_list_dates = array();

foreach($episode_list as $episode){
    array_push($episode_list_dates, $episode['air_date']);
}

usort($episode_list_dates, 'date_sorting');
//echo $identifier_episode_current;
/*
foreach($episode_list_dates as $date){
    foreach($episode_list as $episode){
        if($episode['air_date'] == $date){
            if($episode['episode_number'] == $identifier_episode_current){
                echo $episode['URL'] . ' SELECTED<br>';
            } else {
                echo $episode['URL'] . ' NOT<br>';
            }
        }
    }
}*/

$json = json_decode(str_replace("crunchyroll\n{", "{", get_streams("roll", $identifier_episode_id)), true);

foreach ($json['streams'] as $stream) {
    if(!isset($_COOKIE['preferred_locale'])){
        if(strtolower($stream['hardsub_locale']) == "en-us"){
            $makeurl = $stream['url'];
            $selsub = "en";
        } else {
            $makeurl = $stream['url'];
            $selsub = explode("-", $stream['audio_locale'])[0];
        }
    } else {
        if($stream['hardsub_locale'] == ""){
            if(explode("-", $stream['audio_locale'])[0] == $_COOKIE['preferred_locale']){
                $makeurl = $stream['url'];
    
                $selsub = explode("-", $stream['audio_locale'])[0];
            }
        } else {
            if(explode("-", $stream['hardsub_locale'])[0] == $_COOKIE['preferred_locale']){
                $makeurl = $stream['url'];
    
                $selsub = explode("-", $stream['hardsub_locale'])[0];
            }
        }
    }
    $subindex += 1;
}

if($makeurl == ""){
    foreach ($json['streams'] as $streame) {
        $stream = $streame['url'];
        if(strpos($streame['hardsub_locale'], "-")){
            $selsub = explode("-", $streame['hardsub_locale'])[0];
        }
    }
    
} else {
    $stream = $makeurl;
}

$result = /*REMOVED SQL CODE | https://i.imgur.com/BjE5Fql.png */

foreach($result as $row){
    $title       = $row['title'];
    $description = $row['description'];
    $genres      = $row['genres'];
    $status      = $row['status'];
}

//echo $identifier_season_title;
$simplied_title = strlen($identifier_season_title) > 98 ? substr($identifier_season_title,0,98)."..." : $identifier_season_title;
$mal   = fetch_search_anime(smallifyTitle($simplied_title));
$jikan = parse_anime(fetch_anime_byId($mal['id']));

$seen_data = cookie_progress_episode_seen($mal['id']);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, shrink-to-fit=no, user-scalable=no" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="AnimixReplay" />
    <meta name="application-name" content="AnimixReplay" />
    <meta name="msapplication-starturl" content="/" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta property="og:title" content="<?php echo $identifier_season_title; ?> - AnimixReplay" />
    <meta property="og:image" content="<?php echo $jikan['poster']; ?>" />
    <meta property="og:description" content="<?php $jikan['description']; ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="description" content="<?php echo $jikan['description']; ?>" />
    <meta name="theme-color" content="#191919" />
    
    <title><?php echo $identifier_season_title; ?> - AnimixReplay</title>

    <link rel="icon" href="/assets/icon.webp" />
    <link rel="apple-touch-icon" href="/assets/icon.webp" />
    <link rel="manifest" href="/assets/s/manifest.json" />
    <link rel="stylesheet" href="/assets/plyr.css" />
    <link rel="stylesheet" href="/assets/fonts.min.css" />
    <link rel="stylesheet" href="/assets/player.css" />
    <link rel="stylesheet" type="text/css" href="/assets/style.minabec.css?m12" />

    <script src="/assets/lib/jquery.min.js" defer></script>
    <script src="/assets/axios.min.js"></script>
    <script src="/assets/main.js" defer=""></script>
    <script src="/assets/common.min.js" defer=""></script>
    <script src="/assets/v1.min.js" defer=""></script>
    <script src="/assets/player.js" defer=""></script>
    <script src="/assets/plyr.min.js"></script>
    <script src="/assets/hls.js"></script>
  </head>

  <body>
    <div id="coverlight" style="z-index: 8; display: none; opacity: 1;  transition: opacity 0.5s ease 0s;"></div>
    <div id="loadcontainer">
      <div class="loadindicator"></div>
    </div>
    <div class="toppart" style="position: relative; z-index: 1;">
      <div id="playertopmenu" class="floattopsearch">
        <a id="backicon" onclick="window.history.back()">
            <i class="glyphicon glyphicon-chevron-left"></i>
        </a>
        <a id="homeicon" href="/index.php">
            <i class="glyphicon glyphicon-home"></i>
        </a>
        <div id="searchbox">
          <input type="text" style="display:none" />
          <input type="password" style="display:none" />
          <a href="/">
            <img class="webtitle" alt="AnimixReplay"src="/assets/logo.webp"/>
          </a>
          <input
            class="form-control searchbar"
            pattern=".{3,}"
            placeholder="Search"
            id="q"
            type="search"
            autocomplete="off"
            onfocus="searchfocused()"
            onblur="searchblur()"
          />
          <button id="searchbutton" onclick="dosearchfromplayer()">
            <i class="glyphicon glyphicon-search"></i>
          </button>
          <a class="topmenubtn" title="Random anime" href="/random">
            <i class="glyphicon glyphicon-random"></i>
            Random
          </a>
          <a class="topmenubtn" title="A-Z List" href="/list">A-Z List</a>
        </div>
        <span id="usernametop"></span>
        <button id="menumobilebtn2" OnClick="showmobilemenu()">
          <i class="glyphicon glyphicon-menu-hamburger"></i>
        </button>
        <button id="showsearchbtn" OnClick="togglesearch()">
          <i class="glyphicon glyphicon-search"></i>
        </button>
      </div>
    </div>

    <div class="quicksearchcontainer absolutee" style="display: none;">
      <div class="resultcontainer sanimepage">
        <div id="fullresultbtn">
          <a onclick="cSearch('full')">Full</a>
          <a onclick="cSearch('roll')">ROLL</a>
          <a onclick="cSearch('gogo')">GOGO</a>
          <a onclick="cSearch('kawa')">KAWA</a>
          <a onclick="cSearch('mal')">MAL</a>
        </div>
        <ul id="search-results" class="quickresult">
          <!-- Results in here -->
        </ul>
      </div>
    </div>
    <div id="tips"></div>
    <div id="topmid"></div>
    <div class="playersidebar"></div>

    <div id="playerleftsidebar">
      <button id="recomendedclosebtn" onclick="hiderecomendmenu();">
        <i class="glyphicon glyphicon-arrow-left"></i>
      </button>
      <div id="moreinfobtn" onclick="editStreams()"><a>Problem ?</a></div>
      <div id="recomendedlist">
        <div class="recomendedtitle">ADN</div>
        <div class="reclistcontainer">
          <a href="/#" title="#(Dub)">
            <div>
              <div class="recflexlist">
                <div class="imguserlist">
                  <img class="imgusr" src="https://cdn.animixplay.to/i/662ca18de093a67899875183434bdcb5.jpg"/>
                </div>
                <div class="detailuserlist" style="cursor:pointer">
                  <p class="reclisttitle">
                    <span class="dubtag">[Dub]</span> #
                  </p>
                  <p class="watchprogress">#</p>
                  <p class="listviewcount">#</p>
                </div>
              </div>
            </div>
          </a>

          <a href="#" title="Chainsaw Man">
            <div onclick="showrecomendmenu();" style="border-left:3px solid #5baaff;padding-left:7px;margin-left:-10px;">
              <div class="recflexlist">
                <div class="imguserlist">
                  <img class="imgusr" src="https://cdn.animixplay.to/min/mal/1806/126216.jpg" />
                </div>
                <div class="detailuserlist" style="cursor:pointer">
                  <p class="reclisttitle">#</p>
                  <p class="watchprogress">#</p>
                  <p class="listviewcount">#</p>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="recomendedtitle" style="opacity:0.5">Neko-Sama</div>
        <div class="reclistcontainer" style="opacity:0.5">
          <a href="#" title="#">
            <div>
              <div class="recflexlist">
                <div class="imguserlist">
                  <img class="imgusr" src="https://cdn.animixplay.to/i/662ca18de093a67899875183434bdcb5.jpg" />
                </div>
                <div class="detailuserlist" style="cursor:pointer">
                  <p class="reclisttitle">#</p>
                  <p class="watchprogress">#</p>
                  <p class="listviewcount">#</p>
                </div>
              </div>
            </div>
          </a>

          <a href="#" title="Chainsaw Man (Dub)">
            <div>
              <div class="recflexlist">
                <div class="imguserlist">
                  <img class="imgusr" src="https://cdn.animixplay.to/i/662ca18de093a67899875183434bdcb5.jpg" />
                </div>
                <div class="detailuserlist" style="cursor:pointer">
                  <p class="reclisttitle"><span class="dubtag">[Dub]</span>#</p>
                  <p class="watchprogress">#</p>
                  <p class="listviewcount">#</p>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="recomendedtitle" style="opacity:0.5">CrunchyRoll</div>
        <div class="reclistcontainer" style="opacity:0.5">
          <a href="#" title="#">
            <div>
              <div class="recflexlist">
                <div class="imguserlist">
                  <img class="imgusr" src="https://cdn.animixplay.to/i/662ca18de093a67899875183434bdcb5.jpg" />
                </div>
                <div class="detailuserlist" style="cursor:pointer">
                  <p class="reclisttitle">#</p>
                  <p class="watchprogress">#</p>
                  <p class="listviewcount">#</p>
                </div>
              </div>
            </div>
        </a>
    </div>
        <div id="extracontainer">
          <button id="showExternalBtn" onclick="showExternal()">
            <i class="glyphicon glyphicon-menu-down"></i> External Websites
          </button>
          <div id="loadStatus"></div>
        </div>
      </div>
    </div>

    <div class="playerpage">
      <div class="subpart eptitle">
        <div id="eptitle">
          <span id="eptitleplace">
            <?php 
            $out_episode_title = strlen($identifier_episode_title) > 25 ? substr($identifier_episode_title,0,25)."..." : $identifier_episode_title;
            echo "EP" . $identifier_episode_current . " S" . $identifier_season . " - " . $out_episode_title; 
            ?>
          </span>
          <span class="altsourcenotif">Internal Player</span>
        </div>
        <div id="toprightplayer">
          <i onClick="switchToLive();" class="proxybtn glyphicon glyphicon glyphicon-transfer">
            <span class="tooltiptext">Switch</span>
          </i>
          <i onClick="lighttoggle();" class="lightbtn glyphicon glyphicon-sunglasses">
            <span class="tooltiptext">Lights</span>
          </i>
          <i onClick="download();" class="dlbutton glyphicon glyphicon-download-alt">
            <span class="tooltiptext">Download</span>
          </i>
          <i onClick="toggleautoplay();" class="autoplaybutton glyphicon glyphicon-flash">
            <span class="tooltiptext">Autoplay</span>
          </i>
          <i onClick="window.location = '<?php
          $total = $identifier_episode_current + 1;
          $paramurl = "/v1.php?name=$identifier_slugtitle_full&ep=$total&s=$identifier_season";
          echo $paramurl;
          ?>'" id="nextbtn" class="glyphicon glyphicon-forward">
            <span class="tooltiptext">Next ep</span>
          </i>
        </div>
      </div>
      <div id="loadcontainer2" style="display:none;overflow:hidden">
        <div class="loadindicator"></div>
      </div>
      <div id="iframecontainer">
        <div class="container">
          <video id="VIDEOA" controls playsinline poster="">
            <source type="application/x-mpegURL" src="lol why would i tell you???" />
          </video>
        </div>
      </div>
      <select id="srcselect" onchange="srcChange()"></select>
      <div id="lowerplayerpage">
        <div id="aligncenter">
          <div id="streamtypecontainer">
            <div id="streamtype">
              <?php echo $streamtype; ?>
              Stream
            </div>
            <div id="showrecomendbtn" onClick="showrecomendmenu();" style="display: inline-block;">
              <i class="glyphicon glyphicon-cog"></i>
              <span id="changetext">Change</span>
            </div>
            <div id="sharebtn" style="display: none;">
              <i class="glyphicon glyphicon-share-alt"></i>
              <span id="shareText">Share</span>
            </div>
            <div id="reloadbtn" class="js-reload" style="display: block;">
              <i class="glyphicon glyphicon-repeat"></i>
              <span class="reportText">Reload</span>
            </div>
            <div id="widescreenbtn">
              <i class="glyphicon glyphicon-fullscreen js-fullscreen"></i>
            </div>
          </div>

          <a id="animebtn" style="display: inline;" href="<?php echo "anime.php?id=" . $mal['id']; ?>">
            <svg
              stroke="currentColor"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              height="25"
              width="25"
              id="foldersvg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z">
            </path>
            </svg>
          </a>
          <span class="animetitle"><?php echo $identifier_season_title ?></span>
          <button id="trackbtn" onclick="startTrack();">
            <i class="glyphicon glyphicon-plus">
            </i> Watchlist
          </button>
          <button id="followbtn" onclick="followtoggle();">
            <i class="glyphicon glyphicon-bell">
            </i> Follow
          </button>
          <br />
          <div id="animeimage"></div>
          <span id="notice" style="display: none;">
            <br />
            <br />
            <br />
            Try clear cache & make sure your browser
            extension not block javascript
            <br />
            <br />
            <br/>
          </span>
        </div>
        <div id="epslistplace" style="display: grid;">
        <?php
        echo $generated_episodes_html;
        ?>
        </div>
        <div id="flexbottom" style="display: flex;">
          <div id="bottomleft">
            <span id="genres">Genres :
              <span id="genredata">
                <?php echo str_replace(",", ", ", $jikan['genres']) ?>
              </span>
            </span>
            <br />
            <span id="status">Status :
              <span id="statusdata"><?php echo $jikan['status']; ?>
              </span>
            </span>
            <span id="animeinfobottom" style="display: block;">
                <a id="animebtn2" href="<?php echo "anime.php?id=" . $mal['id']; ?>">More info </a>
            </span>
          </div>
          <div class="epsavailable">
            Ep total :
            <span id="epsavailable"><?php echo $episode_count - 1; ?>
            </span>
            <a onClick="updatecheck()" id="updatebtn">
                <i class="glyphicon glyphicon-refresh">
                </i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div id="flexstreambottom">
      <div style="flex:1">
        <div id="disquscommentnew">
          <button id="showcommentbtn" OnClick="showcomment()">
            Show Comments
          </button>
          <div id="disqus_thread"></div>
        </div>
        <div id="belowcomment"></div>
      </div>
      <div id="streambottomright"></div>
    </div>
    <div id="belowbox"></div>
    <div id="notifiaction">Test</div>
    <script>
	var player = undefined;
	var malid = "<?php echo $mal['id']; ?>"
	var season_title = "<?php echo $identifier_season_title; ?>"
	var episode_current = "<?php echo $identifier_episode_current; ?>"
    </script>
	<?php include 'players/v1_player.php'; ?>
  </body>
</html>
