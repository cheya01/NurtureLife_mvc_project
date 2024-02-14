<?php

//main model class
use JetBrains\PhpStorm\NoReturn;

class Model extends Database
{
    protected string $table = "users";

    public function insert($data): void
    {
        //remove unwanted columns
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);

        $query = "insert into " . $this->table;
        $query .= " (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";

        $this->query($query, $data);

    }

    public function update($id, $data, $customKey = null): void
    {
        $updateKey = 'id';
        if (!empty($customKey)) {
            $updateKey = $customKey;
        }
        //remove unwanted columns
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);

        $query = "update " . $this->table . " set ";

        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query, ",");
        $query .= " where $updateKey = :id";

        $data['id'] = $id;
        $this->query($query, $data);

    }


    public function where($data, $order = 'desc'): false|array
    {
        $keys = array_keys($data);

        $query = "select * from " . $this->table . " where ";

        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . " && ";
        }

        $query = trim($query, "&& ");
        $query .= " order by id $order";
        $res = $this->query($query, $data);

        if (is_array($res)) {
            //run afterSelect functions
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $res = $this->$func($res);
                }
            }
            return $res;
        }
        return false;

    }

    public function findAll($order = 'desc', $orderField = null): false|array
    {
        if (empty($orderField)) $orderField = $this->primaryKey;
        $query = "select * from " . $this->table . " order by $orderField $order ";
        $res = $this->query($query);

        if (is_array($res)) {
            //run afterSelect functions
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $res = $this->$func($res);
                }
            }
            return $res;
        }
        return false;

    }

    public function first($data, $order = 'desc')
    {
        $keys = array_keys($data);

        $query = "select * from " . $this->table . " where ";

        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . " && ";
        }

        $query = trim($query, "&& ");
        $query .= " order by id $order limit 1";
        $res = $this->query($query, $data);

        if (is_array($res)) {
//            $res = $res[0];
            //run afterSelect functions
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $res = $this->$func($res);
                }
            }
//            show($res);die;
            return $res[0];
        }
        return false;

    }

    public function delete($id): true
    {
        $query = "delete from " . $this->table . " where " . $this->primaryKey . "=:id limit 1";
        $this->query($query, ['id' => $id]);
        return true;
    }

    #[NoReturn] public function extractFromNic($nic): array
    {
        $dates = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        //nic length
        $nicLength = strlen($nic);

        $daysOld = (int)substr($nic, 2, 3);
        $daysNew = (int)substr($nic, 4, 3);

        //checking for v at last for old nic
        $checkV = substr_compare($nic, "v", -1) || substr_compare($nic, "V", -1);

        //check for first digit in new nic
        $checkOne = substr($nic, 0, 1) === '1';
        $checkTwo = substr($nic, 0, 1) === '2';

        $isOld = true;
        //validating
        if ($nicLength == 10 && $checkV && ($daysOld <= 366 || ($daysOld >= 501 && $daysOld <= 866))) {
            //this is an old nic
            $isOld = true;
        } else if ($nicLength == 12 && ($checkOne || $checkTwo) && ($daysNew <= 366 || ($daysNew >= 501 && $daysNew <= 866))) {
            //this is an old nic
            $isOld = false;
        }

        $year = ($isOld) ? 1900 + (int)substr($nic, 0, 2) : (int)substr($nic, 0, 4);
        $threeDigitsForDays = ($isOld) ? $daysOld : $daysNew;

        //Validate gender
        $gender = "Male";
        if ($threeDigitsForDays > 500) {
            $threeDigitsForDays -= 500;
            $gender = "Female"; //If day value > 500 it means NIC owner is a female.
        }

        $total = 0;
        $date = $month = 0;
        for ($i = 0; $i <= sizeof($dates); $i++) {
            $total += $dates[$i];
            if ($threeDigitsForDays <= $total) {
                $month = $i + 1; //Get the month
                $date = $threeDigitsForDays - ($total - $dates[$i]); //Get the day
                break;
            }
        }
        $date = new DateTime("$year-$month-$date");
        $dob = $date->format('Y-m-d');
        return ['dob' => $dob, 'gender' => $gender];
    }


}