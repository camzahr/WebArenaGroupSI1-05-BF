<?php $this->assign('title', 'Diary');
    ?>

<table class="table" id="myTable">
                            <thead>
                                <tr class="filters">
                                    <th>Event</th>
                                    <th>Date</th>
                                </tr>
                             </thead>
                            <tbody>
                                 <?php foreach ($Events as $Event):?>
                                <tr>
                                    <td>    
                                            <?php echo $Event['Event']['name']; ?>      
                                    </td>

                                    <td>  
                                            <?php echo $Event['Event']['date']; ?>  
                                    </td>
                                </tr>
                                 <?php endforeach; ?>
                            </tbody>
                        </table>

<script>
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>