<?php 


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $this->layout = 'unlogged';
    echo $this->Html->link('Subscribe', array('controller' => 'users', 'action' => 'subscribe'));
    echo $this->Form->create("User");
    echo $this->Form->input("email" , array("label"=> "E-Mail"));
    echo $this->Form->input("password");
    echo $this->html->link('Mot de passe oublié ?', array('controller'=> 'users', 'action'=> 'password'));
    echo $this->Form->end("Login");
    

?> 
<!--<header >
    <form action="login.php" method='post' class="form-signin">
            <h2 class="form-signin-heading">Login</h2>
            <label for="inputEmail" class="sr-only">Username</label>
            <input type="email" id="username" class="form-control" placeholder="Username" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="password" class="form-control" placeholder="Password" required>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</header>-->

