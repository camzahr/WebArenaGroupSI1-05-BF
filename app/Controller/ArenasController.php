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
     * index method : first page
     *
     * @return void
     */
    public function fighter()
    {
          $this->set('raw',$this->Fighter->findById(1));
    }
    
    /**
     * index method : first page
     *
     * @return void
     */
    public function sight()
    {
        
    }
    
    /**
     * index method : first page
     *
     * @return void
     */
    public function diary()
    {
        $this->set('raw',$this->Event->find());
    }

}
?>
