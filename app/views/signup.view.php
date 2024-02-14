<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - <?=APP_NAME?></title>
    <link rel="icon" type="image/x-icon" href="./assets/images/icons/favicon.png">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

<div class="signup_form_container">
    <h2>User Registration</h2><br>
    <form action="" method="post">
        <label for="firstname">First Name:</label>
        <input class="<?=!empty($errors['firstname']) ? 'border-danger':'';?>" value="<?= set_value('firstname')?>" type="text" id="firstname" name="firstname" >
        <?php if (!empty($errors['firstname'])):?>
            <small class="text-danger"><?=$errors['firstname']?></small>
        <?php endif;?>

        <br>
        <label for="lastname">Last Name:</label>
        <input class="<?=!empty($errors['lastname']) ? 'border-danger':'';?>" value="<?= set_value('lastname')?>" type="text" id="lastname" name="lastname" >
        <?php if (!empty($errors['lastname'])):?>
            <small class="text-danger"><?=$errors['lastname']?></small>
        <?php endif;?>

        <br>
        <label for="email">Email:</label>
        <input class="<?=!empty($errors['email']) ? 'border-danger':'';?>" value="<?= set_value('email')?>" type="email" id="email" name="email" >
        <?php if (!empty($errors['email'])):?>
            <small class="text-danger"><?=$errors['email']?></small>
        <?php endif;?>

        <br>
        <label for="nic">NIC:</label>
        <input class="<?=!empty($errors['nic']) ? 'border-danger':'';?>" value="<?= set_value('nic')?>" type="text" id="nic" name="nic" >
        <?php if (!empty($errors['nic'])):?>
            <small class="text-danger"><?=$errors['nic']?></small>
        <?php endif;?>

        <br>
        <label for="contact_no">Contact Number:</label>
        <input class="<?=!empty($errors['contact_no']) ? 'border-danger':'';?>" value="<?= set_value('contact_no')?>" type="tel" id="contact_no" name="contact_no" >
        <?php if (!empty($errors['contact_no'])):?>
            <small class="text-danger"><?=$errors['contact_no']?></small>
        <?php endif;?>

<!--        <br>-->
<!--        <label for="dob">Date of Birth:</label>-->
<!--        <input class="--><?php //=!empty($errors['dob']) ? 'border-danger':'';?><!--" value="--><?php //= set_value('dob')?><!--" type="date" id="dob" name="dob" >-->
<!--        --><?php //if (!empty($errors['dob'])):?>
<!--            <small class="text-danger">--><?php //=$errors['dob']?><!--</small>-->
<!--        --><?php //endif;?>
<!---->
<!--        <br>-->
<!--        <label for="gender">Gender:</label>-->
<!--        <select class="--><?php //=!empty($errors['gender']) ? 'border-danger':'';?><!--" value="--><?php //= set_value('gender')?><!--" id="gender" name="gender" >-->
<!--            <option value="male">Male</option>-->
<!--            <option value="female">Female</option>-->
<!--            <option value="other">Other</option>-->
<!--            <option value="none">Prefer not to answer</option>-->
<!--        </select>-->
<!--        --><?php //if (!empty($errors['gender'])):?>
<!--            <small class="text-danger">--><?php //=$errors['gender']?><!--</small>-->
<!--        --><?php //endif;?>

        <br>
        <label for="password">Password:</label>
        <input class="<?=!empty($errors['password']) ? 'border-danger':'';?>" value="<?= set_value('password')?>" type="password" id="password" name="password" >
        <?php if (!empty($errors['password'])):?>
            <small class="text-danger"><?=$errors['password']?></small>
        <?php endif;?>

        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input class="<?=!empty($errors['confirm_password']) ? 'border-danger':'';?>" value="<?= set_value('confirm_password')?>" type="password" id="confirm_password" name="confirm_password" >
        <?php if (!empty($errors['confirm_password'])):?>
            <small class="text-danger"><?=$errors['confirm_password']?></small>
        <?php endif;?>

        <br>
        <label>
            <input type="radio" name="acceptance" >
            I accept the <a href="/termsAndConditions" target="_blank">Terms and Conditions</a>
            <?php if (!empty($errors['acceptance'])):?>
                <small class="text-danger"><?=$errors['acceptance']?></small>
            <?php endif;?>
        </label>


        <button type="submit">Register</button>
    </form>
</div>

<!--<script>-->
<!--    function validateForm() {-->
<!--        // You can add more sophisticated validation here if needed-->
<!--        var password = document.getElementById('password').value;-->
<!--        var confirmPassword = document.getElementById('confirm_password').value;-->
<!---->
<!--        if (password !== confirmPassword) {-->
<!--            alert('Passwords do not match.');-->
<!--            return false;-->
<!--        }-->
<!---->
<!--        return true;-->
<!--    }-->
<!--</script>-->
</body>

</html>
