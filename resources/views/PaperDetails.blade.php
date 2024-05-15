<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css\QuestionCreation_style.css ') }}" >
    <script>
      window.history.forward(); 
        function noBack() { 
            window.history.forward(); 
        } 
    </script>
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg text-light py-3 fixed-top bgprimary">
        <div class="container">
            <a href="#" class="navbar-brand">DQPMS</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto text-light">
                    <li class="nav-item"><a href="#" class="nav-link color-w">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Published</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Drafts</a></li>
                    <li class="nav-item ">
                        <a href="" class="nav-link ps-lg-3">Profile</a>  
                    </li>
                    <li class="badge nav-item">
                        <img src="https://randomuser.me/api/portraits/men/12.jpg" alt="" class="rounded-circle">   
                    </li>
                </ul>
            </div>  
        </div>
    </nav>

    <section class="p-5">
        <div class="container">
                <div class="d-flex align-items-center justify-content-center p-5">
                    <div class="border align-items-center justify-content-center shadow bg-white rounded w-50 p-3 h-50 rounded border-2 border-top-2"
                      style="background-color: rgb(255, 255, 255);border-color: #7041f5 !important;">
                      <div>
                        <span class="h3 fw-bolder family seccolor" 
                          > {{$selectedValues["exam"]}} <br /></span
                        ><span class="h6 pricolor family" 
                          > {{$selectedValues["language"]}} | {{$selectedValues["questiontype"]}}<br /><br /><br /></span
                        ><span
                          class="fs-5 pricolor family "
                          > |{{$selectedValues["noofq"]}} MCQ | 12 Mins<br /><br /><br /></span
                        ><span class=" pb-4 seccolor fs-3 fw-bolder text-decoration-underline family"
                          
                          >Instructions<br /></span
                        ><span class="seccolor fs-4 family fw-normal "
                          ><br /></span
                        ><span class="seccolor family fw-normal"
                          style="
                            font-size: 21px;
                          "
                          >Answer all questions.<br />In each of the questions, pick one of
                          the alternatives from (1), (2), (3), (4), (5) which is correct or
                          most appropriate.</span
                        >
                      </div>
                      <form action="/Question" method="POST">
                      <div class="d-grid gap-2 col-lg-6 mx-auto p-4">
                        @csrf
                        @foreach($selectedValues as $key => $value)
                        <input type="hidden" name="selectedValues[{{ $key }}]" value="{{ $value }}">
                        @endforeach
                          <button class="btn btncolor text-light" type="submit"><h5>Attempt Paper</h5></button>
                          </div>
                        </form>
                </div>

        </div>
    </section>

    

    <!-- <footer class="p-4 bg-dark text-white text-center position-relative">
        <div class="container">
            <p class="lead m-0">Copyright &copy; 2024 DQPMS</p>

        </div>
    </footer>   -->
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>