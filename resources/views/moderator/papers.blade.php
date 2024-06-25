<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <section class="p-5">
        <div class="container">

            <div class="row pb-4 justify-content-center">
                <div class="col-lg-8 p-4 border shadow">
                    <h3>{{$paperdata}}
                    </h3>
                    <p>English | MCQ | 5 Questions | 15 Mins</p>
                </div>
            </div>

            <div class="row justify-content-center pb-4">
                    <div class="col-lg-8 p-4 border shadow">
                            <form action="">

                                <div class="d-flex justify-content-between align-items-center" style="column-gap: 1rem;">
                                    <div class="d-flex flex-fill">
                                        <input type="text" class="form-control rounded-0" placeholder="Enter the Question Here.." id="name">
                                    </div>
                                    <div class="d-flex align-items-center" style="column-gap: 1rem;">
                                        <div class="form-group" style="width: 6rem;">
                                            <select class="form-select" id="questionNature">
                                              <option>IQ</option>
                                              <option>GK</option>
                                              <option>Math</option>
                                              <option>Logic</option>
                                            </select>
                                          </div>
                                          <button class="btn pb-3"><i class="bi-image fs-3"></i></button>

                                    </div>
                                </div>

                                <div class="row" style="column-gap: 2rem;">
                                    <div class="col-lg-5 mt-3">
                                        <div class="form-check d-flex align-items-center" style="column-gap: 1rem;">
                                            <input class="form-check-input shadow border border-dark" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" disabled>
                                            <input type="text" class="form-control rounded-0" placeholder="Option 1" id="name">
                                            <button class="btn pb-3"><i class="bi-image fs-4"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 mt-3">
                                        <div class="form-check d-flex align-items-center" style="column-gap: 1rem;">
                                            <input class="form-check-input shadow border border-dark" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" disabled>
                                            <input type="text" class="form-control rounded-0" placeholder="Option 2" id="name">
                                            <button class="btn pb-3"><i class="bi-image fs-4"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row " style="column-gap: 2rem;">
                                    <div class="col-lg-5 mt-3">
                                        <div class="form-check d-flex align-items-center" style="column-gap: 1rem;">
                                            <input class="form-check-input shadow border border-dark" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" disabled>
                                            <input type="text" class="form-control rounded-0" placeholder="Option 3" id="name">
                                            <button class="btn pb-3"><i class="bi-image fs-4"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 mt-3">
                                        <div class="form-check d-flex align-items-center" style="column-gap: 1rem;">
                                            <input class="form-check-input shadow border border-dark" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" disabled>
                                            <input type="text" class="form-control rounded-0" placeholder="Option 4" id="name">
                                            <button class="btn pb-3"><i class="bi-image fs-4"></i></button>
                                        </div>
                                    </div>
                                </div>





                                <!-- <div class="d-flex align-items-center" style="column-gap: 1rem; width: fit-content;">
                                    <input class="form-check-input shadow border border-dark" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" disabled>
                                    <button class="btn btn-sm btn-link">Add Option</button>
                                </div> -->

                                <div class="d-flex mt-3 align-items-center">
                                    <button class="btn btn-sm pt-0"><i class="bi bi-clipboard-check fs-3"></i> Set Answer</button>
                                </div>


                            </form>


                    </div>


            </div>


            <div class="row justify-content-center">
                <div class="col-lg-8 px-0">
                    <div class="d-flex flex-row-reverse">
                        <button class="btn btncolor ms-2  text-dark" type="button">Submit</button>
                        <button class="btn  ms-0  text-dark" type="button">Save as Draft</button>
                    </div>

                </div>
            </div>

            @dd($paperdata)
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
