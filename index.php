<?php
header("Cache-Control: max-age=2592000");
function parse_anime($series){
    $mal_id         = $series['mal_id'];
    $title_english  = $series['title_english'];
    $description    = $series['synopsis'];
    $star_rating    = $series['score'];
    $status         = $series['status'];
    $episodes       = $series['episodes'];
    $type           = $series['type'];
    $year           = $series['year'];
    $season         = $series['season'];
    $poster         = $series['images']['webp']['large_image_url'];
    $genres         = NULL;
    $allTitles      = array("title"          => $series['title'],
                            "title_english"  => $series['title_english'],
                            "title_japanese" => $series['title_japanese']);

    foreach ($series['genres'] as $genre) {
        $genres = $genres . "," . $genre['name'];
    }
    $genres = substr($genres, 1);

    $tcount = 0;
    foreach ($series['titles'] as $sTitle) {
        $allTitles["title" . $tcount] = $sTitle['title'];
        $tcount = $tcount + 1;
    }

    foreach ($series['title_synonyms'] as $sTitle) {
        $allTitles["title" . $tcount] = $sTitle;
        $tcount = $tcount + 1;
    }
    return array("mal_id"       => $mal_id, 
                 "title_english"=> $title_english, 
                 "titles"       => $allTitles,
                 "description"  => $description, 
                 "rating"       => $star_rating, 
                 "type"         => $type, 
                 "year"         => $year, 
                 "season"       => $season, 
                 "status"       => $status, 
                 "episodes"     => $episodes, 
                 "poster"       => $poster, 
                 "genres"       => $genres);
}

//type = ("tv" "movie" "ova" "special" "ona" "music")
//filter = ("airing" "upcoming" "bypopularity" "favorite")
//page = integer
//limit = amount of titles to get
function fetch_recent_anime($type, $filter, $page, $limit){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.simkl.com/anime/airing?get-airing-anime?client_id=lmao");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json   = json_decode(curl_exec($ch), true);
    $titles = array();

    foreach ($json['data'] as $series) {
        array_push($titles, parse_anime($series));
    }
    return $titles;
}

function fetch_top_anime($type, $filter, $page, $limit){
    //https://api.jikan.moe/v4/top/anime?type=tv&filter=airing&limit=24
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.jikan.moe/v4/top/anime?type=" . $type . "&filter=" . $filter . "&page=" . $page . "&limit=" . $limit);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json   = json_decode(curl_exec($ch), true);
    $titles = array();

    foreach ($json['data'] as $series) {
        array_push($titles, parse_anime($series));
    }
    return $titles;
}

function fetch_search_anime($name, $resultlimit){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.jikan.moe/v4/anime?q=" . $name . "&limit=" . $resultlimit);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json   = json_decode(curl_exec($ch), true);
    $titles = array();

    foreach ($json['data'] as $series) {
        array_push($titles, parse_anime($series));
    }
    return $titles;
}
//$arry = fetch_search_anime("highschool", 10);
//echo '<pre>' . var_dump($arry[0]['titles']) . '</pre>'
//echo $arry[0]['titles']['title_japanese'];

$top_tv = fetch_top_anime("tv", "airing", 1, 7);
$top_ova = fetch_top_anime("ova", "airing", 1, 7);
$top_ona = fetch_top_anime("ona", "airing", 1, 7);
$top_movie = fetch_top_anime("ona", "movie", 1, 7);
$result = array_merge($top_tv, $top_ova, $top_ona, $top_movie);
$cache = "https://cdn.animixreplay.to/";
$domain = "https://animixreplay.to/";


function encodeURIComponent($str) {
  $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
  return strtr(rawurlencode($str), $revert);
}


function makecachelink($asset){
  echo "https://cdn.animixreplay.to/" . base64_encode(encodeURIComponent($asset));
}
function makecache($asset){
  echo "https://cdn.animixreplay.to/" . base64_encode(encodeURIComponent("https://animixreplay.to/" . $asset));
}
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="UTF-8">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="application-name" content="AnimixReplay">
  <meta name="apple-mobile-web-app-title" content="Animixreplay">
  <meta name="msapplication-starturl" content="/">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=no">
  <meta property="og:image" content="<?php makecache("assets/icon.webp"); ?>">
  <meta property="og:title" content="Animixreplay - Watch HD Anime for Free">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="theme-color" content="#191919">
  <meta name="twitter:card" content="summary">
  <link rel="icon" href="<?php makecache("assets/icon.webp"); ?>">
  <link rel="apple-touch-icon" href="<?php makecache("assets/apple/apple-touch-icon.webp"); ?>">
  <link rel="manifest" href="/assets/s/manifest.json">

  <title>AnimixReplay - Watch HD Anime for Free</title>
  <script type="text/javascript" src="<?php makecache("assets/lib/jquery.min.js"); ?>" defer></script>
  <link rel="stylesheet" href="<?php makecache("assets/fonts.min.css?version=3"); ?>">
  <link rel="stylesheet" type="text/css" href="<?php makecache("assets/style.minabec.css?m12"); ?>">
  <!-- <script type="text/javascript" src="assets/main.minbc0a.js?m23" defer></script> -->
  <script src="<?php makecache("assets/main.js?version=942762123"); ?>" defer></script>
  <script src="" defer></script>
  <script src="<?php makecache("assets/lib/jquery.min.js"); ?>" defer></script>
  <script src="/assets/common.min.js" defer></script>
  <!--
  <script src="/assets/homepage.js" defer></script> -->

  <script src="<?php makecachelink("https://cdn.jsdelivr.net/npm/axios@0.21.2/dist/axios.min.js"); ?>"></script>
  <meta property="og:description" content="Watch Anime for free in HD quality with English subbed or dubbed.">
  <meta name="description" content="Watch Anime for free in HD quality with English subbed or dubbed.">
</head>

<body style="background-color:rgb(25,25,25)">
  <div id="coverlight" style="z-index:8"></div>
  <div id="loadcontainer">
    <div class="loadindicator"></div>
  </div>
  <div class="toppart">
    <div id="songContent" class="floattopsearch">
      <a id="backiconhome" onclick="window.history.back()"><i class="glyphicon glyphicon-chevron-left"></i></a>
      <a id="homeicon" href="index.php"><i class="glyphicon glyphicon-home"></i></a>
      <div id="searchbox">
        <input type="text" style="display:none;">
        <input type="password" style="display:none;">
        <a href="index.php"><img class="webtitle" alt="AnimixReplay" src="<?php makecache("assets/logo.webp"); ?>" /></a>
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
		
	<button id="searchbutton" onClick="dosearchfromplayer()"><i class="glyphicon glyphicon-search"></i></button>
        <a class="topmenubtn" title="Random anime" href="/random.php"><i class="glyphicon glyphicon-random"></i>Random</a>
        <a class="topmenubtn" title="A-Z List" href="/list.php">A-Z List</a>
      </div>
      <button id="menumobilebtn" OnClick="showmobilemenu()"><i class="glyphicon glyphicon-menu-hamburger"></i></button>
      <button id="showsearchbtn" OnClick="togglesearch()"><i class="glyphicon glyphicon-search"></i></button>
    </div>
  </div>
  <div class="quicksearchcontainer" style="display: none;">
    <div class="resultcontainer">
      <div id="fullresultbtn">
        <a onClick="searchfull()">Full</a><a onClick="searchE1()">GOGO</a><a onClick="searchE11()">AL</a><a onClick="searchE6()">RUSH</a><a onClick="searchMAL()">MAL</a>
      </div>
	  
	  
      <ul id="search-results" class="quickresult">
          <!-- Results in here -->
        </ul>
	  
	  
    </div>
  </div>
  <div class="middle">
    <div id="flexcontainer">
      <div class="leftside">
        <div id="pwaContainer">
          AniMixPlay PWA available<button id="pwaButton" class="btn btn-primary">Install PWA</button>
        </div>
        <div id="featuredcard">
          <div id="featuredbgcont">
            <img id="featuredbg" src="#" />
          </div>

          <div id="featuredcont">

            <a href="/v2/high-school-dxd-dub/ep1"><img id="featuredimg" src="<?php makecache("assets/dxd_thumbnail.webp"); ?>" /></a>
            <div id="featuredtitle"><a href="/v2/high-school-dxd-dub/ep1">Highschool DxD</a></div>
            <div id="featuredtext"> A war between heaven and hell is raging on Earth—and hormonal fury is raging in Issei’s pants. Enter curvy redhead Rias, president of The Occult Research Club: a club that doesn’t actually research the occult. They are the occult—and Rias is a Devil!</div>
            <div id="featuredgenre"><i class="glyphicon glyphicon-tag"></i> Best, Anime, Ever</div>
            <!-- 
            <a id="featuredNext" onClick="showFeatured(curFeatured + 1)"><i class="glyphicon glyphicon-chevron-right"></i></a>
            <a id="featuredBack" onClick="showFeatured(curFeatured - 1)"><i class="glyphicon glyphicon-chevron-left"></i></a>
            -->
          </div>
        </div>

        <div id="announcement" style="display: none;">
          Beware of fake sites, only <span style="color:#c1ba93;">animixreplay.to</span> is ours.<br>
          Don't rely on google search! use bookmark instead.<br>
          <br>
          If you got problem try <i class="glyphicon glyphicon-repeat"></i> reload the player several times, or just switch to external player.<br>
          Also worth to try in incognito mode, disabling browser extension, or clearing cache.<br>
          <br>
          For mobile users, you can swipe left / right to open menu, schedule, and stream list.<br>
          You can also install PWA (add to homescreen) to launch AniMixPlay like an app.<br>
          <br>
          Read more info in our <a href="info.html">info</a> page.<br>
        </div>
        <button style="display: none;"type="button" id="readmorebtn" onClick="readmore()" class="btn btn-secondary btn-sm btn-lg btn-block"><i class="glyphicon glyphicon-menu-down"></i></button>
        <button type="button" id="openschedulebtn" onClick="showschedulemenu()"><i class="glyphicon glyphicon-time"></i> Schedule</button>
        <div id="navtab">
          <ul class="nav nav-tabs">
            <!-- <li id="recentbtn" class="active" onload="recentfetch()"><a>Recent</a></li> -->
		    <li id="subbtn" class="active" onload="subfetch()"><a>Sub</a></li>
            <li id="dubbtn"><a style="border-bottom: 1px solid #e36a6a;">Dub</a></li>
            <!-- <li id="followedbtn"><a>Followed</a></li> -->
            <li id="popularbtn"><a>Popular</a></li>
			<li id="upcomingbtn"><a>Upcoming</a></li>
            <li id="moviebtn"><a>Movie</a></li>
          </ul>
        </div>
        <div id="seasontopnav">
          <div id="prevseasonbtn" onClick="seasonPrev()">&lt; Previous season</div>
          <div id="nextseasonbtn" onClick="seasonNext()">Next season &gt;</div>
          <select id="topfilterselect" onchange="seasonFilterChange()">
            <option value="all">Show all</option>
            <option value="new">New</option>
            <option value="continuing">Continuing</option>
          </select>
        </div>
        <div id="genresortbtn">
          Sort by :
          <select id="topsortselect" onchange="filterSortChange()">
            <option value="any">none</option>
            <option value="popular" selected>Popularity</option>
            <option value="rating">Rating</option>
            <option value="latest">Latest update</option>
          </select>
        </div>
        <div id="resultplace">
          <ul id="homepage"class="searchresult">
			<!-- Mainpage Slots -->	
			 
			  
          </ul>
          <div id="bottommsg">
            <div type="button" id="loadmorelist"><i class="glyphicon glyphicon-menu-down"></i> Load more</div>
          </div>
		  
        </div>
        <div id="loadingtext">
          <svg class="spinner" width="75px" height="75px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
          </svg><br><br>Loading...
        </div>
        <div id="resultAlt">
          <div id="loadmoresearch">Loading...</div>
        </div>
        <br>
      </div>
	
	
      <div class="rightside" id="rightsidee">
	  
        <div class="rightcard">
          <div style="display: none;"class="loadingreplacement">Loading...</div>
          <div id="userpanel">
    <span class="usernameplace"></span><span id="premiumcrown"></span><br><br>
    <div id="iconmenu">
        <a class="linkpersonal glyphicon glyphicon-th-list" href=""><br><span class="subtextmenuicon">User Panel</span></a>
        <i class="autotrackbtn glyphicon glyphicon-refresh" onclick="autotrackbtnclick();"><br><span class="subtextmenuicon">Autotracking</span></i>
        <i class="glyphicon glyphicon-off" onclick="logout();"><br><span class="subtextmenuicon">Logout</span></i>
    </div>
    <div id="logoutmsg"></div>
</div>
<div id="loginform" style="display: block;">
    <div class="flexrightcard">
        <div class="halfleft">
            <input class="logininput" placeholder="Username" id="username" type="text" autocomplete="username">
            <input class="logininput" placeholder="Password" id="password" type="password" autocomplete="current-password">
            <input type="checkbox" value="" id="rememberme" checked="">
            <label class="form-check-label rememberlabel" for="rememberme">
            Remember me
            </label>
        </div>
        <div class="halfright">
            <div class="loginbtn" onclick="login();">Login</div>
            <a class="openregisterbtn" onclick="window.location.href='/account/index';">Register</a>
        </div>
    </div>
    <div id="statuslogin"></div>
</div>
<form id="registerform">
    <a class="openloginbtn" onclick="backlogin();">&lt; back</a><br><br>
    <span id="alretinfo">Note: we don't use email (no reset password), please use password manager so you not forget</span>
    <div id="formregister">
        <input class="logininput" placeholder="Username" id="usernameregis" type="text" autocomplete="off">
        <div class="formsubtext">letters/numbers/_.-| max 25 chars</div>
        <input class="logininput" placeholder="Password" id="passwordregis" type="password" autocomplete="off">
        <div class="formsubtext">any 4 - 200 chars</div>
        <input class="logininput" placeholder="Confirm Password" id="confirm" type="password" autocomplete="off">
        <div class="formsubtext">retype password</div>
        <div class="g-recaptcha" data-theme="dark" data-sitekey="6LfYUUceAAAAAEC5G8ZmQEqELhXx55thJrVKDrew"></div>
    </div>
    <div id="statusregister"></div>
    <div class="registerbtn" onclick="window.location.href='/account/index';">Register</div>
</form>

        </div>
		<br>
        <div class="rightcard signinhome" id="gsignsection">
          <div class="subtitleright" style="border-bottom:none"></div>
          <div id="gconnectbtn"><img id="gconnectbtnimg" onClick="connectGoogle()" src="<?php makecache("assets/s/gsign.jpg"); ?>"></div>
        </div>
        <div class="rightcard mobilemenureplace">
          <a class="topmenubtn" onClick="showschedulemenu()"><i class="glyphicon glyphicon-time"></i>Schedule</a>
          <a class="topmenubtn" title="Random anime" href="anime/18055.html"><i class="glyphicon glyphicon-random"></i>Random</a>
          <a class="topmenubtn" title="A-Z List" href="list.html">A-Z List</a>
        </div>
        <div class="rightcard">
          <div class="flexrightcard" id="seasonfilter">
            <div id="seasonleft">
              <label for="seasonselect">Season:</label>
              <select id="seasonselect">
                <option value="Winter">Winter</option>
                <option value="Spring">Spring</option>
                <option value="Summer">Summer</option>
                <option value="Fall">Fall</option>
              </select>
            </div>
            <div id="yearright">
              <label for="yearselect">Year:</label>
              <select id="yearselect"></select>
            </div>
            <div style="flex:1">
              <div id="seasonalgobtn" onClick="seasonGo()">GO</div>
            </div>
          </div>
        </div>
        <div class="rightcard">
          <div class="subtitleright">Genres</div>
          
		  <div class="genresgrid form-check"><div><input class="form-check-input" type="checkbox" id="gen-Action" value="Action">
            <label class="form-check-label" for="gen-Action">Action</label></div><div><input class="form-check-input" type="checkbox" id="gen-Adventure" value="Adventure">
            <label class="form-check-label" for="gen-Adventure">Adventure</label></div><div><input class="form-check-input" type="checkbox" id="gen-Anti-Hero" value="Anti-Hero">
            <label class="form-check-label" for="gen-Anti-Hero">Anti-Hero</label></div><div><input class="form-check-input" type="checkbox" id="gen-CGDCT" value="CGDCT">
            <label class="form-check-label" for="gen-CGDCT">CGDCT</label></div><div><input class="form-check-input" type="checkbox" id="gen-College" value="College">
            <label class="form-check-label" for="gen-College">College</label></div><div><input class="form-check-input" type="checkbox" id="gen-Comedy" value="Comedy">
            <label class="form-check-label" for="gen-Comedy">Comedy</label></div><div><input class="form-check-input" type="checkbox" id="gen-Drama" value="Drama">
            <label class="form-check-label" for="gen-Drama">Drama</label></div><div><input class="form-check-input" type="checkbox" id="gen-Dub" value="Dub">
            <label class="form-check-label" for="gen-Dub">Dub</label></div><div><input class="form-check-input" type="checkbox" id="gen-Ecchi" value="Ecchi">
            <label class="form-check-label" for="gen-Ecchi">Ecchi</label></div><div><input class="form-check-input" type="checkbox" id="gen-Fantasy" value="Fantasy">
            <label class="form-check-label" for="gen-Fantasy">Fantasy</label></div><div><input class="form-check-input" type="checkbox" id="gen-GagHumor" value="Gag Humor">
            <label class="form-check-label" for="gen-GagHumor">Gag Humor</label></div><div><input class="form-check-input" type="checkbox" id="gen-Game" value="Game">
            <label class="form-check-label" for="gen-Game">Game</label></div><div><input class="form-check-input" type="checkbox" id="gen-Harem" value="Harem">
            <label class="form-check-label" for="gen-Harem">Harem</label></div><div><input class="form-check-input" type="checkbox" id="gen-Historical" value="Historical">
            <label class="form-check-label" for="gen-Historical">Historical</label></div><div><input class="form-check-input" type="checkbox" id="gen-Horror" value="Horror">
            <label class="form-check-label" for="gen-Horror">Horror</label></div><div><input class="form-check-input" type="checkbox" id="gen-Idol" value="Idol">
            <label class="form-check-label" for="gen-Idol">Idol</label></div><div><input class="form-check-input" type="checkbox" id="gen-Isekai" value="Isekai">
            <label class="form-check-label" for="gen-Isekai">Isekai</label></div><div><input class="form-check-input" type="checkbox" id="gen-Iyashikei" value="Iyashikei">
            <label class="form-check-label" for="gen-Iyashikei">Iyashikei</label></div><div><input class="form-check-input" type="checkbox" id="gen-Josei" value="Josei">
            
			<!--
			<label class="form-check-label" for="gen-Josei">Josei</label></div><div><input class="form-check-input" type="checkbox" id="gen-Kids" value="Kids">
            <label class="form-check-label" for="gen-Kids">Kids</label></div><div><input class="form-check-input" type="checkbox" id="gen-MagicalGirl" value="Magical Girl">
            <label class="form-check-label" for="gen-MagicalGirl">Magical Girl</label></div><div><input class="form-check-input" type="checkbox" id="gen-MartialArts" value="Martial Arts">
            <label class="form-check-label" for="gen-MartialArts">Martial Arts</label></div><div><input class="form-check-input" type="checkbox" id="gen-Mecha" value="Mecha">
            <label class="form-check-label" for="gen-Mecha">Mecha</label></div><div><input class="form-check-input" type="checkbox" id="gen-Military" value="Military">
            <label class="form-check-label" for="gen-Military">Military</label></div><div><input class="form-check-input" type="checkbox" id="gen-Movie" value="Movie">
            <label class="form-check-label" for="gen-Movie">Movie</label></div><div><input class="form-check-input" type="checkbox" id="gen-Music" value="Music">
            <label class="form-check-label" for="gen-Music">Music</label></div><div><input class="form-check-input" type="checkbox" id="gen-Mythology" value="Mythology">
            <label class="form-check-label" for="gen-Mythology">Mythology</label></div><div><input class="form-check-input" type="checkbox" id="gen-Mystery" value="Mystery">
            <label class="form-check-label" for="gen-Mystery">Mystery</label></div><div><input class="form-check-input" type="checkbox" id="gen-Otaku" value="Otaku">
            <label class="form-check-label" for="gen-Otaku">Otaku</label></div><div><input class="form-check-input" type="checkbox" id="gen-Parody" value="Parody">
            <label class="form-check-label" for="gen-Parody">Parody</label></div><div><input class="form-check-input" type="checkbox" id="gen-Police" value="Police">
            <label class="form-check-label" for="gen-Police">Police</label></div><div><input class="form-check-input" type="checkbox" id="gen-Psychological" value="Psychological">
            <label class="form-check-label" for="gen-Psychological">Psychological</label></div><div><input class="form-check-input" type="checkbox" id="gen-Racing" value="Racing">
            <label class="form-check-label" for="gen-Racing">Racing</label></div><div><input class="form-check-input" type="checkbox" id="gen-Revenge" value="Revenge">
            <label class="form-check-label" for="gen-Revenge">Revenge</label></div><div><input class="form-check-input" type="checkbox" id="gen-Romance" value="Romance">
            <label class="form-check-label" for="gen-Romance">Romance</label></div><div><input class="form-check-input" type="checkbox" id="gen-Rural" value="Rural">
            <label class="form-check-label" for="gen-Rural">Rural</label></div><div><input class="form-check-input" type="checkbox" id="gen-Samurai" value="Samurai">
            <label class="form-check-label" for="gen-Samurai">Samurai</label></div><div><input class="form-check-input" type="checkbox" id="gen-School" value="School">
            <label class="form-check-label" for="gen-School">School</label></div><div><input class="form-check-input" type="checkbox" id="gen-Sci-Fi" value="Sci-Fi">
            <label class="form-check-label" for="gen-Sci-Fi">Sci-Fi</label></div><div><input class="form-check-input" type="checkbox" id="gen-Seinen" value="Seinen">
            <label class="form-check-label" for="gen-Seinen">Seinen</label></div><div><input class="form-check-input" type="checkbox" id="gen-Shoujo" value="Shoujo">
            <label class="form-check-label" for="gen-Shoujo">Shoujo</label></div><div><input class="form-check-input" type="checkbox" id="gen-ShoujoAi" value="Shoujo Ai">
            <label class="form-check-label" for="gen-ShoujoAi">Shoujo Ai</label></div><div><input class="form-check-input" type="checkbox" id="gen-Shounen" value="Shounen">
            <label class="form-check-label" for="gen-Shounen">Shounen</label></div><div><input class="form-check-input" type="checkbox" id="gen-ShounenAi" value="Shounen Ai">
            <label class="form-check-label" for="gen-ShounenAi">Shounen Ai</label></div><div><input class="form-check-input" type="checkbox" id="gen-SliceofLife" value="Slice of Life">
            <label class="form-check-label" for="gen-SliceofLife">Slice of Life</label></div><div><input class="form-check-input" type="checkbox" id="gen-Space" value="Space">
            <label class="form-check-label" for="gen-Space">Space</label></div><div><input class="form-check-input" type="checkbox" id="gen-Sports" value="Sports">
            <label class="form-check-label" for="gen-Sports">Sports</label></div><div><input class="form-check-input" type="checkbox" id="gen-SuperPower" value="Super Power">
            <label class="form-check-label" for="gen-SuperPower">Super Power</label></div><div><input class="form-check-input" type="checkbox" id="gen-Supernatural" value="Supernatural">
            <label class="form-check-label" for="gen-Supernatural">Supernatural</label></div><div><input class="form-check-input" type="checkbox" id="gen-Survival" value="Survival">
            <label class="form-check-label" for="gen-Survival">Survival</label></div><div><input class="form-check-input" type="checkbox" id="gen-Suspense" value="Suspense">
            <label class="form-check-label" for="gen-Suspense">Suspense</label></div><div><input class="form-check-input" type="checkbox" id="gen-TimeTravel" value="Time Travel">
            <label class="form-check-label" for="gen-TimeTravel">Time Travel</label></div><div><input class="form-check-input" type="checkbox" id="gen-Vampire" value="Vampire">
            <label class="form-check-label" for="gen-Vampire">Vampire</label></div><div><input class="form-check-input" type="checkbox" id="gen-Work" value="Work">
            <label class="form-check-label" for="gen-Work">Work</label>
					  -->
			</div></div>

          <button type="button" id="expandbtn" onClick="expandgenre()" class="btn btn-secondary btn-sm btn-lg btn-block"><i class="glyphicon glyphicon-menu-down"></i></button>
        </div>
        <div class="rightcard" style="display:none; border-top: 1px solid #3c3c3c;">
          <div class="flexrightcard" id="filterplace">
            <div class="halfleft">
              <label for="typeselect">Stream:</label>
			  
              <select id="typeselect" onchange="typechange()">
                <option value="0">Any</option>
                <option value="1">GOGO Stream</option>
                <option value="11">AL Stream</option>
                <option value="6">RUSH Stream</option>
              </select>
            </div>
            <div class="halfright">
              <label for="langselect">Sub/Dub:</label>
              <select id="langselect" onchange="langchange()">
                <option value="any">Any</option>
                <option value="sub">Sub</option>
                <option value="dub">Dub</option>
              </select>
            </div>
          </div>
        </div>
        <div class="rightcard" style="margin-bottom:20px">
          <div class="subtitleright">Weekly Top</div>
          <div id="ongoingplace" style="height:unset"></div>
          <button type="button" id="expandbtn2" onClick="expandweekly()" class="btn btn-secondary btn-sm btn-lg btn-block"><i class="glyphicon glyphicon-menu-down"></i></button>
        </div>
      </div>
    
	</div>
  </div>
  <div id="playerleftsidebar" class="schedulemenucontainer">
    <button id="recomendedclosebtn" style="margin-left:10px" OnClick="showschedulemenu()"><i class="glyphicon glyphicon-arrow-left"></i></button>
    <div id="seasontitle"></div>
    <div id="scheduletimezone"></div>
    <div id="recomendedlist" style="padding-top:unset"></div>
    <div id="schedulenotice">Release time is estimated</div>
  </div>
  <div class="leftbottom">
    <span id="donatelabel">RSS</span><a class="customicon rssicon" href="rss.html"></a>
    <div class="floatright">
      <div class="togglelabel">Chat</div>
      <label class="switch">
        <input type="checkbox" id="enablechat">
        <span class="slider round"></span>
      </label> <a href="info.html" style="font-size:17px;margin-left:4px"><i class="glyphicon glyphicon-info-sign"></i></a><br>
    </div>
  </div>
  <div class="footer">
    <span class="bottomtext">
      Watch HD Anime for Free ©2022 AnimixReplay
    </span>
    Disclaimer: This site does not store any files on its server. All contents are provided by non-affiliated third parties.
  </div>
  <div id="notifiaction"></div>
  <div id="lastwatch">
    <i onClick="lastwatchclose();" id="lastwatchclosebtn" class="glyphicon glyphicon-remove"></i>
    Continue watching :<br>
    <a id="lastwatchlink">
      <div id="lastwatchtitle"></div>
      <div id="lastwatchurl"></div>
    </a>
  </div>
  <script type="text/javascript">
    var nowtime = 'Yea';
    var envYear = 2023;
    var envSeason = 'Winter';
    var curFeatured = 8;
  </script>
  <script src="<?php makecache("assets/weeklytop.min.js"); ?>"></script>
  <img src="<?php makecache("assets/Mayumi-chan_2.webp"); ?>" id="mascot">
  <!-- <div id="backtotopbtn" style="opacity: 1;"><i class="glyphicon glyphicon-menu-up"></i></div> -->
</body>
</html>
