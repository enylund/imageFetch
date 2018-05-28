var img = new Image();

// User Variables - customize these to change the image being scrolled, its
// direction, and the speed.

img.src = 'img/hiphopdx/2018-05-18/nick-grant.jpg';
var CanvasXSize = img.naturalWidth;
var CanvasYSize = img.naturalHeight;
var speed = 20; // lower is faster

// Main program

var dx = 0.75;
var imgW;
var imgH;
var x = 0;
var clearX;
var clearY;
var ctx;

img.onload = function() {
    imgW = img.width;
    imgH = img.height;

    clearX = CanvasXSize;
    clearY = CanvasYSize;

    // get canvas context
    canvas = document.getElementById('image-canvas')
    ctx = canvas.getContext('2d');
    canvas.width = imgW;
    canvas.height = imgH;

    // set refresh rate
    return setInterval(draw, speed);
}

function draw() {
    ctx.clearRect(0, 0, clearX, clearY); // clear the canvas

    // draw image
    ctx.drawImage(img, 0, 0);
    img.style.display = 'none';
    var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    var data = imageData.data;


    for (var i = 0; i < data.length; i += 4) {
      if (i > x){
        data[i + 3] = 0;
      } else if( data[i] > 100 && data[i + 1] > 100  & data[i + 2] > 100 ){
        data[i + 3] = 0;
      } else {
        data[i]     = 0; // red
        data[i + 1] = 0; // green
        data[i + 2] = 0; // blue
      }
    }

    ctx.putImageData(imageData, 0, 0);
    x += 7000;
}