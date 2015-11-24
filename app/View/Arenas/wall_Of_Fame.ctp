<?php $this->assign('title', 'wallOfFame');
    ?>
<?php 
//IF User Connected
if(empty($isConnected))
{
    $this->layout = 'unlogged';
      
}

?>
<!--CODE HTML    -->
