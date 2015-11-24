
  
    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
    <script class="include" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<?php $this->assign('title', 'wallOfFame');
    ?>
<?php 
//IF User Connected
if(empty($isConnected))
{
    $this->layout = 'unlogged';
      
}

?>
    
    <div id="chart1c" style="width:400px;height:260px;"></div>

<div id="chart2" style="width:600px;height:260px;"></div>

<div id="customTooltipDiv">I'm a tooltip.</div>

  

<!--CODE HTML    -->


