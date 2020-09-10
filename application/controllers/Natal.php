<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;

class Natal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->library('session');
        $this->load->library('firebase');
    }

    public function index()
    {
        $latitude = '';
        $longitude = '';
        $url = '';
        if (isset($_POST['dateVal']) && isset($_POST['timezone'])) {
            $datetime = $_POST['dateVal'];
            $timezone = $_POST['timezone'];
            $url = $this->calculater($datetime, $latitude, $longitude, $timezone);
            // $this->home($url);
            echo json_encode($url);
        }
    }

    public function cron_job()
    {   
        $latitude = '';
        $longitude = '';
        $url = '';
        $tokens = [];

        $dateVal = '2019-07-25 00:39';
        $datestamp = strtotime($dateVal);
        $now = date("Y-m-d H:i:s", $datestamp);
        $timezone = 0;
        $users = $this->get_data();
        // foreach ($users as $user) {
        //     array_push($tokens, $user['account']['token']);
        //     $cal_between = strtotime($user['data']['lunar_return']) - strtotime($now);
        //     if (abs($cal_between) <= 60) {
        //         $this->lunar_notification($user['account']['token']);
        //     }
        // }
        $url = $this->calculater($now, $latitude, $longitude, $timezone);
        $Url = $this->store_session($url);
        $imgUrl = $Url[0];
        $sign = $Url[1];
        $aspect = $Url[2];
        $this->save_data($imgUrl, $sign, $aspect);
    }

    public function install_app($token)
    {
        
    }

    private function store_session($url)
    {
        $arrTotal = $this->result_url($url);
        $storeurl = $arrTotal[0];
        $oldUrl = $this->session->userdata('imgUrl');
        var_dump($oldUrl);
        var_dump($arrTotal);
        if ($oldUrl != $storeurl) {
            $sessionUrl = array('imgUrl' => $storeurl);
            $this->session->set_userdata($sessionUrl);
            return $arrTotal;
        } else {
            var_dump("url is already exist!"); exit;
        }
    }

    private function lunar_notification()
    {

    }

    private function save_data($imgUrl, $sign, $aspect)
    {   
        $firebase = $this->firebase->init();
        $db = $firebase->getDatabase();
        
        $users = $this->get_data();
        foreach ($users as $user) {
            $id = $user['account']['id'] + 1;
            $upadte = [
                'Users/user'.$id.'/data/img_url' => $imgUrl,
                'Users/user'.$id.'/data/sign' => $sign,
                'Users/user'.$id.'/data/aspect' => $aspect,
            ]; 
            $db->getReference()->update($upadte);
        }
    }
  
    public function get_data()
    {
        $firebase = $this->firebase->init();
        $db = $firebase->getDatabase();
        $data = $db->getReference('Users')->getValue();
        return $data;
    }

    private function result_url($url)
    {
        $absNumber = [];
        $arrNumUrl = [];
        $arraspect = '';
        $sign = '';
        $finalUrl = '';
        $count = Count($url);
        for ($i = 0; $i < $count; $i++) {
            $Url = explode("|", $url[$i]);
            
            if (count($Url) > 2) {
                $absnumber = abs($Url[2]);
                $intensity = $Url[3];
                $UrlTemp = $Url[4];
                $sign = $Url[5];
                array_push($absNumber, $absnumber);
                array_push($arrNumUrl, [$absnumber, $UrlTemp]);
                $tmpAspect = $Url[1]." "."(".$Url[0].")"." ". $intensity."|";
                $arraspect = $arraspect.$tmpAspect ;
            } else {
                $finalUrl = $Url[0];
                $sign = $Url[1];
                $aspect = "VOC";
                $arrReturn = [$finalUrl, $sign, $aspect];
                return $arrReturn;
            }
        }

        $number = min($absNumber);
        foreach ($arrNumUrl as $arrNumurl) {
            if ($arrNumurl[0] == $number) {
                $finalUrl = $arrNumurl[1];
            }
        }
        $arrReturn = [$finalUrl, $sign, $arraspect];
        return $arrReturn;
    }
    private function calculater($datetime, $latitude, $longitude, $timezone)
    {

        $output = $this->natal($datetime, $latitude, $longitude, $timezone);
        $arr_Aspect =  array(
            array("conjunct", -6, 0, "c"),
            array("soft", 54, 60, "s"),
            array("soft", 114, 120, "s"),
            array("hard", 84, 90, "h"),
            array("hard", 174, 180, "h")
        );

        $arr_Sign = array(
            array("aries", 0, 30, "ar"),
            array("taurus", 30, 60, "ta"),
            array("gemini", 60, 90, "ge"),
            array("cancer", 90, 120, "cn"),
            array("leo", 120, 150, "le"),
            array("virgo", 150, 180, "vi"),
            array("libra", 180, 210, "li"),
            array("scorpio", 210, 240, "sc"),
            array("sagittarius", 240, 270, "sa"),
            array("capricorn", 270, 300, "cp"),
            array("aquarius", 300, 330, "aq"),
            array("pisces", 330, 360, "pi")
        );

        $arrTotal = [];
        $arrBetween = [];
        $SignDegree = [];
        $url = [];
        $currentLink = "";
        $currentdegree = "";
        $tempN = 0;


        foreach ($output as $z) {
            $out = explode(",", $z);
            $out[0] = trim($out[0]);

            $positionTemp = explode("°", $out[1]);
            $position = intval($positionTemp[0]) * 60 + intval($positionTemp[1]);

            $fromSign = explode(" ", $out[2]);
            $i = 0;
            $fromsignTemp = array("", "", "");
            foreach ($fromSign as $t) {
                if ($t != " " && $t != "") {
                    $fromsignTemp[$i] = $t;
                    $i++;
                }
            }

            $positionSec = array($fromsignTemp[1], intval($fromsignTemp[0]) * 60 + intval($fromsignTemp[2]));
            foreach ($arr_Sign as $sign) {
                if ($sign[3] == $fromsignTemp[1]) {
                    array_push($SignDegree, $sign[0] . " " . $fromsignTemp[0] . "°" . $fromsignTemp[2] . "'");
                    break;
                }
            }

            $resultTemp = array($out[0], $position, $positionSec[0], $positionSec[1]);
            array_push($arrTotal, $resultTemp);
        }
        $arrBetween = $this->arrBetween_request($arrTotal);
        $url = $this->check_aspect($arr_Sign, $arr_Aspect, $arrTotal, $arrBetween, $SignDegree);
        if ($url == null || count($url) == 0) {
            $url = $this->check_voc($arr_Sign, $arrTotal, $SignDegree);
        }
        return $url;
    }

    private function arrBetween_request($arrTotal)
    {
        $i = 0;
        $arrBetween = [];
        foreach ($arrTotal as $t) {
            if ($i != 1) {
                $betweenTemp = array($t[0], $arrTotal[1][1] - $t[1]);
                array_push($arrBetween, $betweenTemp);
            }
            $i++;
        }
        return $arrBetween;
    }

    private function check_voc($arr_Sign, $arrTotal, $SignDegree)
    {
        $tempN = 0;
        $url = [];
        $Url = [];
        foreach ($arr_Sign as $sign) {
            $tempN++;
            if ($arrTotal[1][1] >= intval($sign[1]) * 60 && $arrTotal[1][1] < intval($sign[2]) * 60) {
                $currentdegree = $SignDegree[1];
                $url = $this->check_SunPosition($arr_Sign, $arrTotal, "", $currentdegree, "10", "voc");
                // return $url;
                array_push($Url, $url);
            }
        }
        // var_dump($Url);
        return $Url;
    }

    private function check_aspect($arr_Sign, $arr_Aspect, $arrTotal, $arrBetween, $SignDegree)
    {
        $tempN = 0;
        $url = [];
        $URL = [];
        foreach ($arrBetween as $t) {
            $tempN++;
            $name = strtolower($t[0]);

            foreach ($arr_Aspect as $aspect) {
                if ($t[1] >= intval($aspect[1]) * 60 && $t[1] <= intval($aspect[2]) * 60) {
                    // var_dump("22");
                    $intensityTemp = $t[1] - intval($aspect[1]) * 60;
                    $intensity = $this->cal_intensity($intensityTemp);
                    $currentdegree = $SignDegree[1];
                    $URL = $this->check_SunPosition($arr_Sign, $arrTotal, $aspect, $currentdegree, $tempN, $name);
                    $urlTemp = $this->make_finalURL($URL, $aspect[0], $t[0], $t[1], $intensity);
                    array_push($url, $urlTemp);
                    // var_dump("11");                    
                }
            }
        }

        return $url;
    }

    private function cal_intensity($value)
    {   
        $result = '';
        if (abs($value) >= 0 || abs($value) <= 1) {
            $result = "very Weak";
        } elseif (abs($value) >1 || abs($value) <= 2) {
            $result = "Weak";
        } elseif (abs($value) >2 || abs($value) <= 3) {
            $result = "Medium";
        } elseif (abs($value) >3 || abs($value) <= 4) {
            $result = "strong";
        } elseif (abs($value) >4 || abs($value) <= 5 || abs($value) <= 6) {
            $result = "very strong";
        }
        
        return $result;
    }

    private function make_finalURL($url, $aspectName, $planetName, $Orb, $intensity)
    {
        $Url = '';
        $Orb = intval($Orb) / 60;
        // var_dump($url);
        // foreach ($url as $URL) {
        // array_push($Url, $aspectName."|".$planetName."|". $Orb."|".$url);

        $Url = $aspectName . "|" . $planetName . "|" . $Orb . "|" . $intensity . "|" . $url;
        // }   
        // var_dump($Url);
        return $Url;
    }

    private function check_SunPosition($arr_Sign, $arrTotal, $aspect, $currentdegree, $number, $name)
    {
        $url = [];
        $tempN = 0;
        foreach ($arr_Sign as $sign) {
            $tempN++;
            if ($arrTotal[0][1] >= intval($sign[1]) * 60 && $arrTotal[0][1] < intval($sign[2]) * 60) {
                if ($aspect == "") {
                    $tempUrl = "assets/images/pictures/" . $number . $name . "/" . $tempN . $sign[0]; //Voc
                } else {
                    $tempUrl = "assets/images/pictures/" . $number . $name . "/" . $aspect[3]; //Aspect
                }

                $filelist = directory_map($tempUrl, 1);
                foreach ($filelist as $flist) {
                    // $filename = str_split($flist, strlen($tempN));
                    preg_match_all('!\d+!', $flist, $filename);
                    if ($filename[0][0] == $tempN) {
                        $tempUrl = $tempUrl . "/" . $flist;
                        $url = $tempUrl . "|" . $currentdegree;
                        // array_push($url, $tempResult);   
                        // var_dump("1");
                    }
                }
            }
        }
        // var_dump($url);

        return $url;
    }

    private function natal($dateTime, $latitude, $longitude, $timezone)
    {
        // path to swiss ephemeris library files
        $libPath = './assets/sweph/';

        putenv("PATH=$libPath");

        /**
         * Assuming birth date to be 
         * 9th August 2017, 9:35 PM
         */
        $birthDate = new DateTime($dateTime);
        //echo $birthDate->format('Y-m-d H:i:s'); echo '<br>';

        /**
         * Latitude Longitude
         * of Kathmandu, Nepal
         */
        // $latitude = 27.7172453;
        // $longitude = 85.3239605;

        /**
         * Timezone value for Nepal
         * As Nepal time is 5 hours 45 minutes ahead of UTC
         *
         * Put this value according to your country
         */
        // $timezone = -4;

        /**
         * Converting birth date/time to UTC
         */
        $offset = intval($timezone) * (60 * 60);
        $birthTimestamp = strtotime($birthDate->format('Y-m-d H:i:s'));
        $utcTimestamp = $birthTimestamp - $offset;
        //echo date('Y-m-d H:i:s', $utcTimestamp); echo '<br>';

        $date = date('d.m.Y', $utcTimestamp);
        $time = date('H:i:s', $utcTimestamp);

        $h_sys = 'P';

        // More about command line options: https://www.astro.com/cgi/swetest.cgi?arg=-h&p=0
        // exec ("swetest -edir$libPath -b$date -ut$time -p0123456789 -eswe -house$longitude,$latitude,$h_sys -fPlj -g, -head", $output1);
        exec("swetest -edir$libPath -b$date -ut$time  -p0123456789 -eswe -fPLZ -roundmin -g, -head ", $output);
        // exec ("swetest -edir$libPath -b$date -ut$time -p0123456789 -eswe -fPLZ -roundmin -g, -head", $output);
        // exec ("swetest -edir$libPath -b$date -ut$time -p0123456789 -eswe -fPLZ -roundmin -g, -head", $output);

        // var_dump($output);
        // var_dump($output1);


        # OUTPUT ARRAY
        # Planet Name, Planet Degree, Planet Speed per day
        return $output;
    }
}
