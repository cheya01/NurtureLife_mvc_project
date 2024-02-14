<?php $this->view('admin/admin.header', $data)?>

<?php if(!empty($row)):?>
    <div class="user_details_container">
        <h2>Details</h2>
        <div class="user_details_row">
            User ID - <?=esc($row->id)?>
        </div>
        <div class="user_details_row">
            Name - <?=esc($row->firstname)?> <?=esc($row->lastname)?>
        </div>
        <div class="user_details_row">
            Email - <?=esc($row->email)?>
        </div>
        <div class="user_details_row">
            Role - <?=esc(Auth::getRole())?>
        </div>
        <div class="user_details_row">
            Contact Number - <?=esc($row->contact_no)?>
        </div>
        <div class="user_details_row">
            Date of Birth - <?=esc($row->dob)?>
        </div>
        <div class="user_details_row">
            NIC No - <?=esc($row->nic)?>
        </div>
    </div>
<br>

<h2>Edit profile</h2>
    <form method="post">
        <div class="edit_profile_container">
<!--            //edit firstname-->
            <div class="edit_profile_row">
                <label>First Name</label>
                <label>
                    <input name="firstname" type="text" value="<?=set_value('firstname', $row->firstname)?>">
                </label>
                <?php if (!empty($errors['firstname'])):?>
                    <small class="text-danger"><?=$errors['firstname']?></small>
                <?php endif;?>
            </div>
<!--            //edit lastname-->
            <div class="edit_profile_row">
                <label>Last Name</label>
                <label>
                    <input name="lastname" type="text" value="<?=set_value('lastname', $row->lastname)?>">
                </label>
                <?php if (!empty($errors['lastname'])):?>
                    <small class="text-danger"><?=$errors['lastname']?></small>
                <?php endif;?>
            </div>
<!--            //edit email-->
            <div class="edit_profile_row">
                <label>Email</label>
                <label>
                    <input name="email" type="email" value="<?=set_value('email', $row->email)?>">
                </label>
                <?php if (!empty($errors['email'])):?>
                    <small class="text-danger"><?=$errors['email']?></small>
                <?php endif;?>
            </div>
<!--            //edit contact_no-->
            <div class="edit_profile_row">
                <label>Contact Number</label>
                <label>
                    <input name="contact_no" type="text" value="<?=set_value('contact_no', $row->contact_no)?>">
                </label>
                <?php if (!empty($errors['contact_no'])):?>
                    <small class="text-danger"><?=$errors['contact_no']?></small>
                <?php endif;?>
            </div>
<!--            //edit DOB-->
<!--            <div class="edit_profile_row">-->
<!--                <label>Date of Birth</label>-->
<!--                <label>-->
<!--                    <input name="dob" type="text" value="--><?php //=set_value('dob', $row->dob)?><!--">-->
<!--                </label>-->
<!--                --><?php //if (!empty($errors['dob'])):?>
<!--                    <small class="text-danger">--><?php //=$errors['dob']?><!--</small>-->
<!--                --><?php //endif;?>
<!--            </div>-->
            <div class="edit_profile_row">
                <?php if(message()):?>
                    <div><?=message('', true)?></div>
                <?php endif;?>
            </div>
            <br>
            <div class="edit_buttons">
                <a href="<?=ROOT?>/admin">
                    <button type="button" class="back_button">Back</button>
                </a>
                <button type="submit" class="save_button">Save Changes</button>
            </div>


        </div>
    </form>


<?php else:?>
    <h1>That user was not found!</h1>
<?php endif;?>


<!--footer-->
<?php $this->view('admin/admin.footer', $data)?>
