
window.onload = function() {
  var img = new Image();
  var el = document.querySelector('canvas');
  img.src = el.getAttribute('data-path');

  img.onload = function() {
    draw(this);
  };

  var timeWrapper = document.getElementsByClassName('timer-wrapper')[0];
  timeWrapper.innerHTML = getFormattedDate();

  setInterval(function(){
    timeWrapper.innerHTML = getFormattedDate();
  }, 1000);

};

function draw(img) {
  var canvas = document.getElementById('image-canvas');
  var ctx = canvas.getContext('2d');
  canvas.width = img.naturalWidth;
  canvas.height = img.naturalHeight;
  ctx.drawImage(img, 0, 0);
  img.style.display = 'none';
  var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
  var data = imageData.data;

  for (var i = 0; i < data.length; i += 4) {
      if(data[i] > 100 && data[i + 1] > 100  & data[i + 2] > 100 ){
        data[i + 3] = 0;
      } else {
        data[i]     = 0; // red
        data[i + 1] = 0; // green
        data[i + 2] = 0; // blue
      }
    }
  ctx.putImageData(imageData, 0, 0);
}

function getFormattedDate() {
    var date = new Date();
    var str = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
    return str;
}

