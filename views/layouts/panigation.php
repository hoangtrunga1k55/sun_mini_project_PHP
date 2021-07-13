<div style="position: relative;">
    <ul class="pagination" style="margin-top: 40px;position: fixed;bottom: 200px;left: 300px">
        <?php
        if(!empty($totalPages)){
            for($i=1; $i<= $totalPages; $i++){
                if($i == 1){
                    ?>
                    <li class="pageitem active" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i;?>" class="page-link" ><?php echo $i;?></a></li>
                    <?php
                }
                else{
                    ?>
                    <li class="pageitem" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></li>
                    <?php
                }
            }
        }
        ?>
    </ul>
</div>
