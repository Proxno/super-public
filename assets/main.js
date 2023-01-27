let [subpage, dubpage, poppage, upcpage, movpage,] = [1, 1, 1, 1, 1];

var type = "null";
var filter = "null";

const recButton = document.getElementById("recentbtn");
const dubButton = document.getElementById("dubbtn");
const subButton = document.getElementById("subbtn");
const popButton = document.getElementById("popularbtn");
const upcButton = document.getElementById("upcomingbtn");
const moviesButton = document.getElementById("moviebtn");
const loadButton = document.getElementById("loadmorelist");


const searchForm = document.getElementById("search-form");
const searchResults = document.getElementById("search-results");
const searchInput = document.getElementById("q");
 
let searchFocused = false;

// Add gID function
var deferredPrompt, notFoundID = {}, gID = function(e) {
    var t = document.getElementById(e);
    return null === t && (void 0 === notFoundID[e] ? (t = document.createElement("div"),
    notFoundID[e] = t) : t = notFoundID[e]),
    t
}, notFoundClass = {}, gClass = function(e) {
    var t = document.getElementsByClassName(e);
    return void 0 === t[0] && (void 0 === notFoundClass[e] ? (t = [document.createElement("div")],
    notFoundClass[e] = t) : t = notFoundClass[e]),
    t
};

document.getElementById("q").addEventListener("input", function() {
    search(this.value);
});

document.addEventListener("DOMContentLoaded", () => {
	subfetch();
	subpage = 1;
    console.log(
        "%cAniMixReplay",
        "font-size:35px;font-family:'Lexend deca',sans-serif;color:#7fc3ff;text-shadow:3px 3px #0b0b0b" //,
        //"console"
    );
});

function search(term) {
    let quickSearchContainer = document.querySelector(
        ".quicksearchcontainer.absolutee"
    );
    // Set the display property to block
    //quickSearchContainer.style.display = "block";
    // Send an AJAX request to the PHP script
	fetch("search.php?search_term=" + term)
        .then((response) => response.text())
        .then((data) => {
            // Update the search results
            document.getElementById("search-results").innerHTML = data;
        })
        .catch((error) => console.error(error));
}

function scrollToTop(e) {
    iOS() || ("scrollBehavior" in document.documentElement.style ? window.scrollTo({
        top: 0,
        behavior: "smooth"
    }) : window.scrollTo(0, 0))
}

/*
function searchstop() {
  let quickSearchContainer = document.querySelector(
    ".quicksearchcontainer.absolutee"
  );
  // Set the display property to block
  quickSearchContainer.style.display = "none";
}
var nextInterval,
  featuredData = [],
  triedFeat = !1;
function loadFeatured(e = 0) {
  if (!triedFeat) {
    var t = new XMLHttpRequest();
    t.open("GET", "/assets/s/featured.json"),
      (t.timeout = 15e3),
      (t.onload = function () {
        200 === this.status &&
          isJson(t.responseText) &&
          ((featuredData = JSON.parse(t.responseText)),
          showFeatured(e, !1),
          (triedFeat = !0));
      }),
      t.send();
  }
}*/
/*Uncaught ReferenceError: curFeatured is not defined
var ImgPreload = [];
function showFeatured(e, t = !0) {
  if (featuredData.length < 1 && t) loadFeatured(e);
  else if (!(featuredData.length < 1)) {
    curFeatured > e && clearInterval(nextInterval);
    var o = featuredData.length - 1;
    e < 0 ? (e = o) : e > o && (e = 0);
    var n = e + 1,
      a = e - 1;
    a < 0 ? (a = o) : n > o && (n = 0),
      void 0 === ImgPreload[n] &&
        (ImgPreload[n] = new Image().src = featuredData[n].img),
      void 0 === ImgPreload[a] &&
        (ImgPreload[a] = new Image().src = featuredData[a].img),
      (curFeatured = e);
    var s = featuredData[e];
    gID(
      "featuredcard"
    ).innerHTML = `<div id="featuredbgcont">\n    <img id="featuredbg" src="${s.img}"/>\n</div>\n<div id="featuredcont">\n    <a href="${s.url}"><img id="featuredimg" src="${s.img}"/></a>\n    <div id="featuredtitle">\n        <a href="${s.url}">${s.title}</a>\n    </div>\n    <div id="featuredtext">${s.desc}</div>\n    <div id="featuredgenre"><i class="glyphicon glyphicon-tag"></i> ${s.genre}</div>\n    <a id="featuredNext" onClick="showFeatured(curFeatured + 1)"><i class="glyphicon glyphicon-chevron-right"></i></a>\n    <a id="featuredBack" onClick="showFeatured(curFeatured - 1)"><i class="glyphicon glyphicon-chevron-left"></i></a>\n</div>`;
  }
}*/
function dateSchedule(e) {
    var t = new Date(1e3 * e),
        o = {};
    return (
        (o.daynum = t.getDay()),
        (o.time =
            ("0" + t.getHours()).slice(-2) +
            ":" +
            ("0" + t.getMinutes()).slice(-2)),
        o
    );
}
var curTimeEnabled = !1;

function shwoschedule() {
    (gID("schedulenotice").style.display = "none"),
    (gID("recomendedlist").innerHTML =
        '<div style="text-align:center;padding-top:50px;color:gray">Loading...</div>'),
    curTimeEnabled || ((curTimeEnabled = !0), currentTime()),
        $.ajax({
            url: "/assets/s/schedule.json",
            type: "GET",
            success: function(e) {
                (scheduleloaded = !0),
                e.forEach(function(e, t, o) {
                        var n = dateSchedule(Number(e.time) + 7200);
                        (o[t].timeday = n.time), (o[t].daynum = n.daynum);
                    }),
                    e.sort(function(e, t) {
                        return e.timeday < t.timeday ? -1 : e.timeday > t.timeday ? 1 : 0;
                    });
                var t = "",
                    o = [
                        "Sunday",
                        "Monday",
                        "Tuesday",
                        "Wednesday",
                        "Thursday",
                        "Friday",
                        "Saturday"
                    ],
                    n = e.length,
                    a = !0,
                    s = [23, 60],
                    r = new Date(),
                    l = r.getDay(),
                    i =
                    ("0" + r.getHours()).slice(-2) +
                    ":" +
                    ("0" + r.getMinutes()).slice(-2),
                    c = (-1 * r.getTimezoneOffset()) / 60;
                (gID("scheduletimezone").innerHTML = c >= 0 ? "UTC+" + c : "UTC" + c),
                (o[l] += ' <span style="color:#ffed8b">(Today)</span>');
                var d,
                    u =
                    '<div style="color:#aa9f68;text-align:right;margin-left:10px;margin-top:1px;">- Now -</div>';
                isStorage("localStorage") &&
                    "string" !=
                    typeof(markedSchedule = localStorage.getItem(
                        "markedSchedule"
                    )) &&
                    (markedSchedule = "");
                for (var m = 0; m < 7; m++) {
                    t += `<div class="scheduletitle">${o[l]}</div>`;
                    for (var g = 0; g < n; g++)
                        e[g].daynum === l &&
                        (a &&
                            e[g].timeday > i &&
                            ((t += u), (a = !1), (s = e[g].timeday.split(":"))),
                            (d = e[g].malid),
                            (t += "<div"),
                            markedSchedule.includes(d + ",") &&
                            (t +=
                                ' style="background-color:#1d2f1d;padding:0 5px;border-left:2px solid lime;"'),
                            (t += ` id="schedule${d}" class="schedulelist" onClick="markSchedule(${d})"><a href="/anime/${d}">${e[g].name}</a></div><div class="airtime" onClick="markSchedule(${d})">${e[g].timeday}</div>`));
                    a && (t += u), (a = !1), 7 === ++l && (l = 0);
                }
                var p = 3600 * (s[0] - r.getHours());
                (p += 60 * (s[1] - r.getMinutes())),
                setTimeout(function() {
                        shwoschedule();
                    }, 1e3 * p),
                    console.log("schedule next refresh in " + p + "s"),
                    (gID("recomendedlist").innerHTML = t),
                    (gID("recomendedlist").style.marginRight = "15px"),
                    (gID("schedulenotice").style.display = "block");
            },
            error: function() {
                gID("recomendedlist").innerHTML =
                    '<div style="text-align:center;margin-top:50px;">Airing Schedule not implemented yet.</div>';
            },
            timeout: 15e3
        });
}
var markedSchedule = "";

function markSchedule(e) {
    if ("A" !== document.activeElement.tagName) {
        var t = gID("schedule" + e),
            o = e + ",";
        markedSchedule.includes(o) ?
            ((t.style = ""), (markedSchedule = markedSchedule.replace(o, ""))) :
            ((t.style =
                    "background-color:#1d2f1d;padding:0 5px;border-left:2px solid lime;"),
                (markedSchedule += o)),
            isStorage("localStorage") &&
            localStorage.setItem("markedSchedule", markedSchedule);
    }
}
var scheduleopen = !1,
    scheduleloaded = !1;

function showschedulemenu(e = "toggle") {
    var t = (scheduleopen && "toggle" === e) || "close" === e;
    if (scheduleopen !== !t) {
        isMobile() ?
            t ?
            $("#playerleftsidebar").css(
                "animation-name",
                "moveout2mobilerecomend"
            ) :
            $("#playerleftsidebar").css(
                "animation-name",
                "movein2mobilerecomend"
            ) :
            t ?
            $("#playerleftsidebar").css("animation-name", "moveout2recomend") :
            $("#playerleftsidebar").css("animation-name", "movein2recomend");
        var o = gID("coverlight");
        t
            ?
            (o.removeEventListener("click", closeSchedule),
                $(o).fadeOut(400),
                mobilemenuopen || (autoReload = !0)) :
            ((o.style.zIndex = "21"),
                $(o).fadeIn(300),
                scheduleloaded || shwoschedule(),
                o.addEventListener("click", closeSchedule),
                (autoReload = !1)),
            (scheduleopen = !t);
    }
}

function currentTime() {
    var e = new Date(),
        t = e.getHours(),
        o = e.getMinutes(),
        n = e.getSeconds();
    (t = updateTime(t)),
    (o = updateTime(o)),
    (n = updateTime(n)),
    (gID("seasontitle").innerHTML = t + ":" + o + ":" + n),
    setTimeout(function() {
        currentTime();
    }, 1e3);
}

function updateTime(e) {
    return e < 10 ? "0" + e : e;
}

function closeSchedule() {
    showschedulemenu("close");
}

function handleTouchMove(e) {
    if (xDown && yDown) {
        var t = xDown - e.touches[0].clientX,
            o = yDown - e.touches[0].clientY;
        (Math.abs(t) < swipeThresold && Math.abs(o) < swipeThresold) ||
        (Math.abs(t) > Math.abs(o) &&
            (t > 0 ?
                scheduleopen ?
                showschedulemenu("close") :
                isMobile() &&
                ($(".rightside").css("animation-name", "movein2mobile"),
                    (mobilemenuopen = !0)) :
                mobilemenuopen ?
                ($(".rightside").css("animation-name", "moveout2mobile"),
                    (mobilemenuopen = !1)) :
                showschedulemenu("open")),
            (xDown = null),
            (yDown = null));
    }
}

function showrecomendmenu() {
    // Change the style of the playerleftsidebar element
    document.getElementById("playerleftsidebar").style.animationName =
        "movein2recomend";
    var coverlight = document.getElementById("coverlight");
    coverlight.style.display = "block";
    coverlight.style.opacity = 0;
    coverlight.style.transition = "opacity 0.5s";
    setTimeout(function() {
        coverlight.style.opacity = 1;
    }, 50);
	document.getElementsByClassName("container")[0].style.zIndex = "1";
    document.getElementById("playerleftsidebar").style.zIndex = "23";
    document.getElementById("iframecontainer").style.zIndex = "1";
    document.getElementById("iframecontainer").style.position = "relative";
}

function hiderecomendmenu() {
    document.getElementById("playerleftsidebar").style.animationName =
        "moveout2recomend";
    var coverlight = document.getElementById("coverlight");
    coverlight.style.display = "none";
    coverlight.style.opacity = 1;
    coverlight.style.transition = "opacity 0.5s";
    setTimeout(function() {
        coverlight.style.opacity = 0;
    }, 50);
	document.getElementsByClassName("container")[0].style.zIndex = "22";
    document.getElementById("playerleftsidebar").style.zIndex = "21";
    document.getElementById("iframecontainer").style.zIndex = "none";
    document.getElementById("iframecontainer").style.position = "none";
}
//main.js:124 Uncaught TypeError: Cannot read properties of null (reading 'addEventListener') at main.js:124:11
function dubfetch() {
    $(".nav li").removeClass("active"),
        $("#dubbtn").addClass("active"),
        console.log("Dub Page Load");	
	    setTimeout(function () {
			fetch(
			'https://cdn.animixreplay.to/' +  btoa(encodeURIComponent(`https://ns512449.ip-192-99-8.net:3000/anime/gogoanime/recent-episodes?type=2?page=1`))
			)
			.then((response) => response.json())
			.then((data) => {
				const animeList = document.getElementById("homepage");
				animeList.innerHTML = "";
				data.results.forEach((series) => {
					const animeLi = document.createElement("li");
					animeLi.className = "anime";
					const link = document.createElement("a");
					//const slug_title = series.url.split("/")[5]
					const title = series.title
					link.href = "/associate2.php?id=" + series.id + "&override" + "&ep=" + series.episodeNumber; 
					link.title = series.title;
					animeLi.appendChild(link);
					const imageDiv = document.createElement("div");
					imageDiv.className = "searchimg";
					const poster = document.createElement("img");
					poster.className = "resultimg";
					//poster.alt = "";
					poster.src = "https://cdn.animixreplay.to/" + btoa(encodeURIComponent(series.image)); 
					imageDiv.appendChild(poster);
					const timeDiv = document.createElement("div");
					timeDiv.className = "timetext";
					timeDiv.textContent = "New";
					imageDiv.appendChild(timeDiv);
					link.appendChild(imageDiv);
					const detailsDiv = document.createElement("div");
					detailsDiv.className = "details";
					const nameP = document.createElement("p");
					nameP.className = "name";
					if (series.title.endsWith("(Dub)") == true){
						const dubTitle = series.title.replace("(Dub)", "")
						nameP.textContent = dubTitle; 
					}
					detailsDiv.appendChild(nameP);
					const dubSpan = document.createElement("span");
					dubSpan.className = "dubtag";
					dubSpan.textContent = "[Dub]";
					nameP.appendChild(dubSpan); 
					const infoP = document.createElement("p");
					infoP.className = "infotext";
					infoP.textContent = "Episode " + series.episodeNumber;
					detailsDiv.appendChild(infoP);
					link.appendChild(detailsDiv);
					const nameIdP = document.createElement("p");
					nameIdP.className = "nameId";
					nameIdP.textContent = series.id;
					detailsDiv.appendChild(nameIdP);
					const ratingDiv = document.createElement("div");
					//ratingDiv.className = "rating";
					//ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> 0.00";
					imageDiv.appendChild(ratingDiv);
					animeList.appendChild(animeLi); 	
					/* if (nameIdP.textContent.endsWith("-dub") == true){
						var nameId = nameIdP.textContent.replace("-dub", "")
					}
					else {
						var nameId = nameIdP.textContent
					}		
					fetch(`https://myanimelist.net/search/prefix.json?type=anime&keyword=${nameId}`)						
						.then(response => response.json())
						.then(data => {
							rating = data.categories[0].items[0].payload.score;
							//english_title = data.categories[0].items[0].name; // Sadly not english_title.

							ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> " + rating;
							//nameP.textContent = english_title;
						}) */
				});
			}); 
		}, 0);
}

dubButton.addEventListener("click", function() {
	if ($("#dubbtn").hasClass("active") == true) {
		return;
	} else {
		dubfetch();
		dubpage = 1;
	}
});  

function subfetch() {
    $(".nav li").removeClass("active"),
        $("#subbtn").addClass("active"),
        console.log("Sub Page Load");	
	    setTimeout(function () {
			fetch(
				'https://cdn.animixreplay.to/' + btoa(encodeURIComponent(`https://ns512449.ip-192-99-8.net:3000/meta/anilist/recent-episodes?page=1&perPage=24`))
			)
			.then((response) => response.json())
			.then((data) => {
				const animeList = document.getElementById("homepage");
				animeList.innerHTML = "";
				data.results.forEach((series) => {  	
					const animeLi = document.createElement("li");
					animeLi.className = "anime";
					const link = document.createElement("a");
					//const slug_title = series.url.split("/")[5]
					link.href = "/associate2.php?id=" + series.malId + "&ep=" + series.episodeNumber;
					link.title = series.title.romaji;
					animeLi.appendChild(link);
					const imageDiv = document.createElement("div");
					imageDiv.className = "searchimg";
					const poster = document.createElement("img");
					poster.className = "resultimg";
					//poster.alt = "";
					poster.src = "https://cdn.animixreplay.to/" + btoa(encodeURIComponent(series.image)); 
					imageDiv.appendChild(poster);
					const timeDiv = document.createElement("div");
					timeDiv.className = "timetext";
					timeDiv.textContent = "Loading...";
					imageDiv.appendChild(timeDiv);
					link.appendChild(imageDiv);
					const detailsDiv = document.createElement("div");
					detailsDiv.className = "details";
					const nameP = document.createElement("p");
					nameP.className = "name";
					if (series.title.english == null) {
						nameP.textContent = series.title.romaji;
					} else {
						nameP.textContent = series.title.english;
					}
					detailsDiv.appendChild(nameP);
					const infoP = document.createElement("p");
					infoP.className = "infotext";
					infoP.textContent = "Episode " + series.episodeNumber;
					detailsDiv.appendChild(infoP);
					link.appendChild(detailsDiv);
					const ratingDiv = document.createElement("div");
					ratingDiv.className = "rating";	
					ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> 0.00";
					
					imageDiv.appendChild(ratingDiv);
					animeList.appendChild(animeLi); 
					
					const malId = series.malId
					const url = 'https://cdn.animixreplay.to/' + btoa(encodeURIComponent(`https://api.myanimelist.net/v2/anime/${malId}?fields=mean,genres,average_episode_duration,studios`));
					
					// Encoded Data
					// const encodedData_1 = "https://ns512449.ip-192-99-8.net/mal.php?f=";
					// const encodedData_2 = btoa(`${malid}?fields=mean,rank,created_at,updated_at,media_type,genres,start_season,broadcast,average_episode_duration,rating,statistics)`);
					
					fetch(url)					
						.then((response) => response.json())
						.then((data) => {
							rating = data.mean;
                            if(data.studios[0] != undefined){
                                studio = data.studios[0].name;
                            }

							if (series.rating == null) {
								ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> N/A";
							} else {
								ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> " + rating;	
							}
							if (studio != null && studio.length < 23) {
								timeDiv.textContent = studio;
							} else {
								timeDiv.textContent = series.genres[0];
							}
							
						}); 		
				});
			});
		}.bind(this), 0);
}

subButton.addEventListener("click", function() {
    if ($("#subbtn").hasClass("active") == true) {
		return;
	} else {
		subfetch();
		subpage = 1;
	}
}); 

function popfetch() {
    $(".nav li").removeClass("active"),
        $("#popularbtn").addClass("active"),
        console.log("Popular Page Load");
		var type = "tv"; // or 'movie'
		var filter = "bypopularity";
		var limit = 24;
	    setTimeout(function () {		
			fetch(
					'https://cdn.animixreplay.to/' + btoa(encodeURIComponent(`https://api.jikan.moe/v4/top/anime?type=${type}&filter=${filter}&limit=${limit}`))
				)
				.then((response) => response.json())
				.then((data) => {
					const animeList = document.getElementById("homepage");
					animeList.innerHTML = "";
					data.data.forEach((series) => {
						const animeLi = document.createElement("li");
						animeLi.className = "anime";
						const link = document.createElement("a");
						const slug_title = series.url.split("/")[5]
						const title = series.title;
						link.href = "/associate2.php?id=" + series.mal_id;
						link.title = series.titles.title;
						animeLi.appendChild(link);
						const imageDiv = document.createElement("div");
						imageDiv.className = "searchimg";
						const poster = document.createElement("img");
						poster.className = "resultimg";
						poster.alt = "";
						poster.src = "https://cdn.animixreplay.to/" + btoa(encodeURIComponent(series.images.webp.image_url));
						imageDiv.appendChild(poster);
						const timeDiv = document.createElement("div");
						timeDiv.className = "timetext";
						timeDiv.textContent = series.aired.from.substring(0, 10);
						imageDiv.appendChild(timeDiv);
						const ratingDiv = document.createElement("div");
						ratingDiv.className = "rating";
						ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> " + series.score;
						imageDiv.appendChild(ratingDiv);
						link.appendChild(imageDiv);
						const detailsDiv = document.createElement("div");
						detailsDiv.className = "details";
						const nameP = document.createElement("p");
						nameP.className = "name";
						if (series.title_english == null) {
							nameP.textContent = series.title;
						} else {
							nameP.textContent = series.title_english;
						}
						detailsDiv.appendChild(nameP);
						const infoP = document.createElement("p");
						infoP.className = "infotext";
						infoP.textContent = series.season.charAt(0).toUpperCase() + series.season.slice(1) + " " + series.year + " " + series.type;
						detailsDiv.appendChild(infoP);
						link.appendChild(detailsDiv);
						animeList.appendChild(animeLi);
					});
				});
		}.bind(this), 0);
}

popButton.addEventListener("click", function() {
   if ($("#popularbtn").hasClass("active") == true) {
		return;
   } else {
	popfetch();
	poppage = 1;
   }
});

function upcfetch() {
    $(".nav li").removeClass("active"),
        $("#upcomingbtn").addClass("active"),
        console.log("Upcoming Page Load");
		var type = "tv"; // or 'movie'
		var filter = "upcoming";
		var limit = 24;
		setTimeout(function () {	
			fetch(
                'https://cdn.animixreplay.to/' + btoa(encodeURIComponent(`https://api.jikan.moe/v4/top/anime?type=${type}&filter=${filter}&limit=${limit}`))
				)
				.then((response) => response.json())
				.then((data) => {
					const animeList = document.getElementById("homepage");
					animeList.innerHTML = "";
					data.data.forEach((series) => {
						const animeLi = document.createElement("li");
						animeLi.className = "anime";
						const link = document.createElement("a");
						const title = series.title
						link.href = "/anime/" + series.mal_id;
						link.title = series.titles.title;
						animeLi.appendChild(link);
						const imageDiv = document.createElement("div");
						imageDiv.className = "searchimg";
						const poster = document.createElement("img");
						poster.className = "resultimg";
						poster.alt = "";
						poster.src = "https://cdn.animixreplay.to/" + btoa(encodeURIComponent(series.images.webp.image_url));
						imageDiv.appendChild(poster);
						const timeDiv = document.createElement("div");
						timeDiv.className = "timetext";
						timeDiv.textContent = series.aired.string;
						imageDiv.appendChild(timeDiv);
						link.appendChild(imageDiv);
						const detailsDiv = document.createElement("div");
						detailsDiv.className = "details";
						const nameP = document.createElement("p");
						nameP.className = "name";
						if (series.title_english == null) {
							nameP.textContent = series.title;
						} else {
							nameP.textContent = series.title_english;
						}
						detailsDiv.appendChild(nameP);
						const infoP = document.createElement("p");
						infoP.className = "infotext";
						if (series.year == null) {
							infoP.textContent = series.type;
						} else {
							infoP.textContent = series.type + " | " + series.year;
						}
						detailsDiv.appendChild(infoP);
						link.appendChild(detailsDiv);
						animeList.appendChild(animeLi);
					});
				});
		}.bind(this), 0);
}

upcButton.addEventListener("click", function() {
   if ($("#upcomingbtn").hasClass("active") == true) {
	   return;
   }
   else {
	   upcfetch();
	   upcpage = 1;
   }
});

function movfetch() {
    $(".nav li").removeClass("active"),
        $("#moviebtn").addClass("active"),
        console.log("Movie Page Load");
		var type = 'movie';
		var filter = "bypopularity";
		var limit = 24;
		setTimeout(function () {	
			fetch(
					'https://cdn.animixreplay.to/' +  btoa(encodeURIComponent(`https://api.jikan.moe/v4/top/anime?type=${type}&filter=${filter}&limit=${limit}`))
				)
				.then((response) => response.json())
				.then((data) => {
					const animeList = document.getElementById("homepage");
					animeList.innerHTML = "";
					data.data.forEach((series) => {
						const animeLi = document.createElement("li");
						animeLi.className = "anime";
						const link = document.createElement("a");
						const slug_title = series.url.split("/")[5]
						const title = series.title 
						link.href = "/associate2.php?id=" + series.mal_id;
						link.title = "series.titles[4].title";
						animeLi.appendChild(link);
						const imageDiv = document.createElement("div");
						imageDiv.className = "searchimg";
						const poster = document.createElement("img");
						poster.className = "resultimg";
						poster.alt = "";
						poster.src = "https://cdn.animixreplay.to/" + btoa(encodeURIComponent(series.images.webp.image_url));
						imageDiv.appendChild(poster);
						const timeDiv = document.createElement("div");
						timeDiv.className = "timetext";
						timeDiv.textContent = series.aired.from.substring(0, 10);
						imageDiv.appendChild(timeDiv);
						const ratingDiv = document.createElement("div");
						ratingDiv.className = "rating";
						ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> " + series.score;
						imageDiv.appendChild(ratingDiv);
						link.appendChild(imageDiv);
						const detailsDiv = document.createElement("div");
						detailsDiv.className = "details";
						const nameP = document.createElement("p");
						nameP.className = "name";
						if (series.title_english == null) {
							nameP.textContent = series.title;
						} else {
							nameP.textContent = series.title_english;
						}
						detailsDiv.appendChild(nameP);
						const infoP = document.createElement("p");
						infoP.className = "infotext";
						infoP.textContent = "Movie";
						detailsDiv.appendChild(infoP);
						link.appendChild(detailsDiv);
						animeList.appendChild(animeLi);
					});
				});
		}.bind(this), 0);
}

moviesButton.addEventListener("click", function() {
   if ($("#moviebtn").hasClass("active") == true) {
		return;
   } else {
	    movfetch();
		movpage = 1;
   }

});

// I know this is sloppy, you can fix if you want. lol
function loadMore() {
	if ($("#moviebtn").hasClass("active")) {
		console.log("Load more Movies");
		movpage++;
		var type = 'movie';
		var filter = "bypopularity";
		var limit = 24;
		fetch(
            'https://cdn.animixreplay.to/' +  btoa(encodeURIComponent(`https://api.jikan.moe/v4/top/anime?type=${type}&filter=${filter}&page=${movpage}&limit=${limit}`))
			)
			.then((response) => response.json())
			.then((data) => {
				const animeList = document.getElementById("homepage");
				data.data.forEach((series) => {
					if (series.score != null) {
						const animeLi = document.createElement("li");
						animeLi.className = "anime";
						const link = document.createElement("a");
                        const slug_title = series.url.split("/")[5]
                        const title = series.title
                        link.href = "/associate2.php?id=" + series.mal_id;
						link.title = series.titles.title;
						animeLi.appendChild(link);
						const imageDiv = document.createElement("div");
						imageDiv.className = "searchimg";
						const poster = document.createElement("img");
						poster.className = "resultimg";
						poster.alt = "";
						poster.src = "https://cdn.animixreplay.to/" + btoa(encodeURIComponent(series.images.webp.image_url));
						imageDiv.appendChild(poster);
						const timeDiv = document.createElement("div");
						timeDiv.className = "timetext";
						timeDiv.textContent = series.aired.from.substring(0, 10);
						imageDiv.appendChild(timeDiv);
						const ratingDiv = document.createElement("div");
						ratingDiv.className = "rating";
						ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> " + series.score;
						imageDiv.appendChild(ratingDiv);
						link.appendChild(imageDiv);
						const detailsDiv = document.createElement("div");
						detailsDiv.className = "details";
						const nameP = document.createElement("p");
						nameP.className = "name";
						if (series.title_english == null) {
							nameP.textContent = series.title;
						} else {
							nameP.textContent = series.title_english;
						}
						detailsDiv.appendChild(nameP);
						const infoP = document.createElement("p");
						infoP.className = "infotext";
						infoP.textContent = series.type;
						detailsDiv.appendChild(infoP);
						link.appendChild(detailsDiv);
						animeList.appendChild(animeLi);
					} else {}
				});
			});
	} else {}
	if ($("#dubbtn").hasClass("active")) {
		console.log("Load more Dubs");
		dubpage++;
	    fetch(
		'https://cdn.animixreplay.to/' + btoa(encodeURIComponent(`https://ns512449.ip-192-99-8.net:3000/anime/gogoanime/recent-episodes?type=2?&page=${dubpage}`))
		)
		.then((response) => response.json())
        .then((data) => {
            const animeList = document.getElementById("homepage");
			data.results.map((series) => {
                const animeLi = document.createElement("li");
                animeLi.className = "anime";
                const link = document.createElement("a");
                //const slug_title = series.url.split("/")[5]
                const title = series.title
                link.href = "/associate2.php?id=" + series.id + "&override" + "&ep=" + series.episodeNumber; 
                link.title = series.title;
                animeLi.appendChild(link);
                const imageDiv = document.createElement("div");
                imageDiv.className = "searchimg";
                const poster = document.createElement("img");
                poster.className = "resultimg";
                //poster.alt = "";
                poster.src = "https://cdn.animixreplay.to/" + btoa(encodeURIComponent(series.image)); 
                imageDiv.appendChild(poster);
                const timeDiv = document.createElement("div");
                timeDiv.className = "timetext";
				//timeDiv.textContent = "New Dub";
				imageDiv.appendChild(timeDiv);
                link.appendChild(imageDiv);
                const detailsDiv = document.createElement("div");
                detailsDiv.className = "details";
                const nameP = document.createElement("p");
			    nameP.className = "name";
				if (series.title.endsWith("(Dub)") == true){
					const dubTitle = series.title.replace("(Dub)", "")
					nameP.textContent = dubTitle; 
				}
				detailsDiv.appendChild(nameP);
				const dubSpan = document.createElement("span");
				dubSpan.className = "dubtag";
				dubSpan.textContent = "[Dub]";
				nameP.appendChild(dubSpan); 
                const infoP = document.createElement("p");
                infoP.className = "infotext";
                infoP.textContent = "Episode " + series.episodeNumber;
                detailsDiv.appendChild(infoP);
                link.appendChild(detailsDiv);
				const nameIdP = document.createElement("p");
				nameIdP.className = "nameId";
				nameIdP.textContent = series.id;
				detailsDiv.appendChild(nameIdP);
				const ratingDiv = document.createElement("div");
				//ratingDiv.className = "rating";
				//ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> 0.00";
				imageDiv.appendChild(ratingDiv);
				animeList.appendChild(animeLi); 	
				/* if (nameIdP.textContent.endsWith("-dub") == true){
					var nameId = nameIdP.textContent.replace("-dub", "")
				}
				else {
					var nameId = nameIdP.textContent
				}
				fetch(`https://myanimelist.net/search/prefix.json?type=anime&keyword=${nameId}`)						
					.then(response => response.json())
					.then(data => {
						rating = data.categories[0].items[0].payload.score;
						//english_title = data.categories[0].items[0].name; // Sadly not english_title.

						ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> " + rating;
						//nameP.textContent = english_title;
					}) */

            });
        }); 
	} else {}
	if ($("#subbtn").hasClass("active")) {
		console.log("Load more Subs");
		subpage++;
	    fetch(
		'https://cdn.animixreplay.to/' +  btoa(encodeURIComponent(`https://ns512449.ip-192-99-8.net:3000/meta/anilist/recent-episodes?page=${subpage}&perPage=24`))
		)
		.then((response) => response.json())
        .then((data) => {
            const animeList = document.getElementById("homepage");
			data.results.forEach((series) => {  		
				const animeLi = document.createElement("li");
                animeLi.className = "anime";
                const link = document.createElement("a");
                //const slug_title = series.url.split("/")[5]
				link.href = "/associate2.php?id=" + series.malId + "&ep=" + series.episodeNumber;
                link.title = series.title.romaji;
                animeLi.appendChild(link);
                const imageDiv = document.createElement("div");
                imageDiv.className = "searchimg";
                const poster = document.createElement("img");
                poster.className = "resultimg";
                //poster.alt = "";
                poster.src = "https://cdn.animixreplay.to/" +  btoa(encodeURIComponent(series.image)); 
                imageDiv.appendChild(poster);
                const timeDiv = document.createElement("div");
                timeDiv.className = "timetext";
				timeDiv.textContent = "Loading...";
				imageDiv.appendChild(timeDiv);
                link.appendChild(imageDiv);
                const detailsDiv = document.createElement("div");
                detailsDiv.className = "details";
                const nameP = document.createElement("p");
                nameP.className = "name";
				if (series.title.english == null) {
					nameP.textContent = series.title.romaji;
                } else {
					nameP.textContent = series.title.english;
                }
				detailsDiv.appendChild(nameP);
                const infoP = document.createElement("p");
                infoP.className = "infotext";
                infoP.textContent = "Episode " + series.episodeNumber;
                detailsDiv.appendChild(infoP);
                link.appendChild(detailsDiv);
				const ratingDiv = document.createElement("div");
				ratingDiv.className = "rating";	
				ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> 0.00";
				imageDiv.appendChild(ratingDiv);
				animeList.appendChild(animeLi); 
				
				const malId = series.malId
				const url = 'https://cdn.animixreplay.to/' + btoa(encodeURIComponent(`https://api.myanimelist.net/v2/anime/${malId}?fields=mean,genres,average_episode_duration,studios`));
				
				// Encoded Data
				// const encodedData_1 = "https://ns512449.ip-192-99-8.net/mal.php?f=";
 				// const encodedData_2 = btoa(`${malid}?fields=mean,rank,created_at,updated_at,media_type,genres,start_season,broadcast,average_episode_duration,rating,statistics)`);
				
				fetch(url)					
					.then((response) => response.json())
					.then((data) => {
						rating = data.mean;
                        if(data.studios[0] != undefined){
                            studio = data.studios[0].name;
                        }

						if (series.rating == null) {
							ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> N/A";
						} else {
							ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> " + rating;	
						}
						if (studio != null && studio.length < 23) {
							timeDiv.textContent = studio;
						} else {
							timeDiv.textContent = series.genres[0];
						}
						
					}); 	
            });
        });
	} else {}
	if ($("#popularbtn").hasClass("active")) {
		console.log("Load more Popular");
		poppage++;
		var type = "tv"; // or 'movie'
		var filter = "bypopularity";
		var limit = 24;
		fetch(
				'https://cdn.animixreplay.to/' + btoa(encodeURIComponent(`https://api.jikan.moe/v4/top/anime?type=${type}&filter=${filter}&page=${poppage}&limit=${limit}`))
			)
			.then((response) => response.json())
			.then((data) => {
				const animeList = document.getElementById("homepage");
				data.data.forEach((series) => {
					if (series.score != null) {
						const animeLi = document.createElement("li");
						animeLi.className = "anime";
						const link = document.createElement("a");
                        const slug_title = series.url.split("/")[5]
                        const title = series.title
                        link.href = "/associate2.php?id=" + series.mal_id;
						link.title = series.titles.title;
						animeLi.appendChild(link);
						const imageDiv = document.createElement("div");
						imageDiv.className = "searchimg";
						const poster = document.createElement("img");
						poster.className = "resultimg";
						poster.alt = "";
						poster.src = "https://cdn.animixreplay.to/" + btoa(encodeURIComponent(series.images.webp.image_url)); 
						imageDiv.appendChild(poster);
						const timeDiv = document.createElement("div");
						timeDiv.className = "timetext";
						timeDiv.textContent = series.aired.from.substring(0, 10);
						imageDiv.appendChild(timeDiv);
						const ratingDiv = document.createElement("div");
						ratingDiv.className = "rating";
						ratingDiv.innerHTML = "<i class='glyphicon glyphicon-star'></i> " + series.score;
						imageDiv.appendChild(ratingDiv);
						link.appendChild(imageDiv);
						const detailsDiv = document.createElement("div");
						detailsDiv.className = "details";
						const nameP = document.createElement("p");
						nameP.className = "name";
						if (series.title_english == null) {
							nameP.textContent = series.title;
						} else {
							nameP.textContent = series.title_english;
						}
						detailsDiv.appendChild(nameP);
						const infoP = document.createElement("p");
						infoP.className = "infotext";
						infoP.textContent = series.season.charAt(0).toUpperCase() + series.season.slice(1) + " " + series.year + " " + series.type;
						detailsDiv.appendChild(infoP);
						link.appendChild(detailsDiv);
						animeList.appendChild(animeLi);
					}
				});
			});
	} else {}
    if ($("#upcomingbtn").hasClass("active")) {
        console.log("Load more Upcoming");
        upcpage++;
        var type = "tv"; // or 'movie'
        var filter = "upcoming";
        var limit = 24;
        fetch(
                'https://cdn.animixreplay.to/' + btoa(encodeURIComponent(`https://api.jikan.moe/v4/top/anime?type=${type}&filter=${filter}&page=${upcpage}&limit=${limit}`))
            )
            .then((response) => response.json())
            .then((data) => {
                const animeList = document.getElementById("homepage");
                data.data.forEach((series) => {
                    const animeLi = document.createElement("li");
                    animeLi.className = "anime";
                    const link = document.createElement("a");
                    const title = series.title
					link.href = "/anime/" + series.mal_id;
                    link.title = series.titles.title;
                    animeLi.appendChild(link);
                    const imageDiv = document.createElement("div");
                    imageDiv.className = "searchimg";
                    const poster = document.createElement("img");
                    poster.className = "resultimg";
                    poster.alt = "";
                    poster.src = "https://cdn.animixreplay.to/" + btoa(encodeURIComponent(series.images.webp.image_url)); 
                    imageDiv.appendChild(poster);				
					const timeDiv = document.createElement("div");
					timeDiv.className = "timetext";
					timeDiv.textContent = series.aired.string;
					imageDiv.appendChild(timeDiv);
                    link.appendChild(imageDiv);
                    const detailsDiv = document.createElement("div");
                    detailsDiv.className = "details";
                    const nameP = document.createElement("p");
                    nameP.className = "name";
					if (series.title_english == null) {
                        nameP.textContent = series.title;
                    } else {
                        nameP.textContent = series.title_english;
                    }
                    detailsDiv.appendChild(nameP);
                    const infoP = document.createElement("p");
                    infoP.className = "infotext";
                    if (series.year == null) {
                        infoP.textContent = series.type;
                    } else {
                        infoP.textContent = series.type + " | " + series.year;
                    }
                    detailsDiv.appendChild(infoP);
                    link.appendChild(detailsDiv);
                    animeList.appendChild(animeLi);
                });
            });
    } else {}
}

loadButton.addEventListener('click', function (clicked) {
    return function () {
        if (!clicked) {
            var loading = this.innerHTML;
            this.innerHTML = 'Loading...';
            clicked = true;
			loadMore();
            setTimeout(function () {
                this.innerHTML = loading;
                clicked = false;
				loadButton.disabled = true;
            }.bind(this), 0);
        }
    };
}(false), this);

var deferredPrompt,
    notFoundID = {},
    gID = function(e) {
        var t = document.getElementById(e);
        return (
            null === t &&
            (void 0 === notFoundID[e] ?
                ((t = document.createElement("div")), (notFoundID[e] = t)) :
                (t = notFoundID[e])),
            t
        );
    },
    notFoundClass = {},
    gClass = function(e) {
        var t = document.getElementsByClassName(e);
        return (
            void 0 === t[0] &&
            (void 0 === notFoundClass[e] ?
                ((t = [document.createElement("div")]), (notFoundClass[e] = t)) :
                (t = notFoundClass[e])),
            t
        );
    };

function isJson(e) {
    try {
        JSON.parse(e);
    } catch (e) {
        return !1;
    }
    return !0;
}
