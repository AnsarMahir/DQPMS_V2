<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Exams</title>
    <link href="{{ asset('Assets/css/bootstrap.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2.5rem;
            color: #333;
        }

        .card-container {
            display: flex;
            justify-content: center;
            gap: 50px; /* Increase the gap between the cards */
        }

        .card {
            border-radius: 15px;
            border-color: #875EFF;
            color: #333;
            box-shadow: 0 0 30px #b4b3b47e;
            width: 700px; /* Increase card width */
            height: 350px; /* Increase card height */
            display: flex;
            flex-direction: row; /* Arrange children in a row */
            overflow: hidden; /* Ensure content doesn't overflow */
            position: relative;
        }

        .card img {
            width: 40%; /* Increase width to occupy the left side more */
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
            font-size: 1.8rem; /* Increase title font size */
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1.2rem; /* Increase text font size */
            margin-bottom: 20px;
        }

        .btncolor {
            color: white;
            background-color: #7748ff;
            border-color: #7748ff;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
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
            margin: 60px;
        }

    </style>
</head>
<body>
    <div class="heading">
    <h1>Upcoming Exams</h1></div><br><br><br>
    <div class="card-container">
        <div class="card">
            <img src="{{ asset('Assets/images/exam_form4.png') }}" alt="Examination">
            <div class="card-body">
                <h5 class="card-title">Post New Examination</h5>
                <p class="card-text">Post details about an upcoming examination and upload the gazette notices, provide application links.</p>
                <div class="btn-container">
                    <a href="{{ route('exam.index') }}" class="btncolor">Post Examination</a>
                </div>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('Assets/images/discussion.png') }}" alt="Discussion">
            <div class="card-body">
                <h5 class="card-title">Start New Discussion</h5>
                <p class="card-text">Start a new discussion topic related to upcoming examinations and engage with community forum</p>
                <div class="btn-container">
                    <a href="{{ url('/discussion/create') }}" class="btncolor">Start Discussion</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
