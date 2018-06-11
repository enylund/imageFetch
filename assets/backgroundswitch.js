var srcArray = ['img/hiphopdx/2018-05-18/nick-grant.jpg',
              'img/aljazeera/2018-05-22/f1398e29dd204095a73c1829c4daf866_6.png',
              'img/infowars/2018-05-24/12-7-17-trump-mueller-610x320.jpg',
              'img/thesource/2018-05-22/LL-Cool-J-Inspired-to-Raise-Money-for-Cancer-Research-Following-Wifes-Diagnosis.jpg',
              'img/techradar/2018-05-18/4a71110f1759755d76e5095a0f135051-320-80.jpg',
              'img/nationalenquirer/2018-05-18/robert-kennedy-rfk-rose-love-child-f.jpg',
              'img/wired/2018-05-18/Deadpool2Review.jpg'
                ];
var el = document.getElementsByClassName("image-one");

function swap(){
  var urlToUpdate = srcArray[Math.floor(Math.random()*srcArray.length)];
  el[0].style.backgroundImage = "url("+ urlToUpdate+")";
}


document.addEventListener("DOMContentLoaded", function() {
  var speed = 5000;
  var drawEffect = setInterval(swap, speed);
});

