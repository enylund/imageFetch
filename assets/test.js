// Global variables
var speed = 40,
x = 0,
imgW,
imgH,
clearX,
clearY,
ctx,
srcArray,
CanvasXSize,
CanvasYSize,
init = function (callback) {
    var srcArray = ['img/hiphopdx/2018-05-18/nick-grant.jpg', 'img/aljazeera/2018-05-22/f1398e29dd204095a73c1829c4daf866_6.png'];

    img          = new Image();
    img.src      = srcArray[Math.floor(Math.random()*srcArray.length)];;
    CanvasXSize  = img.naturalWidth;
    CanvasYSize  = img.naturalHeight;
    x            = 0;
    callback(img);
},
draw = function draw() {
    ctx.clearRect(0, 0, clearX, clearY); // clear the canvas

    // draw image
    ctx.drawImage(img, 0, 0);
    img.style.display = 'none';
    var imageData     = ctx.getImageData(0, 0, canvas.width, canvas.height);
    var data          = imageData.data;

    if (x < data.length - 10000) {
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
        x += 2000;
    } else {
        ctx.clearRect(0, 0, clearX, clearY);
        init(canvasSetup);
    }
},
canvasSetup = function(img){
    img.onload = function() {
        imgW          = img.width;
        imgH          = img.height;

        clearX        = CanvasXSize;
        clearY        = CanvasYSize;

        // get canvas context
        canvas        = document.getElementById('image-canvas')
        ctx           = canvas.getContext('2d');
        canvas.width  = imgW;
        canvas.height = imgH;

        // set refresh rate
        var drawEffect = setInterval(draw, speed);
    }
};

init(canvasSetup);