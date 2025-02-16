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
    <link rel="stylesheet" type="text/css" href="{{ asset('css\Hamas_style.css ') }}" >
</head>

<body>
    <x-nav-bar/>

    <section class="p-5">
        <div class="container pt-5">

            <div class="row pb-4 justify-content-center">
                <div class="col-lg-8 p-4 border shadow">
                    <h3>{{$pastpaper[0]['name']}}</h3>
                    <p> {{$pastpaper[0]['year']}} | {{$pastpaper[0]['language']}} | {{$pastpaper[0]['question_type']}} | {{$pastpaper[0]['no_of_questions']}} Questions</p>
                    <p><b>Status: </b>{{$pastpaper[0]['CreatorState']}}</p>
                </div>
            </div>


                
                {{-- Get Questions into Controller --}}
            @while ($i<$pastpaper[0]['no_of_questions'])
                
                    @if ($pastpaper[0]['question_type']=='MCQ')

                        {{-- @dd($paperData) --}}

                        <x-View-MCQ-Question :i="$i" :data="$paperData"/>
                        
                    @else

                        <x-Edit-SH-Question :i="$i" :data="$paperData"/>
                        
                    @endif

                    @php
                        $i++
                    @endphp
                    
            @endwhile           

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