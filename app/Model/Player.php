<?php

App::uses('AppModel', 'Model');

class Player extends AppModel {

    public $displayField = 'name';

    public function newAvatar($playerId, $data) {
       $datas = $this->read(null, $playerId);
        if(!empty($data['avatar_file']['tmp_name']))
            {
                debug("ACCEPTE");
                $extension = strtolower(pathinfo($data['avatar_file']['name'], PATHINFO_EXTENSION));
                if(in_array($extension, array('jpg','jpeg','png')))
                {
                    move_uploaded_file($data['avatar_file']['tmp_name'], IMAGES.'avatars'.DS.'premierAvatar'.'.'.$extension);
                   
                    $this->savefield('avatar','premierAvatar');
                }
            }
        else debug('NEIN');
    }
    
    
}
?>
    
    