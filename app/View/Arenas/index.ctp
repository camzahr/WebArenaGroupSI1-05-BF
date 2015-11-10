
Bienvenu <?php echo $email;?> dans WebArena

<?php
    pr($raw); 
    pr($email); 
    echo $this->Form->create('Fightercreate');
    echo $this->Form->input('name');
    echo $this->Form->end('Create');
    
    echo $this->Form->create('Playernewavatar', array('type' => 'file'));
    echo $this->Form->input('avatar_file',array('label' => 'Votre avatar (Jpeg ou PNG)', 'type' => 'file'));
    echo $this->Form->end('Send');
    
    pr($fighterList);
    echo $this->Form->create('Fighterchoice');
    echo $this->Form->input('fighter',array('options' => $fighterList));
    echo $this->Form->end('Valid');
    
?>