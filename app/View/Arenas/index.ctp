<?php $this->assign('title', 'Acceuil');?>
Bienvenue <?php echo $myname;?> dans WebArena

<?php
    echo $this->Form->create('Fightercreate');
    echo $this->Form->input('name');
    echo $this->Form->end('Create');
    
    
    
?>