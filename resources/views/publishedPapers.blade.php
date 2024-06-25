<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
    
    /* Custom style for the navbar-toggler-icon */
    .navbar-toggle .icon-bar {
      background-color: white;
    }
    .navbar-header {
      margin-left: -10%;
    }
    /* Adjusted style for the "View All" button */
    .btn-view-all {
      background-color:blueviolet;
      color: white;
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
          <li><a href="#"><strong>&emsp; FAQ&emsp;&emsp;</strong></a></li>
          <li><a href="#"><strong>&emsp; Upcoming Exams&emsp;&emsp;&emsp;&emsp;</strong></a></li>
         
          
        </ul>
      </div>
    </div>
  </nav>

  <br>
  <br>
  
  <div class="container">
    <div class="justify-content-center mt-5">
      <div class="row m-3">
        <div class="col-12">
          <h2 style="color:rgb(21, 14, 102); font-weight: bold;">Published Papers</h2>
          <br>
          <div class="card mt-5">
            <div class="card-body">
              <table class="table table-hover justify-content-center table-PRIMARY table-borderless table-striped">
                <thead>
                  <tr class="table-dark">
                    <th scope="col">Paper</th>
                    <th scope="col">Published Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Language</th>
                    <th scope="col">No. of questions</th>
                    <th scope="col">Creator</th>
                    <th scope="col">Moderator</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="">SLDLE</td>
                    <td>02/06</td>
                    <td>MCQ</td>
                    <td>Sinhala</td>
                    <td>20</td>
                    <td>Mark</td>
                    <td>Jacob</td>
                  </tr>
                  <tr>
                    <td class="">SLDLE</td>
                    <td>02/03</td>
                    <td>MCQ</td>
                    <td>English</td>
                    <td>20</td>
                    <td>Mark</td>
                    <td>Jacob</td>
                  </tr>
                  <tr>
                    <td class="">SLLCE</td>
                    <td>02/04</td>
                    <td>MCQ</td>
                    <td>Sinhala</td>
                    <td>20</td>
                    <td>Jess</td>
                    <td>Henry</td>
                  </tr>
                  <tr>
                    <td class="">SLLCE</td>
                    <td>02/01</td>
                    <td>MCQ</td>
                    <td>English</td>
                    <td>20</td>
                    <td>Jess</td>
                    <td>Henry</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- "View All" button at the bottom right -->
  <div class="container text-right" style="position: fixed; bottom: 20px; right: 20px;" data-toggle="modal" data-target="#myModal">
    <button class="btn btn-view-all">View All</button>
  </div>
   
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm"> 
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>All published papers displayed.</p>
            </div>
        </div>

    </div>
</div>
</body>

</html>
