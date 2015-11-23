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
     
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar">
      <ul class="nav navbar-nav">
                       <li> <?php echo $this->Html->link('Home', array('controller' => 'Arenas', 'action' => 'index')); ?></li>
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
        <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
   width="600px" height="100px" viewBox="0 0 600 100">
<style type="text/css">

<![CDATA[

  text {
    filter: url(#filter);
    fill: white;
      font-family: 'Voltaire', sans-serif;
      font-size: 100px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
        }
]]>
</style>
  <defs>

    <filter id="filter">
        <feFlood flood-color="black" result="black" />
        <feFlood flood-color="red" result="flood1" />
        <feFlood flood-color="limegreen" result="flood2" />
      <feOffset in="SourceGraphic" dx="3" dy="0" result="off1a"/>
      <feOffset in="SourceGraphic" dx="2" dy="0" result="off1b"/>
      <feOffset in="SourceGraphic" dx="-3" dy="0" result="off2a"/>
      <feOffset in="SourceGraphic" dx="-2" dy="0" result="off2b"/>
        <feComposite in="flood1" in2="off1a" operator="in"  result="comp1" />
        <feComposite in="flood2" in2="off2a" operator="in" result="comp2" />

        <feMerge x="0" width="100%" result="merge1">
        <feMergeNode in = "comp1" />
        <feMergeNode in = "off1b" />

        <animate 
          attributeName="y" 
            id = "y"
            dur ="4s"
            
            values = '104px; 104px; 30px; 105px; 30px; 2px; 2px; 50px; 40px; 105px; 105px; 20px; 6ßpx; 40px; 104px; 40px; 70px; 10px; 30px; 104px; 102px'

            keyTimes = '0; 0.362; 0.368; 0.421; 0.440; 0.477; 0.518; 0.564; 0.593; 0.613; 0.644; 0.693; 0.721; 0.736; 0.772; 0.818; 0.844; 0.894; 0.925; 0.939; 1'

            repeatCount = "indefinite" />
 
        <animate attributeName="height" 
            id = "h" 
            dur ="4s"
            
            values = '10px; 0px; 10px; 30px; 50px; 0px; 10px; 0px; 0px; 0px; 10px; 50px; 40px; 0px; 0px; 0px; 40px; 30px; 10px; 0px; 50px'

            keyTimes = '0; 0.362; 0.368; 0.421; 0.440; 0.477; 0.518; 0.564; 0.593; 0.613; 0.644; 0.693; 0.721; 0.736; 0.772; 0.818; 0.844; 0.894; 0.925; 0.939; 1'

            repeatCount = "indefinite" />
        </feMerge>
      

      <feMerge x="0" width="100%" y="60px" height="65px" result="merge2">
        <feMergeNode in = "black" />
        <feMergeNode in = "comp2" />
        <feMergeNode in = "off2b" />

        <animate attributeName="y" 
            id = "y"
            dur ="4s"
            values = '103px; 104px; 69px; 53px; 42px; 104px; 78px; 89px; 96px; 100px; 67px; 50px; 96px; 66px; 88px; 42px; 13px; 100px; 100px; 104px;' 

            keyTimes = '0; 0.055; 0.100; 0.125; 0.159; 0.182; 0.202; 0.236; 0.268; 0.326; 0.357; 0.400; 0.408; 0.461; 0.493; 0.513; 0.548; 0.577; 0.613; 1'

            repeatCount = "indefinite" />
 
        <animate attributeName="height" 
            id = "h"
            dur = "4s"
          
          values = '0px; 0px; 0px; 16px; 16px; 12px; 12px; 0px; 0px; 5px; 10px; 22px; 33px; 11px; 0px; 0px; 10px'

            keyTimes = '0; 0.055; 0.100; 0.125; 0.159; 0.182; 0.202; 0.236; 0.268; 0.326; 0.357; 0.400; 0.408; 0.461; 0.493; 0.513;  1'
             
            repeatCount = "indefinite" />
        </feMerge>
      
      <feMerge>
        <feMergeNode in="SourceGraphic" />  

        <feMergeNode in="merge1" /> 
      <feMergeNode in="merge2" />

        </feMerge>
      </filter>

  </defs>

<g>
  <text x="0" y="100">ECE WebArena</text>
</g>
</svg>
        <p class="lead" style="margin-left: 70px; margin-top:10px;">The Ultimate Information System Student Simulation</p>
      </div>
      <div class="col-md-2">
        <p class="lead" style="text-align: right;"><?php 
        echo $this->Html->image('avatars/'.$fighterId.'.jpg', array(
    'alt' => 'ProfilePicture',
    'style' => 'height: 80px;'));?></p>
      </div>
			 <div class="col-md-3">
				 <span style=" font-family:'Voltaire',Arial,sans-serif; color: white; font-size: 1.5em;"><?php echo $email ?></span>
<div class="popover-markup"> 
    <a href="#" data-placement="bottom" class="trigger btn btn-default"><i class="fa fa-cogs fa-lg"></i> Settings</a>  

<?php echo $this->Html->link('Logout', array('controller'=> 'Users', 'action'=> 'logout'),array(
    'class' => 'btn btn-primary',
    'role' => 'button'));?>


    <div class="head hide">Settings</div>
    <div class="content hide">
       <?php 

 echo $this->Form->create('Fightercreate');
    echo "New caracter: <br/>".$this->Form->input('name');
    echo $this->Form->end('Create');
    
    echo $this->Form->create('Fighternewavatar', array('type' => 'file'));
    echo $this->Form->input('avatar_file',array('label' => 'Votre avatar (Jpg)', 'type' => 'file'));
    echo $this->Form->end('Send');
    
  
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
        <p>Built with <i class="fa fa-heart"></i> at <a href="http://ece.fr">ECE Paris</a> School of engineering</p>
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


var $select = $('#FightermoveDirection');
$('a[href="#m"]').click(function () {
    $select.val( $(this).data('select') );
    $( "#FightermoveIndexForm" ).submit();
});

var $select2 = $('#FighterattackDirection');
$('a[href="#a"]').click(function () {
    $select2.val( $(this).data('select') );
    $( "#FighterattackIndexForm" ).submit();
});

var $select3 = $('#ToolpickupToolChoice');
$('a[href="#t"]').click(function () {
    $select3.val( $(this).data('select') );
    $( "#ToolpickupIndexForm" ).submit();
});

$(document).keydown(function(e) {
    switch(e.which) {
        case 37: // left
        var $select = $('#FightermoveDirection');
         $select.val("west");
         $( "#FighterattackIndexForm" ).submit();
        break;

        case 38: // up
        var $select = $('#FightermoveDirection');
         $select.val("north");
         $( "#FighterattackIndexForm" ).submit();
        break;
        var $select = $('#FightermoveDirection');
         $select.val("east");
         $( "#FighterattackIndexForm" ).submit();
        case 39: // right
        break;

        case 40: // down
        var $select = $('#FightermoveDirection');
         $select.val("south");
         $( "#FighterattackIndexForm" ).submit();
        break;

        default: return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
});
</script>
	
	</body>
</html>