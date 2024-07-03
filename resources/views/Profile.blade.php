<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:url" content="This is my url">
    <meta property="og:image" content="This is my image">
    <meta property="og:title" content="This is my title">
    <meta property='og:description' content='This is my description'>
    <meta property='og:type' content='article'>
    
    <title>Document</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css\Hamas_style.css ') }}">
</head>

<body class="position-relative">
    
    <x-nav-bar/>

    <section class="" style="margin-top: 8rem">

        
        <div class="container" style="">

            <div class="row gx-5 justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="d-flex flex-column justify-content-center align-items-center">

               
                        <img src="{{asset('Level/'.$rank.'.png')}}" alt="This is a new Image" class="w-50 align-content-start">
                
        
                        <h1 class="text-center">{{$creatorName}}</h1>
                        <h5 class="pb-4">Paper Creator</h5> 

                        <h6>Share your Badge</h6>

                        <div class="d-flex gap-2">

                            <a href="/shareBadge/facebook">
                                <button class="btn btncolor">
                                    <i class="bi bi-facebook me-2 fs-5 mx-0" style="display:contents"></i>                            
                                </button> 
                            </a>

                            <a href="/shareBadge/linkedin">
                                <button class="btn btncolor">
                                    <i class="bi bi-linkedin me-2 fs-5 mx-0" style="display:contents"></i>                            
                                </button> 
                            </a>


                        </div>

                        <div class="row mt-5" style="display: contents">                            
                            <h5>For next Level</h5>
                            <div class="progress p-0 ms-2">
                                <div class="progress-bar bgprimary" role="progressbar" style="width: {{($rankStat/40)*100}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex flex-row-reverse p-0">
                                <span>{{$rankStat}}/40</span>
                            </div>
                        </div> 

                        
                                               
                        
        
                    </div> 
                </div>
                <div class="col-6">

                    <canvas id="newChart" style="width:100%;max-width:600px;"></canvas>                    
                    <canvas id="myChart" style="width:100%;max-width:600px; margin-top:2rem"></canvas>
                                          

                </div>
                
                

            </div>  
            
        </div>

    </section>

    <script>
        var mcqShortAnswerXValues = ["MCQ", "ShortAnswer"];
        var mcqShortAnswerYValues = [{{$mcqQuestionsCount}}, {{$shQuestionsCount}}];

        var xValues = ["GK", "IQ", "Math", "Politics", "Economics", "Demographic", "Other"];
        var yValues = [{{$gkQuestionsCount}}, {{$IqQuestionsCount}}, {{$MathQuestionsCount}},{{$PolQuestionsCount}},{{$EcoQuestionsCount}},{{$DemoQuestionsCount}},{{$OtherQuestionsCount}}];
        var barColors = "#875EFF";

    

        var maxValue = Math.max(mcqShortAnswerYValues[0],mcqShortAnswerYValues[1]);
       

        new Chart("newChart", {
        type: "bar",
        data: {
            labels: mcqShortAnswerXValues,
            datasets: [{
                backgroundColor: barColors,
                data: mcqShortAnswerYValues,
                barPercentage: 0.5,
                categoryPercentage: 0.5
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true,
                text: "Number of Questions Created - Question Type",
                fontSize: 20,
                fontStyle: 'bold',
                fontColor: '#000000'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        precision: 0
                    }
                }]
            }
        }
        });

        new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true,
                text: "Number of Questions Created - Question Nature",
                fontSize: 20,
                fontStyle: 'bold',
                fontColor: '#000000'
            },  
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: maxValue,
                        precision: 0
                    }
                }]
            }
        }});
    </script>
    
</body>
</html>

    


    
    