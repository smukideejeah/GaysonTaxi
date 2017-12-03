window.onload = function(e){
  var images = document.getElementsByTagName('img');
  console.debug(images);
  var leftButton = document.getElementById('left-button');
  var rightButton = document.getElementById('right-button');

  //event handlers
  leftButton.onclick=function(e){
    for(var i=images.length-1;i>=0;i--){
      var current;
      var previousImage;
      if(images[i].className=="noh"){
        current = images[i];
        if(i==0) previousImage=images[images.length-1];
        else previousImage = images[i-1];
        current.className="hidden";
        previousImage.className="noh";
        break;
      }
    }
  }
  rightButton.onclick=function(e){
    for(var i=0; i<images.length;i++){
      var current ;
      var nextImage;
      if(images[i].className=="noh") {
        current = images[i];
        nextImage = images[(i+1)%images.length];
        nextImage.className = "noh"
        current.className = "hidden";
        break;
      }
    }
  }
}
