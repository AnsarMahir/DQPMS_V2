<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="{{ asset('Assets/css/bootstrap.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: darkblue;
            margin: 20px 0;
        }

        .card-container {
            display: flex;
            justify-content: center;
            gap: 40px; /* Adjust the gap between the cards */
            flex-wrap: wrap; /* Allow wrapping if screen width is narrow */
        }

        .card {
            border-radius: 15px;
            border-color: #875EFF;
            color: #333;
            box-shadow: 0 0 30px #b4b3b47e;
            width: 500px; /* Adjust card width */
            height: 400px; /* Adjust card height */
            display: flex;
            flex-direction: row; /* Arrange children in a row */
            overflow: hidden; /* Ensure content doesn't overflow */
            position: relative;
        }

        .card img {
            width: 40%; /* Adjust width to occupy the left side */
            object-fit: contain; /* Ensure image is fully contained within the space */
            height: 100%; /* Make the image height match the card height */
        }

        .card-body {
            padding: 20px;
            flex: 1; /* Allow the text to take the remaining space */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
        }

        .card-title {
            font-size: 2rem; /* Adjust title font size */
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1.2rem; /* Adjust text font size */
            margin-bottom: 20px;
        }

        .btncolor {
            color: white;
            background-color: #7748ff;
            border-color: #7748ff;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 1.2rem; /* Adjust button font size */
            transition: background-color 0.3s, border-color 0.3s;
            text-align: center; /* Center align text */
            text-decoration: none; /* Remove underline from button */
        }

        .btncolor:hover {
            background-color: #6339d6;
            border-color: #6339d6;
        }

        .btn-container {
            display: flex;
            justify-content: center; /* Center buttons horizontally */
            gap: 10px; /* Add space between the buttons */
        }
        .heading{
            margin-top: 40px;
            margin-bottom: 130px;

        }
    </style>
</head>
<body>
    <div class="heading">
    <h1 >Upcoming Exams</h1></div>
    <div class="card-container">
        <!-- First Card: Upcoming Exam -->
        <div class="card">
            <img src="{{ asset('Assets/images/bell4.png') }}" alt="Upcoming Exam">
            <div class="card-body">
                <h5 class="card-title">Upcoming Exam</h5>
                <p class="card-text">View details of upcoming exams, download gazzete and essential information to prepare effectively.</p>
                <div class="btn-container">
                    <a href="{{ route('user') }}" class="btncolor">View Exams</a>
                </div>
            </div>
        </div>

        <!-- Second Card: Examination Calendar -->
        <div class="card">
            <img src="{{ asset('Assets/images/bell3.png') }}" alt="Examination Calendar">
            <div class="card-body">
                <h5 class="card-title">Examination Calendar</h5>
                <p class="card-text">Access the examination calendar to keep track of important dates.</p>
                <div class="btn-container">
                    <a href="{{ route('getevent') }}" class="btncolor">View Calendar</a>
                </div>
            </div>
        </div>

        <!-- Third Card: Discussion Forum -->
        <div class="card">
            <img src="{{ asset('Assets/images/discussion.png') }}" alt="Discussion Forum">
            <div class="card-body">
                <h5 class="card-title">Discussion Forum</h5>
                <p class="card-text">Join the forum to discuss upcoming exams and get help from peers and experts.</p>
                <div class="btn-container">
                    <a href="{{ route('forum') }}" class="btncolor">Join Discussion</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
