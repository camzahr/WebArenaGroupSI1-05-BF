<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	<?php echo $this->Html->charset(); ?>
	<?php echo $this->Html->charset(); ?>
  <title>
    <?php echo $cakeDescription ?>:
    <?php echo $this->fetch('Project Web Arena'); ?>
  </title>
  <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('styles');
    echo $this->Html->css('boostrap.min');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
		<meta name="generator" content="Bootply" />
	
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	
	</head>
	<body>

<div class="navbar navbar-fixed-top alt" data-spy="affix" data-offset-top="1000">
  <div class="container">
    <div class="navbar-header">
      <a href="#" class="navbar-brand">Home</a>
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar">
      <ul class="nav navbar-nav">
                       <li> <?php echo $this->Html->link('Index', array('controller' => 'Arenas', 'action' => 'index')); ?></li>
                       <li> <?php echo $this->Html->link('Fighter', array('controller' => 'Arenas', 'action' => 'fighter')); ?></li>
                       <li> <?php echo $this->Html->link('Sight', array('controller' => 'Arenas', 'action' => 'sight')); ?></li>
                       <li> <?php echo $this->Html->link('Diary', array('controller' => 'Arenas', 'action' => 'diary')); ?></li>
                       <li> <?php echo $this->Html->link('My Profile', array('controller' => 'Users', 'action' => 'display')); ?></li>
                       <li><?php echo $this->Html->link('My Messages', array('controller' => 'Arenas', 'action' => 'message')); ?></li>
                       <li><?php echo $this->Html->link('My Guild', array('controller' => 'Arenas', 'action' => 'guild')); ?></li>
      </ul>
    </div>
   </div>
</div>

<div class="header alt vert" >
   <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 style="font-family:'Voltaire',Arial,sans-serif;">ECE WebArena</h1>
        <p class="lead">The Ultimate Information System Student Simulation</p>
      </div>
      <div class="col-md-2">
        <p class="lead" style="text-align: right;"><?php 
        echo $this->Html->image('avatars/'.$raw['User']['id'].'.jpg', array(
    'alt' => 'ProfilePicture',
    'style' => 'height: 80px;'));?></p>
      </div>
			 <div class="col-md-3">
				 <span style=" font-family:'Voltaire',Arial,sans-serif; color: white; font-size: 1.5em;"><?php echo $raw['User']['email'] ?></span>
<div class="popover-markup"> 
    <a href="#" data-placement="bottom" class="trigger btn btn-default"><i class="fa fa-cogs fa-lg"></i> Edit Profile</a>  

<?php echo $this->Html->link('Logout', array('controller'=> 'Users', 'action'=> 'logout'),array(
    'class' => 'trigger btn btn-primary',
    'role' => 'button'));?>


    <div class="head hide">Lorem Ipsum</div>
    <div class="content hide">
       <?php 

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
    </div>
</div>
    
<br>


				  
				 
      </div>
    </div>
  </div>
</div>



<div id="sec1" class="blurb">
 
  <div class="container">

    <div class="row">

     <!--  <?php
				
				// echo "Joueurs Actuellement dans l'Arène : ";
    //     foreach ($players as $player) 
    //     {
    //         echo "</br>".$player['Fighter']['name'];
    //     }
        ?> -->
				 
 <?php echo $this->Flash->render(); ?>

                  <?php echo $this->fetch('content'); ?>

     
    </div>
  </div>
</div>


<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <ul class="list-inline">
          <li><i class="icon-facebook icon-2x"></i></li>
          <li><i class="icon-twitter icon-2x"></i></li>
          <li><i class="icon-google-plus icon-2x"></i></li>
          <li><i class="icon-pinterest icon-2x"></i></li>
        </ul>
        <hr>
        <p>Built with <i class="icon-heart-empty"></i> at <a href="http://www.bootply.com">Bootply</a>.<br>Company ©2014</p>
      </div>
    </div>
  </div>
</footer>

<ul class="nav pull-right scroll-down">
  <li><a href="#" title="Scroll down"><i class="icon-chevron-down icon-3x"></i></a></li>
</ul>
<ul class="nav pull-right scroll-top">
  <li><a href="#" title="Scroll to top"><i class="icon-chevron-up icon-3x"></i></a></li>
</ul>

	<!-- script references -->

		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" ></script>

    <?php  echo $this->Html->script('scripts'); ?>
    
<script>
$('.popover-markup>.trigger').popover({
    html: true,
    title: function () {
        return $(this).parent().find('.head').html();
    },
    content: function () {
        return $(this).parent().find('.content').html();
    }
});
</script>
	
	</body>
</html>