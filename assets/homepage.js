let page = 1;
var type = "null";
var filter = "null";

const dubButton = document.getElementById("dubbtn");
const subButton = document.getElementById("allbtn");
const loadButton = document.getElementById("loadmorelist");
const moviesButton = document.getElementById("moviebtn");

dubButton.addEventListener("click", function () {
  var type = "tv";
  var filter = "dub";
  fetch(`https://api.jikan.moe/v4/top/anime?type=${type}&filter=${filter}`)
    .then((response) => response.json())
    .then((data) => {
      const animeList = document.getElementById("searchresult");
      animeList.innerHTML = "";
      data.data.forEach((series) => {
        const animeLi = document.createElement("li");
        animeLi.className = "anime";
        const link = document.createElement("a");
        link.href = "#";
        link.title = series.title_english;
        animeLi.appendChild(link);
        const imageDiv = document.createElement("div");
        imageDiv.className = "searchimg";
        const poster = document.createElement("img");
        poster.className = "resultimg";
        poster.alt = "";
        poster.src = series.images.jpg.image_url;
        imageDiv.appendChild(poster);
        const timeDiv = document.createElement("div");
        timeDiv.className = "timetext";
        timeDiv.textContent = series.aired.from;
        imageDiv.appendChild(timeDiv);
        const ratingDiv = document.createElement("div");
        ratingDiv.className = "rating";
        ratingDiv.textContent = series.score;
        imageDiv.appendChild(ratingDiv);
        link.appendChild(imageDiv);
        const detailsDiv = document.createElement("div");
        detailsDiv.className = "details";
        const nameP = document.createElement("p");
        nameP.className = "name";
        nameP.textContent = series.title_english;
        detailsDiv.appendChild(nameP);
        const infoP = document.createElement("p");
        infoP.className = "infotext";
        infoP.textContent = series.episodes;
        detailsDiv.appendChild(infoP);
        link.appendChild(detailsDiv);
        animeList.appendChild(animeLi);
      });
    });
});

subButton.addEventListener("click", function () {
  var type = "tv"; // or 'movie'
  var filter = "sub";
  fetch(`https://api.jikan.moe/v4/top/anime?type=${type}&filter=${filter}`)
    .then((response) => response.json())
    .then((data) => {
      const animeList = document.getElementById("searchresult");
      animeList.innerHTML = "";
      data.data.forEach((series) => {
        const animeLi = document.createElement("li");
        animeLi.className = "anime";
        const link = document.createElement("a");
        link.href = "#";
        link.title = series.title_english;
        animeLi.appendChild(link);
        const imageDiv = document.createElement("div");
        imageDiv.className = "searchimg";
        const poster = document.createElement("img");
        poster.className = "resultimg";
        poster.alt = "";
        poster.src = series.images.jpg.image_url;
        imageDiv.appendChild(poster);
        const timeDiv = document.createElement("div");
        timeDiv.className = "timetext";
        timeDiv.textContent = series.aired.prop.year;
        imageDiv.appendChild(timeDiv);
        const ratingDiv = document.createElement("div");
        ratingDiv.className = "rating";
        ratingDiv.textContent = series.score;
        imageDiv.appendChild(ratingDiv);
        link.appendChild(imageDiv);
        const detailsDiv = document.createElement("div");
        detailsDiv.className = "details";
        const nameP = document.createElement("p");
        nameP.className = "name";
        nameP.textContent = series.title_english;
        detailsDiv.appendChild(nameP);
        const infoP = document.createElement("p");
        infoP.className = "infotext";
        infoP.textContent = series.episodes;
        detailsDiv.appendChild(infoP);
        link.appendChild(detailsDiv);
        animeList.appendChild(animeLi);
      });
    });
});

loadButton.addEventListener("click", function () {
  page++;
  const limit = 23;
  fetch(
    `https://api.jikan.moe/v4/top/anime?type=${type}&filter=${filter}&page=${page}&limit=${limit}`
  )
    .then((response) => response.json())
    .then((data) => {
      const animeList = document.getElementById("searchresult");
      data.data.forEach((series) => {
        const animeLi = document.createElement("li");
        animeLi.className = "anime";
        const link = document.createElement("a");
        link.href = "#";
        link.title = series.title_english;
        animeLi.appendChild(link);
        const imageDiv = document.createElement("div");
        imageDiv.className = "searchimg";
        const poster = document.createElement("img");
        poster.className = "resultimg";
        poster.alt = "";
        poster.src = series.images.jpg.image_url;
        imageDiv.appendChild(poster);
        const timeDiv = document.createElement("div");
        timeDiv.className = "timetext";
        timeDiv.textContent = series.aired.from;
        imageDiv.appendChild(timeDiv);
        const ratingDiv = document.createElement("div");
        ratingDiv.className = "rating";
        ratingDiv.textContent = series.score;
        imageDiv.appendChild(ratingDiv);
        link.appendChild(imageDiv);
        const detailsDiv = document.createElement("div");
        detailsDiv.className = "details";
        const nameP = document.createElement("p");
        nameP.className = "name";
        nameP.textContent = series.title_english;
        detailsDiv.appendChild(nameP);
        const infoP = document.createElement("p");
        infoP.className = "infotext";
        infoP.textContent = series.episodes;
        detailsDiv.appendChild(infoP);
        link.appendChild(detailsDiv);
        animeList.appendChild(animeLi);
      });
    });
});

moviesButton.addEventListener("click", function () {
  var type = "movie";
  var filter = "bypopularity";
  fetch(`https://api.jikan.moe/v4/top/anime?type=${type}&filter=${filter}`)
    .then((response) => response.json())
    .then((data) => {
      const animeList = document.getElementById("searchresult");
      animeList.innerHTML = "";
      data.data.forEach((series) => {
        const animeLi = document.createElement("li");
        animeLi.className = "anime";
        const link = document.createElement("a");
        link.href = "#";
        link.title = series.title_english;
        animeLi.appendChild(link);
        const imageDiv = document.createElement("div");
        imageDiv.className = "searchimg";
        const poster = document.createElement("img");
        poster.className = "resultimg";
        poster.alt = "";
        poster.src = series.images.jpg.image_url;
        imageDiv.appendChild(poster);
        const timeDiv = document.createElement("div");
        timeDiv.className = "timetext";
        timeDiv.textContent = series.aired.from;
        imageDiv.appendChild(timeDiv);
        const ratingDiv = document.createElement("div");
        ratingDiv.className = "rating";
        ratingDiv.textContent = series.score;
        imageDiv.appendChild(ratingDiv);
        link.appendChild(imageDiv);
        const detailsDiv = document.createElement("div");
        detailsDiv.className = "details";
        const nameP = document.createElement("p");
        nameP.className = "name";
        nameP.textContent = series.title_english;
        detailsDiv.appendChild(nameP);
        const infoP = document.createElement("p");
        infoP.className = "infotext";
        infoP.textContent = series.episodes;
        detailsDiv.appendChild(infoP);
        link.appendChild(detailsDiv);
        animeList.appendChild(animeLi);
      });
    });
});
