<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Mod/Creator</title>
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
      background-image: url("full.png");
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

    .dropdown {
       
        
        padding: 12px 22px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        
        display: inline-block;
        text-align: center;
        font-size: 13px;
    }

    .btn {
        cursor: pointer;
        border-radius: 50px; /* Rounded edges */
        box-shadow: #875EFF;
        -webkit-transition-duration: 0.35;
        transition-duration: 0.35;
        -webkit-transition-property: boxshadow, transform;
        transition-property: boxshadow, transform;
        margin: 13px;
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
         font-size:larger;
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
        <li><a href="{{url('adminHomepage')}}"><strong>&emsp; Home&emsp;&emsp;</strong></a></li>
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

  <div class="container">
    @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form  action="datasubmit" method="POST">
      @csrf
      <div class="col-md-6 form-group">
        <label for="name">Name</label>
        <input class="form-control" name="name" id="name" type="text" placeholder="Enter the first and last name here" >
      </div>
      <div class="col-md-6 form-group">
        <label for="phone">Phone</label>
        <input class="form-control" name="phone" id="phone" type="tel" placeholder="Enter the contact number here" >
      </div>
      <div class="col-md-6 form-group">
        <label for="email">Email</label>
        <input class="form-control" name="email" id="email" type="email" placeholder="Enter the email here">
      </div>
      <div class="col-md-6 form-group">
        <label for="password">Password</label>
        <input class="form-control"  name="password"id="password" type="password" placeholder="Enter the password here">
      </div>
      <div class="col-md-6 form-group">
        <label for="workplace">Workplace</label>
        <input class="form-control" name="workplace" id="workplace" type="text" placeholder="Enter current workplace">
      </div>
      <div class="col-md-6 form-group">
        <label for="position">Position</label>
        <input class="form-control" name="position" id="position" type="text" placeholder="Enter current position">
      </div>
      
        
      <!-- <div class="form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="list" required="required"> List as a moderator.
        </label>
      </div> -->
     
      
       
      <div class="dropdown"><label for="type">List as</label>
      <select name="type" id="type" required="required">
       <option value="moderator">moderator</option>
       <option value="creator">creator</option>
       <option value="tutor">tutor</option>
      </select>
      </div>

      <button type="submit" class="btn btn-primary" style="background-color: #875EFF;">Submit</button>
    </form>
  </div>

</body>

</html>
