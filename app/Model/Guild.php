    <?php

App::uses('AppModel', 'Model');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Guild extends AppModel {
    
    public function add($data) {
        debug($data);
        if(!empty($data))
        {
            $newData = array(
            'name'             => $data['name']
                         
        );
        $this->create();
        $this->save($newData);
        }
    }
    
    public function join($guildId, $fighterId) {
        //récupérer la position et fixer l'id de travail
        $datas = $this->read(null, $guildId);
        
        $newData = array(
            'name'             => $data['name']);
    }
    
    
    
    
    
}


