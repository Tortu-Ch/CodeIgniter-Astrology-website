<?php
$this->load->helper('url');
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" class="wide wow-animation">

<head>
  <!-- Site Title-->
  <title>Home</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Stylesheets-->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,700%7CRoboto:400,900">
  <link rel="stylesheet" href="assets/css/style.css">

  <link href="assets/js/flatpickr.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/js/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/js/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
  <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
		<![endif]-->
</head>

<body>
  <!-- Page-->
  <div class="page text-center">
    <!-- Page Header-->
    <header class="page-head">
      <!-- RD Navbar-->
      <div class="rd-navbar-wrap">
        <nav data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-static" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-sm-stick-up-offset="1px" data-lg-stick-up-offset="1px" class="rd-navbar">
          <div class="rd-navbar-inner">
            <!-- RD Navbar Panel-->
            <div class="rd-navbar-panel">
              <!-- RD Navbar Brand-->
              <div class="rd-navbar-brand"><a href="index.html" class="brand-name"><img src="assets/images/home-logo-183x41.png" alt="" width="183" height="41" class="block-center" /></a></div>
            </div>
            <div class="rd-navbar-nav-wrap">
              <!-- RD Navbar Nav-->
              <ul class="rd-navbar-nav">
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="lunarreturn.html">My Moon / Lunar Return</a>
                  <!-- RD Navbar Dropdown-->

                </li>


                <li><a href="lunarvoc.html">Void of Course</a>
                  <!-- RD Navbar Dropdown-->

                </li>
                <li><a href="eclipse.html">Eclipse Watch</a></li>
                <li><a href="app.html">App</a></li>

              </ul>
            </div>
            <!-- RD Navbar Toggle-->
            <button data-rd-navbar-toggle=".rd-navbar-nav-wrap" class="rd-navbar-toggle"><span></span></button>
          </div>
        </nav>
      </div>
      <!-- RD Parallax-->
      <section class="rd-parallax">
        <section class="rd-parallax">

          <div class="border-md-left inset-md-right-70">
            <div data-speed="0" data-type="media" data-url="assets/images/home-1-1680x674.jpg" class="rd-parallax-layer"></div>
            <div data-speed="0" data-type="html" class="rd-parallax-layer section-cover inset-left-15 inset-right-15">
              <div class="content-middle">
                <div class="brand-slogan">
                  <div class="row">
                    <div class="col-md-8"><img id="imgView" src="assets/pics/courageous.gif" alt="" width="775" height="513" /></div>
                    <!-- <div class="col-md-8"><img id="imgView" src="assets/pics/courageous.gif" alt="" style="width:80rem"/></div> -->

                    <div class="col-md-4" id="aspect" style="font-size:16px">

                    </div>
                  </div>

                  <!-- Current Lunar Intensity:<br><br> -->
                  <h6 id="txtview"> Current </h6>


                  <div class="h6 text-bold text-uppercase slogan-text-bottom">horoscope - current lunar feeling</div>
                </div>
                <div class="row">

                  <div class="col-md-2"></div>
                  <div class="col-md-5"><input type="text" name="ff_nm_from[]" value="" id="searchTextField" class="form-control" style="color:rgb(204, 208, 246);" placeholder="Please enter your city."></div>


                  <div class="col-md-3 form-group"><input type="text" id="datetime-datepicker" class="form-control flatpickr-input" style="color:rgb(204, 208, 246);" placeholder="Date and Time" readonly="readonly"></div>
                  <div class="col-md-2"></div>
                </div><br>
                <button id="btnCalc" class="btn btn-primary btn-rect">calculate</button>



                <a href="#" class="btn btn-primary btn-rect">download app now</a>

              </div>
            </div>
          </div>
        </section>
    </header>
    <!-- Page Content-->
    <main class="page-content" id="protect">
      <!-- shortly about us-->



      <!-- Welcome to our site!-->
      <section class="section-50 section-lg-top-100 section-lg-bottom-110 section-md-left bg-ebony-clay text-md-left">
        <div class="shell">
          <div class="range">
            <div class="cell-md-6">
              <div class="border-md-left inset-md-right-70">
                <h3 class="text-uppercase text-bold text-white">The Moon / Your Moon</h3>
                <p>Download our app and enter your date of birth and we can tell you where your moon is. We also keep
                  track of your lunar returns for you. This gives you a mini reading for the month with an option for a
                  complete lunar return report purchase </p><a href="lunarreturn.html" class="btn btn-xs btn-white btn-rect">read more</a>
              </div>
            </div>
            <div class="cell-md-6">
              <div class="section-img"><img src="assets/images/home-2-838x416.jpg" alt="" width="838" height="416" class="img-responsive" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- shortly about us-->
      <section class="section-50 section-lg-top-100 section-lg-bottom-110 section-md-right bg-ebony-clay text-md-left">
        <div class="shell">
          <div class="range range-md-justify range-md-reverse">
            <div class="cell-md-6">
              <div class="inset-md-left-70">
                <div class="border-md-left">
                  <h3 class="text-uppercase text-bold text-white">Moon Void of Course</h3>
                  <p>Download our app to be easily keep track of the lunar void of course. It's useful for everyone, but
                    when you are around mentally unstable people, this really helps. Know when to stay clear. We keep
                    track for you.</p><a href="lunarvoc.html" class="btn btn-xs btn-white btn-rect">read more</a>
                </div>
              </div>
            </div>
            <div class="cell-md-6">
              <div class="section-img"><img src="assets/images/home-4-838x416.jpg" alt="" width="838" height="416" class="img-responsive" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Our strategy-->
      <section class="section-55 section-md-bottom-100 text-md-left bg-image bg-fixed bg-image-1">
        <div class="shell">
          <div class="range range-md-center">
            <div class="cell-md-6">
              <div class="inset-md-left-55">
                <div class="border-md-left border-left-spacing-lg">
                  <h3 class="text-uppercase text-bold text-white">Eclipse Watch 2019</h3>
                  <p>Our app keeps track of the eclipses for you and notifies you of the each eclipse 30 days before, on
                    the eclipse date, and 30 days after. We also give a brief reading as to what axis it hits and how it
                    will effect you</p>
                </div>
              </div>
            </div>
          </div>
          <ul class="range list-index">
            <li class="cell-md-6 cell-md-preffix-6">
              <div class="unit unit-md unit-md-horizontal unit-md-middle unit-spacing-lg">
                <div class="unit-left">
                  <div class="list-index-counter"></div>
                </div>
                <div class="unit-body">
                  <h5 class="text-uppercase text-bold text-white">Solar Eclipse Jan 5 15 Cap 32</h5>
                  <p>Solar Eclipse January 5 2019 at 15 degrees Capricorn. Those most effected will be anyone with
                    planets at 15 degrees Cancer, Libra, Capricorn, and Aries.</p>
                </div>
              </div>
            </li>
            <li class="cell-md-6 cell-md-preffix-3">
              <div class="unit unit-md unit-md-horizontal unit-md-middle unit-spacing-lg">
                <div class="unit-left">
                  <div class="list-index-counter"></div>
                </div>
                <div class="unit-body">
                  <h5 class="text-uppercase text-bold text-white">Lunar Eclipse Jan 20 00 Leo 49</h5>
                  <p>Lunar Eclipse January 20 2019 at zero degrees Leo. Those most effected will be anyone with planets
                    at zero degrees Leo, Aquarius, Taurus, and Scorpio.</p>
                </div>
              </div>
            </li>
            <li class="cell-md-6 cell-md-preffix-6">
              <div class="unit unit-md unit-md-horizontal unit-md-middle unit-spacing-lg">
                <div class="unit-left">
                  <div class="list-index-counter"></div>
                </div>
                <div class="unit-body">
                  <h5 class="text-uppercase text-bold text-white">Solar Eclipse Jul 2 10 Can 42</h5>
                  <p>Solar Eclipse July 2 2019 at 10 degrees cancer. Those most effected will be the those who have
                    planets at 10 degrees of the cardinal signs, Cancer, Libra, Capricorn, and Aries.</p>
                </div>
              </div>
            </li>
            <li class="cell-md-6 cell-md-preffix-3">
              <div class="unit unit-md unit-md-horizontal unit-md-middle unit-spacing-lg">
                <div class="unit-left">
                  <div class="list-index-counter"></div>
                </div>
                <div class="unit-body">
                  <h5 class="text-uppercase text-bold text-white">Lunar Eclipse Jul 16 24 Cap 01</h5>
                  <p>Lunar Eclipse July 16 2019 at 24 degrees Capricorn. Those most effected will be those with planets
                    at 24 degrees Cancer, Libra, Capricorn, and Aries.</p>
                </div>
              </div>
            </li>
            <li class="cell-md-6 cell-md-preffix-6">
              <div class="unit unit-md unit-md-horizontal unit-md-middle unit-spacing-lg">
                <div class="unit-left">
                  <div class="list-index-counter"></div>
                </div>
                <div class="unit-body">
                  <h5 class="text-uppercase text-bold text-white">Solar Eclipse Dec 25 04 Cap 10</h5>
                  <p>Solar Eclipse Christmas Day December 25 2019 at 4 degrees Capricorn. Those most effected will be
                    those with planets at 4 degrees Cancer, Libra, Capricorn, and Aries.</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="shell text-md-right"><a href="eclipse.html" class="btn btn-primary btn-rect">view all Eclipses</a>
        </div>
      </section>

      <!-- Our team-->
      <section class="section-55 section-md-100 bg-white">
        <div class="shell relative text-lg-left">
          <h3 class="text-bold heading-aside text-uppercase reveal-inline-block">Our Websites</h3>
          <div class="inset-lg-left-150 inset-lg-right-150 text-center offset-top-50 offset-lg-top-0">
            <div class="range range-sm-center">
              <div class="cell-sm-7 cell-md-4"><a href="http://www.astrologymoonsign.com" target="_blank"><img src="assets/images/home-5-269x215.jpg" alt="" width="269" height="215" class="img-responsive" /></a>
                <div class="overflow">
                  <div class="text-bordered">
                    <p class="big text-bold text-uppercase letter-spacing-200 text-top"> Moon Sign</p>
                    <p class="text-light text-uppercase letter-spacing-75 offset-top--10">astrologymoonsign.com</p>
                  </div>
                </div>
              </div>
              <div class="cell-sm-7 cell-md-4 offset-top-50 offset-md-top-110"><a href="http://www.libramoonastrology.com" target="_blank"><img src="assets/images/home-6-269x215.jpg" alt="" width="269" height="215" class="img-responsive" /></a>
                <div class="overflow">
                  <div class="text-bordered">
                    <p class="big text-bold text-uppercase letter-spacing-200 text-top">Libra Moon </p>
                    <p class="text-light text-uppercase letter-spacing-75 offset-top--10">libramoonastrology.com</p>
                  </div>
                </div>
              </div>
              <div class="cell-sm-7 cell-md-4 offset-top-50 offset-md-top-0"><a href="http://www.zodiac-reports.com" target="_blank"><img src="assets/images/home-7-269x215.jpg" alt="" width="269" height="215" class="img-responsive" /></a>
                <div class="overflow">
                  <div class="text-bordered">
                    <p class="big text-bold text-uppercase letter-spacing-200 text-top">Zodiac Reports</p>
                    <p class="text-light text-uppercase letter-spacing-75 offset-top--10">zodiac-reports.com</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- Page Footer-->
    <footer class="page-footer text-md-left" id="protect">
      <div class="shell section-55 section-lg-bottom-100">
        <div class="range">
          <div class="cell-md-4">


            <div class="border-md-left border-left-spacing-lg">
              <h3 class="text-bold text-uppercase text-white">Download the App Android</h3>
              <a href="#" class="btn btn-sm btn-primary btn-rect offset-top-20">Sign Up</a>
            </div>
          </div>
          <div class="cell-md-4 offset-top-70 offset-md-top-0">
            <div class="border-md-left border-left-spacing-lg">
              <h3 class="text-bold text-uppercase text-white">Libra Moon Inc Follow us</h3>
              <ul class="list-inline">
                <li><a href="#" class="icon icon-sm icon-primary fa-google-plus"></a></li>

                <li><a href="https://www.facebook.com/libramoonastrology/" class="icon icon-sm icon-primary fa-facebook"></a></li>

                <li><a href="https://www.pinterest.com/libramoonastro/pins/" class="icon icon-sm icon-primary fa-pinterest"></a></li>
              </ul>
            </div>
          </div>
          <div class="cell-md-4 offset-top-70 offset-md-top-0">
            <div class="border-md-left border-left-spacing-lg">
              <h3 class="text-bold text-uppercase text-white">Download the App Iphone</h3>
              <a href="#" class="btn btn-sm btn-primary btn-rect offset-top-20">Sign Up</a>
            </div>
          </div>
        </div>
      </div>
      <p class="text-uppercase copyright text-center section-40 bg-white"><a href="http://www.barefeetsolutions.com">
          Bare Feet Solutions </a>&#169; <span id="copyright-year"></span> | <a href="privacy.html">Privacy Policy</a>
      </p>
    </footer>
    <!-- {%FOOTER_LINK}-->
  </div>
  <!-- Global Mailform Output-->
  <div id="form-output-global" class="snackbars"></div>
  <!-- PhotoSwipe Gallery-->
  <div tabindex="-1" role="dialog" id="protect" aria-hidden="true" class="pswp">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
      <div class="pswp__container">
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
      </div>
      <div class="pswp__ui pswp__ui--hidden">
        <div class="pswp__top-bar">
          <div class="pswp__counter"></div>
          <button title="Close (Esc)" class="pswp__button pswp__button--close"></button>
          <button title="Share" class="pswp__button pswp__button--share"></button>
          <button title="Toggle fullscreen" class="pswp__button pswp__button--fs"></button>
          <button title="Zoom in/out" class="pswp__button pswp__button--zoom"></button>
          <div class="pswp__preloader">
            <div class="pswp__preloader__icn">
              <div class="pswp__preloader__cut">
                <div class="pswp__preloader__donut"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
          <div class="pswp__share-tooltip"></div>
        </div>
        <button title="Previous (arrow left)" class="pswp__button pswp__button--arrow--left"></button>
        <button title="Next (arrow right)" class="pswp__button pswp__button--arrow--right"></button>
        <div class="pswp__caption">
          <div class="pswp__caption__cent"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Java script-->
  <script src="assets/js/core.min.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="assets/js/flatpickr.min.js"></script>
  <script src="assets/js/bootstrap-colorpicker.min.js"></script>
  <script src="assets/js/bootstrap-clockpicker.min.js"></script>
  <script src="assets/js/form-pickers.init.js"></script>
  <!-- Init js-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnGi-nhwVSUGz8jBwFknsDDEyyxioNc7c&libraries=places"></script>
  <!-- <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyCnGi-nhwVSUGz8jBwFknsDDEyyxioNc7c&language=en&libraries=places%2Cgeometry&ver=0.2.82"></script> -->

  <!-- <link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/flick/jquery-ui.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> -->

  <script type="text/javascript">
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date + ' ' + time;
    var TZ = -(today.getTimezoneOffset() / 60);
    var long = 0;
    var lat = 0;
    var flag = 0;

    function initialize() {
      var options = {
        types: ['(cities)']
      };

      var input = document.getElementById('searchTextField');
      var autocomplete = new google.maps.places.Autocomplete(input, options);
      autocomplete.addListener('place_changed', function() {
        var data = autocomplete.getPlace();
        TZ = data['utc_offset'] / 60;
      });
    }
    google.maps.event.addDomListener(window, 'load', initialize);


    function realRuest() {
      today = new Date();
      var dateOne = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
      var dateNode = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      var nowdateTime = dateOne +' '+dateNode;
      document.getElementById('datetime-datepicker').value = nowdateTime;
      calculate(dateTime, lat, long, TZ);
    }

    function natalRuest() {
      dateTime = $("#datetime-datepicker").val();
      if (dateTime != "") {
        var dateOne = dateTime.split(" ");
        var dateNode = dateOne[1].split(":");
        dateTime = dateOne[0] + " " + dateNode[0] + ":" + dateNode[1];
        calculate(dateTime, lat, long, TZ);
      } else {
        alert("Please Insert all data.");
      }
    }

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        alert("Geolocation is not supported by this browser.\n The standard position is calculated as latitude 0 ° 0 'and longitude 0 ° 0'.");
        long = 0.0;
        lat = 0.0;
      }
    }

    function showPosition(position) {
      long = position.coords.longitude;
      lat = position.coords.latitude;
      document.getElementById('datetime-datepicker').value = dateTime;
      calculate(dateTime, lat, long, TZ);
    }

    function calculate(date, lat, long, tz) {
      console.log(tz);

      $.ajax({
        type: 'POST',
        url: '<?php base_url() ?>calculate',
        data: {
          'dateVal': date,
          'latitude': lat,
          'longitude': long,
          'timezone': tz
        },
        success: function(result) {
          console.log(result);
          var arrAspect = [];
          arrURL = [];
          var res = [];
          var imgUrl = '';
          var minAspect = '';
          res = JSON.parse(result);
          console.log(res);
          document.getElementById("aspect").innerHTML = '';
          var number = res.length;
          for (var i = 0; i < number; i++) {
            var imgResult = res[i].split('|');
            if (imgResult.length > 2) {
              document.getElementById("txtview").innerHTML = "Now moon's position is " + imgResult[5] + ".";
              document.getElementById("aspect").innerHTML += "<b>" + "Moon" + "&nbsp" + imgResult[0] + "&nbsp" + imgResult[1] + "</b>" + "<br>";
              var absVal = Math.abs(imgResult[2]);
              var tempURL = [absVal, imgResult[4]];
              arrURL.push(tempURL);
              arrAspect.push(absVal);
            } else {
              $("#imgView").attr("src", imgResult[0]);
              document.getElementById("txtview").innerHTML = "Now moon's position is " + imgResult[1] + ".";
              return;
            }
          }
          minAspect = Math.min.apply(null, arrAspect);
          imgUrl = getImgUrl(minAspect, arrURL);
          $("#imgView").attr("src", imgUrl);

        }
      });
    }

    function getImgUrl(minAspect, arrURL) {
      var result = '';
      $.each(arrURL, function(index, val) {
        if (val[0] == minAspect) {
          result = val[1];
        }
      });
      return result;
    }

    $(document).ready(function() {
      getLocation();
      setInterval(realRuest, 60000);
      $("#btnCalc").click(function() {
        console.log(TZ);
        natalRuest();
      });

      $("#btnlunar").click(function() {
        var val = "sfsdf";
        $.ajax({
          type: 'POST',
          url: '<?php base_url() ?>lunarreturn',
          data: {
            'val': val
          },
          success: function(result) {
            console.log(result);
          }
        });
      });

      $("#searchTextField").mousedown(function(e) {
        return true;
      });

      $(document).bind("contextmenu", function(e) {
        return false;
      });

      $("#imgView").mousedown(function(e) {
        return false;
      });
      $("#protect").mousedown(function(e) {
        return false;
      });
    });
  </script>
</body>

</html>