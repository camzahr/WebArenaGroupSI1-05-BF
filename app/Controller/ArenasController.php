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
    }
    
    /**
     * index method : sight
     *
     * @return void
     */
    public function sight()
    {
        if ($this->request->is('post'))       
{            pr($this->request->data);        }
        $this->set('raw',$this->Fighter->findById(1));
        
        $this->Fighter->doMove(1, $this->request->data['Fightermove']['direction']);
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
