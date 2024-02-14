<?php $this->view('admin/admin.header', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/clinics.css">

<?php if ($action == 'add'): ?>
    <div class="add_clinic_form_container">
        <h2>Add New Clinic</h2>
        <form action="" method="post">

            <!--enter name of the clinic-->
            <div class="add_clinic_form_row">
                <label for="name">Clinic Name: </label>
                <input class="<?= !empty($errors['name']) ? 'border-danger' : ''; ?>" value="<?= set_value('name') ?>"
                       type="text" id="name" name="name" required>
                <?php if (!empty($errors['name'])): ?>
                    <small class="text-danger"><?= $errors['name'] ?></small>
                <?php endif; ?>
            </div>
            <!--enter address of the clinic-->
            <div class="add_clinic_form_row">
                <label for="address">Address: </label>
                <input class="<?= !empty($errors['address']) ? 'border-danger' : ''; ?>"
                       value="<?= set_value('address') ?>" type="text" id="address" name="address" required>
                <?php if (!empty($errors['address'])): ?>
                    <small class="text-danger"><?= $errors['address'] ?></small>
                <?php endif; ?>
            </div>
            <!--enter moh area of the clinic-->
            <div class="add_clinic_form_row">
                <label for="moh_area_id">MOH Area: </label>
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

            <!--enter contact number of the clinic-->
            <div class="add_clinic_form_row">
                <label for="contact_no">Contact Number: </label>
                <input class="<?= !empty($errors['contact_no']) ? 'border-danger' : ''; ?>"
                       value="<?= set_value('contact_no') ?>" type="text" id="contact_no" name="contact_no" required>
                <?php if (!empty($errors['contact_no'])): ?>
                    <small class="text-danger"><?= $errors['contact_no'] ?></small>
                <?php endif; ?>
            </div>

            <!--enter capacity of the clinic-->
            <div class="add_clinic_form_row">
                <label for="capacity">Capacity: </label>
                <input class="<?= !empty($errors['capacity']) ? 'border-danger' : ''; ?>"
                       value="<?= set_value('capacity') ?>" type="text" id="capacity" name="capacity" required>
                <?php if (!empty($errors['capacity'])): ?>
                    <small class="text-danger"><?= $errors['capacity'] ?></small>
                <?php endif; ?>
            </div>
            <!--enter GPS location link of the clinic-->
            <div class="add_clinic_form_row">
                <label for="gps_location">GPS Location: </label>
                <input class="<?= !empty($errors['gps_location']) ? 'border-danger' : ''; ?>"
                       value="<?= set_value('gps_location') ?>" type="text" id="gps_location" name="gps_location"
                       required>
                <?php if (!empty($errors['gps_location'])): ?>
                    <small class="text-danger"><?= $errors['gps_location'] ?></small>
                <?php endif; ?>
            </div>

            <!--enter clinic type-->
            <div class="add_clinic_form_row">
                <label for="type_id">Clinic Type: </label>
                <select class="<?= !empty($errors['type_id']) ? 'border-danger' : ''; ?>" id="type_id" name="type_id"
                        required>
                    <option value="" selected="">Clinic Type</option>
                    <?php if (!empty($clinic_types)): ?>
                        <?php foreach ($clinic_types as $type): ?>
                            <option <?= set_select('type_id', $type->id) ?>
                                    value="<?= $type->id ?>"><?= esc($type->type) ?></option>
                        <?php endforeach; endif; ?>
                </select>
                <?php if (!empty($errors['type'])): ?>
                    <small class="text-danger"><?= $errors['type'] ?></small>
                <?php endif; ?>
            </div>
            <!--submit button-->
            <input type="submit" value="Add Clinic">
        </form>
    </div>

<?php elseif ($action == 'edit'): ?>
    <?php if (!empty($row)): ?>
        <div class="user_details_container">
            <h2>Clinic Details</h2>
            <div class="user_details_row">
                Clinic ID:  - <?= esc($row->id) ?>
            </div>
            <div class="user_details_row">
                Name: <?= esc($row->name) ?>
            </div>
            <div class="user_details_row">
                Address: <?= esc($row->address) ?>
            </div>
            <div class="user_details_row">
                Location: <?= esc($row->gps_location) ?>
            </div>
            <div class="user_details_row">
                MOH Area: <?= esc($row->moh_area_row->area) ?>
            </div>
            <div class="user_details_row">
                Clinic Type: <?= esc($row->type_row->type) ?>
            </div>
            <div class="user_details_row">
                Created on: <?= get_date($row->created_at) ?>
            </div>
            <div class="user_details_row">
                Contact No: <?= esc($row->contact_no) ?>
            </div>
            <div class="user_details_row">
                Maximum Operational Capacity: <?= esc($row->capacity) ?>
            </div>
            <div class="user_details_row">
                Created user: <?= esc($row->user_row->name) ?>
            </div>
            <div class="user_details_row">
                Status: <?php if($row->active == 1) echo "Active"; else echo "Inactive";?>
            </div>

        </div>
        <h2>Edit Clinic Details</h2>
        <form method="post">
            <div class="edit_profile_container">

                <!--//edit clinic name-->
                <div class="edit_profile_row">
                    <label>Clinic Name</label>
                    <label>
                        <input name="name" type="text" value="<?= set_value('name', $row->name) ?>">
                    </label>
                    <?php if (!empty($errors['name'])): ?>
                        <small class="text-danger"><?= $errors['name'] ?></small>
                    <?php endif; ?>
                </div>

                <!--//edit address-->
                <div class="edit_profile_row">
                    <label>Address</label>
                    <label>
                        <input name="address" type="text" value="<?= set_value('address', $row->address) ?>">
                    </label>
                    <?php if (!empty($errors['address'])): ?>
                        <small class="text-danger"><?= $errors['address'] ?></small>
                    <?php endif; ?>
                </div>

                <!--//edit GPS location-->
                <div class="edit_profile_row">
                    <label>Location: </label>
                    <label>
                        <input name="gps_location" type="text" value="<?= set_value('gps_location', $row->gps_location) ?>">
                    </label>
                    <?php if (!empty($errors['gps_location'])): ?>
                        <small class="text-danger"><?= $errors['gps_location'] ?></small>
                    <?php endif; ?>
                </div>

                <!--//edit MOH area-->
                <div class="edit_profile_row">
                    <label for="moh_area_id">MOH Area: </label>
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
                <!--//edit Clinic Type-->
                <div class="edit_profile_row">
                    <label for="type_id">Clinic Type: </label>
                    <select class="<?= !empty($errors['type_id']) ? 'border-danger' : ''; ?>" id="type_id"
                            name="type_id" required>
                        <option value="" selected="">Clinic Type</option>
                        <?php if (!empty($clinic_types)): ?>
                            <?php foreach ($clinic_types as $type): ?>
                                <option <?= set_select('type_id', $type->id) ?>
                                        value="<?= $type->id ?>"><?= esc($type->type) ?></option>
                            <?php endforeach; endif; ?>
                    </select>
                    <?php if (!empty($errors['type_id'])): ?>
                        <small class="text-danger"><?= $errors['type_id'] ?></small>
                    <?php endif; ?>
                </div>

                <!--//edit contact no-->
                <div class="edit_profile_row">
                    <label>Contact No: </label>
                    <label>
                        <input name="contact_no" type="text" value="<?= set_value('contact_no', $row->contact_no) ?>">
                    </label>
                    <?php if (!empty($errors['contact_no'])): ?>
                        <small class="text-danger"><?= $errors['contact_no'] ?></small>
                    <?php endif; ?>
                </div>

                <!--//edit capacity-->
                <div class="edit_profile_row">
                    <label>Capacity: </label>
                    <label>
                        <input name="capacity" type="text" value="<?= set_value('capacity', $row->capacity) ?>">
                    </label>
                    <?php if (!empty($errors['capacity'])): ?>
                        <small class="text-danger"><?= $errors['capacity'] ?></small>
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
                    <button type="submit" class="save_button">Save Changes</button>
                </div>


            </div>
        </form>
    <?php else: ?>
        <div> That Clinic was not found</div>
    <?php endif; ?>
<?php else: ?>
    <br>
    <h2>All Clinics
        <a href="<?= ROOT ?>/admin/clinics/add">
            <button>Add New Clinic</button>
        </a>
    </h2>
    <div class="table_container">
        <table>
            <thead>
            <tr>
                <th>Clinic ID</th>
                <th>Clinic Name</th>
                <th>Address</th>
                <th>Contact No.
                <th>Capacity</th>
                <th>GPS Location</th>
                <th>Type</th>
                <th>MOH Area</th>
                <th>Created user</th>
                <th>Created on</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <?php if (!empty($rows)): ?>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= esc($row->id) ?></td>
                        <td><?= esc($row->name) ?></td>
                        <td><?= esc($row->address) ?></td>
                        <td><?= esc($row->contact_no) ?></td>
                        <td><?= esc($row->capacity) ?></td>
                        <td>
                            <a href="<?= esc($row->gps_location) ?>" target="_blank">
                                <?= esc($row->gps_location) ?>
                            </a>
                        </td>
                        <td><?= esc($row->type_row->type ?? 'unknown') ?></td>
                        <td><?= esc($row->moh_area_row->area ?? 'unknown') ?></td>
                        <td><?= esc($row->user_row->name ?? 'unknown') ?></td>
                        <td><?= get_date($row->created_at) ?></td>
                        <td><?= esc($row->active) ?></td>
                        <td>
                            <a href="<?= ROOT ?>/admin/clinics/edit/<?= $row->id ?>">
                                <button class="edit_clinic"><img src="<?= ROOT ?>/assets/images/icons/edit.png">
                                </button>
                            </a>

                            <button onclick="delete_clinic(event, <?= $row->id?>)" class="delete_clinic"><img src="<?= ROOT ?>/assets/images/icons/delete.png"></button>
                            <a href="<?= ROOT ?>/admin/clinics/addPHM/<?= $row->id ?>">
                                <button class="edit_clinic"><img src="<?= ROOT ?>/assets/images/icons/nurse.png">
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            <?php else: ?>
                <tr>
                    <td colspan="12">No clinics found.</td>
                </tr>
            <?php endif; ?>

        </table>

    </div>
<?php endif; ?>

<!--footer-->
<?php $this->view('admin/admin.footer', $data) ?>
<script>
    function delete_clinic(event, clinic_id){
        var result = confirm("Are you sure to delete this clinic? This action cannot be undone");
        if(result){
            //user clicked OK
            //create a form dynamically
            const form = document.createElement("form");
            form.method = "post";
            form.action = "<?=ROOT?>/admin/clinics/delete"; //use the current URL
            form.style.display = "none"; //hide the form

            //create an input element for clinic id
            const actionInput = document.createElement("input");
            actionInput.type = "hidden";
            actionInput.name = "clinic_id";
            actionInput.value = clinic_id;

            //append the input element to the form
            form.appendChild(actionInput);

            //append the form to the document body
            document.body.appendChild(form);

            //submit the form
            form.submit();
        }

    }
</script>

