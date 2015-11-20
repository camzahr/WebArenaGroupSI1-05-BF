<?php $this->assign('title', 'Diary');
    ?>

//Variable PHP
<table class="table">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Evènement" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Date" disabled></th>
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
