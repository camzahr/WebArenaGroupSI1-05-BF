
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<p>
    Bonjour <?php echo $username;?>
 
 </p>
 
 <p>You asked for a new password, click on the below link:</p>
 <p>
     <?php echo $this->Html->link('New password', $this->Html->url($link, true))?>
 </p>