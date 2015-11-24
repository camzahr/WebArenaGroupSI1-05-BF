

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

$cakeDescription = __d('cake_dev', 'MDR');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ECE Web Arena</title>
    
    <link href='//fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
  <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('login');
  ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="login/pwdwidget.js"></script>
    
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    
    
<div class="navbar navbar-fixed-top alt" data-spy="affix" data-offset-top="1000">
  <div class="container">
    
    <div class="navbar-collapse collapse" id="navbar">
      <ul class="nav navbar-nav">
                       <li> <?php echo $this->Html->link('Home', array('controller' => 'Arenas', 'action' => 'home')); ?></li>
                       <li> <?php echo $this->Html->link('Login', array('controller' => 'Users', 'action' => 'login')); ?></li>
                       <li> <?php echo $this->Html->link('Wall of Fame', array('controller' => 'Arenas', 'action' => 'wallOfFame')); ?></li>
                       
      </ul>
    </div>
   </div>
</div>
   
			<?php echo $this->Flash->render(); ?>
                	<?php echo $this->fetch('content'); ?>

    <script type="text/javascript" src="login/script.js"></script>
    <script>
$("#EmailAddress").keyup(function(){
    $("#UserEmail").val(this.value);
});

$("#Pwd").keyup(function(){
    $("#UserPassword").val(this.value);
});


$('#submit_login').click(function () {
  
    $( "#UserLoginForm" ).submit();
});
    </script>
    <?php echo $this->element('sql_dump'); ?>
</body>

</html>
