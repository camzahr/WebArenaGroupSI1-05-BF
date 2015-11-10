<?php

App::uses('AppController', 'Controller');



 
class ApisController extends AppController
{
    public $uses = array ('Player','Fighter','Event');


  public function fighterview($id)
 { 
    
      
    $this->layout = 'ajax'; 
    $this->set('datas', $this->Fighter->find('all', array(
        'conditions' => array(
            'Fighter.id' => $id
            )
    )));


 }
  public function playerview($id)
 {
     $this->layout = 'ajax'; 
$this->set('datas', $this->Player->find('all', array(
        'conditions' => array(
            'Player.id' => $id
            )
    ))); 
}
  public function eventview($id)
 {
     $this->layout = 'ajax'; 
     $this->set('datas', $this->Event->find('all', array(
        'conditions' => array(
            'Event.id' => $id
            )
    )));
 
 }
 
 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
}
?>