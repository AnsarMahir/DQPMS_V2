<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css\StudentHomepage_style.css ') }}">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg text-light py-3 fixed-top bgprimary" >
        <div class="container">
            <a href="#" class="navbar-brand flex-fill align-items-center">DQPMS</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-lg-fill justify-content-lg-center align-items-center" id="navmenu">
                <ul class="navbar-nav text-light" style="column-gap: 2REM;">
                    <li class="nav-item "><a href="CreatorHomepage" class="nav-link nav-hover">Home</a></li>
                    <li class="nav-item "><a href="Draftpapers" class="nav-link nav-hover">Drafted Papers</a></li>
                    <li class="nav-item "><a href="#" class="nav-link nav-hover">Published Papers</a></li>
                    
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
                <h1 class="p-2 textheading">Welcome Creator!</h1>
                <h4 class="p-2 textsub">Create your paper...</h4>
            </div>
            
            <div class="px-5 justify-content-center">

                <form action="/QuestionCreation" method="GET" class="row g-3 col-lg-6 mx-auto mt-0"> 
                    
                    <div class="col-12 m-0">
                        <div class="form-group">
                            <select class="form-select" name="examName">
                                <option selected disabled>Examination Name</option>
                                <option>Sri Lanka Administration Service</option>
                                <option>Sri Lanka Ports and Authorities</option>
                            </select>
                            
                            @error('examName')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                            @enderror  
                        </div>                      
                    </div>

                   
            
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-select" name="questionType">
                                <option selected disabled>Choose the question type</option>
                                <option>MCQ</option>
                                <option>Short Answers</option>
                            </select>
                            @error('questionType')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type='number' step="1" class="form-control" placeholder="Enter the year" name="year">
                            @error('year')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-select" id="language" name="language">
                                <option selected disabled>Choose the Language</option>
                                <option>English</option>
                                <option>Sinhala</option>
                                <option>Tamil</option>
                            </select>
                            @error('language')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                             
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type='number' max="50" step="5" class="form-control" placeholder="Enter Number of Questions" name="numberOfQuestions">
                            @error('numberOfQuestions')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-lg btncolor col-xs mx-auto my-5 w-50">
                        <h4>Create Paper</h4>
                    </button>
                      
                </form>


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