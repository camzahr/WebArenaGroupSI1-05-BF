<?php 

App::uses('AppController', 'Controller');

/**
 * Main controller of our small application
 *
 * @author ...
 */
class ArenasController extends AppController
{
    public $uses = array('User', 'Fighter', 'Event');
    /**
     * index method : first page
     *
     * @return void
     */
    
    var $playerIdActual;
    
    public function index()
    {
       //$this->set('myname', "Jérémy Camilleri");
       if ($this->request->is('post'))       
        {            
           pr($this->request->data);        
        }
        
        $playerIdActual = $this->Session->read('Auth.User.id');
        $playerActual = $this->User->findById($playerIdActual);
   
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
            $this->User->newAvatar($playerIdActual, $this->request->data['Playernewavatar']);
            
        }
        
        
  
    }
    
    /**
     * index method : fighter
     *
     * @return void
     */
    public function fighter()
    {
        $playerIdActual = $this->Session->read('Auth.User.id');
        
        if ($this->request->is('post'))       
        {            
            pr($this->request->data);        
        }
        
        $this->set('raw',$this->Fighter->find('all' , array('conditions'=> array(
                                                        'Fighter.player_id' => $playerIdActual
                                                            )
                                            )
                             ));
        
        
        //Si c'est une action de mouvement
        
        //Si c'est une action de newLevel
        if($this->request->data('Fighternewlevel'))
        {
            $this->Fighter->increaseLevel($playerIdActual, $this->request->data['Fighternewlevel']['skill']);
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
        $playerIdActual = $this->Session->read('Auth.User.id');
        $this->set('raw',$this->Fighter->find('all' , array('conditions'=> array(
                                                        'Fighter.player_id' => $playerIdActual
                                                            )
                                            )
                             ));
        
        //Si c'est une action de mouvement
        if($this->request->data('Fightermove'))
        {
        $this->Fighter->doMove($playerIdActual, $this->request->data['Fightermove']['direction']);
        $this->Session->setFlash('Une action a été réalisée.');

        }
        //Si c'est une action d'attaque
        Elseif($this->request->data('Fighterattack'))
        {
            $this->Fighter->doAttack($playerIdActual, $this->request->data['Fighterattack']['direction']);
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
        $playerIdActual = $this->Session->read('Auth.User.id');
        $this->set('raw',$this->Event->find('all'));
    }

}
?>
