<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Exams</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<style>
    body {
        margin: 0;
        padding: 0;
        background-size: cover;
        background-color: #f8f9fa;

    }

    .container {
        max-width: 1200px;
        padding: 20px;
    }



    .card {
        border-radius: 15px;
        border-color: #875EFF;
        color: #875EFF;
        box-shadow: 0 0 30px #d5a2ec7e;
        margin-bottom: 20px;
        transition: transform 0.2s;
        font-size: 1.1rem;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-title {
        color: darkblue;
        font-weight: bold;
        font-size: 1.8rem;
        margin: 20px;
    }

    .card-subtitle {
        font-size: 1.4rem;
        margin-top: 10px;
    }

    .card img {
        max-width: 100px;
        margin-bottom: 10px;
    }

    .btn {

        color: white;
        background-color: #7748ff;
        border-color: #7748ff;
        margin: 10px;
    }

    .btn:hover {
        border-color: #7748ff;
        border-color: #7748ff;
    }



    .btn-primary:hover {
        background-color: #6c43cc;
        border-color: #6c43cc;
    }

    .search-container {
        margin-bottom: 70px;
        margin-top: 100px;
    }

    .icon-1 {
        position: absolute;
        bottom: 0;
        right: 0;
        padding: 10px;
    }
</style>

<body>


    <div class="container">


        <div class="search-container">
            <input class="form-control" id="searchInput" onkeyup="filterCards()"
                placeholder="Search for upcoming exams..." type="search" aria-label="Search">
        </div>

        <div class="row">
            @foreach ($upcomingexams->sortBy('closing_date')->take(5) as $upcomingexam)
                <div class="col-md-6 col-lg-6 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('Assets/images/examicon.png') }}" class="card-img-top" alt="Exam Icon">
                        <div class="card-body d-flex flex-column">
                            <div class="text-selection">
                                <span class="countdown-label" style="color: red;">Time remaining until closing
                                    date:</span>
                                <p class="card-subtitle" id="countdown_{{ $loop->index }}"
                                    data-closing-date="{{ $upcomingexam->closing_date }}"></p>
                                <h5 class="card-title">{{ $upcomingexam->examination_name }}</h5>
                            </div>
                            <div class="card-subtitle">Closing Date: {{ $upcomingexam->closing_date }}</div>
                            <div class="card-subtitle">Examination Date: {{ $upcomingexam->exam_date }}</div>
                            <div class="card-subtitle">Gazette Notice:
                                <a href="{{ asset($upcomingexam->gazzete_notice) }}" download>
                                    <button type="button" class="btn" style="background-color: #d3c9f0">Download
                                        Gazette Notice</button>
                                </a>
                            </div>
                            <div class="card-subtitle">Amendment Notice:
                                <a href="{{ asset($upcomingexam->amendment_notice) }}" download>
                                    <button type="button" class="btn" style="background-color: #d8cff3">Download
                                        Amendment Notice</button>
                                </a>
                            </div>
                            <div class="card-subtitle">Apply via : <a href="{{ $upcomingexam->apply_link }}"
                                    target="_blank">{{ $upcomingexam->apply_link }}</a></div>
                            <div class="card-subtitle">For more info visit : <a href="{{ $upcomingexam->quick_link }}"
                                    target="_blank">{{ $upcomingexam->quick_link }}</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function updateCountdown(closingDate, elementId) {
            const countdownElement = document.getElementById(elementId);
            const countDownDate = new Date(closingDate).getTime();
            const x = setInterval(function() {
                const now = new Date().getTime();
                const distance = countDownDate - now;
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                countdownElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                if (distance < 0) {
                    clearInterval(x);
                    countdownElement.innerHTML = "Closed";
                }
            }, 1000);
        }

        const countdownElements = document.querySelectorAll('[id^="countdown_"]');
        countdownElements.forEach(function(element) {
            const closingDate = element.dataset.closingDate;
            updateCountdown(closingDate, element.id);
        });

        function filterCards() {
            var input = document.getElementById('searchInput').value.toLowerCase();
            var cardTitles = document.querySelectorAll('.card-title');
            cardTitles.forEach(function(title) {
                var card = title.closest('.card');
                var titleText = title.textContent.toLowerCase();
                var closingDateText = card.querySelector('.card-subtitle:nth-child(3)').textContent.toLowerCase();
                if (titleText.includes(input) || closingDateText.includes(input)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }
    </script>
</body>

</html>
