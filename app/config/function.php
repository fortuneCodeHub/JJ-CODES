<?php 

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getPostDate($date_created) {
    // 2023-09-17 07:44:55
    $dtarray = $date_created;
    $dtarray = explode(" ", $dtarray);

    // Set time and date variables
    $datearray = $dtarray[0];
    $timearray = $dtarray[1];

    // turn date & time to array
    $datearray = explode("-",$datearray);
    $timearray = explode(":",$timearray);

    // set variables
    $y = $datearray[0]; //years
    $m = $datearray[1]; //months
    $d = $datearray[2]; //days
    $h = $timearray[0]; //hours
    $i = $timearray[1]; //minutes
    $s = $timearray[2]; //seconds 

    $date_created = mktime($h,$i,$s,$m,$d,$y);
    
    $date = "";
    $fourWeeks = strtotime("+4 weeks", $date_created);
    $sixDays = strtotime("+6 days", $date_created);
    $oneDay = strtotime("+1 day", $date_created);
    $oneMonth = strtotime("+1 month", $date_created);
    $present = strtotime("today");

    if ($present <= $oneDay) {
        // Set the time variables
        $presentFulltime = date("i s");
        $presentFulltime = explode(" ", $presentFulltime);
        $presentHour = date("H");
        // Hours Array
        $Hours = [];

        // Store the 24hours that make a day in the Hours array
        for ($i=0; $i < 24; $i++) { 
            if ($i > 1) {
                $Hours[] = strtotime("+$i hours", $date_created);
            } else {
                $Hours[] = strtotime("+$i hour", $date_created);
            }
        }
        
        // Get each day out of the array and compare from present date
        foreach ($Hours as $key => $Hour) {
            $hour = date("H", $Hour);

            // echo $presentHour. " ". $hour. "<br>";

            // Set full time values for the creation date
            $hourFulltime = date("i s", $Hour);
            $hourFulltime = explode(" ", $hourFulltime);

            // echo $presentHour." $hour $key <br>";
            // echo date("H i s");
            if ($presentHour == $hour) {
                if ($key > 1) {
                    $key += 1;
                    $date = $key."hours ago";
                } else {
                    if ($key == 1) {
                        $date = "$key hour ago";
                    } elseif ($key == 0) {
                        // Set the seconds and minutes of the hours from post and present time
                        $preSecs = $presentFulltime[1];
                        $preMins = $presentFulltime[0];
                        $hourMins = $hourFulltime[0];
                        $hourSecs = $hourFulltime[1];

                        // Get total Present minutes
                        $preSecs = $preSecs/60;
                        $preTotal = $preMins + $preSecs;

                        // Get total minutes from post
                        $hourSecs = $hourSecs/60;
                        $hourTotal = $hourMins + $hourSecs;

                        $time = $preTotal - $hourTotal;
                        $time = floor($time);
                        $date = ($time > 5) ? $time. " mins ago": "now";
                    }
                }
                break;
            }
        }
    } elseif ($present <= $sixDays) {
        // Days Array
        $Days = [];

        // Store the 6days in the days array
        for ($i=1; $i <= 6; $i++) { 
            if ($i > 1) {
                $Days[] = strtotime("+$i days", $date_created);
            } else {
                $Days[] = strtotime("+$i day", $date_created);
            }
        }

        // Change present date from int to string
        $Present = date("d M Y", $present);

        // Get each day out of the array and compare from present date
        foreach ($Days as $key => $Day) {
            $day = date("d M Y", $Day);
            if ($Present == $day) {
                $key += 1;
                if ($key > 1) {
                    $date = $key."days ago";
                } else {
                    $date = "$key day ago";
                }
                break;
            }
        }
    } elseif($present <= $fourWeeks) {
        // Weeks Array
        $Weeks = [];

        // Store the 6days in the days array
        for ($i=1; $i <= 4; $i++) { 
            if ($i > 1) {
                $Weeks[] = strtotime("+$i weeks", $date_created);
            } else {
                $Weeks[] = strtotime("+$i week", $date_created);
            }
        }

        // Change present date from int to string
        $Present = date("d", $present);
        
        // Get each day out of the array and compare from present date
        foreach ($Weeks as $key => $Week) {
            $weeks[] = date("d", $Week);
        }
        if ($Present >= $weeks[0]) {
            $weekTime = "1 week ago";
        } elseif ($Present >= $weeks[1]) {
            $weekTime = "2 weeks ago";
        } elseif ($Present >= $weeks[2]) {
            $weekTime = "3 weeks ago";
        } elseif ($Present >= $weeks[3]) {
            $weekTime = "4 weeks ago";
        }
        $date = $weekTime;
    } elseif ($present > $fourWeeks) {
        $date_created = date("d M Y", $date_created);
        $date = $date_created;
    }

    if (!empty($date)) {
        return $date;
    }
}

function getDateInWords($date_created) {
    // 2023-09-17 07:44:55
    $dtarray = $date_created;
    $dtarray = explode(" ", $dtarray);

    // Set time and date variables
    $datearray = $dtarray[0];
    $timearray = $dtarray[1];

    // turn date & time to array
    $datearray = explode("-",$datearray);
    $timearray = explode(":",$timearray);

    // set variables
    $y = $datearray[0]; //years
    $m = $datearray[1]; //months
    $d = $datearray[2]; //days
    $h = $timearray[0]; //hours
    $i = $timearray[1]; //minutes
    $s = $timearray[2]; //seconds 

    $date_created = mktime($h,$i,$s,$m,$d,$y);

    $date_created = date("d M Y", $date_created);

    return $date_created;
}

function emailPicker($filepath, $url) 
{
    if (file_exists($filepath)) {
        //get the contents of the file
        $content = file_get_contents($filepath);

        // start output buffering
        ob_start();

        // Evaluate the PHP code within the fetched content
        eval('?>'.$content);

        // Get the buffered content and stop buffering
        $executedContent = ob_get_clean();

        // return the buffered content
        return $executedContent;
    } 
    return false;
}