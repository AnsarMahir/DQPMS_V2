<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Exams</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>
<style>
    .icon {
        position: absolute;
        bottom: 0;
        right: 0;
        padding: 10px;

    }

    .lable {
        display: inline-block;
        display: flex;
        flex-direction: space;
        width: 100px;

    }

    .card {

        border-radius: 15px;
        border-color: #875EFF;
        color: #875EFF;
        box-shadow: 0 0 30px #b4b3b47e
    }

    .cta-section {
        display: flex;
        flex-direction: column;
        position: absolute;
        bottom: 0;
        right: 0;
        padding: 10px;


    }
</style>

<body>

    <div class="row">
        <nav class="navbar  navbar-expand-lg navbar-dark "
            style="background-color: #875EFF;>
                    <a href=" #" class="navbar-brand">DQPMS</a>
            <button class="navbar-toggle" data-toggle="collapse" data-target="#ccsl"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-center" id="ccsl">
                <ul class="navbar-nav ">
                    <li class="nav-item mr-5 "><a href="#" class="nav-link">Papers</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">user details</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">FAQ</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">Upcoming exams</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link"> Admin<img src="pic\profile.png"
                                height="35" width="" style="border-radius: 50%;" class="mr-1 ml-4">
                        </a></li>


                </ul>
        </nav>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </div>
    </Div>
    <div class="justify-content-center mt-5">
        <div class="container  ">
            <div class="row m-3 ">
                <div class="col-12 ">
                    <h1
                        style="font-size: 30px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; color: rgb(10, 10, 73);">
                        Upcoming exams</h1>

                </div>
                <div class="card mt-5">
                    <div class="card-body">
                        <form action="{{ route('exam.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3 row">
                                <div class="col-sm-12 col-md-2 col-lg-2 ">
                                    <label for="examination" class="form-label">Examination:</label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10 ">
                                    <input type="TEXT" class="form-control" name="examination_name" id="example">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-12 col-md-2 col-lg-2 ">
                                    <label for="examination" class="form-label">Closing Date:</label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10 ">
                                    <input type="date" class="form-control" name="closing_date" id="example">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-12 col-md-2 col-lg-2 ">
                                    <label for="examination" class="form-label">examination date:</label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10 ">
                                    <input type="date" class="form-control" name="exam_date" id="example">
                                </div>
                            </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-12 col-md-2 col-lg-2 ">
                                        <label for="gazzete_notice" class="form-label">Gazzete-notice:</label>
                                    </div>
                                    <div class="col-sm-12 col-md-10 col-lg-10 ">
                                        <input type="file" class="form-control" name="gazzete_notice" id="example">

                                    </div>


                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-12 col-md-2 col-lg-2 ">
                                    <label for="amendment_notice" class="form-label">Amendment-notice:</label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10 ">
                                    <input type="file" class="form-control" name="amendment_notice" id="example">

                                </div>
                            </div>

                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-12 col-md-2 col-lg-2 ">
                                <label for="apply_link" class="form-label">Online Application link:</label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10 ">
                                <input type="url" class="form-control" name="apply_link" id="example">


                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12 col-md-2 col-lg-2 ">
                            <label for="quick_link" class="form-label">Quick-link</label>
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10 ">
                            <input type="url" class="form-control" name="quick_link" id="example">

                        </div>
                    </div>

                        </div>

                </div>
                    </div>

                    <!-- Container for flex display -->

                </div>
            </div>
            <td><button type="submit" class="btn  mb-2" style="background-color: #beadf1 ;">ADD</button>

        </div>

        </form>

    </div>


    </div>


</body>

</html>
