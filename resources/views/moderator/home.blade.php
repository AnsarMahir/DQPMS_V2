<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>moderator home page </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<style>
    *{@auth

    @endauth
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline:none;

    }
    body{
        background-image: url("{{ asset('Assets/images/full.png') }}");
    background-repeat: no-repeat;
      background-position: center 2%;
      background-size: cover;
      height: 100%;
     width: 100%;
    }

    body{

        width:100%;
        min-height: 100vh;
        display:grid;
        place-itmes:center;
    }
    .row{
        width: 80%;
        max-width: 1170%;
        display: grid;
        grid-template-columns: repeat(2,1fr);
        grid-gap:50px;
        overflow-x: 0.5rem;

    }
    .custom-width {
      width: 300px;

    }

    .custom-height {
      height: 60px;

    }
    .button {
      background-color: violet;

    }

    .btn:hover {
      box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
    .navbar {
      background-color: #875EFF;

    }
    .professional-image {
        width: 100%;
        max-width: 400px;
        /* Adjust the max-width as needed */
        height: auto;
        border-radius: 10px;
        /* Optional: Add border-radius for a rounded image */}


    .a1{
            border: 2px solid purple;
            padding: 10px 30px;
            text-decoration: none;
            z-index: 1;
            overflow: hidden;
            transition: 1s,box-shadow 1s;

        }

        a1:hover{
            transition-delay: 0s,1s;
            color: aqua;
            box-shadow:
            0 0 10px solid red
            0 0 20px solid red,
            0 0 80px solid red,
            0 0 160px solid red;

        }
        .contentwrapper {
    margin-top: 70px; /* Adjust this value to move the buttons down */
}


</style>
<body>
  <div class="container">

    <div class="justify-content-center">
        <div class="container m-3 ">
          <div class="row m-5">
            <div class="col-12 ">
              <h1 class="text-center" style="font-size: 70px;color: #0B036B
                    ;">Welcome Moderator!</h1>
              <p class="text-center" style="font-size: 35px;color: #483FB4
                    ;">Let's start...</p>

    <div class="row ">
        <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="imgwrapper">
            <img src="{{ asset('Assets/images/mod.png') }}" width="500px" alt="">
        </div>
        </div>
        <div class="row ">
        <div class="contentwrapper col-sm-12 col-md-6  col-lg-6">
            <div class=" col-sm-12 col-md-6  col-lg-6">


                    <a href="#" class="btn m-3  custom-width  custom-height"
                      style="background-color: #7041F5;color: hsl(0, 0%, 96%); text-align: center; font-size: larger;">
                      <i class="fa fa-users mr-2"></i>Proofread</a>
                  </div>
                  <div class=" col-sm-12 col-md-6  col-lg-6">


                    <a href="#" class="btn m-3  btn custom-width  custom-height "
                      style="background-color: #7041F5; color: white;font-size: larger;">
                      <i class="fa fa-ban mr-2"></i>View Papers</a>
                  </div>
                  <div class="col-sm-12 col-md-6  col-lg-6 ">


                    <a href="{{ url(config('chatify.routes.prefix')) }}" class="btn m-3  btn custom-width  custom-height "
                      style="background-color: #7041F5; color: white;font-size: larger;">
                      <i class="fa fa-ban mr-2"></i>connect with paper creator</a>
                  </div>
                  <div class="col-sm-12 col-md-6  col-lg-6">




                    <a href="{{ route('comment') }}" class="btn m-3  btn custom-width  custom-height "
                      style="background-color: #7041F5; color: white;font-size: larger;">
                      <i class="fa fa-ban mr-2"></i>Get Report</a>
                  </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</body>
</html>
