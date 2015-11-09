<?php 

App::uses('AppController', 'Controller');

/**
 * Main controller of our small application
 *
 * @author ...
 */
class PlayersController extends AppController
{
    public $uses = array('Player');

    /**
     * subscribe method : first page
     *
     * @return void
     */
    public function subscribe()
    {
        if ($this->request->is('post'))       
        {            
            pr($this->request->data);        
        }
        
        //Si c'est une action de subscribe
        if($this->request->data('Playersubscribe'))
        {
            $this->Player->subscribe($this->request->data['Playersubscribe']);
        } 
    }
    
    /**
     * display method : first page
     *
     * @return void
     */
    public function display()
    {
        $this->set('raw',$this->Player->findById('545f827c-576c-4dc5-ab6d-27c33186dc3e'));
        $this->set('playerId','545f827c-576c-4dc5-ab6d-27c33186dc3e');
    }
    
}
