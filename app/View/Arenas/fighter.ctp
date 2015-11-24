<?php $this->assign('title', 'Fighter');
?>


<div class="featurette" id="sec2">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Your Characters</h1>
      </div>
    </div>
    <div class="row">

<?php 

	foreach($raw as $fighter)
	{
$pic="./img/avatars/".$fighter['Fighter']['id'].".jpg";
if (!file_exists($pic)) {$pic="./img/empty-profile.jpg";}         
            $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
echo'

      <div class="col-md-2 text-center">
        <div class="featurette-item">
         <img src=".'.$pic.'" class="img-circle" style="height: 150px; width: 150px;"/>
          <h4>'.$fighter['Fighter']['name'].' </h4>
              <p class="legend-fighters">
						<strong>  Level '.$fighter['Fighter']['level'].' </strong><br/>
						 <i class="fa fa-battery-three-quarters fa-lg" style="color: green;"></i> Life '.$fighter['Fighter']['current_health'].' / '.$fighter['Fighter']['skill_health'].'<br/>
						<i class="fa fa-graduation-cap fa-lg"></i> XP '.$fighter['Fighter']['xp'].' / 4<br/>
						<i class="fa fa-paw fa-lg"></i> Strength '.$fighter['Fighter']['skill_strength'].'<br/>
						<i class="fa fa-medkit fa-lg"></i> max HP '.$fighter['Fighter']['skill_health'].'<br/>
						<i class="fa fa-eye fa-lg"></i> Sight: level '.$fighter['Fighter']['skill_sight'].'<br/>
						<i class="fa fa-map-marker fa-lg"></i>'."Position: ".$alpha[$fighter['Fighter']['coordinate_x']-1].$fighter['Fighter']['coordinate_y'];

						if($fighter['Fighter']['id']==$fighterId)
						{

								echo $this->Form->create('Fighternewlevel');
echo $this->Form->input('skill',array('options' => array('sight'=>'sight','strength'=>'strength','life'=>'life'), 'default' => 'strength', 'label'=>'Upgrade skills'));
echo $this->Form->end('Upgrade');

						}


						echo'  

						</p>
				</div>
      </div>';



  }
?>

      <div class="col-md-2 text-center">
      	  <div class="featurette-item">
          <i id="addplayer" class="fa fa-plus" ></i>
          
<h4>Create a fighter</h4>
          <div id="beforeclick">
          <p class="legend-fighters">You can create up to four fighters</p>
      	 </div>

      	 <div id="afterclick" style="display:none;">
      	 		<?php

      	 		echo $this->Form->create('Fightercreate');
    echo $this->Form->input('name');
    echo $this->Form->end('Create');
    ?>
      	 </div>



        </div>
      </div>
    </div>
  </div>
</div>

<script>
$("#addplayer").click(function() {
  $("#afterclick").removeAttr("style");
  $("#beforeclick").attr("style", "display:none;");

});

</script>