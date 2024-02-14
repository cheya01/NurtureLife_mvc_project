
<!--header-->
<?php $this->view('user/user.header', $data)?>

<?php if(empty($row)):?>
    <h1><?=Auth::getRole()?> - profile</h1>
    <div class="sidebar">
        <div class="sidebar_link">
            <div class="sidebar_icon_container">
                <a href="<?=ROOT?>/profile"><img src="<?=ROOT?>/assets/images/user_profile.png"></a>
            </div>
            <div class="sidebar_link_text">
                <a href="<?=ROOT?>/profile"><h3>Profile</h3></a>
            </div>
        </div>
        <div class="side_bar_link">
            <div class="sidebar_link">
                <div class="sidebar_icon_container">
                    <a href="<?=ROOT?>/profile"><img src="<?=ROOT?>/assets/images/user_profile.png"></a>
                </div>
                <div class="sidebar_link_text">
                    <a href="<?=ROOT?>/profile"><h3>Profile</h3></a>
                </div>
            </div>
        </div>
        <div class="side_bar_link">
            <div class="sidebar_link">
                <div class="sidebar_icon_container">
                    <a href="<?=ROOT?>/profile"><img src="<?=ROOT?>/assets/images/user_profile.png"></a>
                </div>
                <div class="sidebar_link_text">
                    <a href="<?=ROOT?>/profile"><h3>Profile</h3></a>
                </div>
            </div>
        </div>
    </div>
<?php else:?>
    <h1>That user was not found!</h1>
<?php endif;?>
<!--footer-->
<?php $this->view('user/user.footer', $data)?>
