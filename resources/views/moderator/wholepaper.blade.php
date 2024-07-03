<?php

$i=0;

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<style>

.pop-z-index{
    z-index: 10000;
    margin-top: 90px;
}

.popup{
background-color: #5d2fba;
border-radius: 5px;


}

.bgprimary{
background-color: #7e53ff
}

.bgbody{
background-color: #efe9ff;
height: 100vh;
}

.textheading{
color: #0b036b;
}

.textsub{
color: #483FB4
}

.btncolor{
color: white;
background-color: #a181ff;
border-color: #8e68ff;
}

.btn:hover{
border-color: #8e68ff;
}

.bgImage{
background-image: url('/images/Vector 2.png');
background-repeat: no-repeat;
background-size: contain;
}


.nav-link{
color: white;
}

.badge{
    display: inline-block;
    vertical-align: middle;
    width: 50px;
    height: 50px;
    overflow: hidden;
    border-radius: 50%;
}

.badge img{
    width: 100%;
    height: auto;
    object-fit: cover;
}

.col-centered {
    float: none;
    margin-right: auto;
    margin-left: auto;
}

.nav-hover:hover{
    border-radius: 10px;
    color:  #0b036b !important;
    background-color: #efe9ff;;

}

.paperCard:hover{
    border-style: solid;
    border-width: thin;
    border-radius: 5px;
    border-color: #0b036b;
    color: #0b036b !important;
    background-color: #efe9ff;
}

.bgprimary{
  background-color: #875EFF;
}

.bgbody{
  background-color: #efe9ff;
}
.textheading{
  color: #0b036b;
}

.textsub{
  color: #483FB4
}

.btncolor{
  color: white !important;
  background-color: #a181ff;
  border-color: #8e68ff;
}

.btn:hover{
  border-color: #8e68ff;
  color: black !important;
}

.bgImage{
  background-image: url('/images/Vector 2.png');
  background-repeat: no-repeat;
  background-size: contain;
}


.nav-link{
  color: white;
}

.badge{
    display: inline-block;
    vertical-align: middle;
    width: 50px;
    height: 50px;
    overflow: hidden;
    border-radius: 50%;
 }

 .badge img{
    width: 100%;
    height: auto;
    object-fit: cover;
 }

 .col-centered {
    float: none;
    margin-right: auto;
    margin-left: auto;
  }

  .noBorder {
    background: transparent;
    border: none;
    border-bottom: 1px solid #adadad;
    outline:none;
    box-shadow:none;
  }

 .noBorder:hover{
  border-bottom: 1px solid #000000;
 }

 .noBorder:focus{
  border-bottom: 1px solid #000000;
  box-shadow: none;
 }


 .form-control::placeholder {
  color: rgb(123, 123, 123);
  opacity: 1;
}


</style>
</head>

<body>


    <section class="p-5">
        <div class="container pt-5">

            <div class="row pb-4 justify-content-center">

                <div class="col-lg-8 p-4 border shadow">
                    <h3>{{$pastpaper[0]['name']}}</h3>
                    <p> {{$pastpaper[0]['year']}} | {{$pastpaper[0]['language']}} | {{$pastpaper[0]['question_type']}} | {{$pastpaper[0]['no_of_questions']}} Questions</p>
                </div>
            </div>

           {{--@dd($paperData)--}}

            <form action="/QuestionStore" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Get Pastpaper Data into controller --}}
                {{-- @foreach ($pastpaper[0] as $data) --}}

                <input type="hidden" value="{{$pastpaper[0]['P_id']}}" name="pastpaperData[]">
                <input type="hidden" value="{{$pastpaper[0]['no_of_questions']}}" name="pastpaperData[]">
                <input type="hidden" value="{{$pastpaper[0]['question_type']}}" name="pastpaperData[]">




                {{-- @endforeach --}}


                {{-- Get Questions into Controller --}}
                @while ($i<$pastpaper[0]['no_of_questions'])

                    @if ($pastpaper[0]['question_type']=='MCQ')

                        {{-- @dd($paperData) --}}

                        <x-m-c-q :i="$i" :data="$paperData"/>

                    @else
                    <x-s-h :i="$i" :data="$paperData"/>


                    @endif

                    @php
                        $i++
                    @endphp

                @endwhile


                <div class="row justify-content-center">
                    <div class="col-lg-8 px-0">
                        <div class="d-flex flex-row-reverse">
                            <button class="btn btncolor ms-2  text-dark" type="submit">publish</button>

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
