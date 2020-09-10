<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lunarreturn extends CI_Controller
{
        public function __construct()
        {
            parent ::__construct();
            $this->load->helper('directory');
        }

        public function index() {
            $birthStamp = strtotime("1962-07-09 18:37");
            $birthPosition = 196.7412259;
            // $birthPosition = 307.5194350;
            date_default_timezone_set("UTC");
            $currentDateTime = date('Y-m-d H:i:s');
            $currentStamp = strtotime($currentDateTime);
            $dateCircle = 2360580;
            // $dateCircle = 2354100;
            // $dateCircle = 2370870;

            $limitTemp = $currentStamp - $birthStamp;
            $limit = intval($limitTemp/$dateCircle);
            $tempTime = $this->tempDate($dateCircle, $limit, $birthStamp, $currentStamp);
            $output = $this->sweph($tempTime, "1");            
            /** $output is 2-D array. */
            
            $lunar = $this->cal_lunar($output, $birthPosition);
            var_dump($lunar);
        }      
        
        function tempDate ($circle, $limit, $birthstamp, $currentstamp) {
            if ($limit == 0) {
                return date("Y-m-d H:i:s", $currentstamp);
            } else {
                // for ($i = 0; $i=$limit; $i++) {
                    $result = $birthstamp + $circle * $limit;
                    var_dump($result."______".$currentstamp);
                    if ($result >= $currentstamp) {
                        return date("Y-m-d H:i:s", $result);
                    }
                // }
            }          
        }

        function cal_lunar($output, $birthPosition) {
            $val = [];
            $arrAbsVal = [];
            $arrTimeAbs = [];
            $arrStep = '';
            $dateTime = '';
            foreach ($output as $outPut) {
                $val = explode(",", $outPut);
                $absVal = abs($birthPosition - $val[2]);
                array_push($arrAbsVal, $absVal);
                array_push($arrTimeAbs, $val[1].",".$val[2].",".$val[4].",".$absVal);
            }

            $minVal = min($arrAbsVal);
            foreach ($arrTimeAbs as $arrtimeabs) {
                $val = explode(",", $arrtimeabs);
               
                if (round($val[3], 3) == round($minVal, 3)) {
                    $arrStep = $arrtimeabs;
                }
            }

            if ($arrStep != '') {
                $val = explode(",", $arrStep);
                $iSpeed = $val[2]/1436; //speed per a minute.
                $tempPosition = $val[1];
                $tpDatetime = explode(" ",$val[0]);
                $tempDatetime = strtotime($tpDatetime[0]." ".$tpDatetime[1]);
                $tpTime = 60 * ($birthPosition -$tempPosition)/$iSpeed;
                $time = $tempDatetime + $tpTime;
                $dateTime = date("Y-m-d H:i:s", $time);
            }
            return $dateTime;
        }

        function sweph ($dateTime, $flag) {
            $libPath = './assets/sweph/';
            putenv("PATH=$libPath");
            // $dateTime = '9 July 1962 6:37 PM';
            
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
            $timezone = 0; 

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
            if ($flag == "1") {
                exec ("swetest -edir$libPath -b$date -ut$time  -p1 -eswe -fPTlZs -n28 -s1 -roundmin -g, -head ", $output);
            }
            if ($flag == "2") {
                // exec("swetest -edir$libPath -b$date -ut$time -p1 -eswe -fPTlZs -roundmin -n100 -s00001157407 -g, -head ", $output);
                exec ("swetest -edir$libPath -b$date -ut$time -p1 -eswe -fPTlZs -roundmin -n2100 -s0.00069444444 -g, -head ", $output);
            }
            
            // var_dump($output);
            // var_dump($output1);


            # OUTPUT ARRAY
            # Planet Name, Planet Degree, Planet Speed per day
            return $output;
        }      
}