
<!--header-->
<?php $this->view('admin/admin.header', $data)?>

<?php if(empty($row)):?>
    <h1><?=Auth::getRole()?> - profile</h1>
    <div class="sidebar">
        <div class="sidebar_link">
            <div class="sidebar_icon_container">
                <a><img src="<?=ROOT?>/assets/images/user_profile.png"></a>
            </div>
            <div class="sidebar_link_text">
                <a href="<?=ROOT?>/<?=Auth::getRole()?>/clinics"><h3>Clinics</h3></a>
            </div>
        </div>
        <div class="side_bar_link">
            <div class="sidebar_link">
                <div class="sidebar_icon_container">
                    <a><img src="<?=ROOT?>/assets/images/user_profile.png"></a>
                </div>
                <div class="sidebar_link_text">
                    <a href="<?=ROOT?>/<?=Auth::getRole()?>/doctors"><h3>Doctors</h3></a>
                </div>
            </div>
        </div>
        <div class="side_bar_link">
            <div class="sidebar_link">
                <div class="sidebar_icon_container">
                    <a><img src="<?=ROOT?>/assets/images/user_profile.png"></a>
                </div>
                <div class="sidebar_link_text">
                    <a href="<?=ROOT?>/<?=Auth::getRole()?>/mothers"><h3>Mothers</h3></a>
                </div>
            </div>
        </div>
        <div class="side_bar_link">
            <div class="sidebar_link">
                <div class="sidebar_icon_container">
                    <a><img src="<?=ROOT?>/assets/images/user_profile.png"></a>
                </div>
                <div class="sidebar_link_text">
                    <a href="<?=ROOT?>/<?=Auth::getRole()?>/midwives"><h3>Midwives</h3></a>
                </div>
            </div>
        </div>
        <div class="side_bar_link">
            <div class="sidebar_link">
                <div class="sidebar_icon_container">
                    <a><img src="<?=ROOT?>/assets/images/user_profile.png"></a>
                </div>
                <div class="sidebar_link_text">
                    <a href="<?=ROOT?>/<?=Auth::getRole()?>/all_users"><h3>All Users</h3></a>
                </div>
            </div>
        </div>
    </div>
<?php else:?>
    <h1>That user was not found!</h1>
<?php endif;?>
<!--footer-->
<?php $this->view('admin/admin.footer', $data)?>
