<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD FAQs
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" src="style.css">
    <link rel="script" src="script.js">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        /* Replace 'path-to-your-background-image.jpg' with the actual path to your image */
        background-size: cover;
    }

    .container {
        max-width: 100%;
        padding: 20px;
        color: rgb(15, 15, 15);
        /* Set text color for better contrast */
    }

    .image-container {
        flex: 1;
        text-align: right;
    }

    .professional-image {
        width: 100%;
        max-width: 400px;
        /* Adjust the max-width as needed */
        height: auto;
        border-radius: 10px;
        /* Optional: Add border-radius for a rounded image */}

        .custom-height{
            height: 100px;


        }
        .custom-width{
            width: 300px;
        }
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
            0 0 10px solid red,
            0 0 20px solid red,
            0 0 80px solid red,
            0 0 160px solid red;

        }
        .icon{

    position: absolute;
    bottom: 0;
    right: 0;
    padding: 10px; /* Adjust the padding as needed */
}

.card{
    border-radius: 15px;
    border-color: #875EFF;
    color: #875EFF;
    box-shadow: 0 0 30px #6e6d6e7e

}

.card-title{
    color: darkblue;
}

.container{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    justify-content: space-between;
}

.icon-1{
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 10px; /* Adjust the padding as needed */

}
.card:hover{
    border-color: #875EFF;
}

input[type=text]{
  width: 100%;
  padding: 12px;
  border: 1px solid #875EFF;
  border-radius: 4px;
  box-sizing: border-box;
  resize: vertical;
}

input[type=submit] {
  background-color: #875EFF;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: left;
}

</style>
<body>
    <div class="row">
        <nav class="navbar  navbar-expand-lg navbar-dark " style="background-color: #875EFF;>
                <a href=" #" class="navbar-brand">DQPMS</a>
            <button class="navbar-toggle" data-toggle="collapse" data-target="#ccsl"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-center" id="ccsl">
                <ul class="navbar-nav ">
                    <li class="nav-item mr-5 "><a href="#" class="nav-link">Papers</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">user details</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">FAQ</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">Upcoming exams</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">Admin<img src="pic\profile.png" height="35"
                                width="" style="border-radius: 50%;" class="mr-1 ml-4">
                        </a></li>


                </ul>
        </nav>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </div>
    </div>
    <form action="{{route('FAQ.store')}}" method="POST">
     @csrf
    <div class="justify-content-center mt-5">
        <div class="container  ">
            <div class="row m-3 ">
                <div class="col-12 ">
                    <h1  style="font-size: 35px;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; color: rgb(16, 16, 116);">Add FAQs</h1>

                </div>


            <div class="row mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-selection">

                                <label for="question"><h5 class="card-title">Question:</h5></label><br>
                                <div class="col-75">
                                <input type="text" id="question" name="question">
                                </div>




                        </div>
                        <div class="cta-section">
                            <div class="icon"><i class="bi bi-plus-circle alt="Bootstrap" width="50" height="50"></i></div> </i>
                        </div>
                    </div>

                </div>
                </div>



                <div class="row mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-selection">

                                <label for="answer"><h5 class="card-title">Answer:</h5></label><br>
                                <div class="col-75">
                                <input type="text" id="answer" name="answer">
                                </div>




                        </div>
                        <div class="cta-section">
                            <div class="icon"><i class="bi bi-plus-circle alt="Bootstrap" width="50" height="50"></i></div> </i>
                        </div>
                    </div>

                </div>
                </div>

            <div class="row">
                <a href="{{route('FAQ.index2')}}" class="btn btn-primary mt-5 width="20"">Submit</a>
            </div>
    </form>


</body>
</html>
