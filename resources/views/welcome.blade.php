<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SozlerEgypt</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chewy&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>

            body{
                color:#fff;
                background:#000;
                }
                p {
                text-align: center;
                font-size: 60px;
                margin: 5px;
                font-family:'Chewy';
            }
            .box:before{
                content: "";
                background: darkgrey;
                position: absolute;
                z-index: 10;
                top: 43px;
                left: 0;
                width: 80px;
                height: 2px;
                border-bottom: 1px solid #fff;
            }
            .box{
                font-family:'Verdana, Geneva, sans-serif' !important;
                margin:0 5px;
                padding: 10px;
                position: relative;
                /*float: left;*/
                width: 60px;
                height: 86px;
                font-size: 60px;
                line-height: 86px;
                border-radius: 4px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.3);
                color:#555555;
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ebebeb+0,ebebeb+50,ffffff+51,f8f8f8+100 */
                background: rgb(235,235,235); /* Old browsers */
                background: -moz-linear-gradient(top, rgba(235,235,235,1) 0%, rgba(235,235,235,1) 50%, rgba(255,255,255,1) 51%, rgba(248,248,248,1) 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(top, rgba(235,235,235,1) 0%,rgba(235,235,235,1) 50%,rgba(255,255,255,1) 51%,rgba(248,248,248,1) 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to bottom, rgba(235,235,235,1) 0%,rgba(235,235,235,1) 50%,rgba(255,255,255,1) 51%,rgba(248,248,248,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ebebeb', endColorstr='#f8f8f8',GradientType=0 ); /* IE6-9 */
            }
            small{
                display: block;
                clear: both;
                letter-spacing: 3px;
                font-size: 12px;
                line-height: 12px;
                font-weight: 700;
                text-transform: uppercase;
                text-align: center;
                padding-top: 13px;
            }
            #Days, #Hours, #Minutes, #Seconds {
                float:left;margin:0px;
            }
            .time-content {
                width: 40%;
                margin: 0 auto;
            }
            .time-content p {
                width: calc(97%/4);
            }
            #dateEnd, #action{
                display:block;
                margin:0 auto;
            }

        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height" style="padding: 100px 0;">
            <div class="content">
                <p style="padding: 70px 0;font-size: 5rem">SozlerEgypt</p>

                <div class="time-content">
                    <p id="Days"></p>
                    <p id="Hours"></p>
                    <p id="Minutes"></p>
                    <p id="Seconds"></p>
                </div>                
            </div>
        </div>

        <script>
            function clean0(timeto0) {
                if (timeto0 < 10){
                    var timeto0 = '0'+timeto0;  
                }else{
                    var timeto0 = timeto0;
                }
                return timeto0;
            }
            var countDownDate = new Date("Mar 15, 2022 00:00:00").getTime();
            // Update the count down every 1 second
            var x = setInterval(function() {
                // Get todays date and time
                var now = new Date().getTime();
                // Find the distance between now an the count down date
                var distance = countDownDate - now;
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                var days = clean0(days);
                var hours = clean0(hours);
                var minutes = clean0(minutes);
                var seconds = clean0(seconds);
                // Output the result in an element with id="demo"
                document.getElementById("Days").innerHTML = "<span class='box'>"+days+"</span><small>Days</small>";
                document.getElementById("Hours").innerHTML = "<span class='box'>"+hours+ "</span><small>Hours</small>";
                document.getElementById("Minutes").innerHTML = "<span class='box'>"+minutes+"</span><small>Minutes</small>";
                document.getElementById("Seconds").innerHTML = "<span class='box'>"+ seconds + "</span><small>Seconds</small>";
                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
            }, 1000);

        </script>
    </body>
</html>
