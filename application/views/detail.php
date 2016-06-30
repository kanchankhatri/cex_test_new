<div class="container">    
    <div class="row">
        <h2>Profile Detail</h2>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <?php if($profile_detail[0]->pic !=''){?>
                    <img src="<?php echo base_url('/assets/images/profile_pic/'.$profile_detail[0]->pic);?>" style='max-width:70%;' /> 
                    <?php } else {echo 'No pic.';}?>
            </div>
            <div class="col-sm-6">
                    <p><?php echo $profile_detail[0]->name;?></p>
                    <p><?php echo $profile_detail[0]->email;?></p>
                    <p><?php echo $profile_detail[0]->phone;?></p>
            </div>                            
        </div>
    </div>
    <?php if(!empty($profile_detail)){?>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-4">
        <div class='pagination'>
            <input type="hidden" name="current_userid" value="<?php echo $profile_detail[0]->userid;?>">
            <input type="hidden" name="pagination_action" value='profile_detail'>
            <span class='prev'>
                <a href='javascript:void(0);'>prev</a>
            </span>&nbsp;&nbsp;
            <span class='next'>
                <a href='javascript:void(0);'>next</a>
            </span>
            </div>
        </div>
    </div>
    <?php }?>
</div>