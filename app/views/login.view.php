<?php if(message()):?>
    <div class="flash_message"><?=message('', true)?></div>
<?php endif;?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?=APP_NAME?></title>
    <link rel="stylesheet" href="./assets/css/login.css">
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
</head>
<body>


<div class="login-container">
    <h2>Login to <?=APP_NAME?></h2>

    <?php if(!empty($errors['email'])):?>
        <small class="wrong_creds"><?=$errors['email']?></small>
    <?php endif;?>

    <form class="login-form" action="#" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input value="<?= set_value('email')?>" type="email" id="email" name="email" >
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input value="<?= set_value('password')?>" type="password" id="password" name="password" >
        </div>
        <div class="form-group">
            <input type="submit" value="Login">
        </div>
    </form>
</div>

</body>
</html>

