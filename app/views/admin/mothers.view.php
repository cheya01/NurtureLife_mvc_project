<?php $this->view('admin/admin.header', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/mothers.css">

<?php if ($action == 'add'): ?>
    <div class="add_mother_form_container">
        <h2>Add New Mother</h2>
        <form action="" method="post">

            <!--enter nic of the mother-->
            <div class="add_mother_form_row">
                <label for="nic"><b>Mother's NIC No: </b></label>
                <input class="<?= !empty($errors['nic']) ? 'border-danger' : ''; ?>" value="<?= set_value('nic') ?>"
                       type="text" id="nic" name="nic" required>
                <?php if (!empty($errors['nic'])): ?>
                    <small class="text-danger"><?= $errors['nic'] ?></small>
                <?php endif; ?>
            </div>
            <!--        enter clinic id of the mother-->
            <div class="add_mother_form_row">
                <label for="clinic_id"><b>Clinic name: </b></label>
                <select class="<?= !empty($errors['clinic_id']) ? 'border-danger' : ''; ?>" id="clinic_id" name="clinic_id" required <?=(!empty($lock_clinic))?'disabled':'';?>>
                    <option value="" selected="">Clinic Name</option>
                    <?php if (!empty($clinic_names)): ?>
                        <?php foreach ($clinic_names as $name): ?>
                            <option <?=(!empty($lock_clinic)&& $lock_clinic==$name->id)?'selected':'';?>  <?= set_select('clinic_id', $name->id) ?>
                                    value="<?= $name->id ?>"><?= esc($name->name) ?> </option>
                        <?php endforeach; endif; ?>
                </select>
                <?php if (!empty($errors['clinic_id'])): ?>
                    <small class="text-danger"><?= $errors['clinic_id'] ?></small>
                <?php endif; ?>
            </div>
            <!--        enter phm id of the mother-->
            <div class="add_mother_form_row">

                <label for="phm_id"><b>PHM name: </b></label>
                <select class="<?= !empty($errors['phm_id']) ? 'border-danger' : ''; ?>" id="phm_id" name="phm_id" required <?=(!empty($lock_phm))?'disabled':'';?>>
                    <option value="" selected="">PHM Name</option>
                    <?php if (!empty($phm_names)): ?>
                        <?php foreach ($phm_names as $name): ?>
                            <option <?=(!empty($lock_phm)&& $lock_phm==$name->id)?'selected':'';?> <?= set_select('phm_id', $name->id) ?>
                                    value="<?= $name->id ?>"><?= esc($name->firstname.' '.$name->lastname) ?></option>
                        <?php endforeach; endif; ?>
                </select>
                <?php if (!empty($errors['phm_id'])): ?>
                    <small class="text-danger"><?= $errors['phm_id'] ?></small>
                <?php endif; ?>
            </div>
<!--            enter status-->
            <div class="add_mother_form_row">
                <label for="status"><b>Status: </b></label>
                <select id="status" name="status">
                    <option value="1" <?= set_select('status', '1'); ?>>Prenatal</option>
                    <option value="2" <?= set_select('status', '2'); ?>>Postnatal</option>
                    <option value="3" <?= set_select('status', '3'); ?>>Inactive</option>
                </select>
                <?php if (!empty($errors['status'])): ?>
                    <small class="text-danger"><?= $errors['status'] ?></small>
                <?php endif; ?>
            </div>
            <!--//enter Marital status-->
            <div class="add_mother_form_row">
                <label for="maritalStatus"><b>Marital status: </b></label>
                <select id="maritalStatus" name="maritalStatus">
                    <option value="1" <?= set_select('maritalStatus', '1'); ?>>Unmarried (Single Mother)</option>
                    <option value="2" <?= set_select('maritalStatus', '2'); ?>>Married</option>
                    <option value="3" <?= set_select('maritalStatus', '3'); ?>>Divorced</option>
                </select>
                <?php if (!empty($errors['maritalStatus'])): ?>
                    <small class="text-danger"><?= $errors['maritalStatus'] ?></small>
                <?php endif; ?>
            </div>

            <!--//enter Marriage Date-->
            <div class="add_mother_form_row">
                <label for="marriageDate"><b>Date of Marriage:</b></label>
                <input class="<?=!empty($errors['marriageDate']) ? 'border-danger':'';?>" value="<?= set_value('marriageDate')?>" type="date" id="marriageDate" name="marriageDate" required>
                <?php if (!empty($errors['marriageDate'])):?>
                    <small class="text-danger"><?=$errors['marriageDate']?></small>
                <?php endif;?>
            </div>

            <!--//enter blood group-->
            <div class="add_mother_form_row">
                <label for="bloodGroup"><b>Blood Group: </b></label>
                <select id="bloodGroup" name="bloodGroup">
                    <option value="1" <?= set_select('bloodGroup', '1'); ?>>A RhD positive (A+)</option>
                    <option value="2" <?= set_select('bloodGroup', '2'); ?>>A RhD negative (A-)</option>
                    <option value="3" <?= set_select('bloodGroup', '3'); ?>>B RhD positive (B+)</option>
                    <option value="4" <?= set_select('bloodGroup', '4'); ?>>B RhD negative (B-)</option>
                    <option value="5" <?= set_select('bloodGroup', '5'); ?>>O RhD positive (O+)</option>
                    <option value="6" <?= set_select('bloodGroup', '6'); ?>>O RhD negative (O-)</option>
                    <option value="7" <?= set_select('bloodGroup', '7'); ?>>AB RhD positive (AB+)</option>
                    <option value="8" <?= set_select('bloodGroup', '8'); ?>>AB RhD negative (AB-)</option>
                </select>
                <?php if (!empty($errors['bloodGroup'])): ?>
                    <small class="text-danger"><?= $errors['bloodGroup'] ?></small>
                <?php endif; ?>
            </div>

            <!--//enter occupation-->
            <div class="add_mother_form_row">
                <label for="occupation"><b>Occupation:</b></label>
                <input class="<?=!empty($errors['occupation']) ? 'border-danger':'';?>" value="<?= set_value('occupation')?>" type="text" id="occupation" name="occupation" required>
                <?php if (!empty($errors['occupation'])):?>
                    <small class="text-danger"><?=$errors['occupation']?></small>
                <?php endif;?>
            </div>
            <!--//enter GPS location-->
            <div class="add_mother_form_row">
                <label for="gps_location"><b>GPS Location: </b></label>
                <input class="<?=!empty($errors['gps_location']) ? 'border-danger':'';?>" value="<?= set_value('gps_location')?>" type="text" id="gps_location" name="gps_location" required>
                <?php if (!empty($errors['gps_location'])):?>
                    <small class="text-danger"><?=$errors['gps_location']?></small>
                <?php endif;?>
            </div>
            <!--//enter Allergies (optional)-->
            <div class="allergies_form">
                <label><b>Allergies:</b></label>
                <div class="all_allergies_box">
                    <div class="allergy_col">
                        <p class="allergy_type">Food Allergies</p>
                        <div class="single_allergy">
                            <input type="checkbox" id="peanuts" name="allergies[]" value="Peanuts">
                            <label for="peanuts">Peanuts</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="tree_nuts" name="allergies[]" value="Tree Nuts">
                            <label for="tree_nuts">Tree Nuts</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="shellfish" name="allergies[]" value="Shellfish">
                            <label for="shellfish">Shellfish</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="milk" name="allergies[]" value="Milk">
                            <label for="milk">Milk</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="eggs" name="allergies[]" value="Eggs">
                            <label for="eggs">Eggs</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="soy" name="allergies[]" value="Soy">
                            <label for="soy">Soy</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="wheat" name="allergies[]" value="Wheat">
                            <label for="wheat">Wheat</label><br>
                        </div>
                    </div>
                    <div class="allergy_col">
                        <p class="allergy_type">Seasonal Allergies</p>
                        <div class="single_allergy">
                            <input type="checkbox" id="pollen" name="allergies[]" value="Pollen">
                            <label for="pollen">Pollen</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="grass" name="allergies[]" value="Grass">
                            <label for="grass">Grass</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="mold" name="allergies[]" value="Mold">
                            <label for="mold">Mold</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="dust_mites" name="allergies[]" value="Dust mites">
                            <label for="dust_mites">Dust mites</label><br>
                        </div>
                    </div>
                    <div class="allergy_col">
                        <p class="allergy_type">Medication Allergies</p>
                        <div class="single_allergy">
                            <input type="checkbox" id="penicillin" name="allergies[]" value="Penicillin and other antibiotics">
                            <label for="penicillin">Penicillin and other antibiotics</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="NSAIDs" name="allergies[]" value="Non-steroidal anti-inflammatory drugs (NSAIDs)">
                            <label for="NSAIDs">Non-steroidal anti-inflammatory drugs (NSAIDs)</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="aspirin" name="allergies[]" value="Aspirin">
                            <label for="aspirin">Aspirin</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="sulfa_drugs" name="allergies[]" value="Sulfa drugs">
                            <label for="sulfa_drugs">Sulfa drugs</label><br>
                        </div>
                    </div>
                </div>
                <div class="all_allergies_box">
                    <div class="allergy_col">
                        <p class="allergy_type">Skin Allergies</p>
                        <div class="single_allergy">
                            <input type="checkbox" id="latex" name="allergies[]" value="Latex">
                            <label for="latex">Latex</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="metals" name="allergies[]" value="Metals">
                            <label for="metals">Metals</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="fragrances" name="allergies[]" value="Fragrances">
                            <label for="fragrances">Fragrances</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="cosmetics" name="allergies[]" value="cosmetics">
                            <label for="cosmetics">Cosmetics</label><br>
                        </div>
                    </div>
                    <div class="allergy_col">
                        <p class="allergy_type">Insect Sting Allergies</p>
                        <div class="single_allergy">
                            <input type="checkbox" id="bees" name="allergies[]" value="Bees">
                            <label for="bees">Bees</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="wasps" name="allergies[]" value="Wasps">
                            <label for="wasps">Wasps</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="fire_ants" name="allergies[]" value="Fire ants">
                            <label for="fire_ants">Fire ants</label><br>
                        </div>
                    </div>
                    <div class="allergy_col">
                        <p class="allergy_type">Environmental Allergies</p>
                        <div class="single_allergy">
                            <input type="checkbox" id="animal_dander" name="allergies[]" value="Animal dander">
                            <label for="animal_dander">Animal dander</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="pet_hair" name="allergies[]" value="Pet hair">
                            <label for="pet_hair">Pet hair</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="smoke" name="allergies[]" value="Smoke">
                            <label for="smoke">Smoke</label><br>
                        </div>
                        <div class="single_allergy">
                            <input type="checkbox" id="hay_fever" name="allergies[]" value="Hay Fever">
                            <label for="hay_fever">Hay Fever</label><br>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="other_allergies">
                    <p>Other Allergies:</p>
                    <label for="other_allergies"></label><textarea id="other_allergies" name="other_allergies" placeholder="Other allergies"></textarea><br>
                </div>
                <div class="no_allergies">
                    <input type="checkbox" id="no_allergies" name="no_allergies" value="true" onchange="updateNoAllergiesValue(this)">
                    <label for="no_allergies">No Known Allergies</label><br>
                </div>
                <?php if (!empty($errors['allergies'])): ?>
                    <small class="text-danger"><?= $errors['allergies'] ?></small>
                <?php endif; ?>
            </div>
            <script>
                function updateNoAllergiesValue(checkbox) {
                    if (checkbox.checked) {
                        checkbox.value = 'true';
                    } else {
                        checkbox.value = 'false';
                    }
                }
            </script>


            <!--//enter consanguinity-->
            <div class="add_mother_form_row">
                <label for="consanguinity"><b>Consanguinity: </b></label>
                <select id="consanguinity" name="consanguinity">
                    <option value="0" <?= set_select('consanguinity', '0'); ?>>No</option>
                    <option value="1" <?= set_select('consanguinity', '1'); ?>>Yes</option>
                    <option value="2" <?= set_select('consanguinity', '2'); ?>>Prefer not to say</option>
                </select>
                <?php if (!empty($errors['consanguinity'])): ?>
                    <small class="text-danger"><?= $errors['consanguinity'] ?></small>
                <?php endif; ?>
            </div>
            <!--//enter history_of_infertility-->
            <div class="add_mother_form_row">
                <label for="history_of_infertility">History of Infertility: </label>
                <select id="history_of_infertility" name="history_of_infertility">
                    <option value="0" <?= set_select('history_of_infertility', '0'); ?>>No</option>
                    <option value="1" <?= set_select('history_of_infertility', '1'); ?>>Yes</option>
                    <option value="2" <?= set_select('history_of_infertility', '2'); ?>>Prefer not to say</option>
                </select>
                <?php if (!empty($errors['history_of_infertility'])): ?>
                    <small class="text-danger"><?= $errors['history_of_infertility'] ?></small>
                <?php endif; ?>
            </div>
            <!--//enter hypertension-->
            <div class="add_mother_form_row">
                <label for="hypertension">Hypertension: </label>
                <select id="hypertension" name="hypertension">
                    <option value="0" <?= set_select('hypertension', '0'); ?>>No</option>
                    <option value="1" <?= set_select('hypertension', '1'); ?>>Yes</option>
                    <option value="2" <?= set_select('hypertension', '2'); ?>>Prefer not to say</option>
                </select>
                <?php if (!empty($errors['hypertension'])): ?>
                    <small class="text-danger"><?= $errors['hypertension'] ?></small>
                <?php endif; ?>
            </div>
            <!--//enter diabetes_mellitus-->
            <div class="add_mother_form_row">
                <label for="diabetes_mellitus">Diabetes Mellitus: </label>
                <select id="diabetes_mellitus" name="diabetes_mellitus">
                    <option value="0" <?= set_select('diabetes_mellitus', '0'); ?>>No</option>
                    <option value="1" <?= set_select('diabetes_mellitus', '1'); ?>>Yes</option>
                    <option value="2" <?= set_select('diabetes_mellitus', '2'); ?>>Prefer not to say</option>
                </select>
                <?php if (!empty($errors['diabetes_mellitus'])): ?>
                    <small class="text-danger"><?= $errors['diabetes_mellitus'] ?></small>
                <?php endif; ?>
            </div>
            <!--//enter rubella_immunization-->
            <div class="add_mother_form_row">
                <label for="rubella_immunization">Rubella Immunization: </label>
                <select id="rubella_immunization" name="rubella_immunization">
                    <option value="0" <?= set_select('rubella_immunization', '0'); ?>>No</option>
                    <option value="1" <?= set_select('rubella_immunization', '1'); ?>>Yes</option>
                    <option value="2" <?= set_select('rubella_immunization', '2'); ?>>Not sure</option>
                </select>
                <?php if (!empty($errors['rubella_immunization'])): ?>
                    <small class="text-danger"><?= $errors['rubella_immunization'] ?></small>
                <?php endif; ?>
            </div>
            <!--//enter emergency_no -->
            <div class="add_mother_form_row">
                <label for="emergency_no">Emergency Contact No:</label>
                <input class="<?=!empty($errors['emergency_no']) ? 'border-danger':'';?>" value="<?= set_value('emergency_no')?>" type="text" id="emergency_no" name="emergency_no" required>
                <?php if (!empty($errors['emergency_no'])):?>
                    <small class="text-danger"><?=$errors['emergency_no']?></small>
                <?php endif;?>
            </div>

            <!--submit button-->
            <input type="submit" value="Add Mother">
        </form>
    </div>
    <?php if(!empty($fromPHM)):?>
        <?php $rows=$PHM_mothers;?>
        <div class="table_container">
            <table>
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Clinic</th>
                    <th>PHM</th>
                    <th>MOH area</th>
                    <th>Doctor</th>
                    <th>Status</th>
                    <th>Blood Group</th>
                    <th>GPS Location</th>
                    <th>Emergency</th>
                    <th>Created on</th>
                    <th>More</th>
                </tr>
                </thead>
                <?php if (!empty($rows)): ?>
                    <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= esc($row->name_row->id) ?></td>
                            <td><?= esc($row->name_row->name ?? 'unknown') ?></td>
                            <td><?= esc($row->clinic_name_row->name ?? 'unknown') ?></td>
                            <td><?= esc($row->mothers_phm_name_row->name ?? 'unknown') ?></td>
                            <td><?= esc($row->moh_area_row->area ?? 'unknown') ?></td>
                            <td><?= esc($row->mothers_doctor_name_row->name ?? 'unknown') ?></td>
                            <td><?php
                                if ($row->status == 1) {
                                    echo "Prenatal";
                                } elseif ($row->status == 2) {
                                    echo "Postnatal";
                                } else {
                                    echo "Inactive";
                                }
                                ?>
                            </td>
                            <td><?php
                                if (!empty($row->bloodGroup)) {
                                    echo match ($row->bloodGroup) {
                                        1 => "A RhD positive (A+)",
                                        2 => "A RhD negative (A-)",
                                        3 => "B RhD positive (B+)",
                                        4 => "B RhD negative (B-)",
                                        5 => "O RhD positive (O+)",
                                        6 => "O RhD negative (O-)",
                                        7 => "AB RhD positive (AB+)",
                                        8 => "AB RhD negative (AB-)",
                                        default => "Unknown Blood Group",
                                    };
                                } else {
                                    echo "Blood Group not specified";
                                }
                                ?>
                            </td>
                            <td><?= esc($row->gps_location ?? 'unknown') ?></td>
                            <td><?= esc($row->emergency_no) ?></td>
                            <td><?= get_date($row->created_at) ?></td>
                            <td>
                                <a href="<?= ROOT ?>/admin/mothers/edit/<?= $row->id ?>">
                                    <button class="edit_clinic"><img src="<?= ROOT ?>/assets/images/icons/edit.png">
                                    </button>
                                </a>
                                <button onclick="delete_mother(event, <?= $row->id?>)" class="delete_clinic"><img src="<?= ROOT ?>/assets/images/icons/delete.png"></button>
                                <a href="<?= ROOT ?>/admin/mothers/<?= $row->id ?>/babies">
                                    <button class="edit_clinic"><img src="<?= ROOT ?>/assets/images/icons/baby.png">
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php else: ?>
                    <tr>
                        <td colspan="12">No Mothers were found under PHM <?=$fromPHM?>.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

    <?php endif;?>
<?php elseif ($action == 'edit'): ?>
    <?php if (!empty($row)): ?>
        <div class="mother_details_container">
            <h2>Mother Details</h2>
            <div class="mother_details_row">
                User ID: <?= esc($row->name_row->id) ?>
            </div>
            <div class="mother_details_row">
                Name: <?= esc($row->name_row->name) ?>
            </div>
            <div class="mother_details_row">
                Email: <?= esc($row->name_row->email) ?>
            </div>
            <div class="mother_details_row">
                Contact No: <?= esc($row->name_row->contact_no) ?>
            </div>
            <div class="mother_details_row">
                Clinic: <?= esc($row->clinic_name_row->name) ?>
            </div>
            <div class="mother_details_row">
                Midwife: <?= esc($row->mothers_phm_name_row->name) ?>
            </div>
            <div class="mother_details_row">
                Doctor: <?= esc($row->mothers_doctor_name_row->name) ?>
            </div>
            <div class="mother_details_row">
                MOH area: <?= esc($row->moh_area_row->area) ?>
            </div>
            <div class="mother_details_row">
                Status: <?php
                if ($row->status == 1) {
                    echo "Prenatal";
                } elseif ($row->status == 2) {
                    echo "Postnatal";
                } else {
                    echo "Inactive";
                }
                ?>
            </div>
            <div class="mother_details_row">
                Blood Group: <?php
                if (!empty($row->bloodGroup)) {
                    switch ($row->bloodGroup) {
                        case 1:
                            echo "A RhD positive (A+)";
                            break;
                        case 2:
                            echo "A RhD negative (A-)";
                            break;
                        case 3:
                            echo "B RhD positive (B+)";
                            break;
                        case 4:
                            echo "B RhD negative (B-)";
                            break;
                        case 5:
                            echo "O RhD positive (O+)";
                            break;
                        case 6:
                            echo "O RhD negative (O-)";
                            break;
                        case 7:
                            echo "AB RhD positive (AB+)";
                            break;
                        case 8:
                            echo "AB RhD negative (AB-)";
                            break;
                        default:
                            echo "Unknown Blood Group";
                    }
                } else {
                    echo "Blood Group not specified";
                }
                ?>
            </div>
            <div class="mother_details_row">
                Allergies: <?php $allergies=json_decode($row->allergies); foreach ($allergies as $allergy):?>
                <?=$allergy?>&nbsp|
                <?php endforeach;?>
            </div>
            <div class="mother_details_row">
                GPS Location: <a target="_blank" href="<?= esc($row->gps_location) ?>"><?= esc($row->gps_location) ?></a>
            </div>
            <div class="mother_details_row">
                Emergency Contact No: <?= esc($row->emergency_no) ?>
            </div>
            <div class="mother_details_row">
                Created User: <?= esc($row->user_row->name) ?>
            </div>
            <div class="mother_details_row">
                Created On: <?= get_date($row->created_at) ?>
            </div>

        </div>
        <br>
        <h2>Edit Mother Details</h2>
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

                <!--//edit Clinic of the mother-->
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

                <!--//edit MOH area of the mother-->
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
                    <label for="status">Status: </label>
                    <select id="status" name="status">
                        <option value="1" <?= set_select('status', '1', ($row->status == 1)); ?>>Prenatal</option>
                        <option value="2" <?= set_select('status', '2', ($row->status == 2)); ?>>Postnatal</option>
                        <option value="3" <?= set_select('status', '3', ($row->status == 3)); ?>>Inactive</option>
                    </select>
                    <?php if (!empty($errors['status'])): ?>
                        <small class="text-danger"><?= $errors['status'] ?></small>
                    <?php endif; ?>
                </div>
                <br>
                <div class="edit_buttons">
                    <a href="<?= ROOT ?>/admin">
                        <button type="button" class="back_button">Back</button>
                    </a>
                    <a href="<?= ROOT ?>/admin/mothers">
                        <button type="submit" class="save_button">Save Changes</button>
                    </a>

                </div>


            </div>
        </form>
    <?php else: ?>
        <div> That Mother was not found</div>
    <?php endif; ?>
<?php else: ?>
    <br>
    <h2>All Mothers
        <a href="<?= ROOT ?>/admin/mothers/add">
            <button>Add New Mother</button>
        </a>
    </h2>
    <div class="table_container">
        <table>
            <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Clinic</th>
                <th>PHM</th>
                <th>MOH area</th>
                <th>Doctor</th>
                <th>Status</th>
                <th>Blood Group</th>
                <th>GPS Location</th>
                <th>Emergency</th>
                <th>Created on</th>
                <th>More</th>
            </tr>
            </thead>
            <?php if (!empty($rows)): ?>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= esc($row->name_row->id) ?></td>
                        <td><?= esc($row->name_row->name ?? 'unknown') ?></td>
                        <td><?= esc($row->clinic_name_row->name ?? 'unknown') ?></td>
                        <td><?= esc($row->mothers_phm_name_row->name ?? 'unknown') ?></td>
                        <td><?= esc($row->moh_area_row->area ?? 'unknown') ?></td>
                        <td><?= esc($row->mothers_doctor_name_row->name ?? 'unknown') ?></td>
                        <td><?php
                            if ($row->status == 1) {
                                echo "Prenatal";
                            } elseif ($row->status == 2) {
                                echo "Postnatal";
                            } else {
                                echo "Inactive";
                            }
                            ?>
                        </td>
                        <td><?php
                            if (!empty($row->bloodGroup)) {
                                echo match ($row->bloodGroup) {
                                    1 => "A RhD positive (A+)",
                                    2 => "A RhD negative (A-)",
                                    3 => "B RhD positive (B+)",
                                    4 => "B RhD negative (B-)",
                                    5 => "O RhD positive (O+)",
                                    6 => "O RhD negative (O-)",
                                    7 => "AB RhD positive (AB+)",
                                    8 => "AB RhD negative (AB-)",
                                    default => "Unknown Blood Group",
                                };
                            } else {
                                echo "Blood Group not specified";
                            }
                            ?>
                        </td>
                        <td><?= esc($row->gps_location ?? 'unknown') ?></td>
                        <td><?= esc($row->emergency_no) ?></td>
                        <td><?= get_date($row->created_at) ?></td>
                        <td>
                            <a href="<?= ROOT ?>/admin/mothers/edit/<?= $row->id ?>">
                                <button class="edit_clinic"><img src="<?= ROOT ?>/assets/images/icons/edit.png">
                                </button>
                            </a>
                            <button onclick="delete_mother(event, <?= $row->id?>)" class="delete_clinic"><img src="<?= ROOT ?>/assets/images/icons/delete.png"></button>
                            <a href="<?= ROOT ?>/admin/mothers/<?= $row->id ?>/babies">
                                <button class="edit_clinic"><img src="<?= ROOT ?>/assets/images/icons/baby.png">
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            <?php else: ?>
                <tr>
                    <td colspan="12">No mothers found.</td>
                </tr>
            <?php endif; ?>

        </table>

    </div>
<?php endif; ?>

<!--footer-->
<?php $this->view('admin/admin.footer', $data) ?>

<script>
    function delete_mother(event, mother_id){
        const result = confirm("Are you sure to delete this Mother? This action cannot be undone");
        if(result){
            //user clicked OK
            //create a form dynamically
            const form = document.createElement("form");
            form.method = "post";
            form.action = "<?=ROOT?>/admin/mothers/delete"; //use the current URL
            form.style.display = "none"; //hide the form

            //create an input element for doctor id
            const actionInput = document.createElement("input");
            actionInput.type = "hidden";
            actionInput.name = "mother_id";
            actionInput.value = mother_id;

            //append the input element to the form
            form.appendChild(actionInput);

            //append the form to the document body
            document.body.appendChild(form);

            //submit the form
            form.submit();
        }

    }
</script>

