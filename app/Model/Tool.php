<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


App::uses('AppModel', 'Model');

class Tool extends AppModel {
    
    function add($data) {
    
    $newData = array(
        'coordinate_x'      => rand(1,15),
        'coordinate_y'      => rand(1,10),
        'type'              => $data['type'],
        'bonus'             => $data['bonus']
        
    );
    $this->create();
    $this->save($newData);
    }
    
    function ramasseTool($toolId, $fighterId){
        
        $datas = $this->read(null, $toolId);
        
        $newData = array(
        'fighter_id'            => $fighterId,
        'coordinate_x'          => "",
        'coordinate_y'          => ""
        
    );
    $this->save($newData);
    
    }
    
    function drop($toolId, $x, $y){
        $datas = $this->read(null, $toolId);
        
        $newData = array(
        'fighter_id'            => "",
        'coordinate_x'          => $x,
        'coordinate_y'          => $y
        
    );
    $this->save($newData);
    }
    
    function fighterDie($fighterId, $x ,$y){
        
        $tools = $this->find('all',array(
            'conditions'    => array(
                'Tool.fighter_id'   => $fighterId
            )
        ));
        
        foreach ($tools as $tool) {
            $this->drop($tool['Tool']['id'],$x ,$y);
        }
    }
}

