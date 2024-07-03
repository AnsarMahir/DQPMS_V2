<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>

    <style>
        .headtag {
            font-size: 75px;
            color: blueviolet;
            margin: 40px;
            margin-top: 50px;
        }

        body {
            background-color: rgb(250, 246, 255);
        }
        .panel-heading{
            font-size: 30PX;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="headtag">EXAMINATION CALLENDAR</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Stay Organized with Our Upcoming Examination Calendar!
            </div>
            <div class="panel-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                navLinks: true,
                editable: false,
                events: function (start, end, timezone, callback) {
                    $.ajax({
                        url: "{{ route('getevent') }}",
                        dataType: 'json',
                        success: function (data) {
                            var events = [];
                            $(data).each(function () {
                                events.push({
                                    id: this.id,
                                    title: this.title,
                                    start: this.start,
                                    color: this.color
                                });
                            });
                            callback(events);
                        }
                    });
                },
                displayEventTime: false
            });
        });
    </script>
</body>

</html>
