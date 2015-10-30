<?php 

App::uses('AppController', 'Controller');

/**
 * Main controller of our small application
 *
 * @author ...
 */
class ArenasController extends AppController
{
    
    public $uses = array('Player', 'Fighter', 'Event');

    /**
     * index method : first page
     *
     * @return void
     */
    public function index()
    {
       $this->set('myname', "Jérémy Camilleri");
       if ($this->request->is('post'))       
        {            
           pr($this->request->data);        
        }
        
        //On affiche la liste des nom de joueurs actuellement dans l'arène
        $players = $this->Fighter->find('all');
        echo "Joueurs Actuellement dans l'Arène : ";
        foreach ($players as $player) {
            echo "</br>".$player['Fighter']['name'];
        }
        
        //Si on demande la création d'un nouveau personnage.
       if($this->request->data('Fightercreate'))
        {
            $this->Fighter->generate($this->request->data['Fightercreate']['name']);
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
        $this->set('raw',$this->Fighter->findById(1));

        if ($this->request->is('post'))       
        {            
            pr($this->request->data);        
        }
        $this->set('raw',$this->Fighter->findById(1));
        
        //Si c'est une action de mouvement
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
        }
        $this->set('raw',$this->Fighter->findById(1));
        
        //Si c'est une action de mouvement
        if($this->request->data('Fightermove'))
        {
        $this->Fighter->doMove(1, $this->request->data['Fightermove']['direction']);
        }
        //Si c'est une action d'attaque
        Elseif($this->request->data('Fighterattack'))
        {
            $this->Fighter->doAttack(1, $this->request->data['Fighterattack']['direction']);
        }

    }
    
    /**
     * index method : diary
     *
     * @return void
     */
    public function diary()
    {
        $this->set('raw',$this->Event->find());
    }

}
?>
