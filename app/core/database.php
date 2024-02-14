<?php

class Database
{
    private function connect(): PDO
    {
        $str = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
        return new PDO($str, DBUSER, DBPASS);
    }

    public function query($query, $data = [], $type = 'object'): false|array
    {
        $con = $this->connect();
        $stm = $con->prepare($query);
        if($stm){
            $check = $stm->execute($data);
            if($check){
                if($type == 'object'){
                    $type = PDO::FETCH_OBJ;
                }else{
                    $type = PDO::FETCH_ASSOC;
                }
                $result = $stm->fetchAll($type);

                if(is_array($result) && count($result) > 0){
                    return $result;
                }
            }
        }
        return false;
    }
    public function create_tables(): void
    {

        //roles table
        $query = "
            CREATE TABLE IF NOT EXISTS roles (
            id INT not null PRIMARY KEY AUTO_INCREMENT,
            role varchar(255) not null    
        ) ENGINE=INNODB
        ";
        $this->query($query);

        //user_roles table
        $query = "
            CREATE TABLE IF NOT EXISTS user_roles (
            user_id INT,
            role_id INT,
            PRIMARY KEY (user_id, role_id),
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (role_id) REFERENCES roles(id)
        )ENGINE=INNODB
        ";

        //clinic_types table
        $query = "
            CREATE TABLE IF NOT EXISTS clinic_types (
            id INT not null PRIMARY KEY AUTO_INCREMENT,
            type varchar(255) not null,
            active TINYINT default 1
        ) ENGINE=INNODB
        ";
        $this->query($query);

        //doctor_specials table
        $query = "
            CREATE TABLE IF NOT EXISTS doctor_specials (
            id INT not null PRIMARY KEY AUTO_INCREMENT,
            special varchar(255) not null
        ) ENGINE=INNODB
        ";
        $this->query($query);

        //insert values into doctor_specials
//        $query = "
//            INSERT IGNORE INTO doctor_specials (id, special) VALUES (null, 'Obstetrician');
//            INSERT IGNORE INTO doctor_specials (id, special) VALUES (null, 'Gynecologist');
//            INSERT IGNORE INTO doctor_specials (id, special) VALUES (null, 'Pediatrician');
//            INSERT IGNORE INTO doctor_specials (id, special) VALUES (null, 'Neonatologist');
//            INSERT IGNORE INTO doctor_specials (id, special) VALUES (null, 'Perinatologist');
//            INSERT IGNORE INTO doctor_specials (id, special) VALUES (null, 'MO');
//        ";
//        $this->query($query);

        //MOH_areas table
        $query = "
            CREATE TABLE IF NOT EXISTS MOH_areas (
            id INT not null PRIMARY KEY AUTO_INCREMENT,
            area varchar(255) not null    
        ) ENGINE=INNODB
        ";
        $this->query($query);

       //insert dummy values into MOH_areas for testing purposes
//        $query = "
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Ampara');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Damana');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Lahugala');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Mahaoya');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Padiyathalawa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Uhana');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Galinbidinuwewa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Galnewa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Horowpothana');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Ipalogama');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Kahatagasdigililiya');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Kebithigollewa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Kekirawa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Madawachchiya');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Mihintale');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Nochchiyagama');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Nuwaragam Palatha - Central');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Nuwaragam Palatha - East');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Padaviya');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Palagala');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Rambewa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Akurana');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Bambaradeniya');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Doluwa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Galagedara');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Harispattuwa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Hasalaka');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Hatharaliyadda');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Agalawatta');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Bandaragama');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Bulathsinhala');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Horana');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Kalutara');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Madurawala');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Mathugama');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Palindanuwara');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Panadura');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Aranayake');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Bulathkohupitiya');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Dehiovita');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Deraniyagala');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Galigamuwa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Kegalle');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Mawanella');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Rambukkana');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Kilinochchi');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Pallai');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Poonakary');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Alauwa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Bingiriya');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Galgamuwa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Ganewatta');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Giribawa');
//            INSERT IGNORE INTO MOH_areas (id, area) VALUES (null, 'Ibbagamuwa');
//        ";
//        $this->query($query);

        //insert values into roles
//        $query = "
//            INSERT IGNORE INTO roles (id, role) VALUES (null, 'user');
//            INSERT IGNORE INTO roles (id, role) VALUES (null, 'admin');
//            INSERT IGNORE INTO roles (id, role) VALUES (null, 'doctor');
//            INSERT IGNORE INTO roles (id, role) VALUES (null, 'mother');
//            INSERT IGNORE INTO roles (id, role) VALUES (null, 'midwife');
//        ";
//        $this->query($query);

        //insert values into clinic types
//        $query = "
//            INSERT IGNORE INTO clinic_types (id, type) VALUES (null, 'Antenatal');
//            INSERT IGNORE INTO clinic_types (id, type) VALUES (null, 'Postnatal');
//            INSERT IGNORE INTO clinic_types (id, type) VALUES (null, 'Well Baby');
//            INSERT IGNORE INTO clinic_types (id, type) VALUES (null, 'Well Woman');
//            INSERT IGNORE INTO clinic_types (id, type) VALUES (null, 'Family Planning');
//        ";
//        $this->query($query);

        //users table
        $query = "
            CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            nic VARCHAR(15) NOT NULL,
            status TINYINT NOT NULL default 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            password VARCHAR(512) NOT NULL,
            contact_no varchar(255),
            dob date,
            gender varchar(255),
            role_id INT NOT NULL default 1,
            FOREIGN KEY (role_id) REFERENCES roles(id),
            KEY email (email),
            KEY created_at (created_at)
            ) ENGINE=INNODB
            ";
        $this->query($query);

        //clinic table
        $query = "CREATE TABLE IF NOT EXISTS clinics (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            address VARCHAR(255) NOT NULL,
            created_at DATE,
            contact_no VARCHAR(255),
            capacity INT,
            gps_location VARCHAR(1000),
            type_id INT,
            moh_area_id INT,
            created_user_id INT,
            active TINYINT default 1,
            FOREIGN KEY (created_user_id) REFERENCES users(id),
            FOREIGN KEY (type_id) REFERENCES clinic_types(id),
            FOREIGN KEY (moh_area_id) REFERENCES MOH_areas(id)
        ) ENGINE=INNODB;";

        $this->query($query);

        //doctors table
        $query = "CREATE TABLE IF NOT EXISTS doctors (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                SLMC_no VARCHAR(255) NOT NULL,
                clinic_id INT,
                moh_area_id INT,
                special_id INT,
                created_user_id INT,
                created_at DATE,
                active TINYINT default 1,
                FOREIGN KEY (special_id) REFERENCES doctor_specials(id),
                FOREIGN KEY (created_user_id) REFERENCES users(id),
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (clinic_id) REFERENCES clinics(id),
                FOREIGN KEY (moh_area_id) REFERENCES MOH_areas(id)
            ) ENGINE=INNODB;
            ";

        $this->query($query);

        //PHM table
        $query = "CREATE TABLE IF NOT EXISTS PHM (
                id INT NOT NULL AUTO_INCREMENT primary key ,
                user_id INT,
                SLMC_no VARCHAR(255) NOT NULL,
                clinic_id INT,
                moh_area_id INT,
                created_user_id INT,
                created_at DATE,
                active TINYINT default 1,
                FOREIGN KEY (created_user_id) REFERENCES users(id),
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (clinic_id) REFERENCES clinics(id),
                FOREIGN KEY (moh_area_id) REFERENCES MOH_areas(id)
            ) ENGINE=INNODB;
            ";
        $this->query($query);

        //Mother table
        $query = "CREATE TABLE IF NOT EXISTS mothers (
                id INT NOT NULL AUTO_INCREMENT primary key ,
                user_id INT,
                phm_id INT,
                clinic_id INT,
                status TINYINT default 1,
                maritalStatus VARCHAR(255),
                marriageDate DATE,
                bloodGroup VARCHAR(10),
                occupation VARCHAR(255),
                gps_location varchar(1000),
                allergies TEXT,
                consanguinity VARCHAR(255),
                history_of_infertility varchar(255),
                hypertension TINYINT(1),
                diabetes_mellitus TINYINT(1),
                rubella_immunization TINYINT(1),
                emergency_no VARCHAR(20),
                created_user_id INT,
                created_at DATE,
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (clinic_id) REFERENCES clinics(id),
                FOREIGN KEY (PHM_id) REFERENCES PHM(id),
                FOREIGN KEY (created_user_id) REFERENCES users(id)
            ) ENGINE=INNODB;
            ";
        $this->query($query);

        //pregnancy record table
        $query = "CREATE TABLE IF NOT EXISTS pregnancy_record (
            id INT AUTO_INCREMENT PRIMARY KEY,
            mother_id int not null,
            phm_id int not null,
            risk_level varchar(255),
            status varchar(255) default 'prenatal',
            gradivity INT,
            initial_bim float,
            no_living_children INT,
            age_of_youngest INT,
            last_menstrual_date date,
            expected_due date,
            do_pregnancy_confirm date,
            poa_at_registration INT,
            folic_acid tinyint,
            medial_surgical_conditions varchar(1000),
            edu_materials INT,
            outcome varchar(255),
            birth_weight float,
            weeks_of_pregnancy int,
            apgar_score float,
            delivery_date date,
            delivery_time timestamp,
            mode_delivery varchar(255),
            vitaminA_megadose tinyint,
            antiD tinyint,
            postnatal_mother_screening tinyint,
            postnatal_baby_screening tinyint,
            discharge_date date,
            remarks varchar(1000),
            FOREIGN KEY (mother_id) REFERENCES mothers(id),
            FOREIGN KEY (phm_id) REFERENCES PHM(id)
        ) ENGINE=INNODB;
        ";
        $this->query($query);

        //child table
        $query = "CREATE TABLE IF NOT EXISTS child (
                id INT NOT NULL AUTO_INCREMENT primary key ,
                phm_id INT,
                mother_id INT,
                clinic_id INT,
                firstname varchar(255),
                lastname varchar(255),
                dob date,
                blood_group varchar(255),
                address VARCHAR(255) NOT NULL,
                status TINYINT default 1,
                gender varchar(255),
                FOREIGN KEY (phm_id) REFERENCES PHM(id),
                FOREIGN KEY (mother_id) REFERENCES mothers(id),
                FOREIGN KEY (clinic_id) REFERENCES clinics(id)
            ) ENGINE=INNODB;
            ";
        $this->query($query);

    }
}