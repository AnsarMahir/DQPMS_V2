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
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
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
        /* Optional: Add border-radius for a rounded image */
    }

    .custom-height {
        height: 100px;


    }

    .custom-width {
        width: 300px;
    }

    .a1 {
        border: 2px solid purple;
        padding: 10px 30px;
        text-decoration: none;
        z-index: 1;
        overflow: hidden;
        transition: 1s, box-shadow 1s;

    }

    a1:hover {
        transition-delay: 0s, 1s;
        color: aqua;
        box-shadow:
            0 0 10px solid red,
            0 0 20px solid red,
            0 0 80px solid red,
            0 0 160px solid red;

    }

    .icon {

        position: absolute;
        bottom: 0;
        right: 0;
        padding: 10px;
        /* Adjust the padding as needed */
    }
    .card-subtitle {
    margin-bottom: 30px; /* Add margin-bottom to separate each subtitle */
    width: 500px;
}
.btn {
    margin-top: 10px;
    background-color: #beadf1 /* Add margin-top to create space between buttons and text */
}
    .card {
        border-radius: 15px;
        border-color: #875EFF;
        color: #875EFF;
        box-shadow: 0 0 30px #d5a2ec7e;
        margin-bottom: 20px;
    }

    .card-title {
        color: darkblue;
        margin-bottom: 10px;
    }
    .card-body {
    display: flex;
    flex-direction: column;
    width: 100%;
}


    .container {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        justify-content: space-between;
    }

div.transbox {
  margin: 30px;
  background-color: #ffffff;
  border: 1px solid black;
  opacity: 0.6;
}




    .icon-1 {
        position: absolute;
        bottom: 0;
        right: 0;
        padding: 10px;
        /* Adjust the padding as needed */

    }






    .card:hover {
        border-color: #875EFF;
    }
</style>
<!-- At the end of the body -->



<body>
    <div class="row">
        <nav class="navbar  navbar-expand-lg navbar-dark " style="background-color: #875EFF;>
                <a href="
            #" class="navbar-brand">DQPMS</a>
            <button class="navbar-toggle" data-toggle="collapse" data-target="#ccsl"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-center" id="ccsl">
                <ul class="navbar-nav ">
                    <li class="nav-item mr-5 "><a href="#" class="nav-link">Papers</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">user details</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">FAQ</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link">Upcoming exams</a></li>
                    <li class="nav-item mr-5"><a href="#" class="nav-link"> Admin<img src="pic\profile.png"
                                height="35" width="" style="border-radius: 50%;" class="mr-1 ml-4">
                        </a></li>


                </ul>
        </nav>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </div>
    </Div>
    
    <div class="m-40px d-flex justify-content-end">
        <a href="{{ route('comment') }}" class="btn btn-primary">Community Forum</a>
    </div>


    <div class="justify-content-center mt-5">
        <div class="container  ">
            <div class="row m-3 ">
                <div class="col-12 ">
                    <h1
                        style="font-size: 35px;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; color: rgb(16, 16, 116);">
                        Upcoming exams</h1>
<!-- Add this input field for the search bar -->

<input class="form-control me-2" id="searchInput" onkeyup="filterCards()" placeholder="Search for upcoming exams..."type="search"  aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
                </div>
                @foreach ($upcomingexams->sortBy('closing_date')->take(5) as $upcomingexam)
                    <div class="row mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-selection">
                                    <span class="countdown-label" style="color: red;">
                                        Time remaining until closing date:
                                    </span>
                                    <p class="card-subtitle" id="countdown_{{ $loop->index }}" data-closing-date="{{ $upcomingexam->closing_date }}"></p>
                                    <h5 class="card-title scope=row">{{ $upcomingexam->examination_name }}</h5>
                                </div>


                                    <p class="card-subtitle mb-10">closing date      - {{ $upcomingexam->closing_date }}</p>
                                    <p class="card-subtitle mt-10">examination date    - {{ $upcomingexam->exam_date }}</p>
                                    <p class="card-subtitle">Gazette Notice-
                                        <a href="{{ asset($upcomingexam->gazzete_notice) }}" download>
                                            <button type="button" class="btn " style="background-color: #d3c9f0">Download Gazette Notice</button>
                                        </a>
                                    </p>
                                    <p class="card-subtitle mb-10">Amendment Notice             -
                                        <a href="{{ asset($upcomingexam->amendment_notice) }}" download>
                                            <button type="button" class="btn" style="background-color: #d8cff3">Download Amendment Notice</button>
                                        </a>
                                    </p>


                                    <a href class="card-subtitle">Apply via - {{ $upcomingexam->apply_link }}</p>
                                        <a href class="card-subtitle">For more info visit - {{ $upcomingexam->quick_link }}</p>


                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach





                <script>
                    // Function to calculate and update countdown timer
                    function updateCountdown(closingDate, elementId) {
                        const countdownElement = document.getElementById(elementId);

                        // Set the date we're counting down to
                        const countDownDate = new Date(closingDate).getTime();

                        // Update the countdown every second
                        const x = setInterval(function() {
                            // Get the current date and time
                            const now = new Date().getTime();

                            // Calculate the remaining time
                            const distance = countDownDate - now;

                            // Calculate days, hours, minutes, and seconds
                            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            // Display the countdown timer
                            countdownElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                            // If the countdown is over, display 'Closed'
                            if (distance < 0) {
                                clearInterval(x);
                                countdownElement.innerHTML = "Closed";
                            }
                        }, 1000); // Update every second
                    }

                    // Fetch all countdown elements and update them
                    const countdownElements = document.querySelectorAll('[id^="countdown_"]');
                    countdownElements.forEach(function(element) {
                        const closingDate = element.dataset.closingDate; // Fetch closing date from data attribute
                        updateCountdown(closingDate, element.id);
                    });







                    function filterCards() {
        // Get input value and convert it to lowercase for case-insensitive matching
        var input = document.getElementById('searchInput').value.toLowerCase();

        // Get all card titles and loop through them
        var cardTitles = document.querySelectorAll('.card-title');
        cardTitles.forEach(function(title) {
            // Get the parent card element
            var card = title.closest('.card');

            // Get the text content of the card title and convert it to lowercase
            var titleText = title.textContent.toLowerCase();

            // Get the text content of the closing date
            var closingDateText = card.querySelector('.card-subtitle:last-of-type').textContent.toLowerCase();

            // Check if the input matches the title or closing date
            if (titleText.includes(input) || closingDateText.includes(input)) {
                // If there's a match, display the card
                card.style.display = "block";
            } else {
                // If there's no match, hide the card
                card.style.display = "none";
            }
        });
    }
                </script>

</body>

</html>
