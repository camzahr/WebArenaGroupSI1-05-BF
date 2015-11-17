
//////////////////// Classroom canvas 

var c_canvas = document.getElementById("c");
var context = c_canvas.getContext("2d");

var img = new Image();

img.onload = function(){
context.drawImage(img,0,0);
	
for (var x = 0.5; x < 801; x += 70) {
  context.moveTo(x, 0);
  context.lineTo(x, 741);
}
  
 context.moveTo(0, 0.5);
  context.lineTo(770, 0.5);
  
for (var y = 40; y < 741; y += 70) {
  context.moveTo(0, y);
  context.lineTo(800, y);
}

var player = new Image();
	player.src = 'img/empty-profile.jpg';
	context.drawImage(player,140,110,70,70);
	
	
	var player = new Image();
	player.src = 'img/empty-profile.jpg';
	context.drawImage(player,210,180,70,70);



context.strokeStyle = "#797979";
context.stroke();
};


img.src = 'img/background-png.png';

