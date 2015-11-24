<?php
    //$this->layout = 'unlogged';
?>
<div class="col-md-4"></div>

<div class="col-md-4">
    <h3>Inside the Arena, now </h3>
<div class="container">
<div id="carousel1" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
<?php
$i = 0;
foreach($raw as $fighter)
	{
    
    
$pic="./img/avatars/".$fighter['Fighter']['id'].".jpg";

if (file_exists($pic)) {
    if($i == 0)
    {
        ?>
    <div class="item active">
        <div class="col-md-6">
            <img alt="<?php echo $fighter['Fighter']['name']?>" src="<?php echo $this->webroot; ?>/img/avatars/<?php echo $fighter['Fighter']['id'] ?>.jpg" class="img-circle" style="height: 300px; width: 300px;">  
            <h3 class="align-center"> <?php echo $fighter['Fighter']['name']?> </h3>
        </div>
    </div>
    <?php
    }
    else{
    ?>
    
    <div class="item">
        <img src="<?php echo $this->webroot; ?>/img/avatars/<?php echo $fighter['Fighter']['id'] ?>.jpg" class="img-circle" style="height: 300px; width: 300px;"> 
        <h3 class="align-center"> <?php echo $fighter['Fighter']['name']?> </h3>
    </div>
    
    
    
    <?php 
    }
    //echo "<img src='.$pic' />";
    $i = $i + 1;
    }  
      
}

/*
?>
    
<ul class="nav nav-pills nav-justified">
        <?php
        $i = 0;
foreach($raw as $fighter)
	{
    
?>
            <li data-target="#carousel1" data-slide-to=<?php echo $i ?> >
                <a href="#"><?php echo $fighter['Fighter']['name']?></a>
            </li>
    
  <?php  
  $i = $i + 1;
    }
 
 */
?>

</ul>
    
            
    
        
    </div>
</div>

</div>
</div>


    <script type="text/javascript">
    jQuery(function ($) {
        $('#carousel1').carousel({
            interval: 500
        });
    </script>