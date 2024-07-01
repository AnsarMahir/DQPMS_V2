<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        background-size: cover;
    }
    .container {
        max-width: 100%;
        padding: 20px;
        color: rgb(15, 15, 15);
    }
    .navbar {
        background-color: #875EFF;
    }
    .navbar-brand, .nav-link {
        color: white;
    }
    .card {
        border-radius: 15px;
        border-color: #875EFF;
        color: #875EFF;
        box-shadow: 0 0 30px #6e6d6e7e;
    }
    .card-title {
        color: darkblue;
    }
    .card:hover {
        border-color: #875EFF;
    }
    input[type=text], textarea {
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
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a href="#" class="navbar-brand">DQPMS</a>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item mr-5"><a href="#" class="nav-link">Papers</a></li>
                <li class="nav-item mr-5"><a href="#" class="nav-link">User Details</a></li>
                <li class="nav-item mr-5"><a href="#" class="nav-link">FAQ</a></li>
                <li class="nav-item mr-5"><a href="#" class="nav-link">Upcoming Exams</a></li>
                <li class="nav-item mr-5"><a href="#" class="nav-link">Admin <img src="pic/profile.png" height="35" width="35" style="border-radius: 50%;" class="ml-2"></a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        @yield('content')
    </div>
</body>
</html>
