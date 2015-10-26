<!-- HEADER -->
<header>
      <h1><strong>Hello.</strong> Welcome to WebArena.</h1>
</header>
  
    <nav>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#infos">Personal Informations</a></li>
          <li><a href="#work">Work</a></li>
          <li><a href="#education">Education</a></li>
          <li><a href="#skills">Skills</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="images/CV.pdf">CV</a></li>  
          <li><a href="images/Lettre.pdf">Lettre de recommandation</a></li>       
        </ul>
    </nav>

    <nav class="floatable">
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#infos">Personal Informations</a></li>
          <li><a href="#work">Work</a></li>
          <li><a href="#education">Education</a></li>
          <li><a href="#skills">Skills</a></li>
          <li><a href="#contact">Contact</a></li>    
        </ul>
    </nav>
        
<?php

pr($raw); 

echo $this->Form->create('Fightermove');
echo $this->Form->input('direction',array('options' => array('north'=>'north','east'=>'east','south'=>'south','west'=>'west'), 'default' => 'east'));
echo $this->Form->end('Move');

echo $this->Form->create('Fighterattack');
echo $this->Form->input('direction',array('options' => array('north'=>'north','east'=>'east','south'=>'south','west'=>'west'), 'default' => 'east'));
echo $this->Form->end('Attack');


?>