<?php $this->view('admin/admin.header', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/clinics.css">

<?php if ($action == 'edit'): ?>
    <?php if (!empty($row)): ?>
<div class="user_details_container">
    <h2>User Details</h2>
    <div class="user_details_row">
        User ID - <?= esc($row->id) ?>
    </div>
    <div class="user_details_row">
        First Name - <?= esc($row->firstname) ?>
    </div>
    <div class="user_details_row">
        Last Name - <?= esc($row->lastname) ?>
    </div>
    <div class="user_details_row">
        Email address - <?= esc($row->email) ?>
    </div>
    <div class="user_details_row">
        NIC No. - <?= esc($row->nic) ?>
    </div>
    <div class="user_details_row">
        Created At - <?= esc($row->created_at) ?>
    </div>
    <div class="user_details_row">
        Contact No. - <?= esc($row->contact_no) ?>
    </div>
    <div class="user_details_row">
        Date of Birth - <?= esc($row->dob) ?>
    </div>
    <div class="user_details_row">
        Gender - <?= esc($row->gender) ?>
    </div>
    <div class="user_details_row">
        Role ID - <?= esc($row->role_id) ?>
    </div>
    <div class="user_details_row">
        Status - <?= esc($row->status) ?>
    </div>
</div>
<br>
<h2>Edit User Details</h2>
<form method="post">
    <div class="edit_profile_container">

        <!--//edit firstname-->
        <div class="edit_profile_row">
            <label>Firstname: </label>
            <label>
                <input name="firstname" type="text" value="<?= set_value('fistname', $row->firstname) ?>">
            </label>
            <?php if (!empty($errors['firstname'])): ?>
            <small class="text-danger"><?= $errors['firstname'] ?></small>
            <?php endif; ?>
        </div>

        <!--//edit lastname-->
        <div class="edit_profile_row">
            <label>Lastname: </label>
            <label>
                <input name="lastname" type="text" value="<?= set_value('lastname', $row->lastname) ?>">
            </label>
            <?php if (!empty($errors['lastname'])): ?>
            <small class="text-danger"><?= $errors['lastname'] ?></small>
            <?php endif; ?>
        </div>

        <!--//edit email address-->
        <div class="edit_profile_row">
            <label>Email: </label>
            <label>
                <input name="email" type="text" value="<?= set_value('email', $row->email) ?>">
            </label>
            <?php if (!empty($errors['email'])): ?>
            <small class="text-danger"><?= $errors['email'] ?></small>
            <?php endif; ?>
        </div>

        <!--//edit contact number-->
        <div class="edit_profile_row">
            <label>Contact No.</label>
            <label>
                <input name="contact_no" type="text" value="<?= set_value('contact_no', $row->contact_no) ?>">
            </label>
            <?php if (!empty($errors['contact_no'])): ?>
            <small class="text-danger"><?= $errors['contact_no'] ?></small>
            <?php endif; ?>
        </div>

        <!--//edit date of birth-->
        <div class="edit_profile_row">
            <label>Date of birth: </label>
            <label>
                <input name="dob" type="date" value="<?= set_value('dob', $row->dob) ?>">
            </label>
            <?php if (!empty($errors['dob'])): ?>
            <small class="text-danger"><?= $errors['dob'] ?></small>
            <?php endif; ?>
        </div>

        <!--//edit NIC No.-->
        <div class="edit_profile_row">
            <label>NIC No. : </label>
            <label>
                <input name="nic" type="text" value="<?= set_value('nic', $row->nic) ?>">
            </label>
            <?php if (!empty($errors['nic'])): ?>
                <small class="text-danger"><?= $errors['nic'] ?></small>
            <?php endif; ?>
        </div>

        <!--//edit status-->
        <div class="edit_profile_row">
            <label>User Status: </label>
            <label>
                <input name="status" type="text" value="<?= set_value('status', $row->status) ?>">
            </label>
            <?php if (!empty($errors['status'])): ?>
                <small class="text-danger"><?= $errors['status'] ?></small>
            <?php endif; ?>
        </div>

        <!--//edit Role id-->
        <div class="edit_profile_row">
            <label>Role ID: </label>
            <label>
                <input name="role_id" type="text" value="<?= set_value('role_id', $row->role_id) ?>">
            </label>
            <?php if (!empty($errors['role_id'])): ?>
                <small class="text-danger"><?= $errors['role_id'] ?></small>
            <?php endif; ?>
        </div>
        <br>
        <div class="edit_buttons">
            <a href="<?= ROOT ?>/admin/all_users">
                <button type="button" class="back_button">Back</button>
            </a>
            <a href="<?= ROOT ?>/admin/all_users">
                <button type="submit" class="save_button">Save Changes</button>
            </a>
        </div>
    </form>
    <?php else: ?>
        <div> That User was not found</div>
    <?php endif; ?>
<?php else: ?>
    <br>
    <div class="table_container">
        <table>
            <thead>
            <tr>
                <th>User ID</th>
                <th>Fist Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>NIC No.</th>
                <th>Created At</th>
                <th>Contact No.</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Role ID</th>
                <th>Actions</th>
            </tr>
            </thead>
            <?php if (!empty($rows)): ?>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= esc($row->id ?? 'unknown') ?></td>
                        <td><?= esc($row->firstname) ?></td>
                        <td><?= esc($row->lastname) ?></td>
                        <td><?= esc($row->email ?? 'unknown') ?></td>
                        <td><?= esc($row->nic ?? 'unknown') ?></td>
                        <td><?= get_date($row->created_at) ?></td>
                        <td><?= esc($row->contact_no ?? 'unknown') ?></td>
                        <td><?= get_date($row->dob) ?></td>
                        <td><?= esc($row->gender) ?></td>
                        <td><?= esc($row->role_id) ?></td>
                        <td>
                            <a href="<?= ROOT ?>/admin/all_users/edit/<?= $row->id ?>">
                                <button class="edit_clinic"><img src="<?= ROOT ?>/assets/images/icons/edit.png">
                                </button>
                            </a>

                            <button onclick="delete_user(event, <?= $row->id?>)" class="delete_clinic"><img src="<?= ROOT ?>/assets/images/icons/delete.png"></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            <?php else: ?>
                <tr>
                    <td colspan="12">No Users found.</td>
                </tr>
            <?php endif; ?>

        </table>

    </div>
<?php endif; ?>

<!--footer-->
<?php $this->view('admin/admin.footer', $data) ?>
<script>
    function delete_user(event, user_id){
        const result = confirm("Are you sure to delete this user? This action cannot be undone");
        if(result){
            //user clicked OK
            //create a form dynamically
            const form = document.createElement("form");
            form.method = "post";
            form.action = "<?=ROOT?>/admin/all_users/delete"; //use the current URL
            form.style.display = "none"; //hide the form

            //create an input element for clinic id
            const actionInput = document.createElement("input");
            actionInput.type = "hidden";
            actionInput.name = "user_id";
            actionInput.value = user_id;

            //append the input element to the form
            form.appendChild(actionInput);

            //append the form to the document body
            document.body.appendChild(form);

            //submit the form
            form.submit();
        }

    }
</script>
