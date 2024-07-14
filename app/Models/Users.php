<?php

namespace app\Models;

require_once __DIR__."/../Database/DatabaseHandler.php";
require_once __DIR__."/../config/config.php";
require_once __DIR__."/../Models/Sessions.php";
require_once __DIR__."/../config/function.php";

class Users
{
    use \app\Database\Data;
    public $error = "";
    public $success = "";
    public $tryAgain = false;
    public $authChange = false;
    public $verifiedData = [];

    /**
     * these are the columns of the user table
     * 
     * fisrtname, lastname, username, email, password, verifyph, verify
     */

    public function __construct()
    {
        $this->table = "users";
        $this->dbname = DBNAME;
    }

    public function createUser($data) //:bool
    {
        if (!empty($data)) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Trim and validate fields
                $data["firstname"] = test_input($data["firstname"]);
                $data["lastname"] = test_input($data["lastname"]);
                $data["username"] = test_input($data["username"]);
                if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
                    $this->error = "Invalid Email";
                    return false;
                } else {
                    $data["email"] = test_input($data["email"]);
                }
                $data["password"] = test_input($data["password"]);
                $data["confirm_password"] = test_input($data["confirm_password"]);

                // Check if email is unique
                $users = $this->selectAll();
                if (!empty($users)) {
                    foreach ($users as $user) {
                        if (in_array($data["email"], $user)) {
                            $this->error = "This email already exists";
                            return false;
                        }
                        if (in_array($data["username"], $user)) {
                            $this->error = "This Username already exists";
                            return false;
                        }
                    }
                }

                if (empty($this->error)) {
                    if ($data["password"] != $data["confirm_password"]) {
                        $this->error = "These passwords don't match, please input them again";
                        return false;
                    } else {
                        // create verifyphrase
                        $code = rand(100000, 9999999);
                        $verifyph = "vfml".$code."code";
                        $data["verifyph"] = $verifyph;
                        $data["verify"] = "no";

                        // Unset confirm_password
                        unset($data["confirm_password"]);

                        // Hash password
                        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

                        // Insert data
                        if ($this->insert($data)) {
                            // create an id for the session
                            // $id = "sesi".rand(100000, 9999999)."d";
                            // $data["sesid"] = $id;

                            // Store data in property
                            $this->verifiedData = $data;
                            return true;
                        } else {
                            $this->error = "User could not be created";
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            }
        }
    }

    public function loginUser($data)
    {
        if (!empty($data)) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Trim and validate fields
                if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
                    $this->error = "This email is invalid";
                    return false;
                } else {
                    $data["email"] = test_input($data["email"]);
                }
                $data["password"] = test_input($data["password"]);

                
                if (empty($this->error)) {
                    $user = $this->where(["email" => $data["email"]]);

                    if (!empty($user)) {
                        
                        if (in_array($user["password"], $user)) {
                            $pwdhashed = $user["password"];
                            $checkpwd = password_verify($data["password"], $pwdhashed);
                            if ($checkpwd) {
                                $this->verifiedData = $user;
                                return true;
                            } else {
                                $this->error = "Invalid details";
                                return false;
                            }
                        }

                    } else {
                        $this->error = "Invalid details";
                        return false;
                    }
                } else {
                    $this->error = "check and try again";
                    return false;
                }
            }
        }
    }

    public function checkEmail($data)
    {
        if (!empty($data)) {
            $user = $this->where(["email" => $data["email"]]);
            if (!empty($user)) {
                $this->verifiedData = $user;
                return true;
            } else {
                $this->error = "The email does not exist";
                return false;
            }
        }
    }

    public function checkPWD($data) 
    {
        if (!empty($data)) {
            $password = $data["password"];
            $rptPassword = $data["rptpassword"];

            if ($password == $rptPassword) {
                $this->verifiedData = $data;
                return true;
            } else {
                $this->error = "The passwords don't match";
                return false;
            }   
        }
    }
}


