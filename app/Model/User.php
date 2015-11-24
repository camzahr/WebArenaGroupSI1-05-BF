<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

class User extends AppModel {
    
    public $useTable="players";
    
    public $hasMany = array(

        'Fighter' => array(

            'className' => 'Fighter',


        ),

   );
    
     public $validate = array(
        'email' => array(
            array(
                'rule' => 'isUnique',
                'message' => 'Mail déjà existant',

            ),

            array(
                'rule' => 'email',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Mail non valide',

            )
        ),
        
        'password' => array(
            'rule' => 'notEmpty',
            'message' => 'Vous devez entre un mot de passe',
            'allowEmpty' => false
        )
    );
     
   /* public function newAvatar($playerId, $data) {
        $datas = $this->read(null, $playerId);

        if(!empty($data['avatar_file']['tmp_name']))
            {
                debug("ACCEPTE");
                $extension = strtolower(pathinfo($data['avatar_file']['name'], PATHINFO_EXTENSION));
                if(in_array($extension, array('jpg','jpeg','png')))
                {
                    move_uploaded_file($data['avatar_file']['tmp_name'], IMAGES.'avatars'.DS.$playerId.'.'.$extension);
                   
                }
            }
        else debug('NEIN');
    }*/
    public function changePassword($playerId, $data) {
        $datas = $this->read(null, $playerId);
        
        $newData = array(
            'password'             => $data['password']);
        
        $this->save($newData);
    }
    
}

?>