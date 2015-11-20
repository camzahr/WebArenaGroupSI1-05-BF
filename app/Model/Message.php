    <?php

App::uses('AppModel', 'Model');

class Message extends AppModel {
    public function add($id, $data) {
        if(!empty($data))
        {
            debug($data);
            $newData = array(
            'title'             => $data['title'],
            'date'              => date("Y-m-d H:i:s"),
            'message'           => $data['messageField'],
            'fighter_id_from'   => $id,
            'fighter_id'        => $data['fighter_id']
                    
        );
        $this->create();
        $this->save($newData);
        }
    }
    
    
    
    
    
}
