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
   public function doMove($fighterId, $direction){
//récupérer la position et fixer l'id de travail
$datas = $this->read(null, $fighterId);

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
    
    //@todo Empecher de sortir de l'arène
    
    //@todo Empecher d'entrer sur une zone occupée
    
    $this->save();
    return true;
}

}



?>