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
    
    var $playerIdActual;
    var $fighterIdActual;
    
    /**
     * index method : first page
     *
     * @return void
     */
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
        
        $fightersActual = $this->Fighter->find('all',array(
                'conditions' => array(
                    'Fighter.player_id' => $playerIdActual
                )
            ));
        $fightersUser = array();

        foreach($fightersActual as $fighter){
            debug($fighter);
            $fightersUser[$fighter['Fighter']['id']] = $fighter['Fighter']['name'];
            /*if (!$fighterIdActual) {
                $fighterIdActual = $fighter['Fighter']['id'];
            }*/
        }
        
        $this->set('fighterList',$fightersUser);
        
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
        $fighterIdActual = $this->Session->read('Fighter.id');
        
        if ($this->request->is('post'))       
        {            
            pr($this->request->data);        
        }
        
        $this->set('raw',$this->Fighter->find('all' , array('conditions'=> array(
                                                        'Fighter.id' => $fighterIdActual
                                                            )
                                            )
                             ));
        
        
        //Si c'est une action de mouvement
        
        //Si c'est une action de newLevel
        if($this->request->data('Fighternewlevel'))
        {
            if($this->Fighter->increaseLevel($fighterIdActual, $this->request->data['Fighternewlevel']['skill']))
            {
                
            }
            Else
            {
                $this->Flash->set("Pas de points à utiliser !!");
            }
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
            

        }
        $playerIdActual = $this->Session->read('Auth.User.id');
        $fighterIdActual = $this->Session->read('Fighter.id');
        $this->set('raw',$this->Fighter->find('all' , array('conditions'=> array(
                                                        'Fighter.id' => $fighterIdActual
                                                            )
                                            )
                             ));
        
        //Si c'est une action de mouvement
        if($this->request->data('Fightermove'))
        {
            $this->Fighter->doMove($fighterIdActual, $this->request->data['Fightermove']['direction']);
        }
        
        //Si c'est une action d'attaque
        Elseif($this->request->data('Fighterattack'))
        {
            if ($this->Fighter->doAttack($fighterIdActual, $this->request->data['Fighterattack']['direction']))
            {
                
            }
            Else
            {
                $this->Flash->set("Attaque Ratée !!");
            }

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
        $fighterIdActual = $this->Session->read('Fighter.id');
        $this->set('raw',$this->Event->find('all'));
    }

}
?>
