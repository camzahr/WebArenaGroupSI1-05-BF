<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $this->layout='unlogged';
    echo $this->Session->flash();
    echo $this->Form->create("User");
    echo $this->Form->input("email" , array("label"=> "E-Mail utilisé lors de l'inscription"));
    echo $this->Form->end("Envoyer");

?>
