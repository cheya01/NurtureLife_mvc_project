<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APP_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?=ROOT?>/assets/images/icons/favicon.png">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin.css">
</head>
<body>
<div class="navbar" id="myNavbar">
    <div class="NL_logo_container">
        <a href="<?=ROOT?>"><img src="<?=ROOT?>/assets/images/nurturelife_logo.png" class="NL_logo"></a>

    </div>
    <a href="<?=ROOT?>/home">Home</a>
    <a href="<?=ROOT?>/about">About</a>

    <div class="search-container">
        <input type="text" placeholder=" Search...">
        <button type="submit">Search</button>
    </div>

    <?php if(!Auth::logged_in()):?>
        <a href="<?=ROOT?>/login">Login</a>
        <a href="<?=ROOT?>/signup">Signup</a>
    <?php else:?>
        <div class="dropdown">
            <button class="dropbtn">Hi, <?=Auth::getFirstname()?></button>
            <div class="dropdown-content">
                <a href="<?=ROOT?>/<?=Auth::getRole()?>">Dashboard</a>
                <a href="<?=ROOT?>/<?=Auth::getRole()?>/profile">Profile</a>
                <a href="<?=ROOT?>/<?=Auth::getRole()?>/settings">Settings</a>
                <a href="<?=ROOT?>/logout">Logout</a>
            </div>
        </div>
    <?php endif;?>

    <div class="navbar_emg">
        Emergency Hotline<br>+94 11 238 4618
    </div>
</div>
<?php if(message()):?>
<div class="flash_message"><?=message('', true)?></div>
<?php endif;?>