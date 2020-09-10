<?php
 class Sweph extends CI_Controller
 {
    public function __construct()
    {
    }
    public function index () {
        // path to swiss ephemeris library files
         $libPath = './assets/sweph/';
 
         putenv("PATH=$libPath");
 
         /**
          * Assuming birth date to be 
          * 9th August 2017, 9:35 PM
          */
         $birthDate = new DateTime('2019-5-12 3:23:12');
         //echo $birthDate->format('Y-m-d H:i:s'); echo '<br>';
 
         /**
          * Latitude Longitude
          * of Kathmandu, Nepal
          */
         $latitude = 27.7172453;
         $longitude = 85.3239605;
 
         /**
          * Timezone value for Nepal
          * As Nepal time is 5 hours 45 minutes ahead of UTC
          *
          * Put this value according to your country
          */
         $timezone = -4; 
 
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
         exec ("swetest -edir$libPath -b$date -ut$time  -p0123456789 -eswe -house$longitude,$latitude,$h_sys -fPlZ -roundmin -g, -head ", $output);
         // exec ("swetest -edir$libPath -b$date -ut$time -p0123456789 -eswe -fPLZ -roundmin -g, -head", $output);
         // exec ("swetest -edir$libPath -b$date -ut$time -p0123456789 -eswe -fPLZ -roundmin -g, -head", $output);
         
         // var_dump($output);
         // var_dump($output1);
 
        var_dump($output);
         # OUTPUT ARRAY
         # Planet Name, Planet Degree, Planet Speed per day
         return $output;
     }
 }
 
 