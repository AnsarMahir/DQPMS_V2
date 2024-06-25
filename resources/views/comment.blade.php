<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
        background-image: url("{{ asset('Assets/images/full.png') }}");
              background-repeat: no-repeat;
      background-position: center 2%;
      background-size: cover;
      height: 100%;
     width: 100%;
        }
        .header-container {
            display: flex;
            align-items: center;
            margin-top: 10px;

        }
        .header-container h1 {
            font-size: 50px;
            color: rgb(160, 51, 233);
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #875EFF;">
            <a href="#" class="navbar-brand">DQPMS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ccsl"
                aria-controls="ccsl" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="ccsl">
                <ul class="navbar-nav">
                    <li class="nav-item mr-5"><a href="#" class="nav-link">Papers</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">User Details</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">FAQ</a></li>
                    <li class="nav-item mr-5"><a href="{{ route('user') }}" class="nav-link">Upcoming Exams</a></li>
                    <li class="nav-item mr-5">
                        <a href="#" class="nav-link">Admin<img src="pic/profile.png" height="35" width=""
                                style="border-radius: 50%;" class="mr-1 ml-4"></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container ">
        <div class="header-container">
        <img src="{{ asset('Assets/images/icon.jpeg') }}" width="75px" alt="">
        <h1 style="margin-top: 10px; font-size: 50px; color: rgb(160, 51, 233);"> Discussion Forum </h1>

        </div>
        <hr style="margin-top: 20px; border-color: purple; border-width:10px">

    @foreach($post as $posts)
        <h1 style="color: rgb(44, 18, 105) ">{{$posts->title }}</h1>
                <h1 style="color: rgb(44, 18, 105) ">{{ $posts->description }}</h1>

                <livewire:comments :model="$posts"/>


    @endforeach
    </div>
</body>
</html>
