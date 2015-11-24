<h3><?php 
     if(!empty($guildName))
    {
        echo " You are at the guild : $guildName <br/><br/>";
    }
    Else echo " You Join no Guild <br/><br/>";
?>
</h3>

<div class="col-md-4">
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
   
    echo " Join a Guild : ";
    echo $this->Form->create('guildJoin');
    echo $this->Form->input('guilds_id',array('options' => $guildsName));
    echo $this->Form->end('Join !');
    
    echo "<br/><br/>";
    ?>
</div>
 <div class="col-md-4">   
     <?php
    echo " Create a Guild : ";
    echo $this->Form->create('guildCreate');
    echo $this->Form->input('name');
    echo $this->Form->end('Create !');
    ?>
    </div>