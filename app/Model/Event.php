<?php

App::uses('AppModel', 'Model');

class Event extends AppModel {
    
    public function add($data) {
        if(!empty($data))
        {
            $newData = array(
            'name'              => $data['name'],
            'date'              => date("Y-m-d H:i:s"),
            'coordinate_x'      => $data['coordinate_x'],
            'coordinate_y'      => $data['coordinate_y']
                    
        );
        $this->create();
        $this->save($newData);
        }
    }
    
}