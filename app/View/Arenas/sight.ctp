<!-- HEADER -->
<header>
      <h1><strong>Hello.</strong> Welcome to WebArena.</h1>
</header>
        
<?php

pr($raw); 

echo $this->Form->create('Fightermove');
echo $this->Form->input('direction',array('options' => array('north'=>'north','east'=>'east','south'=>'south','west'=>'west'), 'default' => 'east'));
echo $this->Form->end('Move');

echo $this->Form->create('Fighterattack');
echo $this->Form->input('direction',array('options' => array('north'=>'north','east'=>'east','south'=>'south','west'=>'west'), 'default' => 'east'));
echo $this->Form->end('Attack');


?>