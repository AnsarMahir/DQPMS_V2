<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Homepage / User_Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    body {
     /* background-image: url("full.png");*/
      background-repeat: no-repeat;
      background-position: center 2%;
      background-size: cover;
      height: 100%;
      width: 100%;
    }
    li a {
      color: white;
    }
    
    /* Custom style for the navbar-toggler-icon */
    .navbar-toggle .icon-bar {
      background-color: white;
    }
    .navbar-header {
      margin-left: -10%;
    }
    .br5 {border-radius: 5px; border: 1px solid;padding: 2px;padding-left: 50px;}
    .content {width: calc(100% - 90px);}
    .fw600 {font-weight: 600; font-size: 15px;}
    .fw400 {font-weight: 400;}
    
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
          <li><a href="#"><strong>&emsp; User Details&emsp;&emsp;</strong></a></li>
          <li><a href="#"><strong>&emsp; FAQ&emsp;&emsp;</strong></a></li>
          <li><a href="#"><strong>&emsp; Upcoming Exams&emsp;&emsp;&emsp;&emsp;</strong></a></li>
         
          
        </ul>
      </div>
    </div>
  </nav>

 

 </div>

 <!-- data retrieval -->
 
  <br>
 <div class="container  ">
  <div class="justify-content-center mt-5">
      
          <div class="row m-3 ">
              <div class="col-12 ">
                <h2 style="color:rgb(21, 14, 102); font-weight: bold;">User Details</h2>
                
                <div class= "row m-0 p-2">
                
                 @foreach($users as $user)


                 <div class="col-12 shadow-sm big-white p-2 d-flex mb-2 br5">
                  <div class="px-2 content">
                    <p class=" mb-1 fw600">Username : {{$user->name}} </p>
                    <p class=" mb-1 fw400">UserID : {{$user->id}}  </p>
                    <p class=" mb-1 fw400">Email : {{$user->email}}  </p>
                    <!-- password needs to be encrypted when storing -->
                    <p class=" mb-1 fw400">Password : {{$user->password}}  </p>
                    <p class=" mb-1 fw400">Contact Number : {{$user->phone}}  </p>
                    <p class=" mb-1 fw400">Type of User : {{$user->type}} </p>
                    
                  </div>
                </div>
                <br>

                @endforeach

              </div>
              </div>
            </div>


                  
             </div>
             </div>
             <br>
             <!-- "View All" button at the bottom right -->
             <div class="container text-right">
             <button class="btn btn-view-all" data-toggle="modal" data-target="#myModal">View All</button>
             
             <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm"> 
     
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>All user details displayed.</p>
            </div>
        </div>

    </div>
</div>

             </div><br>

</body>

</html>