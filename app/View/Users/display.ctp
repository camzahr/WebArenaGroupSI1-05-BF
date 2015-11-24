<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//PHP HELPER IMAGE 
/*
  echo $this->Html->image('avatars/'.$playerId.'.jpg', array(
  'alt' => 'ProfilPicture',
  'style' => 'width: 200px;'));

 */
/* $raw['User']['email'];

  pr($raw); */
?>

<div class="col-md-4">
    <h3>Your Email :</h3>
    <h3><?php echo $raw['User']['email']; ?> </h3>
</div>

<div class="col-md-6">
    <h4>Change Password</h4>
    <?php
    echo $this->Form->create("Changepassword");
    echo $this->Form->input("passwordNew");
    echo $this->Form->end("Change");
    ?>
</div>

<div class="col-md-2"></div>
<div class="col-md-12">

    <div class="container">
        <div id="carousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <h3>Avatars in Game</h3>
                <?php
                $i = 0;
                foreach ($rawAll as $fighter) {


                    $pic = "./img/avatars/" . $fighter['Fighter']['id'] . ".jpg";

                    if (file_exists($pic)) {
                        if ($i == 0) {
                            ?>
                            <div class="item active">
                                <div class="col-md-6">
                                    <img alt="<?php echo $fighter['Fighter']['name'] ?>" src="<?php echo $this->webroot; ?>/img/avatars/<?php echo $fighter['Fighter']['id'] ?>.jpg" class="img-circle" style="height: 300px; width: 300px;">  
                                    <h3 class="align-center"> <?php echo $fighter['Fighter']['name'] ?> </h3>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>

                            <div class="item">
                                <img src="<?php echo $this->webroot; ?>/img/avatars/<?php echo $fighter['Fighter']['id'] ?>.jpg" class="img-circle" style="height: 300px; width: 300px;"> 
                                <h3 class="align-center"> <?php echo $fighter['Fighter']['name'] ?> </h3>
                            </div>



                            <?php
                        }

                        $i = $i + 1;
                    }
                }
                ?>

                </ul>




            </div>
        </div>

    </div>
</div>