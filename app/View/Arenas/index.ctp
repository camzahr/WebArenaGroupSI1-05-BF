<<<<<<< HEAD
<?php $this->assign('title', 'Acceuil');?>
Bienvenue <?php echo $myname;?> dans WebArena
=======
Bienvenu <?php echo $email;?> dans WebArena
>>>>>>> refs/remotes/origin/master

<?php
pr($raw); 
pr($email); 
    echo $this->Form->create('Fightercreate');
    echo $this->Form->input('name');
    echo $this->Form->end('Create');
    
    echo $this->Form->create('Playernewavatar', array('type' => 'file'));
    echo $this->Form->input('avatar_file',array('label' => 'Votre avatar (Jpeg ou PNG)', 'type' => 'file'));
    echo $this->Form->end('Send');
    
    
    
?>