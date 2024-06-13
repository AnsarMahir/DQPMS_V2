@php
unset($_SESSION['review_completed']);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css\QuestionCreation_style.css ') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script type="text/javascript">
    localStorage.clear();
    var selectedLanguage = null;

$(document).ready(function() {
  selectedLanguage = $('#selectedLanguage').val(); // Assuming a hidden field

  $('#exam').change(function() {
    var exam = $(this).val();

    $.ajax({
      url: "{{ route('get.languages') }}",
      method: 'GET',
      data: {
        exam: exam
      },
      success: function(data) {
        var $languageDropdown = $('#language');
        $languageDropdown.empty();

        if (data.length) {
          $.each(data, function(key, value) {
            $languageDropdown.append('<option value="' + value + '">' + value + '</option>');
          });
        } else {
          $languageDropdown.append('<option value="">No languages found</option>');
        }

        // Pre-select language if available
        if (selectedLanguage) {
          $('#language').val(selectedLanguage);
        }
      }
    });
  });
});

    </script>    
</head>

<body class="position-relative">
    
    @if (session()->has('message'))

    <div x-data="{show:true}" x-init = "setTimeout(() => show = false , 3000)" x-show='show' class="position-absolute top-0 start-50 translate-middle-x text-light pop-z-index">
    <div class=" px-4 pb-4 popup text-center">
        <i class="bi bi-check-circle-fill fs-1"></i>
        <h5 class="my-auto text-center text-uppercase pt-2">
            {{session('message')}}
        </h5>
    </div>
    </div>

@endif

    
    
    <nav class="navbar navbar-dark navbar-expand-lg text-light py-3 fixed-top bgprimary" >
        <div class="container">
            <a href="#" class="navbar-brand flex-fill align-items-center">DQPMS</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-lg-fill justify-content-lg-center align-items-center" id="navmenu">
                <ul class="navbar-nav text-light" style="column-gap: 2REM;">
                    <li class="nav-item "><a href="#" class="nav-link nav-hover">Home</a></li>
                    <li class="nav-item "><a href="#" class="nav-link nav-hover">FaQ</a></li>
                    <li class="nav-item "><a href="#" class="nav-link nav-hover">Upcoming Exams</a></li>
                    
                </ul>
            </div>
            
            <div class="collapse navbar-collapse flex-lg-fill justify-content-lg-end align-items-center" id="navmenu">
                <ul class="navbar-nav text-light ">
                    <li class="nav-item">
                        <a href="" class="nav-link ps-lg-3">Profile</a>  
                    </li>
                    <li class="badge nav-item">
                        <img src="https://randomuser.me/api/portraits/men/12.jpg" alt="" class="rounded-circle">   
                    </li>
                </ul>

            </div>               
            
        </div>
    </nav>

    <section class="p-5 pt-lg-5 bgbody">
        <div class="container" >
            <div class="p-5 text-center ">
                <h1 class="p-2 textheading">Welcome Student!</h1>
                <h4 class="p-2 textsub">Choose your paper...</h4>
            </div>
            
            <div class="px-5 justify-content-center">

                <form action="/process-form" method="POST" class="row g-3 col-lg-6 mx-auto mt-0"> 
                    @csrf
                    <div class="col-12 m-0">
                        <div class="form-group">
                            <select class="form-select" id="exam" name="exam">
                                <option selected disabled>Examination Name</option>
                                @foreach($examname as $name)
                                <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            </select>
                          </div>                        
                    </div>
            
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-select" id="questionType" name="questiontype">
                                <option selected disabled>Choose your question type</option>
                                <option value="MCQ">MCQ</option>
                                <option value="ShortAnswer">Short Answers</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-select" id="questionNature" name="qnature">
                                <option selected disabled>Choose your question nature</option>
                                @foreach($natures as $nature)
                                <option value="{{ $nature }}">{{ $nature }}</option>
                                @endforeach
                                <option value="All">ALL</option>
                            </select>
                          </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-select" id="language" name="language" value="{{ old('language') }}">
                                <option selected disabled>Choose your Language</option>
                                
                                <option value="English">English</option>
                                
                            </select>
                          </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-select" id="language" name="noofq">
                                <option selected disabled>Choose number of Questions</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-lg btncolor col-xs mx-auto my-5 w-50">
                        <h4>Generate Paper</h4>
                    </button>
                   
                </form>
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            </div>
                
        </div>  

    </section>

    <!-- <footer class="p-4 bg-dark text-white text-center position-relative">
        <div class="container">
            <p class="lead m-0">Copyright &copy; 2024 DQPMS</p>

        </div>
    </footer>  
    
    <script>
        document.addEventListener('DOMContentLoaded', e => {
            $('#input-datalist').autocomplete()
        }, false);
    </script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>