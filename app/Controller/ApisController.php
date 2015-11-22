<?php

App::uses('AppController', 'Controller');



 
class ApisController extends AppController
{
     public $uses = array('User', 'Fighter', 'Event', 'Message', 'Guild');


  public function fighterview($id)
 { 
    
      
    $this->layout = 'ajax'; 
    $this->set('datas', $this->Fighter->find('all', array(
        'conditions' => array(
            'Fighter.id' => $id
            )
    )));


 }
  public function userview($id)
 {
     $this->layout = 'ajax'; 
$this->set('datas', $this->User->find('all', array(
        'conditions' => array(
            'User.id' => $id
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
 
   public function domoveview($id,$direction)
 {
     $this->layout = 'ajax'; 
     $this->Fighter->doMove($id,$direction);
     
    
 }
   public function doattackview($id,$direction)
 {
     $this->layout = 'ajax'; 
     $this->Fighter->doAttack($id,$direction);
     
    
 }

 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
}
?>