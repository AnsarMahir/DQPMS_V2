<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Upcoming Exams</title>
    <link href="{{ asset('Assets/css/customform.css') }}" rel="stylesheet">
    <link href="{{ asset('Assets/css/bootstrap.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>
<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .navbar {
        margin-bottom: 20px;
    }

    .card {
        border-radius: 15px;
        border-color: #875EFF;
        color: #875EFF;
        box-shadow: 0 0 30px #b4b3b47e;
        margin-top: 30px;
    }

    .card-body {
        padding: 20px;
    }

    .form-label {
        font-weight: bold;
        color: #333;
        font-size: 1.3rem
    }

    .form-control {
        border-radius: 10px;
    }

    .btn-lg {
        background-color: #beadf1;
        border-color: #beadf1;
        color: #fff;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 16px;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .btn-lg:hover {
        background-color: #9a8de0;
        border-color: #9a8de0;
    }

    .alert-danger {
        border-radius: 10px;
        padding: 10px;
    }
    .headtitle{
        margin: 20px;
    }

    h1 {
        font-size: 30px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        color: rgb(10, 10, 73);
    }
</style>

<body>
<!-- Display success message -->


    <div class="container">




        <div class="row justify-content-center">
            <div class="col-12">
                <div class="headtitle">
                <h1><br>
                    Post Upcoming Examinations </h1></div>
            </div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                @endif
            <div class="col-12">
                <div class="card">
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
                                <label for="examination" class="col-sm-12 col-md-2 col-lg-2 form-label">Examination:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input type="text" class="form-control" name="examination_name" placeholder="Enter examination name..." id="example">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="closing_date" class="col-sm-12 col-md-2 col-lg-2 form-label">Closing Date:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input type="date" class="form-control" name="closing_date" placeholder="Enter closing date..." id="example">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="exam_date" class="col-sm-12 col-md-2 col-lg-2 form-label">Examination Date:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input type="date" class="form-control" name="exam_date" placeholder="Enter examination date..." id="example">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="gazzete_notice" class="col-sm-12 col-md-2 col-lg-2 form-label">Gazette Notice:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input type="file" class="form-control" name="gazzete_notice" placeholder="Upload gazette..." id="example">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="amendment_notice" class="col-sm-12 col-md-2 col-lg-2 form-label">Amendment Notice:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input type="file" class="form-control" name="amendment_notice" placeholder="Upload amendment notice..." id="example">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="apply_link" class="col-sm-12 col-md-2 col-lg-2 form-label">Online Application Link:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input type="url" class="form-control" name="apply_link" placeholder="Enter online application link..." id="example">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="quick_link" class="col-sm-12 col-md-2 col-lg-2 form-label">Quick Link:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input type="url" class="form-control" name="quick_link" placeholder="Enter quick link..." id="example">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-12 col-md-10 col-lg-10 offset-md-2">
                                    <button type="submit" class="btn btn-lg">Post Notice</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
