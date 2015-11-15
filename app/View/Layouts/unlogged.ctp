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
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('Project Web Arena'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('boostrap');
		echo $this->Html->css('boostra.responsive');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Bienvenue dans WebArena !</h1>
                        <?php //echo $this->Html->link('Index', array('controller' => 'Arenas', 'action' => 'index')); ?>
                        <?php //echo $this->Html->link('Fighter', array('controller' => 'Arenas', 'action' => 'fighter')); ?>
                        <?php //echo $this->Html->link('Sight', array('controller' => 'Arenas', 'action' => 'sight')); ?>
                        <?php //echo $this->Html->link('Diary', array('controller' => 'Arenas', 'action' => 'diary')); ?>
                        <?php //echo $this->Html->link('My Profil', array('controller' => 'Users', 'action' => 'display')); ?>
                        <?php // if ($this->$long==false)
                                //echo $this->Html->link('Subscribe', array('controller' => 'Users', 'action' => 'subscribe'));
                              //if ($this->$long==true)
                                //echo $this->Html->link('Login', array('controller' => 'Users', 'action' => 'login'));
                                //echo $this->Html->link('Subscribe', array('controller' => 'Users', 'action' => 'subscribe'));
                                        ?>
                        <?php //echo $this->Html->link('Logout', array('controller'=> 'Users', 'action'=> 'logout'));?>
		</div>
		<div id="content">

			<?php echo $this->Flash->render(); ?>
                	<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; 
                                        echo "Project Web Arena BF by Jeremy CAMILLERI, Jalil BENAYACHI, Aurelien GUERARD, Jean-Baptiste GESNEL"
                                ?>
			</p>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>