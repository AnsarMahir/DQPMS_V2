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

    <section class="p-5 pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="col" style="border-radius: 5px; background-color:#7e53ff">

                        <div class="d-flex flex-column">
                            <div class="flex flex-column p-4 text-light">
                                <h5 >Srilanka Administration Service</h4>
                                <p> 2016 | English | MCQ | 5 Questions</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col" style="background-color: cornflowerblue; border-radius: 5px">

                        <div class="d-flex flex-column">
                            <div class="flex flex-column p-4">
                                <h5>Srilanka Administration Service</h4>
                                <p> 2016 | English | MCQ | 5 Questions</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col" style="background-color: cornflowerblue; border-radius: 5px">

                        <div class="d-flex flex-column">
                            <div class="flex flex-column p-4">
                                <h5>Srilanka Administration Service</h4>
                                <p> 2016 | English | MCQ | 5 Questions</p>
                            </div>
                        </div>

                    </div>
                </div>
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