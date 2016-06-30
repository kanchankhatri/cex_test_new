<div class="container">
    <div class="row">
        <h2>Manage Category</h2>            
        <div class="col-sm-12">
            <?php if(!empty($profiles)){?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Userid</th>
                            
                            <th>Name</th>
                            <th>Email</th>
                            <th>phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($profiles as $value){                        ?>
                            <tr>
                                <td><a href="<?php echo base_url('/profile/detail/'.$value->userid);?>" >
                                    <?php echo $value->userid;?></a>
                                </td>
                                        <td>
                                            <?php echo $value->name;?>
                                        </td>
                                        <td>
                                            <?php echo $value->email;?>
                                        </td>
                                        <td>
                                            <?php echo $value->phone;?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('/profile/edit/'.$value->userid);?>">Edit</a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>                
                            <?php } else {
                                echo 'no users found';
                            }?>
                        </div>
                    </div>
                </div>