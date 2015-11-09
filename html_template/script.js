
		var pwdwidget = new PasswordWidget('thepwddiv','regpwd');
		pwdwidget.MakePWDWidget();
	

  var loadFile = function(event) {
    var output = document.getElementById('rounded_upload');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
//////////////////// Classroom canvas 

var c_canvas = document.getElementById("c");
var context = c_canvas.getContext("2d");

var img = new Image();

img.onload = function(){
context.drawImage(img,0,0);
	
for (var x = 0.5; x < 801; x += 70) {
  context.moveTo(x, 0);
  context.lineTo(x, 601);
}

for (var y = 40; y < 601; y += 70) {
  context.moveTo(0, y);
  context.lineTo(800, y);
}

var player = new Image();
	player.src = 'img/empty-profile.jpg';
	context.drawImage(player,140,110,70,70);
	
	
	var player = new Image();
	player.src = 'portrait.jpg';
	context.drawImage(player,210,180,70,70);



context.strokeStyle = "#ddd";
context.stroke();
};


img.src = 'background.jpg';

// Chat scroll div

function getMessages(letter) {
    var div = $("#messages");
    div.scrollTop(div.prop('scrollHeight'));
}

$(function() {
    getMessages();
});



function educationShowmore(id) {
	document.getElementById("eduipsum").style.display = 'none';
	document.getElementById("ece").style.display = 'none';
	document.getElementById("lyautey").style.display = 'none';
	document.getElementById("cpe").style.display = 'none';
	document.getElementById("jth").style.display = 'none';

	document.getElementById(id).style.display = 'block';

}

function workShowmore(id) {
	document.getElementById("workipsum").style.display = 'none';
	document.getElementById("pdf").style.display = 'none';
	document.getElementById("ram").style.display = 'none';
	document.getElementById("ana").style.display = 'none';
	document.getElementById("expform").style.display = 'none';

	document.getElementById(id).style.display = 'block';
	
}





// Listener: user inputs year 
var yearmodif = document.getElementById('fmyear');
yearmodif.onkeyup = yearmodif.onkeypress = function() {
	document.getElementById('dispyear').innerHTML = this.value;
}
// Listener: user inputs Company name
var companymodif = document.getElementById('fmcompany');
companymodif.onkeyup = companymodif.onkeypress = function() {
	document.getElementById('dispcompany').innerHTML = this.value;
}
// Listener: user inputs experience description
var descmodif = document.getElementById('fmdesc');
descmodif.onkeyup = descmodif.onkeypress = function() {
	document.getElementById('dispdesc').innerHTML = "<br/>				" + this.value;
}

var mailme = document.getElementById('mailme');
mailme.onclick = function() {
	document.getElementById('contactform').style.display = 'block';
}