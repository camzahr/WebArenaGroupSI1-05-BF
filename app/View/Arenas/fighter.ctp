<?php $this->assign('title', 'Fighter');



echo $this->Form->create('Fighternewlevel');
echo $this->Form->input('skill',array('options' => array('sight'=>'sight','strength'=>'strength','life'=>'life'), 'default' => 'strength'));
echo $this->Form->end('Valid');


?>
