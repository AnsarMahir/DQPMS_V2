<?php

$i=0;

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

            <div class="row pb-4 justify-content-center">
                <div class="col-lg-8 p-4 border shadow">
                    <h3>{{$pastpaper['examName']}}</h3>
                    <p> {{$pastpaper['year']}} | {{$pastpaper['language']}} | {{$pastpaper['questionType']}} | {{$pastpaper['numberOfQuestions']}} Questions</p>
                </div>
            </div>

            <form action="/QuestionStore" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Get Pastpaper Data into controller --}}
                @foreach ($pastpaper as $data)

                <input type="hidden" value="{{$data}}" name="pastpaperData[]">
                    
                @endforeach

                
                {{-- Get Questions into Controller --}}
                @while ($i<$pastpaper['numberOfQuestions'])
                
                    @if ($pastpaper['questionType']=='MCQ')

                        <x-Create-MCQ-Question :i="$i"/>
                        
                    @else

                        <x-Create-SH-Question :i="$i"/>
                        
                    @endif

                    @php
                        $i++
                    @endphp
                    
                @endwhile           
                

                <div class="row justify-content-center">
                    <div class="col-lg-8 px-0">
                        <div class="d-flex flex-row-reverse">
                            <button class="btn btncolor ms-2  text-dark" type="submit">Submit</button>
                            <button class="btn  ms-0  text-dark" type="submit" formaction="{{route('problems')}}">Save as Draft</button>                        
                        </div>
                        
                    </div>
                </div>

            </form>     

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