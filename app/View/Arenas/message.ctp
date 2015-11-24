<div class="col-md-4">

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    echo " <h4> Send a message  </h4>";
    echo $this->Form->create('MessageCreate');
    echo $this->Form->input('title');
    echo $this->Form->input('messageField');
    echo $this->Form->input('fighter_id',array('options' => $fightersName));
    echo $this->Form->end('Send');
    
    echo "<br/><br/>";
 
    echo "<h4> Scream  </h4>";
    echo $this->Form->create('Crier');
    echo $this->Form->input('name');
    echo $this->Form->end('Crier');
 ?>   
</div>

<div class="col-md-8">
<h1>Message Received</h1>
    <table class="table" id="received">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Title" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Message" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Sender" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Date" disabled></th>
                                </tr>
                             </thead>
                            <tbody>
                                 <?php foreach ($Messages as $Message):?>
                                <tr>
                                    <td>    
                                            <?php echo $Message['Message']['title']; ?>      
                                    </td>

                                    <td>  
                                            <?php echo $Message['Message']['message']; ?>  
                                    </td>
                                    
                                    <td>  
                                            <?php echo $Message['Message']['fighter_id_from']; ?>  
                                    </td>
                                    
                                    <td>  
                                            <?php echo $Message['Message']['date']; ?>  
                                    </td>
                                </tr>
                                 <?php endforeach; ?>
                            </tbody>
                        </table>


<h1>Message Sent</h1>
    <table class="table" id="sent">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Title" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Message" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Destination" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Date" disabled></th>
                                </tr>
                             </thead>
                            <tbody>
                                 <?php foreach ($MessagesSent as $Message):?>
                                <tr>
                                    <td>    
                                            <?php echo $Message['Message']['title']; ?>      
                                    </td>

                                    <td>  
                                            <?php echo $Message['Message']['message']; ?>  
                                    </td>
                                    
                                    <td>  
                                            <?php echo $Message['Message']['fighter_id']; ?>  
                                    </td>
                                    
                                    <td>  
                                            <?php echo $Message['Message']['date']; ?>  
                                    </td>
                                </tr>
                                 <?php endforeach; ?>
                            </tbody>
                        </table>

</div>

<script>
$(document).ready(function(){
    $('#sent').DataTable();
});

$(document).ready(function(){
    $('#received').DataTable();
});

</script>