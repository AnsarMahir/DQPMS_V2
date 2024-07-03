<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Published Papers</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-color: #f0ebfa;
            color: white;
        }

        #bannerimage {
            width: 100%;
            height: 405px;
            background-color: rgba(203, 136, 248, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }

        .centered {
            font-size: 100px;
            margin: 0;
        }

        .second {
            font-size: 40px;
        }

        .card {
            border: 2px solid #d3b8ff;
            color: #a997f0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
            background-color: #ffffff;
        }

        .card-title,
        .card-subtitle {
            color: #14073d;
            margin: 10px;
            font-size: 18px; /* Increased font size */
        }

        .btn {
            background-color: #7b5cf7;
            width: 100%;
            height: 40px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
            border-radius: 12px;
            color: white;
            text-decoration: none;
            text-align: center;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .col-md-4 {
            flex: 0 0 calc(33.3333% - 20px);
            max-width: calc(33.3333% - 20px);
        }

        .card-img-top {
            width: 150px; /* Decreased image size */
            height: auto; /* Maintain aspect ratio */
            margin: 10px auto;
        }
    </style>
</head>

<body>
    <div id="bannerimage">
        <div class="centered">Published Papers</div>
        <div class="second">Sharing Knowledge and Excellence...</div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($publishedPapers as $paper)
            <div class="col">
                <div class="card">
                    <img src="{{ asset('Assets/images/published.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $paper->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Moderation completed. Publication Successful.</h6>

                        <h6 class="card-subtitle mb-2 text-body-secondary">Question Type: {{ $paper->question_type }}</h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Year: {{ $paper->year }}</h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary">No. of Questions: {{ $paper->no_of_questions }}</h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Created by: {{ $paper->paperCreator->name }}</h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>
