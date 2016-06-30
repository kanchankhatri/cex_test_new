<?php
$current_method = $this->router->fetch_method();
$name = '';
$email = '';
$pic = '';
$phone = '';
$action='new';
if(!empty($_POST) && isset($profile_detail)){
    $name = $profile_detail['name'];
    $email = $profile_detail['email']; 
    $phone = $profile_detail['phone'];
    // $pic = $profile_detail['pic'];
    if($current_method!='new'){
        $action='edit';
    }   
} else if(isset($profile_detail)){
    $profile_detail = $profile_detail[0];
    $name = $profile_detail->name;
    $email = $profile_detail->email;
    $phone = $profile_detail->phone;
    $pic = $profile_detail->pic;
    if($current_method!='new'){
        $action='edit';
    }
}
?>

<div class="container">
    <div class='row'>
        <div class="col-sm-12">             
            <form id="profile-form" role="form" novalidate="" method="POST" enctype="multipart/form-data">                
                <div class="col-sm-8 col-sm-offset-2">
                    <h4 class="font-alt m-t-0 m-b-0">Add Profile</h4>
                    <hr class="divider-w m-t-10 m-b-20">
                    <div class="form-group">
                        <!-- <label class="sr-only" for="title">Title</label> -->
                        <input style='text-transform:none;' class="form-control input-lg" type="text" placeholder="Name" required="" data-validation-required-message="Please enter name." aria-invalid="false" name='name' value="<?php echo $name;?>">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <!-- <label class="sr-only" for="author">Author</label> -->
                        <input style='text-transform:none;' class="form-control input-lg" type="email" placeholder="Email" required="" data-validation-required-message="Please enter Email." aria-invalid="false" name='email' value="<?php echo $email;?>"  maxlength="255">
                        <p class="help-block text-danger"></p>
                    </div>                    
                    <div class="form-group">
                        <label class="sr-only" for="phone">Phone</label>
                        <input type="number" id="phone" name="phone" class="form-control" placeholder="Your Phone" required="" data-validation-required-message="Please enter your contact no." maxlength="10" value="<?php echo $phone;?>">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <?php if($pic!=''){?>
                            <img src='<?php echo base_url('/assets/images/profile_pic/'.$pic);?>' class='p-b-20'/>
                            <?php }?>
                            <label class="sr-only" for="category_image">Choose Featured Image</label>
                            <input style='text-transform:none;' class="form-control input-lg" type="file" required="" data-validation-required-message="Please choose a file." aria-invalid="false" name='profile_pic_image'>
                        </div>
                        <p class='text-danger'><?php if (isset($error)) echo $error;?></p>
                        <button type="submit" class="btn btn-round btn-g">Submit</button>
                    </div>
                    <!-- <input type="hidden" name='action' value='<?php echo $action;?>'> -->
                </form>
            </div>
        </div>      
    </div>
