<?php

App::uses('AppModel', 'Model');

class Player extends AppModel {
    
    public $hasMany = array(

        'Fighter' => array(

            'className' => 'Fighter',


        ),

   );
/*
    public $validate = array(
        'avatar_file' => array(
            'rule' => array('fileExtension', array('jpg','jpeg','png')),
            'message' => 'Vous ne pouvez envoyer que des jpg ou des png'
        )
    );
    
    public function fileExtension($check,$extensions)
    {
        $file = current($check);
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        return in_array($extension, $extensions);        
    }
    
    public function beforeDelete($cascade = true)
    {
        $oldextension = $this->field('avatar');
        $oldfile = IMAGES . 'avatars' . DS . $this->id . '.' . $oldextension;
        if(file_exists($oldfile))
        {
            unlink($oldfile);
        }
    }
    
    public function afterSave($created,$options = array())
    {
        debug($this->data); 
        if(isset($this->data[$this->alias]['avatar_file']))
        {
            $file = $this->data[$this->alias]['avatar_file'];
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
               
            if(!empty($file['tmp_name']))
            {
                $oldextension = $this->field('avatar');
                $oldfile = IMAGES . 'avatars' . DS . $this->id . '.' . $oldextension;
                if(file_exists($oldfile))
                {
                    unlink($oldfile);
                }
                move_uploaded_file(
                        $file['tmp_name'], 
                        IMAGES.'avatars'.DS.$this->id.'.'.$extension);
                $this->saveField('avatar',$extension);
                   
            }
        }
        
    }*/

    public function newAvatar($playerId, $data) {
       $datas = $this->read(null, $playerId);
        if(!empty($data['avatar_file']['tmp_name']))
            {
                debug("ACCEPTE");
                $extension = strtolower(pathinfo($data['avatar_file']['name'], PATHINFO_EXTENSION));
                if(in_array($extension, array('jpg','jpeg','png')))
                {
                    move_uploaded_file($data['avatar_file']['tmp_name'], IMAGES.'avatars'.DS.$playerId.'.'.$extension);
                   
                    $this->savefield('avatar',$extension);
                }
            }
        else debug('NEIN');
    }
    
    public function subscribe($data) {
        if(!empty($data))
        {
            $newData = array(
            'email'              => $data['email'],
            'password'         => $data['password']
        );
        $this->create();
        $this->save($newData);
        }
    }
    
    
}
?>