<?php 

App::uses('AppController', 'Controller');

/**
 * Main controller of our small application
 *
 * @author ...
 */
class ArenasController extends AppController
{
    public $uses = array('User', 'Fighter', 'Event', 'Message', 'Guild', 'Tool');
    
    var $playerIdActual;

    var $fighterIdActual;

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('home', 'wallOfFame');

         
    }
    
    /**
     * index method : first page
     *
     * @return void
     */
    public function index()
    {
       //$this->set('myname', "Jérémy Camilleri");
        
        $playerIdActual = $this->Session->read('Auth.User.id');
        $playerActual = $this->User->findById($playerIdActual);
        
        $this->set('raw',$playerActual);
        $this->set('email', $playerActual['User']['email']);
       
        
        //On affiche la liste des nom de joueurs actuellement dans l'arène
       
        
        /*foreach ($Events as $event) 
        {
            <td>$event['Event']['name']</td>
        }*/
        
        $fightersActual = $this->Fighter->find('all',array(
                'conditions' => array(
                    'Fighter.player_id' => $playerIdActual
                )
            ));
        
   
        $fightersUser = array();

        foreach($fightersActual as $fighter){
            $fightersUser[$fighter['Fighter']['id']] = $fighter['Fighter']['name'];
            
            
        }
        $this->set('fighterList',$fightersUser);

        $fighterIdActual = $this->Session->read('Fighter.id');
        
        if(empty($fighterIdActual)){
        $fighterIdActual = $fightersActual[0]['Fighter']['id'];
        }
     
        
        $this->set('fighterId',$fighterIdActual);
       
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fightercreate'))
        {
            $message = $this->Fighter->generate($playerIdActual,$this->request->data['Fightercreate']['name']);
            
            $dataTool = array();
            
            $random = rand(1,3);
            
            if($random == 1){
                $dataTool['type'] = 'strength';
            }
            Elseif($random == 2){
                $dataTool['type'] = 'sight';
            }
            Else {
                $dataTool['type'] = 'life';
            }
            
            $dataTool['bonus'] = rand(1,3);
            
            $message = $message . " " . $this->Tool->add($dataTool);
            $this->set('messages',$message);
        }
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fighterchoice'))
        {
            $this->Session->write('Fighter.id',$this->request->data['Fighterchoice']['fighter']);
            $fighterIdActual = $this->Session->read('Fighter.id');
            
           $this->set('messages',"You change your character !");
           echo "<script>window.location = window.location.href;</script>";  
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
            $message = $this->Fighter->newAvatar($fighterIdActual, $this->request->data['Fighternewavatar']);
            $this->set('messages',$message);
        }
       
        

        $currentFighter = $this->Fighter->find('first' , array('conditions'=> array(
                                                        'Fighter.id' => $fighterIdActual
                                                            )
                                            )
                             );
        
        $this->set('myFighter',$currentFighter);
        
        
        
        $this->set('othersFighters',$this->Fighter->find('all' , array('conditions'=> array(
                                                        'Fighter.coordinate_x <=' => $currentFighter['Fighter']['coordinate_x'] + $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.coordinate_x >=' => $currentFighter['Fighter']['coordinate_x'] - $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.coordinate_y <=' => $currentFighter['Fighter']['coordinate_y'] + $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.coordinate_y >=' => $currentFighter['Fighter']['coordinate_y'] - $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.id !='          => $fighterIdActual
                                                            )
                                            )
                             ));

        $this->set('invisibleFighters',$this->Fighter->find('all' , array('conditions'=> array(
                                                        'Fighter.coordinate_x >' => $currentFighter['Fighter']['coordinate_x'] + $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.coordinate_x <' => $currentFighter['Fighter']['coordinate_x'] - $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.coordinate_y >' => $currentFighter['Fighter']['coordinate_y'] + $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.coordinate_y <' => $currentFighter['Fighter']['coordinate_y'] - $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.id !='          => $fighterIdActual
                                                            )
                                            )
                             ));
        
        $toolsCurrent = $this->Tool->find('all', array(
            'conditions'    =>  array(
                'Tool.coordinate_x' => $currentFighter['Fighter']['coordinate_x'],
                'Tool.coordinate_y' => $currentFighter['Fighter']['coordinate_y']
                
            )
        ));
        
        $this->set('tool',$toolsCurrent);
        
        $toolList = array();

        foreach($toolsCurrent as $tool){
            $toolList[$tool['Tool']['id']] = $tool['Tool']['type']." ".$tool['Tool']['bonus'];
        }
        $this->set('toolList',$toolList);
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Toolpickup'))
        {
            $message = $this->Fighter->ramasserWeapon($fighterIdActual, $this->request->data['Toolpickup']['toolChoice']);
            $this->set('messages',$message);
        }
        
            //Si c'est une action de mouvement
        if($this->request->data('Fightermove'))
        {
            $message = $this->Fighter->doMove($fighterIdActual, $this->request->data['Fightermove']['direction']);
            $this->set('messages',$message);

        }
        
        //Si c'est une action d'attaque
        Elseif($this->request->data('Fighterattack'))
        {
            $message = $this->Fighter->doAttack($fighterIdActual, $this->request->data['Fighterattack']['direction']);
            $this->set('messages',$message);
            

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
        $playerActual = $this->User->findById($playerIdActual);
        $this->set('email', $playerActual['User']['email']);

        
        $this->set('fighterId',$fighterIdActual);
        
        $fightersActual = $this->Fighter->find('all',array(
                'conditions' => array(
                    'Fighter.player_id' => $playerIdActual
                )
            ));
        
        
        $fightersUser = array();

        foreach($fightersActual as $fighter){
            $fightersUser[$fighter['Fighter']['id']] = $fighter['Fighter']['name'];
            
            
        }
        $this->set('fighterList',$fightersUser);
    
        
        $this->set('raw',$this->Fighter->find('all' , array('conditions'=> array(
                                                        'Fighter.player_id' => $playerIdActual
                                                            )
                                            )
                             ));
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fightercreate'))
        {
            $this->Fighter->generate($playerIdActual,$this->request->data['Fightercreate']['name']);
            
            //Création d'une nouvelle arme
            $dataTool = array();
            
            $random = rand(1,3);
            
            if($random == 1){
                $dataTool['type'] = 'strength';
            }
            Elseif($random == 2){
                $dataTool['type'] = 'sight';
            }
            Else {
                $dataTool['type'] = 'life';
            }
            
            $dataTool['bonus'] = rand(1,3);
            
            $this->Tool->add($dataTool);
        }
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fighterchoice'))
        {
            $this->Session->write('Fighter.id',$this->request->data['Fighterchoice']['fighter']);
            $fighterIdActual = $this->Session->read('Fighter.id');
            
            echo "<script>window.location = window.location.href;</script>";  
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
        
        //Si c'est une action de newLevel
        if($this->request->data('Fighternewlevel'))
        {
            $message = $this->Fighter->increaseLevel($fighterIdActual, $this->request->data['Fighternewlevel']['skill']);
            $this->set("messages",$message);
        } 
         
    }
    
    /**
     * index method : sight
     *
     * @return void
     */
    public function sight()
    {
 
        $playerIdActual = $this->Session->read('Auth.User.id');
        $fighterIdActual = $this->Session->read('Fighter.id');
        $playerActual = $this->User->findById($playerIdActual);
        $this->set('email', $playerActual['User']['email']);
        
        $this->set('fighterId',$fighterIdActual);

        $currentFighter = $this->Fighter->find('first' , array('conditions'=> array(
                                                        'Fighter.id' => $fighterIdActual
                                                            )
                                            )
                             );
        
         $fightersUser = array();
         
         $fightersActual = $this->Fighter->find('all',array(
                'conditions' => array(
                    'Fighter.player_id' => $playerIdActual
                )
            ));
        
        foreach($fightersActual as $fighter){
            $fightersUser[$fighter['Fighter']['id']] = $fighter['Fighter']['name'];
            
            
        }
        $this->set('fighterList',$fightersUser);
        
        $this->set('raw',$currentFighter);
        
        $this->set('othersFighters',$this->Fighter->find('all' , array('conditions'=> array(
                                                        'Fighter.coordinate_x <' => $currentFighter['Fighter']['coordinate_x'] + $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.coordinate_x >' => $currentFighter['Fighter']['coordinate_x'] - $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.coordinate_y <' => $currentFighter['Fighter']['coordinate_y'] + $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.coordinate_y >' => $currentFighter['Fighter']['coordinate_y'] - $currentFighter['Fighter']['skill_sight'],
                                                        'Fighter.id !='          => $fighterIdActual
                                                            )
                                            )
                             ));
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fightercreate'))
        {
            $this->Fighter->generate($playerIdActual,$this->request->data['Fightercreate']['name']);
            
            //Création d'un nouveau Tool
            $dataTool = array();
            
            $random = rand(1,4);
            
            if($random == 1){
                $dataTool['type'] = 'strength';
            }
            Elseif($random == 2){
                $dataTool['type'] = 'sight';
            }
            Elseif($random == 3) {
                $dataTool['type'] = 'health';
            }
            Else {
                $dataTool['type'] = 'lifePoints';
            }
            
            $dataTool['bonus'] = rand(1,3);
            
            $this->Tool->add($dataTool);
        }
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fighterchoice'))
        {
            $this->Session->write('Fighter.id',$this->request->data['Fighterchoice']['fighter']);
            $fighterIdActual = $this->Session->read('Fighter.id');
            echo "<script>window.location = window.location.href;</script>";  
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
        
        //Si c'est une action de mouvement
        if($this->request->data('Fightermove'))
        {
            $message = $this->Fighter->doMove($fighterIdActual, $this->request->data['Fightermove']['direction']);
            $this->set('messages',$message);
            
        }
        
        //Si c'est une action d'attaque
        Elseif($this->request->data('Fighterattack'))
        {
            $message = $this->Fighter->doAttack($fighterIdActual, $this->request->data['Fighterattack']['direction']);
            
             $this->set('messages',$message);

        }
        
        //Affichage des données           
        $this->set('name', $currentFighter['Fighter']['name']);
        $this->set('level', $currentFighter['Fighter']['level']);
        $this->set('xp', $currentFighter['Fighter']['xp']);
        $this->set('coordinate_x', $currentFighter['Fighter']['coordinate_x']);
        $this->set('coordinate_y', $currentFighter['Fighter']['coordinate_y']);
        $this->set('force', $currentFighter['Fighter']['skill_strength']);
        $this->set('vision', $currentFighter['Fighter']['skill_sight']);
        $this->set('vieMax', $currentFighter['Fighter']['skill_health']);
        $this->set('vieActuelle', $currentFighter['Fighter']['current_health']);

        //Affichage des informations utilisateur
        $this->set('email', $this->Session->read('Auth.User.email'));



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
        $this->set('fighterId',$fighterIdActual);
        
        $playerActual = $this->User->findById($playerIdActual);
        $this->set('email', $playerActual['User']['email']);

        
        $fightersActual = $this->Fighter->find('all',array(
                'conditions' => array(
                    'Fighter.player_id' => $playerIdActual
                )
            ));
        
         $fightersUser = array();

        foreach($fightersActual as $fighter){
            $fightersUser[$fighter['Fighter']['id']] = $fighter['Fighter']['name'];
            
            
        }
        $this->set('fighterList',$fightersUser);
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fightercreate'))
        {
            $this->Fighter->generate($playerIdActual,$this->request->data['Fightercreate']['name']);
            
            //Création d'une nouvelle arme
            $dataTool = array();
            
            $random = rand(1,3);
            
            if($random == 1){
                $dataTool['type'] = 'strength';
            }
            Elseif($random == 2){
                $dataTool['type'] = 'sight';
            }
            Else {
                $dataTool['type'] = 'life';
            }
            
            $dataTool['bonus'] = rand(1,3);
            
            $this->Tool->add($dataTool);
        }
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fighterchoice'))
        {
            $this->Session->write('Fighter.id',$this->request->data['Fighterchoice']['fighter']);
            $fighterIdActual = $this->Session->read('Fighter.id');
            echo "<script>window.location = window.location.href;</script>";  
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
        
        $event = $this->Event->find('all', array(
                'conditions' => array(
                    'Event.date BETWEEN NOW() -INTERVAL 1 DAY AND NOW()'),
                'order' => array('Event.date DESC'), ));
        
        $this->set('Events', $event);
        
    }
    
    /**
     * message method : first page
     *
     * @return void
     */
    public function message()
    {
        $playerIdActual = $this->Session->read('Auth.User.id');
        $fighterIdActual = $this->Session->read('Fighter.id');
        
        $playerActual = $this->User->findById($playerIdActual);
        $this->set('email', $playerActual['User']['email']);
        
        $fightersActual = $this->Fighter->find('all',array(
                'conditions' => array(
                    'Fighter.player_id' => $playerIdActual
                )
            ));
        
        $this->set('playerId',$playerIdActual);
        $this->set('fighterId',$fighterIdActual);

        
        $fightersUser = array();

        foreach($fightersActual as $fighter){
            $fightersUser[$fighter['Fighter']['id']] = $fighter['Fighter']['name'];
            
            
        }
        $this->set('fighterList',$fightersUser);
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fightercreate'))
        {
            $this->Fighter->generate($playerIdActual,$this->request->data['Fightercreate']['name']);
            
            //Création d'une nouvelle arme
            $dataTool = array();
            
            $random = rand(1,3);
            
            if($random == 1){
                $dataTool['type'] = 'strength';
            }
            Elseif($random == 2){
                $dataTool['type'] = 'sight';
            }
            Else {
                $dataTool['type'] = 'life';
            }
            
            $dataTool['bonus'] = rand(1,3);
            
            $this->Tool->add($dataTool);
        }
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fighterchoice'))
        {
            $this->Session->write('Fighter.id',$this->request->data['Fighterchoice']['fighter']);
            $fighterIdActual = $this->Session->read('Fighter.id');
            echo "<script>window.location = window.location.href;</script>";  
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
        
        $messages = $this->Message->find('all', array(
                'conditions' => array(
                    'Message.fighter_id'    => $fighterIdActual),
                'order' => array('Message.date DESC'), ));
        
        $messagesSent = $this->Message->find('all', array(
                'conditions' => array(
                    'Message.fighter_id_from'    => $fighterIdActual),
                'order' => array('Message.date DESC'), ));
        
//TRADUCTION ID TO NAME
        $i=0;
        foreach($messages as $message){
            $fighterActual = $this->Fighter->find('first',array(
                'conditions' => array(
                    'Fighter.id'    => $message['Message']['fighter_id_from'])));
            $messages[$i]['Message']['fighter_id_from'] = $fighterActual['Fighter']['name'];
            
            $i = $i +1 ;
        }
        
        $i=0;
        foreach($messagesSent as $message){
            $fighterActual = $this->Fighter->find('first',array(
                'conditions' => array(
                    'Fighter.id'    => $message['Message']['fighter_id'])));
            $messagesSent[$i]['Message']['fighter_id'] = $fighterActual['Fighter']['name'];
            
            $i = $i +1 ;
        }
        
        
        $fighters = $this->Fighter->find('all',array(
                'conditions' => array(
                    'Fighter.player_id !='    => $playerIdActual)));
        
        $fightersName = array();

        foreach($fighters as $fighter){
            $fightersName[$fighter['Fighter']['id']] = $fighter['Fighter']['name'];
            
            
        }
        
        $this->set('fightersName',$fightersName);
        
        $this->set('Messages',$messages);
        $this->set('MessagesSent',$messagesSent);
        
        //Si c'est une action de mouvement
        if($this->request->data('MessageCreate'))
        {
            $this->Message->add($fighterIdActual, $this->request->data['MessageCreate']);
        }
        
        Elseif($this->request->data('Crier'))
        {
            $currentFighter = $this->Fighter->find('first' , array('conditions'=> array(
                                                        'Fighter.id' => $fighterIdActual
                                                            )
                                            )
                             );
            
            $this->request->data['Crier']['coordinate_x'] = $currentFighter['Fighter']['coordinate_x'];
            $this->request->data['Crier']['coordinate_y'] = $currentFighter['Fighter']['coordinate_y'];
            $this->request->data['Crier']['name'] = $currentFighter['Fighter']['name'] . " Screams " . $this->request->data['Crier']['name'];
            $this->Event->add($this->request->data['Crier']);
        }
  
    }
    
     /**
     * guild method : first page
     *
     * @return void
     */
    public function guild()
    {
        $playerIdActual = $this->Session->read('Auth.User.id');
        $fighterIdActual = $this->Session->read('Fighter.id');
        
        $playerActual = $this->User->findById($playerIdActual);
        $this->set('email', $playerActual['User']['email']);
        
        $fightersActual = $this->Fighter->find('all',array(
                'conditions' => array(
                    'Fighter.player_id' => $playerIdActual
                )
            ));
        
        
        $this->set('playerId',$playerIdActual);
        $this->set('fighterId',$fighterIdActual);
        
        $fightersUser = array();

        foreach($fightersActual as $fighter){
            $fightersUser[$fighter['Fighter']['id']] = $fighter['Fighter']['name'];
            
            
        }
        $this->set('fighterList',$fightersUser);
        
        $guilds = $this->Guild->find('all');
        
        $guildsName = array();

        foreach($guilds as $guild){
            $guildsName[$guild['Guild']['id']] = $guild['Guild']['name'];
  
        }
        
        $currentFighter = $this->Fighter->find('first',array(
                'conditions' => array(
                    'Fighter.id' => $fighterIdActual
                )
            ));
        
        if($currentFighter['Fighter']['guild_id'] != NULL){
            
            $guildActual = $this->Guild->find('first',array(
                'conditions'        => array(
                    'Guild.id'  => $currentFighter['Fighter']['guild_id']
                )
            ));
            
            $this->set('guildName',$guildActual['Guild']['name']);
        }
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fightercreate'))
        {
            $this->Fighter->generate($playerIdActual,$this->request->data['Fightercreate']['name']);
            
            //Création d'une nouvelle arme
            $dataTool = array();
            
            $random = rand(1,3);
            
            if($random == 1){
                $dataTool['type'] = 'strength';
            }
            Elseif($random == 2){
                $dataTool['type'] = 'sight';
            }
            Else {
                $dataTool['type'] = 'life';
            }
            
            $dataTool['bonus'] = rand(1,3);
            
            $this->Tool->add($dataTool);
        }
        
        //Si on demande la création d'un nouveau personnage.
        if($this->request->data('Fighterchoice'))
        {
            $this->Session->write('Fighter.id',$this->request->data['Fighterchoice']['fighter']);
            $fighterIdActual = $this->Session->read('Fighter.id');
            echo "<script>window.location = window.location.href;</script>";  
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
        
        $this->set('guildsName',$guildsName);
        
        //Si c'est une action de mouvement
        if($this->request->data('guildCreate'))
        {
            $this->Guild->add($this->request->data['guildCreate']);
        }
        
        //Si c'est une action de mouvement
        Elseif($this->request->data('guildJoin'))
        {
            $this->Fighter->joinGuild($fighterIdActual, $this->request->data['guildJoin']['guilds_id']);
        }
        
        
    }
    
    /**
     * home method : first page
     *
     * @return void
     */
    public function home()
    {
        $fightersAll = $this->Fighter->find('all');
        debug($fightersAll);
        $this->set('raw',$fightersAll);
        $playerIdActual = $this->Session->read('Auth.User.id');
        $this->set('isConnected',$playerIdActual);
    }
    
    /**
     * wallOfFame method : first page
     *
     * @return void
     */
    public function wallOfFame()
    {
        $playerIdActual = $this->Session->read('Auth.User.id');
        $this->set('isConnected',$playerIdActual);
    }

}
?>