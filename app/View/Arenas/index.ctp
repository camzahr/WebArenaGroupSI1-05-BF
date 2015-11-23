
<div class="col-md-12">

       <canvas id="c" width="1080px" height="741px" ></canvas>
       </div>

      


             <div class="col-md-12" style="background: #232134 url('http://www.bootply.com/assets/example/pt_topo.png') repeat center center fixed; position: fixed; bottom: 0; left: 0; z-index: 999; padding-bottom: 20px;">    
  <div class="col-md-2" style='color: white;   font-family: Voltaire;'>  <h3 style="color: white; font-family: Voltaire;">
<span style="color: #b59100;" > LVL<?php echo $myFighter['Fighter']['level']; ?></span>
 <?php echo $myFighter['Fighter']['name']; ?></h3>
    <?php 
    $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');

     $life_percent=(100*$myFighter['Fighter']['current_health'])/$myFighter['Fighter']['skill_health'];?>

    <div class="progress" style="height: 30px; margin-bottom: 5px; margin-top:5px;">
  <div class="progress-bar progress-bar-success progress-bar-striped active"  role="progressbar" aria-valuenow="<?php echo $myFighter['Fighter']['current_health']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $myFighter['Fighter']['skill_health']; ?>" style="width: <?php echo $life_percent;?>%; font-size: 20px; padding-top: 5px;">
  <?php echo "  Life: ".$myFighter['Fighter']['current_health']."/ ".$myFighter['Fighter']['skill_health']." "; ?>
  </div>
</div>
<?php $xp_percent=(100*$myFighter['Fighter']['xp'])/4; if($xp_percent>100){$xp_percent=100;} ?>
 <div class="progress" style="height: 30px; margin-bottom: 5px; margin-top:5px;">
  <div class="progress-bar progress-bar-warning progress-bar-striped active"  role="progressbar" aria-valuenow="<?php echo $myFighter['Fighter']['current_health']; ?>" aria-valuemin="0" aria-valuemax="4" style="width: <?php echo $xp_percent;?>%; font-size: 20px; padding-top: 5px;">
  <?php echo "  XP: ".$myFighter['Fighter']['xp']."/ 4 "; ?>
  </div>
</div>

<?php 
echo  "Position: ".$alpha[$myFighter['Fighter']['coordinate_x']-1].$myFighter['Fighter']['coordinate_y']; 
?>
  </div>   
<div class="col-md-3">   
           <h3 style="color: white; font-family: Voltaire;">Move</h3>
            <a href="#m" data-select="west" /><img src="img/west.png" style="width: 70px; height: 70px;"/></a>
            <a href="#m" data-select="north" /> <img src="img/up.png" style="width: 70px; height: 70px;"/></a>
            <a href="#m" data-select="south" /><img src="img/down.png" style="width: 70px; height: 70px;"/></a>
            <a href="#m" data-select="east" /><img src="img/east.png" style="width: 70px; height: 70px;"/></a>
  </div>
  <div class="col-md-3">    
          <h3 style="color: white; font-family: Voltaire;">Attack</h3>
            <a href="#a" data-select="west" /><img src="img/west.png" style="width: 70px; height: 70px;"/></a>
            <a href="#a" data-select="north" /> <img src="img/up.png" style="width: 70px; height: 70px;"/></a>
            <a href="#a" data-select="south" /><img src="img/down.png" style="width: 70px; height: 70px;"/></a>
            <a href="#a" data-select="east" /><img src="img/east.png" style="width: 70px; height: 70px;"/></a>
    </div>  
     <div class="col-md-3"> 
      <h3 style="color: white; font-family: Voltaire;">Pick Up</h3>
     <?php


// Checking if there's any tool available to pick up 
$tools = array_filter($tool);
if (!empty($tools)) { //there's some tool in there ! :)

        foreach ($tool as $potion)
        {

            switch($potion['Tool']['type'])
            {
              case "strength":

              echo "<a href='#t' data-select='".$potion['Tool']['type']."' style='text-decoration: none;' > <div style='clear: both;'><img src='img/potion1.png'  style='float: left;'/> <span style='color: white;   font-family: Voltaire;'> 
              <strong style='color: #b53700'; />Strength Potion </strong><br/>Bonus : +".$potion['Tool']['bonus']." Strength
              </span>

              </div> </a>

  ";            break;
              case "sight":

              echo "<a href='#t' data-select='".$potion['Tool']['type']."' style='text-decoration: none;'> <div style='clear: both;'><img src='img/potion2.png' style='float: left;' /> <span style='color: white;  font-family: Voltaire;'>   <strong style='color: #0059b5'; />Sight Potion </strong><br/>Bonus : +".$potion['Tool']['bonus']." Sight</span>

                </div> </a>
    ";          break; 
              case "health":

              echo "<a href='#t' data-select='".$potion['Tool']['type']."' style='text-decoration: none;'> <div style='clear: both;'><img src='img/potion3.png' style='float: left;' /> <span style='color: white;  font-family: Voltaire;'>  
              <strong style='color: #8f0000'; />Strength Potion</strong><br/>Bonus : +".$potion['Tool']['bonus']." Health</span>


              </div> </a>
    ";          break;
              case "lifePoints":

              echo "<a href='#t' data-select='".$potion['Tool']['type']."' style='text-decoration: none;'> <div style='clear: both;'><img src='img/potion3.png' style='float: left;' /> <span style='color: white;  font-family: Voltaire;'> 
                <strong style='color: #8f0000'; />Strength Potion </strong><br/>Bonus : +".$potion['Tool']['bonus']." Life Points
              </span>


              </div> </a>";

              break;
            }

        }

}
     ?>   
    </div>
      </div>  
   <?php
echo'<div style="display:none;">';

echo $this->Form->create('Fightermove');
echo $this->Form->input('direction',array('options' => array('north'=>'north','east'=>'east','south'=>'south','west'=>'west'), 'default' => 'east'));
echo $this->Form->end('Move');

echo $this->Form->create('Fighterattack');
echo $this->Form->input('direction',array('options' => array('north'=>'north','east'=>'east','south'=>'south','west'=>'west'), 'default' => 'east'));
echo $this->Form->end('Attack');

echo'</div>';





echo'<div style="display:none;">';

echo $this->Form->create('Toolpickup');
echo $this->Form->input('toolChoice',array('options' => $toolList));
echo $this->Form->end('PickUp Tool');

echo'</div>';


?>
             </div>


               <div class="col-md-8">



           
             
            
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

        context.font = '15px Voltaire';
        context.fillText('$name',$x+2,$y+65);

        } ";
 $loop++;} 
    

     // Drawing the actual fighter 
            $x=$myFighter['Fighter']['coordinate_x']*70-70;
            $y=40+$myFighter['Fighter']['coordinate_y']*70-70;
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

  
      if ($minx<0) {$minx=0;}
      if ($miny<0) {$miny=0;}
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
