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
      background-repeat: no-repeat;
      background-position: center 2%;
      background-size: cover;
      height: 100%;
      width: 100%;
    }
    li a {
      color: white;
    }
    .container {
        max-width: 100%;
        padding: 20px;
    }
    
    .navbar-toggle .icon-bar {
      background-color: white;
    }
    .navbar-header {
      margin-left: -10%;
    }

    .big-card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
      background-color: white;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      max-width: 630px;
      margin: auto; /* Center the big card horizontally */
      margin-top: -2%;
      padding: 30px; /* Equal padding on all sides */
    }

    .card-custom {
      border: 2px solid #875EFF;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s;
      padding:15px;
      margin: 10px; /* Adjusted margin */
      background-color: white;
      max-width: 300px;
    }
    .card-custom:hover {
      transform: scale(1.05);
    }
    .card-body-custom {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
    }
    .card-text-custom {
      color: black;
      font-size: 15px;
      font-weight:500px ;
      text-decoration: none;
    }
    .card-text-custom:hover {
      text-decoration: none;
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

  
  
  <div class="container text-center mb-4">
    <h2 style="font-size: 35px;">Welcome Admin!</h2>
    <p style="font-size: 22px;">Let's start...</p>
  </div>
  
  <div class="container justify-content-center">
    <div class="big-card mx-auto">
      <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12 mb-4">
          <div class="card card-custom">
            <div class="card-body card-body-custom">
              <a href="{{url('addMod')}}" class="card-text-custom">Add Moderator / Tutor</a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 mb-4">
          <div class="card card-custom">
            <div class="card-body card-body-custom">
              <a href="{{url('addMod')}}" class="card-text-custom">Add Paper Creator</a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 mb-4">
          <div class="card card-custom">
            <div class="card-body card-body-custom">
              <a href="#" class="card-text-custom">Add FAQs</a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 mb-4">
          <div class="card card-custom">
            <div class="card-body card-body-custom">
              <a href="#" class="card-text-custom">Post Upcoming Exams</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
