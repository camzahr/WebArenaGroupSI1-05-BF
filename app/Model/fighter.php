    <?php

App::uses('AppModel', 'Model');
App::uses('Event', 'Model');

class Fighter extends AppModel {

    public $displayField = 'name';

    public $belongsTo = array(

        'Player' => array(

            'className' => 'Player',

            'foreignKey' => 'player_id',

        ),

   );
    
    
    
//FONCTIONS DO MOVE    
protected function verifLimit(){
    debug($this->data['Fighter']['coordinate_y']);
    if($this->data['Fighter']['coordinate_y']> 10)
    {
        echo("You pass the limits");
        $this->set('coordinate_y', 10); 
        return false;
    }
    elseif($this->data['Fighter']['coordinate_y']< 1)
    {
        echo("You pass the limits");
        $this->set('coordinate_y', 1); 
        return false;
    }
    
    if($this->data['Fighter']['coordinate_x']> 15)
    {
        echo("You pass the limits");
        $this->set('coordinate_x', 15);
        return false;
    }
    elseif($this->data['Fighter']['coordinate_x']< 1)
    {
        echo("You pass the limits");
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
    'coordinate_y' => $datas['Fighter']['coordinate_y']+1);        
        break;

    case 'south':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x'],
    'coordinate_y' => $datas['Fighter']['coordinate_y']-1);
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
        echo "Direction inconnue";
    }
    echo "You want to move to $case[coordinate_x] / $case[coordinate_y]";

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
        echo" Nobody is currently at this position !!!!";
        return true;
    }
    //Si oui, on l'attaque
    else 
    {
        echo" Case occupied by someone else";
        return false;
    }

}

public function doMove($fighterId, $direction){
    //récupérer la position et fixer l'id de travail
    $datas = $this->read(null, $fighterId);
    // Empecher d'entrer sur une zone occupée
    if($this->verifCaseOccupy($fighterId, $direction))
        {
            echo("Free case");
            
            switch ($direction)
                {
                case 'north':
                    $this->set('coordinate_y', $datas['Fighter']['coordinate_y'] + 1);
                    break;

                case 'south':
                    $this->set('coordinate_y', $datas['Fighter']['coordinate_y'] - 1);
                    break;

                case 'east':
                    $this->set('coordinate_x', $datas['Fighter']['coordinate_x'] + 1);
                    break;

                case 'west':
                    $this->set('coordinate_x', $datas['Fighter']['coordinate_x'] - 1);
                    break;

                default:
                    echo "Direction inconnue";
                }
                
            //Empecher de sortir de l'arène
            if($this->verifLimit())
                {
                    echo("Mouvement Accepté !");
                }
            else
                {
                    echo("Mouvement Invalide");
                    return false;
                }
            $this->save();
            return true;
                
        }
    else
        {
            echo("Mouvement invalide,case occupée");
            return false;
        }
}

//FONCTIONS DO ATTACK

protected function xpIncrease($fighterId, $level) {

    $datas = $this->read(null, $fighterId);
    $this->set('xp', $datas['Fighter']['xp'] + $level);
    $this->save();
}

protected function healthControl($fighterId) {
    
    $datas = $this->read(null, $fighterId);
    if ($datas['Fighter']['current_health'] < 1) {
        $this->delete();
    }
    
}

protected function hurt($fighterId, $level) {

    $datas = $this->read(null, $fighterId);
    $this->set('current_health', $datas['Fighter']['current_health'] - $level);
    $this->save();
    
    $this->healthControl($fighterId);
    
}

public function doAttack($fighterId, $direction){
    //récupérer la position et fixer l'id de travail
    $datas = $this->read(null, $fighterId);
    $case = array('coordinate_x' => $datas['Fighter']['coordinate_x'],
                  'coordinate_y' => $datas['Fighter']['coordinate_y']);
    
    switch ($direction)
    {
    case 'north':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x'],
    'coordinate_y' => $datas['Fighter']['coordinate_y']+1);        
        break;

    case 'south':
        $case = array('coordinate_x' => $datas['Fighter']['coordinate_x'],
    'coordinate_y' => $datas['Fighter']['coordinate_y']-1);
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
        echo "Direction inconnue";
    }
    echo "Gonna attack : $case[coordinate_x] / $case[coordinate_y]";
    
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
        echo" Nobody is currently at this position !!!!";
    }
    //Si oui, on l'attaque
    else 
    {
        echo"  You will Attack :  {$ennemy['Fighter']['name']} ";
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
                echo"Attaque Réussie ";
                $change = array(
                    'current_health' => $ennemy['Fighter']['current_health'] - $datas['Fighter']['level']
                );
                $this->hurt($ennemy['Fighter']['id'], $datas['Fighter']['level']);
                //SI DESTRUCTION
                if ($change['current_health'] < 1){
                    echo "DETRUIT";
                    $dataEvent['name'] = $datas['Fighter']['name'] . " Kills " . $ennemy['Fighter']['name'];
                
                    $this->xpIncrease($fighterId, $ennemy['Fighter']['level']);
                    $event->add($dataEvent);
                    //$ennemy->save($change);
                }
                else
                {
                    $this->set('xp', $datas['Fighter']['xp'] + 1);
                    $this->save();
                    $this->xpControl($fighterId);
                    $event->add($dataEvent);
                    
                }
               
            }   
        else 
            {
                $dataEvent['name'] = $datas['Fighter']['name'] . " Miss " . $ennemy['Fighter']['name'];
                $event->add($dataEvent);
                
                echo"Attaque Ratée !!!";
                return false;
            }
        /*$ennemy[0]->Fighter->set('current_health',$ennemy[0]['Fighter']['current_health']-1);*/
        echo"   Your ennemy remains : {$ennemy['Fighter']['current_health']} Life Points";
        
    }

    $this->save();
    
    return true;
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
    return true;
    }
    else
    {
        return false;
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
}


}
