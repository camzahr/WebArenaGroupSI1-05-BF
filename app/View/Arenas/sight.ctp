<head><?php $this->assign('title', 'Acceuil');?></head>
        
<div class="col-md-4">
<?php
/*
pr($raw);
pr($othersFighters);*/

echo $this->Form->create('Fightermove');
echo $this->Form->input('direction',array('options' => array('north'=>'north','east'=>'east','south'=>'south','west'=>'west'), 'default' => 'east'));
echo $this->Form->end('Move');

echo $this->Form->create('Fighterattack');
echo $this->Form->input('direction',array('options' => array('north'=>'north','east'=>'east','south'=>'south','west'=>'west'), 'default' => 'east'));
echo $this->Form->end('Attack');


?>

</div>