
<style>
  .video-container {
    position: relative;
    width: 600px;
  }

  .logo {
    position: absolute;
    top: 10px;
    left: 10px;
  }
</style>

<div class="video-container">
<video  id="myVideo" controls>
  <source src="video.mp4" type="video/mp4">
</video>
  <img class="logo" src="website-logo-white.png" alt="Logo">
</div>

<script>
var video = document.getElementById("myVideo");
var currentLink; // Şu anki link
var linkIntervals = [
  {
    start: 1,
    end: 5,
    url: "https://www.google.com.tr/",
    title: "Bu birinci link"
  },
  {
    start: 10,
    end: 15,
    url: "https://www.google.com.tr/",
    title: "Bu ikinci link"
  },
  {
    start: 20,
    end: 25,
    url: "https://www.google.com.tr/",
    title: "Bu üçüncü link"
  },
  {
    start: 30,
    end: 35,
    url: "https://www.google.com.tr/",
    title: "Bu dördüncü link"
  }
  
];


video.addEventListener("timeupdate", function() {
  var currentTime = video.currentTime;
  var linkInterval = getLinkInterval(currentTime);  
  if (linkInterval !== null) {
    createLink(linkIntervals[linkInterval].url, linkIntervals[linkInterval].title);
  } else {
    removeCurrentLink();
  }  
});

function getLinkInterval(currentTime) {
  for (var i = 0; i < linkIntervals.length; i++) {
    var interval = linkIntervals[i];
    if (currentTime >= interval.start && currentTime < interval.end) {
      return i;
    }
  }
  return null;
}

function createLink(url, title) {
  // Şu anki link varsa, onu kaldır
  removeCurrentLink();
  
  // Yeni linki oluştur
  var link = document.createElement("a");
  link.href = url;
  link.target = "_blank";
  link.innerText = title;
  link.style.position = "absolute";
  link.style.top = "66%";
  link.style.right = "62%";
  link.style.zIndex = "9999";
  link.style.color = "white";
  link.style.fontSize = "25px";
  link.style.textDecoration = "none";
  document.body.appendChild(link);
  
  // Şu anki linki kaydet
  currentLink = link;
  
}

function removeCurrentLink() {
  // Şu anki link varsa, onu kaldır
  if (currentLink) {
    currentLink.remove();
    currentLink = null;
  }
}

document.addEventListener("visibilitychange", function() {
  if (document.hidden) {
    // Sayfa görünürlüğü kaybedilirse (başka bir sekme veya pencere açılırsa), videoyu durdur
    video.pause();
  } else {
    // Sayfa görünürlüğü geri geldiğinde (sayfa yeniden görünür hale geldiğinde), videoyu otomatik olarak oynat
    video.play();
  }
});

</script>



