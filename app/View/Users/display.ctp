<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//PHP HELPER IMAGE 
/*
echo $this->Html->image('avatars/'.$playerId.'.jpg', array(
    'alt' => 'ProfilPicture',
    'style' => 'width: 200px;'));

*/
 /*$raw['User']['email'];

pr($raw); */?>

<div class="col-md-4">
    <h3><?php echo $raw['User']['email']; ?> </h3>
</div>

<div class="col-md-6">
    <?php
            echo $this->Form->create("Changepassword");
            echo $this->Form->input("passwordNew", array("placeholder" => "Password", "label" => "New Password"));
            echo $this->Form->end("Change");
    ?>
</div>