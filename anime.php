<html lang="en">
<script type="text/javascript" id="custom-useragent-string-page-script"></script>

<head>
  <meta charset="UTF-8">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="application-name" content="AnimixReplay">
  <meta name="apple-mobile-web-app-title" content="AnimixReplay">
  <meta name="msapplication-starturl" content="/">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, shrink-to-fit=no, user-scalable=no">
  <!--<meta property="og:image" content="/assets/icon.png">-->
  <meta property="og:image" content="<?php# echo $poster; ?>">
  <meta property="image" content="<?php #echo $poster; ?>">
  <meta property="og:title" content="<?php #echo $title ?> - AnimixReplay">
  <meta property="og:description" content="<?php #echo $description ?>">
  <meta name="description" content="<?php #echo $description ?>">
  <meta property="title" content="<?php #echo $title ?> - AnimixReplay">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="theme-color" content="#191919">
  <meta name="twitter:card" content="summary">
  <link rel="icon" href="/assets/icon.png">
  <link rel="apple-touch-icon" href="/assets/icon.png">
  <link rel="manifest" href="/assets/s/manifest.json">
  <title><?php #echo $title; ?> - AnimixReplay</title>
  <link rel="stylesheet" href="/assets/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/style.min.css">
  <style>
    body {
      background-color: rgb(25, 25, 25);
    }

    #countwrapper {
      color: gray;
      font-size: 14px;
      display: none;
    }

    #animepagecountdown {
      color: yellow;
      display: inline;
      margin-right: 5px;
      font-size: 17px;
    }

    #showcommentbtn {
      background-color: rgb(50 56 60);
    }

    .searchresult {
      margin-right: 0px;
    }

    .toppart {
      padding-top: 0;
    }

    #songContent {
      position: absolute;
      height: 150px;
      background-image: linear-gradient(rgba(25, 25, 25, 1), rgba(25, 25, 25, 0));
      background-color: unset;
    }

    #fullresultbtn {
      border: none !important;
      background: none !important;
      padding-top: 5px !important;
    }

    .quicksearchcontainer {
      margin-top: 49px;
      z-index: 20;
    }

    .resultcontainer {
      box-shadow: none;
    }

    #topcover {
      height: 248px;
    }

    .nav-tabs {
      min-width: 340px;
    }

    .leftbottom {
      padding-left: calc((100% - 1120px) / 2);
      padding-right: calc((100% - 1120px) / 2);
    }
  </style>
  <script type="text/javascript" src="/assets/anime.min.js" defer=""></script>

<body>
  <div id="coverlight"></div>
  <div id="loadcontainer" style="display: none;">
    <div class="loadindicator"></div>
  </div>
  <div class="toppart">
    <div id="songContent" class="floattopsearch">
      <a id="backicon" onclick="window.history.back()"><i class="glyphicon glyphicon-chevron-left"></i></a>
      <a id="homeicon" href="/"><i class="glyphicon glyphicon-home"></i></a>
      <div id="searchbox">
        <input type="text" style="display:none">
        <input type="password" style="display:none">
        <a href="/"><img class="webtitle" alt="AnimixReplay" src="/assets/logo.png"></a>
        <input class="form-control searchbar" placeholder="Search" id="q" type="search" autocomplete="off" onfocus="searchfocused()" onblur="searchblur()">
        <button id="searchbutton" onclick="dosearchfromplayer()"><i class="glyphicon glyphicon-search"></i></button>
        <a class="topmenubtn" title="Random anime" href="/random"><i class="glyphicon glyphicon-random"></i>Random</a>
        <a class="topmenubtn" title="A-Z List" href="/list">A-Z List</a>
      </div>
      <button id="menumobilebtn"><a href="/random"><i class="glyphicon glyphicon-random"></i></a></button>
      <button id="showsearchbtn" onclick="togglesearch()"><i class="glyphicon glyphicon-search"></i></button>
    </div>
  </div>
  <div class="quicksearchcontainer">
    <div class="resultcontainer sanimepage">
      <div id="fullresultbtn">
        <a onclick="cSearch('full')">Full</a><a onclick="cSearch('gogo')">GOGO</a><a onclick="cSearch('al')">AL</a><a onclick="cSearch('rush')">RUSH</a><a onclick="cSearch('mal')">MAL</a>
      </div>
    </div>
  </div>
  <div id="playerleftsidebar">
    <button id="recomendedclosebtn" onclick="showrecomendmenu()"><i class="glyphicon glyphicon-arrow-left"></i></button>
    <div id="moreinfobtn" onclick="editStreams()"><a>Wrong ?</a></div>
    <div id="recomendedlist"></div>
  </div>
  <div id="topcover">
    <img id="topcoverimage" src="" onerror="">
  </div>
  <div id="animepagemiddle">
    <div id="leftsideanimepage">
      <img id="maincoverimage" src="" style="cursor: pointer;">
      <div id="animeleftside">
        <div class="rightcard">
          <div id="infopanel">
            <div id="sharebtn">
              <i class="glyphicon glyphicon-share-alt"></i> Share
            </div>
            <span id="addTitle"></span>
            <div class="subtitleright" style="margin-top:10px">Information <a href="/anime?id=<?php echo $_GET['id']; ?>"><i class="glyphicon glyphicon-repeat animerefbtn"></i></a></div>
            <span id="addInfo">
				 
          </div>
          <button type="button" id="expandbtn" onclick="expandinfo()" class="btn btn-secondary btn-sm btn-lg btn-block"><i class="glyphicon glyphicon-menu-down"></i></button>
        </div>
      </div>
    </div>
    <div id="rightsideanimepage" style="display: block;">
      <div id="showstreambtn" onclick="showrecomendmenu();"><i class="glyphicon glyphicon-play"></i> Watch</div>
      <div id="animepagetitle"></div>
      <span id="genres" style="float:unset;font-size:13px;">Genres : <span id="genredata"><?php #echo str_replace(",", ", ", $genre); ?> </span></span>
      <div id="countwrapper">
        <div id="animepagecountdown"></div> (estimated)
      </div>
      <div id="navtab" style="margin:10px 0 0 0">
        <ul class="nav nav-tabs" style="margin:0">
          <li id="synopbtn" class="active" onclick="showsynopsis()"><a>Synopsis</a></li>
          <li id="relatebtn" onclick="showrelated()"><a>Related</a></li>
          <li id="recombtn" onclick="showrecomendation()"><a>Similar</a></li>
          <li id="songbtn" onclick="showsong()"><a>OP/ED</a></li>
          <li id="traillerbtn" onclick="showtrailler()"><a>Trailer</a></li>
        </ul>
      </div>
      <div id="panelplace"></div>
      <!--<div id="anibottomplace">
<div style="text-align:center;margin-top:5px;opacity:0.9;flex:1;">
<div id="anicommentplace">
<button id="showcommentbtn" onclick="showcomment()">Show 59 Comments</button>
</div>-->
      <div id="disqus_thread"></div>
    </div>
    <div id="anibottomright"></div>
  </div>
  <div id="belowcomment" style="display: none !important;"></div>
  </div>
  </div>
  <div class="leftbottom">
    <!--<span id="donatelabel">RSS</span><a class="customicon rssicon" href="/rss"></a>
<div class="floatright">
<div class="togglelabel">Chat</div>
<label class="switch">
<input type="checkbox" id="enablechat">
<span class="slider round"></span>
</label> <a href="/info" style="font-size:17px;margin-left:4px"><i class="glyphicon glyphicon-info-sign"></i></a><br>
</div>-->
  </div>
  <div class="footer">
    <span class="bottomtext">
      Watch HD Anime for Free ©2022 <a href="/about">AnimixReplay</a>
    </span>
    Disclaimer: This site does not store any files on its server. All contents are provided by non-affiliated third parties.
  </div>
  <div id="notifiaction"></div>

  <div id="backtotopbtn" style="opacity: 0;"><i class="glyphicon glyphicon-menu-up"></i></div>
<script>
async function fetchAnimeById(id) {
  try {
    const response = await fetch(`https://api.jikan.moe/v4/anime/${id}`);
    const data = await response.json();
    return data.data;
  } catch (error) {
    console.error(error);
  }
}
async function fetchIdsById(id) {
  try {
    const response = await fetch('https://arm.haglund.dev/api/ids?source=myanimelist&id=' + id);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(error);
  }
}

fetchAnimeById(<?php echo $_GET['id']; ?>).then(data => {
  let genres = data.genres.map(genre => genre.name).join(', ');
  let studios = data.studios.map(studio => studio.name).join(', ');
  let themes = data.themes.map(theme => theme.name).join(', ');
  let titles = data.titles.map(function(title){
	if(title.type != "English"){
		return title.title;
	}
  }).join('<br> ');
  let demographics = data.demographics.map(demographic => demographic.name).join(', ');

  document.querySelector('meta[property="og:image"]').content = data.images.webp.large_image_url;
  document.querySelector('meta[property="image"]').content = data.images.webp.large_image_url;
  document.querySelector('meta[property="og:description"]').content = data.synopsis;
  document.querySelector('meta[name="description"]').content = data.synopsis;
  if(data.title_english != null){
	document.querySelector('meta[property="og:title"]').content = data.title_english;
    document.querySelector('meta[property="title"]').content = data.title_english;
  } else {
	document.querySelector('meta[property="og:title"]').content = data.title;
  document.querySelector('meta[property="title"]').content = data.title;
  }

  //document.getElementById("statusdata").textContent = data['status']
  
  document.getElementById("maincoverimage").src = data.images.webp.large_image_url;
  document.getElementById("topcoverimage").src = data.images.webp.large_image_url;

  if(genres != ""){
	document.getElementById("genredata").textContent = genres;
  }

  if(themes != ""){
	if(genres != ""){
		document.getElementById("genredata").textContent += ", " + themes;
	} else {
		document.getElementById("genredata").textContent += themes;
	}
  }

  if(demographics != ""){
	if(genres != "" || themes != ""){
		document.getElementById("genredata").textContent += ", " + demographics;
	} else {
		document.getElementById("genredata").textContent +=  demographics;
	}
  }
  if(!data.score == null){
	document.getElementById("addInfo").innerHTML += 'Score: <i class="glyphicon glyphicon-star" style="color:#ffd530e8;"></i> ' + data.score + '<br>';
  } else {
	document.getElementById("addInfo").innerHTML += 'Score: <i class="glyphicon glyphicon-star" style="color:#ffd530e8;"></i> ' + "Unknown" + '<br>';
  }
	
  if(data.episodes == null){
	document.getElementById("addInfo").innerHTML += 'Episodes: Unknown ' + data.type + '<br>';
  } else {
	document.getElementById("addInfo").innerHTML += 'Episodes: ' + data.episodes + " " + data.type + '<br>';
  }

  document.getElementById("addInfo").innerHTML += 'Status: ' + data.status + '<br>';
  document.getElementById("addInfo").innerHTML += 'Aired: ' + data.aired.string + '<br>';
  document.getElementById("addInfo").innerHTML += 'Popularity: ' + data.members.toLocaleString("en-US") + ' <span style="color: #8c8c8c;">#' + data.popularity.toLocaleString("en-US") + '</span><br>';
  document.getElementById("addInfo").innerHTML += 'Rating: ' + data.rating + '<br>';
  document.getElementById("addInfo").innerHTML += 'Duration: ' + data.duration + '<br>';
  document.getElementById("addInfo").innerHTML += 'Source: ' + data.source + '<br>';
  if(studios != ""){
	document.getElementById("addInfo").innerHTML += 'Studios: ' + studios + '<br>';
  } else {
	document.getElementById("addInfo").innerHTML += 'Studios: Unknown<br>';
  }
  if(data.synopsis != null) {
	document.getElementById("panelplace").textContent =  data.synopsis.replace('[Written by MAL Rewrite]', "");
  }
  document.getElementById("panelplace").innerHTML +=  ' [Written by <a id="malsource" href="https://myanimelist.net/anime/<?php echo $_GET['id']; ?>" target="_blank" rel="noreferrer">MAL</a> Rewrite]'
  
  if(data.title_english != null){
	document.getElementById("animepagetitle").textContent =  data.title_english;
  } else {
	document.getElementById("animepagetitle").textContent =  data.title;
  }
  document.getElementById("addTitle").innerHTML =  titles;
  fetchIdsById(<?php echo $_GET['id']; ?>).then(data => {
	document.getElementById("addInfo").innerHTML += 'More info: <a id="moreinfomal" href="https://myanimelist.net/anime/<?php echo $_GET['id']; ?>" target="_blank" rel="noreferrer">MAL</a>, <a id="moreinfoani" href="https://anilist.co/anime/' + data.anilist + '" target="_blank">AL</a>, <a id="moreinfoal" href="https://anidb.net/anime/' + data.anidb + '" target="_blank">AniDB</a></span>';
});
});
</script>

</body>

</html>
