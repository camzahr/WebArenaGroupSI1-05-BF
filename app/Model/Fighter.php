<?php

App::uses('AppModel', 'Model');
App::uses('Event', 'Model');
App::uses('Tool', 'Model');

class Fighter extends AppModel {

    public $displayField = 'name';

    public $belongsTo = array(

        'Player' => array(

            'className' => 'Player',

            'foreignKey' => 'player_id',

        ),

   );
    
 public $validate = array(
    'name' => array(
        array(
            'rule' => 'isUnique',
            'message' => 'Pseudo déjà existant',

        )));
    

    
//FONCTIONS DO MOVE    

protected function verifLimit(){
    debug($this->data['Fighter']['coordinate_y']);
    if($this->data['Fighter']['coordinate_y']> 10)
    {
        //echo("You pass the limits");
        $this->set('coordinate_y', 10); 
        return false;
    }
    elseif($this->data['Fighter']['coordinate_y']< 1)
    {
        //echo("You pass the limits");
        $this->set('coordinate_y', 1); 
        return false;
    }
    
    if($this->data['Fighter']['coordinate_x']> 15)
    {
        //echo("You pass the limits");
        $this->set('coordinate_x', 15);
        return false;
    }
    elseif($this->data['Fighter']['coordinate_x']< 1)
    {
        //echo("You pass the limits");
        $this->set('coordinate_x', 1);
        return false;
    }
    
    return true;   
}

protected function verifCaseOccupy($fighterId, $direction){
    $datas = $this->read(null, $fighterId);
    $case = array('coordinate_x' => $datas['Fighter']['coordinate_x'],
                  'coordinate_y' => $datas['Fighter']['coordinate_y']);
     
    switch ($direction)
    {
    case 'north':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x'],
    'coordinate_y' => $datas['Fighter']['coordinate_y']-1);        
        break;

    case 'south':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x'],
    'coordinate_y' => $datas['Fighter']['coordinate_y']+1);
        break;

    case 'east':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x']+1,
    'coordinate_y' => $datas['Fighter']['coordinate_y']);
        break;

    case 'west':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x']-1,
    'coordinate_y' => $datas['Fighter']['coordinate_y']);
        break;

    default:
        //echo "Direction inconnue";
    }
    //echo "You want to move to $case[coordinate_x] / $case[coordinate_y]";

    //On cherche l'ennemy sur la case attaquée
    $ennemy = $this->find('all' , array('conditions'=> array(
                                                        'Fighter.coordinate_x' => $case['coordinate_x'],
                                                        'Fighter.coordinate_y' => $case['coordinate_y']
                                                            )
                                            )
                             );

    //On vérifie que l'ennemy existe
    if( empty ($ennemy) )
    {
        //echo" Nobody is currently at this position !!!!";
        return true;
    }
    //Si oui, on l'attaque
    else 
    {
        return false;
    }

}

public function doMove($fighterId, $direction){
    //récupérer la position et fixer l'id de travail
    $datas = $this->read(null, $fighterId);
    
    $messages;
    // Empecher d'entrer sur une zone occupée
    if($this->verifCaseOccupy($fighterId, $direction))
        {
            
            
            switch ($direction)
                {
                case 'north':
                    $this->set('coordinate_y', $datas['Fighter']['coordinate_y'] - 1);
                    break;

                case 'south':
                    $this->set('coordinate_y', $datas['Fighter']['coordinate_y'] + 1);
                    break;

                case 'east':
                    $this->set('coordinate_x', $datas['Fighter']['coordinate_x'] + 1);
                    break;

                case 'west':
                    $this->set('coordinate_x', $datas['Fighter']['coordinate_x'] - 1);
                    break;

                default:
                    $messages = "Wrong direction";
                    echo "<script>window.location = window.location.href;</script>";
                    return $messages;
                }
                
            //Empecher de sortir de l'arène
            if($this->verifLimit())
                {
                 
                //    echo("Mouvement Accepté !");
                }
            else
                {
                  $messages = $messages . " " . "You try to quit the Arena !";
                  echo "<script>window.location = window.location.href;</script>";
                  return $messages;
                }
            $this->save();
            echo "<script>window.location = window.location.href;</script>";
            return $messages;
                
        }
    else
        {
          $messages = $messages . " " . "Case Occupied !";
          echo "<script>window.location = window.location.href;</script>";
          return $messages;
        }
}

//FONCTIONS DO ATTACK

protected function guildControl($fighterId, $attackerGuildId) {

    $datas = $this->read(null, $fighterId);
    
    $west = $this->find('first', array(
        'conditions' => array(
            'Fighter.guild_id'      => $attackerGuildId,
            'Fighter.coordinate_x'  => $datas['Fighter']['coordinate_x'] - 1,
            'Fighter.coordinate_y'  => $datas['Fighter']['coordinate_y']
        )
    ));
    
    $est = $this->find('first', array(
        'conditions' => array(
            'Fighter.guild_id'      => $attackerGuildId,
            'Fighter.coordinate_x'  => $datas['Fighter']['coordinate_x'] + 1,
            'Fighter.coordinate_y'  => $datas['Fighter']['coordinate_y']
        )
    ));
    
    $south = $this->find('first', array(
        'conditions' => array(
            'Fighter.guild_id'      => $attackerGuildId,
            'Fighter.coordinate_x'  => $datas['Fighter']['coordinate_x'],
            'Fighter.coordinate_y'  => $datas['Fighter']['coordinate_y'] + 1
        )
    ));
    
    $north = $this->find('first', array(
        'conditions' => array(
            'Fighter.guild_id'      => $attackerGuildId,
            'Fighter.coordinate_x'  => $datas['Fighter']['coordinate_x'],
            'Fighter.coordinate_y'  => $datas['Fighter']['coordinate_y'] - 1
        )
    ));
    
    $result = 0;
    
    if($west) $result = $result + 1;
    if($south) $result = $result + 1;
    if($est) $result = $result + 1;
    if($north) $result = $result + 1;
    
    //on enleve l'attaquant
    $result = $result - 1;
    
    return $result;
}

protected function xpIncrease($fighterId, $level) {

    $datas = $this->read(null, $fighterId);
    $this->set('xp', $datas['Fighter']['xp'] + $level);
    $this->save();
    
    return "You Earn XPs";
}

protected function healthControl($fighterId) {
    
    $datas = $this->read(null, $fighterId);
    if ($datas['Fighter']['current_health'] < 1) {
        $tool = new Tool();
        $tool->fighterDie($fighterId, $datas['Fighter']['coordinate_x'], $datas['Fighter']['coordinate_y']);
        $this->delete();
        return "You destroy an Ennemy !";
    }
}

protected function hurt($fighterId, $strength) {

    $datas = $this->read(null, $fighterId);
    $this->set('current_health', $datas['Fighter']['current_health'] - $strength);
    $this->save();
    
    
    
    return $this->healthControl($fighterId) . " You hurt the ennemy !";
    
}

public function doAttack($fighterId, $direction){
    //récupérer la position et fixer l'id de travail
    $datas = $this->read(null, $fighterId);
    $case = array('coordinate_x' => $datas['Fighter']['coordinate_x'],
                  'coordinate_y' => $datas['Fighter']['coordinate_y']);
    
    $messages;
    
    switch ($direction)
    {
    case 'north':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x'],
    'coordinate_y' => $datas['Fighter']['coordinate_y']-1);        
        break;

    case 'south':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x'],
    'coordinate_y' => $datas['Fighter']['coordinate_y']+1);
        break;

    case 'east':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x']+1,
    'coordinate_y' => $datas['Fighter']['coordinate_y']);
        break;

    case 'west':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x']-1,
    'coordinate_y' => $datas['Fighter']['coordinate_y']);
        break;

    default:
        $messages = "Wrong Direction";
        echo "<script>window.location = window.location.href;</script>";
    
        return $messages;
        //echo "Direction inconnue";
    }
    //echo "Gonna attack : $case[coordinate_x] / $case[coordinate_y]";
    
    $ennemy = new Fighter();     
    //On cherche l'ennemy sur la case attaquée
    $ennemy = $this->find('first' , array('conditions'=> array(
                                                        'Fighter.coordinate_x' => $case['coordinate_x'],
                                                        'Fighter.coordinate_y' => $case['coordinate_y']
                                                            )
                                            )
                             );
    
    
    //On vérifie que l'ennemy existe
    if( empty ($ennemy) )
    {
        die('t');
        //echo" Nobody is currently at this position !!!!";
        $messages = "Nobody is currently at this position !";
        echo "<script>window.location = window.location.href;</script>";
        return $messages;
    }
    //Si oui, on l'attaque
    else 
    {
        //echo"  You will Attack :  {$ennemy['Fighter']['name']} ";
        //$ennemyFighter = read()
        $result = (10 - $datas['Fighter']['level'] + $ennemy['Fighter']['level']);
        
        $dataEvent = array(
            'coordinate_x' =>   $case[coordinate_x],
            'coordinate_y' =>   $case[coordinate_y]
        );
        
        $event = new Event();
        
        if (rand(1,20) > $result)
            {
                $dataEvent['name'] = $datas['Fighter']['name'] . " Attack " . $ennemy['Fighter']['name'];
                //echo"Attaque Réussie ";
                
                $bonusGuild = $this->guildControl($ennemy['Fighter']['id'], $datas['Fighter']['guild_id']);
                debug("BONUS : ".$bonusGuild);
                
                $change = array(
                    'current_health' => $ennemy['Fighter']['current_health'] - $datas['Fighter']['skill_strength'] - $bonusGuild
                );
                $this->hurt($ennemy['Fighter']['id'], $datas['Fighter']['skill_strength']);
                //SI DESTRUCTION
                if ($change['current_health'] < 1){
                    //echo "DETRUIT";
                    $dataEvent['name'] = $datas['Fighter']['name'] . " Kills " . $ennemy['Fighter']['name'];
                
                    $this->xpIncrease($fighterId, $ennemy['Fighter']['level']);
                    $event->add($dataEvent);
                    
                    $messages = $messages . " " ."You killed Someone !";
                    echo "<script>window.location = window.location.href;</script>";
    
                    return $messages;
                    //$ennemy->save($change);
                }
                else
                {
                    $this->set('xp', $datas['Fighter']['xp'] + 1);
                    $this->save();
                    $event->add($dataEvent);
                    
                    $messages = $messages . " " . " You Hurt Your Ennemy !";
                    echo "<script>window.location = window.location.href;</script>";
    
                    return $messages;
                    
                }
               
            }   
        else 
            {
                $dataEvent['name'] = $datas['Fighter']['name'] . " Miss " . $ennemy['Fighter']['name'];
                $event->add($dataEvent);
                
                //echo"Attaque Ratée !!!";
                $messages = $messages . " " . " Attaque Ratée !";
                echo "<script>window.location = window.location.href;</script>";
                return $messages;
            }
        /*$ennemy[0]->Fighter->set('current_health',$ennemy[0]['Fighter']['current_health']-1);*/
        
            //debug("   Your ennemy remains : {$ennemy['Fighter']['current_health']} Life Points");
        
    }

    $this->save();
    echo "<script>window.location = window.location.href;</script>";
            
    return $messages;
}

//FONCTIONS AUTRES
public function increaseLevel($fighterId, $skill){
    //récupérer la position et fixer l'id de travail
    $datas = $this->read(null, $fighterId);
    if ($datas['Fighter']['xp'] > 4)
        {
    $this->set('xp', $datas['Fighter']['xp'] - 4);

    $this->set('level', ($datas['Fighter']['level'] + 1));
    
    switch ($skill) {
        case 'strength':
            $dataChanged =array(
                'skill_strength' => ($datas['Fighter']['skill_strength'] + 1),
                'current_health' =>  $datas['Fighter']['skill_health']
                );
            break;
        
        case 'sight':
            $dataChanged =array(
                'skill_sight'   =>  ($datas['Fighter']['skill_sight'] + 1),
                'current_health'=>  $datas['Fighter']['skill_health']
                );
            
            break;
        
        case'life':
            $dataChanged =array(
                'skill_health'  =>  ($datas['Fighter']['skill_health'] + 3),
                'current_health'=>  ($datas['Fighter']['skill_health'] + 3)
                );
            break;

        default:
            break;
    }
    
    $this->set('current_health',  $datas['Fighter']['skill_health']);

    $this->save($dataChanged);

    return "You pass a level !";
    }
    else
    {
        return "You don't have enough XPs";
    }
    
}

public function generate($id,$name) {
    
    $newData = array(
        'name'              => $name,
        'coordinate_x'      => rand(1,15),
        'coordinate_y'      => rand(1,10),
        'level'             => 1,
        'xp'                => 0,
        'skill_sight'       => 0,
        'skill_strength'    => 1,
        'skill_health'      => 3,
        'current_health'    => 3,
        'player_id'         => $id
    );
    $this->create();
    $this->save($newData);
    
    return ("Welcome $name");
}

public function joinGuild($fighterId, $guildId) {
        //récupérer la position et fixer l'id de travail
        $datas = $this->read(null, $fighterId);
        
        $newData = array(
            'guild_id'             => $guildId);
        
        $this->save($newData);
        return'Welcome to your new Guild !';
    }
    
    public function newAvatar($fighterId, $data) {
        $datas = $this->read(null, $fighterId);

        if(!empty($data['avatar_file']['tmp_name']))
            {
                
                $extension = strtolower(pathinfo($data['avatar_file']['name'], PATHINFO_EXTENSION));
                if(in_array($extension, array('jpg')))
                {
                    move_uploaded_file($data['avatar_file']['tmp_name'], IMAGES.'avatars'.DS.$fighterId.'.'.$extension);
                   
                }
                
                return "Nouvel Avatar Accepté";
            }
        return "Avatar Non Valide";
    }
    
    public function ramasserWeapon($fighterId, $toolId){
        
        $datas = $this->read(null, $fighterId);
        
        $tool = new Tool();
        
        $toolCurrent = $tool->find('first', array(
            'conditions'    => array(
                'Tool.coordinate_x'     => $datas['Fighter']['coordinate_x'],
                'Tool.coordinate_y'     => $datas['Fighter']['coordinate_y'],
                'Tool.id'               => $toolId
            )
        ));
        
        $tool->ramasseTool($toolId,$fighterId);
        
        switch ($toolCurrent['Tool']['type']) {
        case 'strength':
            $dataChanged =array(
                'skill_strength'    => ($datas['Fighter']['skill_strength'] + $toolCurrent['Tool']['bonus'])
                );
            break;
        
        case 'sight':
            $dataChanged =array(
                'skill_sight'       =>  ($datas['Fighter']['skill_sight'] + $toolCurrent['Tool']['bonus']),
                );
            
            break;
        
        case'health':
            $dataChanged =array(
                'skill_health'      =>  ($datas['Fighter']['skill_health'] + $toolCurrent['Tool']['bonus']),
                'current_health'    =>  ($datas['Fighter']['skill_health'] + $toolCurrent['Tool']['bonus'])
                );
            break;
        
        case'lifePoints':
            $dataChanged =array(
                'current_health'    =>  ($datas['Fighter']['skill_health'])
                );
            break;

        default:
            break;
    }
    
    $this->save($dataChanged);
        
    return "You have a new Weapon !";
        
    }


}
