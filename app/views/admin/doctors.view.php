<?php $this->view('admin/admin.header', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/clinics.css">

<?php if ($action == 'add'): ?>
    <div class="add_clinic_form_container">
        <h2>Add New Doctor</h2>
        <form action="" method="post">

            <!--enter user_id of the doctor-->
            <div class="add_clinic_form_row">
                <label for="user_id">Doctors user id: </label>
                <input class="<?= !empty($errors['user_id']) ? 'border-danger' : ''; ?>" value="<?= set_value('user_id') ?>"
                       type="text" id="user_id" name="user_id" required>
                <?php if (!empty($errors['user_id'])): ?>
                    <small class="text-danger"><?= $errors['user_id'] ?></small>
                <?php endif; ?>
            </div>
            <!--enter SLMC Reg no of the doctor-->
            <div class="add_clinic_form_row">
                <label for="SLMC_no">SLMC Reg no: </label>
                <input class="<?= !empty($errors['SLMC_no']) ? 'border-danger' : ''; ?>"
                       value="<?= set_value('SLMC_no') ?>" type="text" id="SLMC_no" name="SLMC_no" required>
                <?php if (!empty($errors['SLMC_no'])): ?>
                    <small class="text-danger"><?= $errors['SLMC_no'] ?></small>
                <?php endif; ?>
            </div>

<!--        enter clinic id of the doctor-->
            <div class="add_clinic_form_row">
                <label for="clinic_id">Clinic name: </label>
                <select class="<?= !empty($errors['clinic_id']) ? 'border-danger' : ''; ?>" id="clinic_id" name="clinic_id" required>
                    <option value="" selected="">Clinic Name</option>
                    <?php if (!empty($clinic_names)): ?>
                        <?php foreach ($clinic_names as $name): ?>
                            <option <?= set_select('clinic_id', $name->id) ?>
                                value="<?= $name->id ?>"><?= esc($name->name) ?></option>
                        <?php endforeach; endif; ?>
                </select>
                <?php if (!empty($errors['clinic_id'])): ?>
                    <small class="text-danger"><?= $errors['clinic_id'] ?></small>
                <?php endif; ?>
            </div>
            <!--enter moh_area_id of the doctor-->
            <div class="add_clinic_form_row">
                <label for="moh_area_id">MOH area: </label>
                <select class="<?= !empty($errors['moh_area_id']) ? 'border-danger' : ''; ?>" id="moh_area_id" name="moh_area_id" required>
                    <option value="" selected="">MOH area</option>
                    <?php if (!empty($moh_areas)): ?>
                        <?php foreach ($moh_areas as $area): ?>
                            <option <?= set_select('moh_area_id', $area->id) ?>
                                value="<?= $area->id ?>"><?= esc($area->area) ?></option>
                        <?php endforeach; endif; ?>
                </select>
                <?php if (!empty($errors['moh_area_id'])): ?>
                    <small class="text-danger"><?= $errors['moh_area_id'] ?></small>
                <?php endif; ?>
            </div>

            <!--enter special_id of the doctor-->
            <div class="add_clinic_form_row">
                <label for="special_id">Speciality: </label>
                <select class="<?= !empty($errors['special_id']) ? 'border-danger' : ''; ?>" id="special_id" name="special_id" required>
                    <option value="" selected="">Doctors Special</option>
                    <?php if (!empty($doctor_specials)): ?>
                        <?php foreach ($doctor_specials as $special): ?>
                            <option <?= set_select('special_id', $special->id) ?>
                                value="<?= $special->id ?>"><?= esc($special->special) ?></option>
                        <?php endforeach; endif; ?>
                </select>
                <?php if (!empty($errors['special_id'])): ?>
                    <small class="text-danger"><?= $errors['special_id'] ?></small>
                <?php endif; ?>
            </div>


            <!--submit button-->
            <input type="submit" value="Add Doctor">
        </form>
    </div>

<?php elseif ($action == 'edit'): ?>
    <?php if (!empty($row)): ?>
        <div class="user_details_container">
            <h2>Doctor Details</h2>
            <div class="user_details_row">
                User ID: <?= esc($row->name_row->id) ?>
            </div>
            <div class="user_details_row">
                Name: <?= esc($row->name_row->name) ?>
            </div>
            <div class="user_details_row">
                Email - <?= esc($row->name_row->email) ?>
            </div>
            <div class="user_details_row">
                SLMC Reg No: <?= esc($row->SLMC_no) ?>
            </div>
            <div class="user_details_row">
                Speciality: <?= esc($row->doctor_special_row->special) ?>
            </div>
            <div class="user_details_row">
                Contact No - <?= esc($row->name_row->contact_no) ?>
            </div>
            <div class="user_details_row">
                Clinic: <?= esc($row->clinic_name_row->name) ?>
            </div>
            <div class="user_details_row">
                MOH Area: <?= esc($row->moh_area_row->area) ?>
            </div>
            <div class="user_details_row">
                Created User: <?= esc($row->user_row->name) ?>
            </div>
            <div class="user_details_row">
                Created On: <?= get_date($row->created_at) ?>
            </div>
            <div class="user_details_row">
                Status: <?php if($row->active == 1) echo "Active"; else echo "Inactive";?>
            </div>

        </div>
        <br>
        <h2>Edit Doctor Details</h2>
        <form method="post">
            <div class="edit_profile_container">

                <!--//edit firstname-->
                <div class="edit_profile_row">
                    <label>First Name: </label>
                    <label>
                        <input name="firstname" type="text" value="<?= set_value('firstname', $row->name_row->firstname) ?>">
                    </label>
                    <?php if (!empty($errors['firstname'])): ?>
                        <small class="text-danger"><?= $errors['firstname'] ?></small>
                    <?php endif; ?>
                </div>

                <!--//edit lastname-->
                <div class="edit_profile_row">
                    <label>Last Name: </label>
                    <label>
                        <input name="lastname" type="text" value="<?= set_value('lastname', $row->name_row->lastname) ?>">
                    </label>
                    <?php if (!empty($errors['lastname'])): ?>
                        <small class="text-danger"><?= $errors['lastname'] ?></small>
                    <?php endif; ?>
                </div>

                <!--//edit Clinic of the doctor-->
                <div class="edit_profile_row">
                    <label for="clinic_id">Clinic: </label>
                    <select class="<?= !empty($errors['clinic_id']) ? 'border-danger' : ''; ?>" id="clinic_id"
                            name="clinic_id" required>
                        <option value="" selected="">Clinic</option>
                        <?php if (!empty($clinic_names)): ?>
                            <?php foreach ($clinic_names as $name): ?>
                                <option <?= set_select('clinic_id', $name->id) ?>
                                        value="<?= $name->id ?>"><?= esc($name->name) ?></option>
                            <?php endforeach; endif; ?>
                    </select>
                    <?php if (!empty($errors['clinic_id'])): ?>
                        <small class="text-danger"><?= $errors['clinic_id'] ?></small>
                    <?php endif; ?>
                </div>

                <!--//edit MOH area of the doctor-->
                <div class="edit_profile_row">
                    <label for="moh_area_id">MOH area: </label>
                    <select class="<?= !empty($errors['moh_area_id']) ? 'border-danger' : ''; ?>" id="moh_area_id"
                            name="moh_area_id" required>
                        <option value="" selected="">MOH area</option>
                        <?php if (!empty($moh_areas)): ?>
                            <?php foreach ($moh_areas as $area): ?>
                                <option <?= set_select('moh_area_id', $area->id) ?>
                                        value="<?= $area->id ?>"><?= esc($area->area) ?></option>
                            <?php endforeach; endif; ?>
                    </select>
                    <?php if (!empty($errors['moh_area_id'])): ?>
                        <small class="text-danger"><?= $errors['moh_area_id'] ?></small>
                    <?php endif; ?>
                </div>

                <!--//edit status-->
                <div class="edit_profile_row">
                    <label for="active">Status: </label>
                    <select id="active" name="active">
                        <option value="1" <?= set_select('active', '1', ($row->active == 1)); ?>>Active</option>
                        <option value="0" <?= set_select('active', '0', ($row->active == 0)); ?>>Inactive</option>
                    </select>
                    <?php if (!empty($errors['active'])): ?>
                        <small class="text-danger"><?= $errors['active'] ?></small>
                    <?php endif; ?>
                </div>
                <br>
                <div class="edit_buttons">
                    <a href="<?= ROOT ?>/admin">
                        <button type="button" class="back_button">Back</button>
                    </a>
                    <a href="<?= ROOT ?>/admin/doctors">
                        <button type="submit" class="save_button">Save Changes</button>
                    </a>

                </div>


            </div>
        </form>
    <?php else: ?>
        <div> That Doctor was not found</div>
    <?php endif; ?>
<?php else: ?>
    <br>
    <h2>All Doctors
        <a href="<?= ROOT ?>/admin/doctors/add">
            <button>Add New Doctor</button>
        </a>
    </h2>
    <div class="table_container">
        <table>
            <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>SLMC Reg no.</th>
                <th>Email</th>
                <th>Clinic</th>
                <th>MOH area</th>
                <th>Speciality</th>
                <th>Created Admin</th>
                <th>Created on</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <?php if (!empty($rows)): ?>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= esc($row->name_row->id) ?></td>
                        <td><?= esc($row->name_row->name ?? 'unknown') ?></td>
                        <td><?= esc($row->SLMC_no) ?></td>
                        <td><?= esc($row->name_row->email ?? 'unknown') ?></td>
                        <td><?= esc($row->clinic_name_row->name ?? 'unknown') ?></td>
                        <td><?= esc($row->moh_area_row->area ?? 'unknown') ?></td>
                        <td><?= esc($row->doctor_special_row->special ?? 'unknown') ?></td>
                        <td><?= esc($row->user_row->name ?? 'unknown') ?></td>
                        <td><?= get_date($row->created_at) ?></td>
                        <td><?= esc($row->active) ?></td>
                        <td>
                            <a href="<?= ROOT ?>/admin/doctors/edit/<?= $row->id ?>">
                                <button class="edit_clinic"><img src="<?= ROOT ?>/assets/images/icons/edit.png">
                                </button>
                            </a>

                            <button onclick="delete_doctor(event, <?= $row->id?>)" class="delete_clinic"><img src="<?= ROOT ?>/assets/images/icons/delete.png"></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            <?php else: ?>
                <tr>
                    <td colspan="12">No doctors found.</td>
                </tr>
            <?php endif; ?>

        </table>

    </div>
<?php endif; ?>

<!--footer-->
<?php $this->view('admin/admin.footer', $data) ?>

<script>
    function delete_doctor(event, doctor_id){
        const result = confirm("Are you sure to delete this doctor? This action cannot be undone");
        if(result){
            //user clicked OK
            //create a form dynamically
            const form = document.createElement("form");
            form.method = "post";
            form.action = "<?=ROOT?>/admin/doctors/delete"; //use the current URL
            form.style.display = "none"; //hide the form

            //create an input element for doctor id
            const actionInput = document.createElement("input");
            actionInput.type = "hidden";
            actionInput.name = "doctor_id";
            actionInput.value = doctor_id;

            //append the input element to the form
            form.appendChild(actionInput);

            //append the form to the document body
            document.body.appendChild(form);

            //submit the form
            form.submit();
        }

    }
</script>

