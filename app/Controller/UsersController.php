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
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('subscribe','password', 'login');

         
    }
    
        /**
     * index method : login
     *
     * @return void
     */
    
    public function login()
    {
        //$this->loadModel('Player');
        
        if(!empty($this->request->data)){
            if($this->Auth->login())
                {
                    return $this->redirect('/Arenas/Index');  
                }
            Else
                {
                    $this->Flash->set('Email ou Password invalide');
                }
        }
    }
    
    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect('/Arenas/Index');    
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
            if(!empty($this->request->data('Playersubscribe')))
            {
                $this->User->create();

                $datas = array(
                    'email'     => $this->request->data['Playersubscribe']['email'],
                    'password'  => $this->Auth->password($this->request->data['Playersubscribe']['password'])
                );

                if($this->User->save($datas))
                {
                    
                }
                Else
                {
                    $this->Flash->set('Email ou Password invalide');
                }

            }
            //$this->User->subscribe($this->request->data['Playersubscribe']);
        } 
        
    }
    
    /**
     * display method : first page
     *
     * @return void
     */
    public function display()
    {
        $playerIdActual = $this->Session->read('Auth.User.id');
        $this->set('raw',$this->User->findById($playerIdActual));
        $this->set('playerId',$playerIdActual);
    }
    
    function password(){
        if($this->request->is('post'))
        {
            $u= current($this->request->data);
            $user=$this->User->find('first', array(
                'conditions'=> array('email'=>$u['email'])
            ));
            
        }
        if (empty($user))
            $this->Session->setFlash("Aucun utilisateur ne possède ce mail");
        else {
            App::uses('CakeEmail', 'Network/Email');
            
            $link = array('controller'=>'users', 'action'=>'password', 'token'=>$user['User']['id'].'-'.md5($user['User']['password']));
            $email = New CakeEmail('default');
            $email->to($user['User']['email']);
            $email->emailFormat('html');
            $email->template('mdp');
            $email->subject('Modification of your password');    
            $email->viewVars(array('username'=>$user['User']['username'], 'link'=>$link));
            $email->send();
        }
    }
}
