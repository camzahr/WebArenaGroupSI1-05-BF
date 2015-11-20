<?php

    //$this->start('page');
    echo $this->Html->link('Login', array('controller' => 'Users', 'action' => 'login'));
    //$this->end();
    
    $this->layout = 'unlogged';
    echo $this->Form->create('Playersubscribe');
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->end('Subscribe');

?>
