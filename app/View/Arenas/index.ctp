<<<<<<< HEAD
Bienvenu <?php echo $myname;?> dans WebArena

<?php
=======
Bienvenu <?php echo $email;?> dans WebArena

<?php
pr($raw); 
pr($email); 
>>>>>>> refs/remotes/origin/master
    echo $this->Form->create('Fightercreate');
    echo $this->Form->input('name');
    echo $this->Form->end('Create');
    
<<<<<<< HEAD
=======
    echo $this->Form->create('Playernewavatar', array('type' => 'file'));
    echo $this->Form->input('avatar_file',array('label' => 'Votre avatar (Jpeg ou PNG)', 'type' => 'file'));
    echo $this->Form->end('Send');
    
>>>>>>> refs/remotes/origin/master
    
    
?>