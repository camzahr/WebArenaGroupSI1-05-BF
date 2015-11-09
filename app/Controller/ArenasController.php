<?php 

App::uses('AppController', 'Controller');

/**
 * Main controller of our small application
 *
 * @author ...
 */
class ArenasController extends AppController
{
<<<<<<< HEAD
    
=======
>>>>>>> refs/remotes/origin/master
    public $uses = array('Player', 'Fighter', 'Event');
    /**
     * index method : first page
     *
     * @return void
     */
    public function index()
    {
       if ($this->request->is('post'))       
        {            
           pr($this->request->data);        
        }
        
        $playerActual = $this->Player->findById('0c3ebe52-8024-11e5-96f5-5dcadefa4980');
        $this->set('raw',$playerActual);
        $this->set('email', $playerActual['Player']['email']);
       
        
        //On affiche la liste des nom de joueurs actuellement dans l'arène
        $players = $this->Fighter->find('all');
        echo "Joueurs Actuellement dans l'Arène : ";
        foreach ($players as $player) 
        {
            echo "</br>".$player['Fighter']['name'];
        }
        
        //Si on demande la création d'un nouveau personnage.
       if($this->request->data('Fightercreate'))
        {
            $this->Fighter->generate($playerActual['Player']['id'],$this->request->data['Fightercreate']['name']);
        }
        
        //Si on demande un nouvel avatar
        if($this->request->data('Playernewavatar'))
        {
            /*debug($this->request->data['Playernewavatar']);
            $this->request->data->Player->id = '0c3ebe52-8024-11e5-96f5-5dcadefa4980';
            if(!$this->Player->save($this->request->data))
                {
                debug($this->Player->invalidFields()); die();
                }*/
            $this->Player->newAvatar('0c3ebe52-8024-11e5-96f5-5dcadefa4980', $this->request->data['Playernewavatar']);
            
        }
  
    }
    
    /**
     * index method : login
     *
     * @return void
     */
    public function login()
    {
        
    }
    
    /**
     * index method : fighter
     *
     * @return void
     */
    public function fighter()
    {
<<<<<<< HEAD
        $this->set('raw',$this->Fighter->findById(1));

=======
>>>>>>> refs/remotes/origin/master
        if ($this->request->is('post'))       
        {            
            pr($this->request->data);        
        }
        $this->set('raw',$this->Fighter->findById(1));
        
        
        //Si c'est une action de newLevel
        if($this->request->data('Fighternewlevel'))
        {
            $this->Fighter->increaseLevel(1, $this->request->data['Fighternewlevel']['skill']);
        } 
         
    }
    
    /**
     * index method : sight
     *
     * @return void
     */
    public function sight()
    {
        if ($this->request->is('post'))       
        {            
            pr($this->request->data);  
            $this->Session->setFlash('Une action a été réalisée.');

        }
        $this->set('raw',$this->Fighter->findById(1));
        
        //Si c'est une action de mouvement
        if($this->request->data('Fightermove'))
        {
        $this->Fighter->doMove(1, $this->request->data['Fightermove']['direction']);
        $this->Session->setFlash('Une action a été réalisée.');

        }
        //Si c'est une action d'attaque
        Elseif($this->request->data('Fighterattack'))
        {
            $this->Fighter->doAttack(1, $this->request->data['Fighterattack']['direction']);
            $this->Session->setFlash('Une action a été réalisée.');

        }


    }
    
    /**
     * index method : diary
     *
     * @return void
     */
    public function diary()
    {
        $this->set('raw',$this->Event->find('all'));
    }

}
?>
