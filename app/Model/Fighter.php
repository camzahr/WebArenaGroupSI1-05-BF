<?php

App::uses('AppModel', 'Model');

class Fighter extends AppModel {

    public $displayField = 'name';

    public $belongsTo = array(

        'Player' => array(

            'className' => 'Player',

            'foreignKey' => 'player_id',

        ),

   );
    
    
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

public function doMove($fighterId, $direction){
//récupérer la position et fixer l'id de travail
$datas = $this->read(null, $fighterId);
debug($this);
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
    if($this->verifLimit()){
        echo("Mouvement Accepté !");
    }

    //@todo Empecher d'entrer sur une zone occupée
    
    $this->save();
    return true;
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
    }
    //Si oui, on l'attaque
    else 
    {
        echo"  You will Attack :  {$ennemy[0]['Fighter']['name']}";
        /*$ennemy[0]->Fighter->set('current_health',$ennemy[0]['Fighter']['current_health']-1);*/
        echo"   Your ennemy remains : {$ennemy[0]['Fighter']['current_health']}";
    }

    $this->save();
    
    return true;
}
public function increaseLevel($fighterId, $skill){
    //récupérer la position et fixer l'id de travail
    $datas = $this->read(null, $fighterId);
    switch ($skill) {
        case 'strength':
            debug($datas);
            $this->set('skill_strength',  $datas['Fighter']['skill_strength'] + 1);
            $this->set('coordinate_y', $datas['Fighter']['coordinate_y'] + 1);
            break;
        
        case 'sight':
            $this->set('skill_sight',  $datas['Fighter']['skill_sight'] + 1);
            break;
        
        case'life':
            $this->set('skill_health',  $datas['Fighter']['skill_health'] + 3);
            break;

        default:
            break;
    }
    
    $this->set('current_health',  $datas['Fighter']['skill_health']);
    
}
public function generate($name) {
    
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
        //'player_id'         => $this->Player['player_id'] ATTENTION PAS DE PLAYER ID :(
    );
    $this->create();
    $this->save($newData);
}


}



?>