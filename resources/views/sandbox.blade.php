<!DOCTYPE html>
<html lang="en" class="has-navbar-fixed-top">
<head>
    <title>SmartKoli - Admin</title>  
    @include('layouts.headers')
    <link rel="stylesheet" type="text/css" href="{{url('/css/main.css')}}">
</head>
<body>
    @include('layouts.navbar')

    <div id='main' class='container'>        
        <div class='section'>
            <div class='columns'>
                <div class='column'>
                    <div class="panel">
                        <p class="panel-heading">BKK járatok</p>
                        <div class="panel-block">
                            <div id="bkk">
                                <ul id="departure_list"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='columns'>
                <div class='column'>
                    <div class="panel">
                        <p class="panel-heading">Vue próba</p>
                        <div class="panel-block">
                            <div id="root">
                                <input class="input" type="text" id="textinput" v-model="message">

                                <p>The value of the input is {{ message }}</p>
                            </div>

                            <script>
                                new Vue({
                                    el: '#root'
                                    data: {
                                        message: 'Hello World'
                                    }
                                })
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        

    @include('layouts.footer')

    <script>
        $( document ).ready( function() {
            bkk_getdata();
            setInterval(bkk_getdata, 3000);
        });

        function bkk_getdata() {
            $.ajax({
                type: 'get',
                url: 'https://futar.bkk.hu/api/query/v1/ws/otp/api/where/arrivals-and-departures-for-stop.json?key=apaiary-test&version=3&appVersion=apiary-1.0&includeReferences=true&stopId=BKK_F01221&onlyDepartures=false&limit=60&minutesBefore=0&minutesAfter=30&fbclid=IwAR3SO9lc1zqkClKg9yaoAaNq3Rbkqm5MhF3_BmLSwrx_jbJG8sV52g2M8_U',
                dataType: 'jsonp',
                success: function(data) {
                    document.getElementById("departure_list").innerHTML = "";
                    data.data.entry.stopTimes.forEach(element => {
                        var date = new Date(0);
                        date.setUTCSeconds(element.predictedDepartureTime);
                        var datetext = date.getHours().toString() + ':' + date.getMinutes().toString();
                        var list = document.createElement("LI");
                        var text = document.createTextNode(element.stopHeadsign + '(indul: ' + datetext + ')'); 
                        list.appendChild(text);
                        document.getElementById("departure_list").appendChild(list);
                    });
                },
                error: function(data) {
                    alert('error');
                }
            });
        }
    </script>
</body>
</html>