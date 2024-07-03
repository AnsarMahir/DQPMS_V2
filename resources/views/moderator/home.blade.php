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
    <title>Moderator Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }
        body {
            background-image: url("{{ asset('Assets/images/full.png') }}");
            background-repeat: no-repeat;
            background-position: center 2%;
            background-size: cover;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            overflow-x: hidden;
        }
        .content-wrapper {
            width: 80%;
            max-width: 1200px;
        }
        .welcome-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 60px; /* Increased margin between rows */
        }
        .welcome-text {
            text-align: center;
            margin-top: 60px; /* Adjust this value to add top margin */
        }
        .welcome-text h1 {
            font-size: 80px; /* Increased font size */
            color: #0B036B;
            margin-bottom: 20px; /* Added margin below header */
        }
        .welcome-image {
            margin-top: 20px;
        }
        .welcome-image img {
            width: 100%;
            max-width: 800px; /* Increased welcome image size */
            border-radius: 10px;
        }
        .card-group {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            flex: 1;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 20px;
            min-width: 250px;
            height: 400px; /* Increased card height */
        }
        .card img {
            width: 100%;
            height: 150px;
            object-fit: contain;
            padding: 10px;
        }
        .card-body {
            padding: 15px;
        }
        .card-body p {
            font-size: 14px;
            margin-bottom: 40px;
        }
        .btncolor {
            color: white;
            font-size: 20px;
            background-color: #7748ff;
            border-color: #7748ff;
        }
        .btncolor:hover {
            border-color: #7748ff;
        }
        .card-group .btn {
            margin: 0; /* Align buttons in a horizontal line */
            width: 200px; /* Full width for the buttons */
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="welcome-section">
            <div class="welcome-text">
                <h1>Welcome Moderator!</h1>
            </div>
            <div class="welcome-image">
                <img src="{{ asset('Assets/images/mod.png') }}" alt="Moderator Image">
            </div>
        </div>
        <div class="card-group">
            <div class="card">
                <img src="{{ asset('Assets/images/modicon.jpg') }}" alt="Proofread">
                <div class="card-body">
                    <h5 class="card-title">Proofread</h5>
                    <p>Moderate and proofread the exam papers created by paper creators.</p>
                    <a href="{{ route('moderator.papers') }}" class="btn btncolor">Go to Proofread</a>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('Assets/images/published.png') }}" alt="View Published Papers">
                <div class="card-body">
                    <h5 class="card-title">View Published Papers</h5>
                    <p>Check the papers that have been published after the moderation process.</p>
                    <a href="{{ route('published.papers') }}"  class="btn btncolor"> Published Papers</a>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('Assets/images/report.png') }}" alt="Do Analysis">
                <div class="card-body">
                    <h5 class="card-title">Do Analysis</h5>
                    <p>Go to your dashboard and analyze the performance.</p>
                    <a href="{{ route('moderator.dashboard') }}" class="btn btncolor">Do Analysis</a>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('Assets/images/chat3.jpg') }}" alt="Connect with Paper Creator">
                <div class="card-body">
                    <h5 class="card-title">Connect with Paper Creator</h5>
                    <p>Chat with paper creators to discuss and provide feedback.</p>
                    <a href="{{ url(config('chatify.routes.prefix')) }}" class="btn btncolor">Connect Now</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
