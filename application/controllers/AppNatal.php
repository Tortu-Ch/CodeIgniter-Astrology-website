<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;

class AppNatal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->library('session');
        $this->load->library('firebase');
    }

    public function index($id, $dateVal)
    {
        $latitude = '';
        $longitude = '';
        $url = '';
        $timezone = '';
        $latitude = '';
        $longitude = '';
        $datetemp = explode(".", $dateVal);
        $dateVal = $datetemp[0]." ".$datetemp[1];
        $users = $this->get_data();
        if (isset($id) && isset($dateVal)) {
            foreach ($users as $user) {
                // $token = $user['account']['token'];
                if ($user['account']['id'] == $id) {
                    $timezone = $user['account']['timezone'];     
                    $latitude = $user['account']['latitude'];
                    $longitude = $user['account']['latitude'];  
                }
            }
            $datestamp = strtotime($dateVal);
            $datetime = date("Y-m-d H:i:s", $datestamp);
            // $url = $this->calculater($datetime, $latitude, $longitude, $timezone);
            // $Url = $this->resultURL($url);
            $moonSign = $this->moon_sign($datetime, $timezone, $latitude, $longitude);
            $moonHouse = $this->moon_house($datetime, $timezone, $latitude, $longitude);
            var_dump($moonHouse);

            // $image = base_url().$Url[0];
            // $sign = $Url[1];
            // $aspect = $Url[2];
            // $this->push_notification($token, $image, $sign, $aspect);
            // var_dump($this->session->userdata('imgUrl'));
        }
    }
   
    private function push_notification($token, $sessionUrl, $sign, $aspect)
    {
        $firebase = $this->firebase->init();
        $messaging = $firebase->getMessaging();

        $title = 'Position of the moon.';
        // $data = [$sign, $aspect];
        // $notification = Notification::fromArray([
        //     'title' => $title,
        //     'body' => '$body',
        //     'image' => $sessionUrl
        // ]);

        $config = WebPushConfig::fromArray([
            'notification' => [
                'title' => '$GOOG up 1.43% on the day',
                'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
                'icon' => 'https://www.gstatic.com/devrel-devsite/vbb62cc5a3e8f17e37bae4792b437f28f787df3f9cf9732cbfcc99b4f4ff41a54/firebase/images/lockup.png',
            ],
            'fcm_options' => [
                'link' => 'feelbythemoon.com',
            ],
        ]);
        

        $data = [
            'first_key' => 'first_value',
            'second_key' => 'second_value'
        ];

        $message = CloudMessage::fromArray([
            'data' => $data
        ]);
        $message = $message->withWebPushConfig($config);
        $sendRport = $messaging->sendMulticast($message, $token);
        echo 'Successful sends: '.$sendRport->successes()->count().PHP_EOL;
        echo 'Failed sends: '.$sendRport->failures()->count().PHP_EOL;

        if ($sendRport->hasFailures()) {
            foreach ($sendRport->failures()->getItems() as $failure) {
                echo $failure->error()->getMessage().PHP_EOL;
            }
        }
    }

    public function get_data()
    {
        $firebase = $this->firebase->init();
        $db = $firebase->getDatabase();
        $data = $db->getReference('Users')->getValue();
        return $data;
    }

    private function resultURL($url)
    {
        $absNumber = [];
        $arrNumUrl = [];
        $arraspect = [];
        $sign = '';
        $finalUrl = '';
        $count = Count($url);
        for ($i = 0; $i < $count; $i++) {
            $Url = explode("|", $url[$i]);
            
            if (count($Url) > 2) {
                $absnumber = abs($Url[2]);
                $UrlTemp = $Url[3];
                $sign = $Url[4];
                array_push($absNumber, $absnumber);
                array_push($arrNumUrl, [$absnumber, $UrlTemp]);
                array_push($arraspect, $Url[0] ." ". $Url[1] ." ". $Url[2]);
                
            } else {
                $finalUrl = $Url[0];
                $sign = $Url[1];
                $aspect = "Void of course";
                $arrReturn = [$finalUrl, $sign, $aspect];
                return $arrReturn;
            }
        }
        $number = min($absNumber);
        foreach ($arrNumUrl as $arrNumurl) {
            if ($arrNumurl == $number) {
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
            array("sextile", 54, 60, "s"),
            array("trine", 114, 120, "s"),
            array("square", 84, 90, "h"),
            array("opposite", 174, 180, "h")
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
                    $currentdegree = $SignDegree[1];
                    $URL = $this->check_SunPosition($arr_Sign, $arrTotal, $aspect, $currentdegree, $tempN, $name);

                    $urlTemp = $this->make_finalURL($URL, $aspect[0], $t[0], $t[1]);
                    array_push($url, $urlTemp);
                    // var_dump("11");                    
                }
            }
        }

        return $url;
    }

    private function make_finalURL($url, $aspectName, $planetName, $Orb)
    {
        $Url = '';
        $Orb = intval($Orb) / 60;
        // var_dump($url);
        // foreach ($url as $URL) {
        // array_push($Url, $aspectName."|".$planetName."|". $Orb."|".$url);

        $Url = $aspectName . "|" . $planetName . "|" . $Orb . "|" . $url;

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

    private function moon_sign($dt, $tz, $latt, $longt)
    {   
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

        $outPut = $this->natal($dt, $tz, $latt, $longt);
        $outNode = explode(",", $outPut[1]);
        $moonSign = explode(" ", $outNode[2]);
        $signTmp = array("", "", "");
        $i = 0;
        foreach ($moonSign as $t) {
            if($t != "" && $t != " ") {
                $signTmp[$i] = $t;
                $i++;
            }
        }
        $sgnName = $signTmp[1]; 
        $signName='';

        foreach ($arr_Sign as $sign) {
            if ($sgnName == $sign[3]) {
                $signName = $sign[0];
                break;
            }
        }
        return $signName;
    }

    private function moon_house($dt, $tz, $latt, $longt)
    {
        $outPut = $this->natal($dt, $tz, $latt, $longt);
        $moonTemp = explode(",", $outPut[1]);
        $moon = trim($moonTemp[1]);
        $house = [];
        for ($i=10; $i<=21; $i++) {
            $temp = explode(",", $outPut[$i]);
            if($i == 21) {
                $tempSec = explode(",", $outPut[10]);
                $house = [trim($temp[0]), trim($temp[1]), trim($tempSec[1])];    
            } else {
                $tempSec = explode(",", $outPut[$i+1]);
                $house = [trim($temp[0]), trim($temp[1]), trim($tempSec[1])];
            }

            if ($moon >= $house[1] && $moon < $house[2]) {
                $moonHouse = $house[0];
                return $moonHouse;
            }
        }
    }

    private function natal($dateTime, $timezone, $latitude, $longitude)
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
        exec("swetest -edir$libPath -b$date -ut$time  -p0123456789 -eswe -fPlZ -house$longitude,$latitude,$h_sys -roundmin -g, -head ", $output);
        // exec ("swetest -edir$libPath -b$date -ut$time -p0123456789 -eswe -fPLZ -roundmin -g, -head", $output);
        // exec ("swetest -edir$libPath -b$date -ut$time -p0123456789 -eswe -fPLZ -roundmin -g, -head", $output);

        // var_dump($output);
        // var_dump($output1);


        # OUTPUT ARRAY
        # Planet Name, Planet Degree, Planet Speed per day
        return $output;
    }
}
