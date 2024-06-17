<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <style>
    body {
      /*background-image: url("full.png");*/
      background-repeat: no-repeat;
      background-position: center 2%;
      background-size: cover;
      height: 100%;
      width: 100%;
    }
    li a {
      color: white;
    }
    .custom-width {
        width: 250px;

    }

    .custom-height {
        height: 60px;

    }
    .container {
        max-width: 100%;
        padding: 20px;}
    
    /* Custom style for the navbar-toggler-icon */
    .navbar-toggle .icon-bar {
      background-color: white;
    }
    .navbar-header {
      margin-left: -10%;
    }
    .image-container {
        flex: 1;
        text-align: center;
    }

    .professional-image {
        width: 100%;
        max-width: 400px;
       
        height: auto;
        border-radius: 10px;
        /* Optional: Add border-radius for a rounded image */


    }

    .btn {
        cursor: pointer;
        /*border-radius: 50px;  Rounded edges */
        box-shadow: #875EFF;
        -webkit-transition-duration: 0.35;
        transition-duration: 0.35;
        -webkit-transition-property: boxshadow, transform;
        transition-property: boxshadow, transform;
        margin: 5px;
        display: flex;
        flex-direction: column;



    }

    .btn:hover,
    .btn:focus,
    .btn:active {
        box-shadow: 0 0 20px rgba (0, 0, 0, 0.5);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

    .h1 {
         font-size(4rem);
    }

    .h1 {
        font-size: calc(1.525rem + 3.3vw);
    }

    @media (min-width: 1200px) {
        .h1 {
            font-size: 4rem;
        }
    }
  </style>
</head>

<body class="body">

  <nav class="navbar navbar-light" style="background-color: blueviolet;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#" style="color:white;">DQPMS</a>
      </div>
     
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{url('publishedPapers')}}"><strong>&emsp; Papers&emsp;&emsp;</strong></a></li>
          <li><a href="{{url('userDetails')}}"><strong>&emsp; User Details&emsp;&emsp;</strong></a></li>
          <li><a href="#" style="color:white;"><strong>&emsp; FAQ&emsp;&emsp;</strong></a></li>
          <li><a href="#"><strong>&emsp; Upcoming Exams&emsp;&emsp;&emsp;&emsp;</strong></a></li>
          
          
        </ul>
      </div>
    </div>
  </nav>

 <br>
 <br>
  
 <div class="justify-content-center">
  <div class="container m-3 ">
      <div class="row m-5">
          <div class="col-12 ">
              <h2 class="text-center" style="font-size: 45px;">Welcome Admin!</h2>
              <p class="text-center" style="font-size: 30px;">Let's start...</p>
          </div>

          <br><br>

          <div class="row justify-content-center"> <!-- Centering the buttons -->
              <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="{{url('addMod')}}"><button
                      class="btn rounded-pill m-5 custom-width custom-height text-center"
                      style="background-color: #875EFF ;font-size: 18PX; color:white;">
  
                      Add Moderator</button></a>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="{{url('addCreator')}}"><button
                      class="btn rounded-pill m-5 custom-width custom-height text-center"
                      style="background-color: #c7b9f1;font-size:18PX;   color:white;">
                      Add Paper Creator</button></a>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                  <button
                      class="btn rounded-pill m-5 custom-width custom-height text-center"
                      style="background-color: #875EFF; font-size:18PX;  color:white;" >Add FAQs
                  </button>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                  <button
                      class="btn rounded-pill m-5 custom-width custom-height text-center"
                      style="background-color: #d6cdf3; font-size:18PX; color:white;">
                      Post Upcoming Exams</button>
              </div>
          </div>

      </div>
    </div>
  </div>
</body>

</html>
