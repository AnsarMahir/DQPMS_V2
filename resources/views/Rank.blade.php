<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:url" content="localserver">
    <meta property="og:image" content="https://firebasestorage.googleapis.com/v0/b/dqpms-5abb0.appspot.com/o/Level1.png?alt=media&token=7d81cf15-49a1-4702-91c3-e5b2e9e08675">
    <meta property="og:title" content="Hello World">
    <meta property="og:type" content="article">
    
    <title>Document</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/f903cca9e5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css\Hamas_style.css ') }}">
</head>

<body class="position-relative">
    
    <x-nav-bar/>

    <section class="" style="margin-top: 6rem">

        <h1 style="padding-bottom: 10px;" class="text-center">Welcome, {{ $userName }}</h1>
        <div class="container" style="">

            <div class="row gx-5">
                <div class="col-md-6">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ $firebaseImageUrl }}" alt="" class="w-50 align-content-start">
        
                        <div class="share-buttons">
                            <h3>Share your badge:</h3>
                            <a class="share-button" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($firebaseImageUrl) }}" target="_blank">
                                <img src="https://cdn-icons-png.flaticon.com/512/174/174848.png" alt="Share on Facebook" width="40">
                            </a>
                            <a class="share-button" href="https://twitter.com/intent/tweet?url={{ urlencode($firebaseImageUrl) }}&text=Check%20out%20my%20badge!" target="_blank">
                                <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Share on Twitter" width="40">
                            </a>
                            <a class="share-button" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($firebaseImageUrl) }}&title=My%20Badge" target="_blank">
                                <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="Share on LinkedIn" width="40">
                            </a>
                            <a class="share-button" href="https://api.whatsapp.com/send?text={{ urlencode($firebaseImageUrl) }}" target="_blank">
                                <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="Share on WhatsApp" width="40">
                            </a>
                        </div>
                    </div> 
                </div>
                <div class="col-6">

                    
                <h2 style="padding-top: 20px;">Your current level: {{ $level }}</h2>

        <div class="progress" style="height: 30px; width:400px; ">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                {{ $progress }}%
            </div>
        </div>
        <p>You have answered {{ $rightcount }} questions correctly.
        @if ($questionsToNextLevel > 0)
        {{ $questionsToNextLevel }} questions </br>remaining to reach the next level.</p>
    @else
        Congratulations! You have reached the highest level.</p>
    @endif               
        </div>
            </div>  
        </div>
    </section>
    
</body>
</html>