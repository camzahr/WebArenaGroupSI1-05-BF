
<div class="col-md-12">

       <canvas id="c" width="1080px" height="741px" ></canvas>
       </div>

      


             <div class="col-md-4">     
   <?php
echo $myFighter['Fighter']['id'];
 $pic="img/avatars/".$myFighter['Fighter']['id'].".jpg";

 if (file_exists($pic)) { echo "LOOOL";}
echo $this->Form->create('Fightermove');
echo $this->Form->input('direction',array('options' => array('north'=>'north','east'=>'east','south'=>'south','west'=>'west'), 'default' => 'east'));
echo $this->Form->end('Move');

echo $this->Form->create('Fighterattack');
echo $this->Form->input('direction',array('options' => array('north'=>'north','east'=>'east','south'=>'south','west'=>'west'), 'default' => 'east'));
echo $this->Form->end('Attack');

?>
             </div>


               <div class="col-md-8">



            <div class="commentArea" id="messages" style="overflow-y: scroll; height:400px; background-color: #e7e7e7;" >
        <div class="bubbledRight">
        Error dicunt theophrastus cu qui. Ad eos simul possit option, adipisci principes sed at. Detracto adolescens pro ea, duo no
    </div>
                    <div style="float: right; clear: both; margin-top: 5px;"    >
                        <img src="portrait.jpg" style="height: 30px; width: 30px;  "/> <i class="fa fa-arrow-right fa-lg"></i> <img src="img/empty-profile.jpg" style="height: 30px; width: 30px;  "/>
                </div>
    
    <div class="bubbledLeft">
        Lorem ipsum dolor sit amet, ea oblique constituam signiferumque eam. Pri adipisci maluisset te.
    </div>
                <div style="float: left; clear: both; margin-top: 5px;" >
                     <img src="img/empty-profile.jpg" style="height: 30px; width: 30px;  "/> <i class="fa fa-arrow-right fa-lg"></i>    <img src="portrait.jpg" style="height: 30px; width: 30px;  "/>
                </div>
            
                    <div class="bubbledRight">
        Error dicunt theophrastus cu qui. Ad eos simul possit option, adipisci principes sed at. Detracto adolescens pro ea, duo no
    </div>
                    <div style="float: right; clear: both; margin-top: 5px;"    >
                        <img src="portrait.jpg" style="height: 30px; width: 30px;  "/> <i class="fa fa-arrow-right fa-lg"></i> <img src="img/empty-profile.jpg" style="height: 30px; width: 30px;  "/>
                </div>
    
    <div class="bubbledLeft">
        Lorem ipsum dolor sit amet, ea oblique constituam signiferumque eam. Pri adipisci maluisset te.
    </div>
                <div style="float: left; clear: both; margin-top: 5px;" >
                     <img src="img/empty-profile.jpg" style="height: 30px; width: 30px;  "/> <i class="fa fa-arrow-right fa-lg"></i>    <img src="portrait.jpg" style="height: 30px; width: 30px;  "/>
                </div>
                
            
                
</div>  
                <input type="text" placeholder="Type Message" style="width: 100%;" />
            
            </div>

  </div>

      </div>
    


<script>

//////////////////// Classroom canvas 

var c_canvas = document.getElementById("c");
var context = c_canvas.getContext("2d");

var img = new Image();

img.onload = function(){
context.drawImage(img,0,0);
    
for (var x = 0.5; x < 1081; x += 70) {
  context.moveTo(x, 0);
  context.lineTo(x, 741);
}
  
 context.moveTo(0, 0.5);
  context.lineTo(770, 0.5);
  
for (var y = 40; y < 741; y += 70) {
  context.moveTo(0, y);
  context.lineTo(1080, y);
}

  <?php 

  
        $loop=0;

// Drawing visible opponents

        foreach ($othersFighters as $player) 
        {
            $x=$player['Fighter']['coordinate_x']*70;
            $y=40+$player['Fighter']['coordinate_y']*70;
            $name=$player['Fighter']['name'];
            $pic="img/avatars/".$player['Fighter']['id'].".jpg";
              if (!file_exists($pic)) {$pic="img/empty-profile.jpg";}

         echo"
                  var player$loop = new Image();  
        player$loop.src = '$pic';
        player$loop.onload = function(){
          context.drawImage(player$loop,$x+1,$y+1,69,50);
        context.fillStyle = 'white';
        context.font = '15px Voltaire';
        context.fillText('$name',$x+2,$y+65);

        } ";
 $loop++;} 
    

     // Drawing the actual fighter 
            $x=$myFighter['Fighter']['coordinate_x']*70;
            $y=40+$myFighter['Fighter']['coordinate_y']*70;
            $name=$myFighter['Fighter']['name'];
            $pic="img/avatars/".$myFighter['Fighter']['id'].".jpg";
            
            if (!file_exists($pic)) {$pic="img/empty-profile.jpg";}
        
         echo"
                  var players = new Image();   // Crée un nouvel objet Image
        players.src = '$pic';
        players.onload = function(){
           
          context.drawImage(players,$x+1,$y+1,69,50);
        context.font = '15px Voltaire';
        context.fillText('$name',$x+5,$y+65);

        } ";    

 //drawing the off-sight mask:

      $surround= $myFighter['Fighter']['skill_sight']*70; 
      $maxy=$y+$surround;
      $maxx=$x+$surround;
      $miny=$y-$surround;
      $minx=$x-$surround;

  
     
 echo"


    context.fillStyle = 'rgba(0,0,0,0.5)';
    context.fillRect($maxx+70,40,981-$maxx,700);
     context.fillRect(0,$miny,$minx,700);


       context.fillRect(0,40,$maxx+70,$miny+40-70-10);


     context.fillRect($minx,$maxy+70,$maxx+70-$minx,740-$maxy);




        
    ";
?>



context.strokeStyle = "#797979";
context.stroke();
};


img.src = 'img/background-png.png';



</script>
