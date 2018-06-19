$( document ).ready(function() {
  var $imageOne = $(".image-one");
  var $imageTwo = $(".image-two");
  var showImageOne = false;

  init($imageOne, $imageTwo);

  setInterval( function(){
    if(showImageOne == true) {
      $imageOne.show();
      var imagePath = getImgPath();
      console.log(imagePath);
      $imageTwo.css('background-image', 'url(' + imagePath + ')');
      showImageOne = false;
    } else {
      $imageOne.hide();
      var imagePath = getImgPath();
      console.log(imagePath);
      $imageOne.css('background-image', 'url(' + imagePath + ')');
      showImageOne = true;
    }
  }, 3000);

});


function init($imageOne, $imageTwo){
  var imagePathOne = getImgPath();
  $imageOne.css('background-image', 'url(' + imagePathOne + ')');
  var imagePathTwo = getImgPath();
  $imageTwo.css('background-image', 'url(' + imagePathTwo + ')');
}

function getImgPath() {
  var url = "";
  var jsonData = $('body').data('json');

  // Get the first level key
  var randomFirstLevelKeys = Object.keys(jsonData);
  var firstLevel = randomFirstLevelKeys[Math.floor(Math.random()*randomFirstLevelKeys.length)];

  // Get the second level key
  var randomSecondLevelKeys = Object.keys(jsonData[String(firstLevel)]);
  var secondLevel = randomSecondLevelKeys[Math.floor(Math.random()*randomSecondLevelKeys.length)];


  // Get the third level key
  var thirdLevel = jsonData[String(firstLevel)][String(secondLevel)][Math.floor(Math.random()*jsonData[String(firstLevel)][String(secondLevel)].length)];
  return('img/'+firstLevel+'/'+secondLevel+'/'+thirdLevel);
}
