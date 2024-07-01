<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css\QuestionCreation_style.css ') }}">

    <style>

        .profile-image {
            border-radius: 50%;
            /* Creates a circular shape */
            margin-left: auto;
        }
        .button {
            background-color: violet;

        }

        .btn:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .custom-width {
            width: 300px;

        }

        .custom-height {
            height: 60px;

        }

    </style>
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
                <li class="nav-item "><a href="#" class="nav-link nav-hover">Contents</a></li>
                <li class="nav-item "><a href="#" class="nav-link nav-hover">Question Papers</a></li>

            </ul>
        </div>

        <div class="collapse navbar-collapse flex-lg-fill justify-content-lg-end align-items-center" id="navmenu">
            <ul class="navbar-nav text-light ">
                <li class="nav-item">
                    <a href="" class="nav-link ps-lg-3">Profile</a>
                </li>
                <li class="badge nav-item">
                    <img src="" alt="" class="rounded-circle">
                </li>
            </ul>

        </div>

    </div>
</nav>

<section class="p-5 pt-lg-5 bgbody d-flex justify-content-center align-items-center">
    <div class="container text-center">
        <div class="p-5 text-center ">
            <h1 class="p-2 textheading">Welcome Tutor!</h1>
            <h4 class="p-2 textsub">Let's start...</h4>
        </div>

                <div class="px-5 justify-content-center">

                    <form action="/TutorForm2" method="GET" class="row g-3 col-lg-6 mx-auto mt-0">

                        <div class="row justify-content-center">

                            <div class="col-sm-12 col-md-4 col-lg-6 ">

                        <div class="col-md-6">
                            <!--TutorForm2-->
                            <button type="submit" class="btn m-3 custom-width custom-height"
                                    style="background-color: #875EFF;color: hsl(0, 0%, 96%); text-align: center;">
                                <i class="fa fa-users mr-2"></i>Upload Content
                            </button>
                        </div>

                    </form>

                </div>

                    <div class="col-sm-12 col-md-4 col-lg-6 ">

                    <!--TutorForm1-->
                    <form action="/TutorQuestion" method="GET" class="row g-3 col-lg-6 mx-auto mt-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn custom-width custom-height"
                                    style="background-color: #875EFF; color: white;">
                                <i class="fa fa-ban mr-2"></i>Add Question Paper
                            </button>
                        </div>
                    </form>

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
