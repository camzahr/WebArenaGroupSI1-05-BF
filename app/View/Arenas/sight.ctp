<head><?php $this->assign('title', 'Acceuil');?></head>

<!-- HEADER -->
<header>
    
      <h1><strong>Hello.</strong> Welcome to WebArena.</h1>
      <?php echo $this->Html->link('Vision', array('controller' => 'Arenas', 'action' => 'sight')),"  ",
      $this->Html->link('Home', array('controller' => 'Arenas', 'action' => '/')),"  ",
       $this->Html->link('Fighter', array('controller' => 'Arenas', 'action' => 'fighter')),"  ",
       $this->Html->link('Diary', array('controller' => 'Arenas', 'action' => 'diary'));
      ?>
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