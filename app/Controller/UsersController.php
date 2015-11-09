<?php 

App::uses('AppController', 'Controller');

/**
 * Main controller of our small application
 *
 * @author ...
 */
class UsersController extends AppController
{
    //public $uses = array('Player');

//    public function beforeFilter() {
//    $this->Auth->authenticate = array(
//        'Form' => array(
//            'userModel' => 'Player',
//        )
//    );
//
//    return parent::beforeFilter();      
//}
    
        /**
     * index method : login
     *
     * @return void
     */
    
    public function login()
    {
        //$this->loadModel('Player');
        
        // A UTILISER POUR CREER UN COMPTE USER
//        $this->User->save(array(
//            'email'=> 'admin@admin.fr',
//            'password'=>$this->Auth->password('admin')
//        ));
        debug($this->Session->read());
        if(!empty($this->request->data)){
            if($this->Auth->login())
                return $this->redirect('/Arenas');    
        }
    }
    
    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect('/');    
    }
    
    
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
