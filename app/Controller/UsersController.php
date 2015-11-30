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
    public $uses = array('User','Fighter');
    
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
        $data = $this->request->data;
        if(!empty($data)){
            if($this->Auth->login())
                {
                    return $this->redirect('/Arenas');  
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
        return $this->redirect('/Arenas');    
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
            $data = $this->request->data('Playersubscribe');
            if(!empty($data))
            {
                $this->User->create();

                $datas = array(
                    'email'     => $this->request->data['Playersubscribe']['email'],
                    'password'  => $this->Auth->password($this->request->data['Playersubscribe']['password'])
                );

                if($this->User->save($datas))
                {
                    return $this->redirect('/Users/login'); 
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
        $fightersAll = $this->Fighter->find('all');
        $this->set('rawAll',$fightersAll);
        
        $playerIdActual = $this->Session->read('Auth.User.id');
        $this->set('raw',$this->User->findById($playerIdActual));
        $this->set('playerId',$playerIdActual);
        
        $playerActual = $this->User->findById($playerIdActual);
        $this->set('email', $playerActual['User']['email']);
        
        $fighterIdActual = $this->Session->read('Fighter.id');
        $this->set('fighterId',$fighterIdActual);
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fightercreate'))
        {
            $this->Fighter->generate($playerIdActual,$this->request->data['Fightercreate']['name']);
        }
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fighterchoice'))
        {
            $this->Session->write('Fighter.id',$this->request->data['Fighterchoice']['fighter']);
            $fighterIdActual = $this->Session->read('Fighter.id');
        }
        
        //Si on demande un nouvel avatar
        if($this->request->data('Fighternewavatar'))
        {
            /*debug($this->request->data['Playernewavatar']);
            $this->request->data->Player->id = '0c3ebe52-8024-11e5-96f5-5dcadefa4980';
            if(!$this->Player->save($this->request->data))
                {
                debug($this->Player->invalidFields()); die();
                }*/
            $this->Fighter->newAvatar($fighterIdActual, $this->request->data['Fighternewavatar']);
            
        }
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Changepassword'))
        {
            //$oldPassword = $this->request->data['Fighternewavatar']['passwordOld'];
            $newPassword = $this->request->data['Changepassword']['passwordNew'];
            
            $data = array(
                    'password'  => $this->Auth->password($newPassword)
                );
            
            //die($newPassword . " / " .$this->Auth->password($newPassword));

            $this->User->changePassword($this->Session->read('Auth.User.id'), $data);
            
        }
    }
    
    function newPassword() {

            $chrs = 8;
            $chaine = ""; 
            $list = "0123456789azertyuiopqsdfghjklmwxcvbnABCDEFGHIJKLMNOPQRSTUVWXYZ*-+/";

            mt_srand((double)microtime()*1000000);

            $newstring="";

            while( strlen( $newstring )< $chrs ) {
                    $newstring .= $list[mt_rand(0, strlen($list)-1)];
            }
        return $newstring;
    }
    
    function password(){
        
        App::uses('CakeEmail', 'Network/Email');
        if($this->request->is('post'))
        {          
            $u= current($this->request->data);
            $user=$this->User->find('first', array(
                'conditions'=> array('email'=>$u['email'])
            ));
            $password = $this->newPassword();
            
            $data = array(
                    'password'  => $this->Auth->password($password)
                );
            
            $this->User->changePassword($user['User']['id'], $data);
            
            $this->set('passwordN',$password);
            //$link = array('controller'=>'users', 'action'=>'password', 'token'=>$user['User']['id'].'-'.md5($user['User']['password']));
            $email = New CakeEmail('default');
            $email->to($user['User']['email']);
            $email->emailFormat('html');
            $email->template('mdp');
            $email->subject('Modification of your password');    
            $email->viewVars(array('email'=>$user['User']['email'], 'password'=>$password));
            $email->send();
        }
        
        else {
            
        }
    }
    
    
    
    
}
