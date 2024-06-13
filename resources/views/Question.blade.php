
@php 
$answerindex = 0; 
$counter=1;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css\Question_style.css ') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
    <script>
        function updateCountdown() {
            let initialTime = localStorage.getItem('initialTime');
            if (!initialTime) {
                // Set initial time in minutes
                initialTime = {{ $time }}*60;
                localStorage.setItem('initialTime', initialTime); // Save initial time in seconds
            }
    
            let timeInSeconds = initialTime;

            // Function to convert seconds to minutes and seconds
            function convertTime(seconds) {
                let minutes = Math.floor(seconds / 60);
                let remainingSeconds = seconds % 60;
                return {
                    minutes: minutes,
                    seconds: remainingSeconds
                };
            }
    
            // Display the time in the button
            function displayTime(minutes, seconds) {
                let displayMinutes = (minutes < 10 ? '0' : '') + minutes;
                let displaySeconds = (seconds < 10 ? '0' : '') + seconds;
                document.getElementById('countdown').innerText = displayMinutes + ':' + displaySeconds;
            }
    
            // Reduce the time by 1 second
            function tick() {
                timeInSeconds--;
                let time = convertTime(timeInSeconds);
                displayTime(time.minutes, time.seconds);
    
                localStorage.setItem('initialTime', timeInSeconds); // Update stored time in seconds
    
                // Check if the timer has reached 0
                if (timeInSeconds <= 0) {
                    clearInterval(interval);
                    localStorage.removeItem('initialTime'); // Clear stored time when countdown ends
                    $('#countdown-form').submit();
                   
                }
            }
    
            tick(); // Call tick immediately to display initial time
    
            // Update the countdown every second
            let interval = setInterval(tick, 1000);
        }  
        // Call updateCountdown when the page loads
        $(document).ready(function() {
            updateCountdown();
            examfinish();
           
        });

        window.history.forward(); 
        function noBack() { 
            window.history.forward(); 
        } 
    </script>
</head>

<body class="d-flex flex-column min-vh-100">

    <section class="p-5 mt-auto">
        <div class="container">
            
            <form action="/Review" method="POST" id="countdown-form" >
                <div class="d-grid d-sm-block pb-3 sticky-top">
                    <button class="btn btn-primary ms-0 bgbody text-dark" type="button" id="countdown">{{$time}}:00</button>
                </div>

            @foreach ($questions as $question)
            <div class="row"> {{-- Question box starts here--}}
                <div class="col-12">
                    <div class="mb-4 shadow-lg rounded border border-3 bgbody">
                        <div class="py-3 px-4">
                        <h4>Question {{$loop->iteration}}
                        </h4>
                        <p> {{ $question->description }}</p>
                        @foreach($qreference as $q)
                        @if($question->referenceid == $q['R_id'])
                            {!!$q['reference_HTML']!!}
                        @endif
                        @endforeach  
                        </div>
                        <div class="px-4">
                                @csrf
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefaultHidden" value="0" style="display: none;" checked>
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault2" value="1">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    {{-- @foreach($answerreference as $a)
                                                    @if($answers[$answerindex]->reference == $a['R_id'])
                                                    {!!$a['reference_HTML']!!}
                                                    @endif
                                                    @endforeach  --}}
                                                    {{ $answers[$answerindex]->description }}
                                                </label>
                                              </div>
    
                                        </div>
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault1" value="2">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{-- @foreach($areference as $a)
                                                    @if($answers[$answerindex]->reference == $a['R_id'])
                                                    {!!$a['reference_HTML']!!}
                                                    @endif
                                                    @endforeach --}}
                                                    {{ $answers[$answerindex + 1]->description }}
                                                </label>
                                              </div>
    
                                        </div>
                                    </div>
                                    <div class="row">
    
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault1" value="3">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                     {{-- @foreach($areference as $a)
                                                    @if($answers[$answerindex]->reference == $a['R_id'])
                                                    {!!$a['reference_HTML']!!}
                                                    @endif
                                                    @endforeach  --}}
                                                    {{ $answers[$answerindex + 2]->description }}
                                                </label>
                                              </div>
    
                                        </div>
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault2" value="4">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                     {{-- @foreach($areference as $a)
                                                    @if($answers[$answerindex]->reference == $a['R_id'])
                                                    {!!$a['reference_HTML']!!}
                                                    @endif
                                                    @endforeach  --}}
                                                    {{ $answers[$answerindex + 3]->description }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($finalizedmcqid as $item)
                                <input type="hidden" name="finalids[]" value="{{ $item }}">
                                @endforeach
                        </div>
                </div>
                </div>
                @php 
                $answerindex += 4; 
                @endphp
            @endforeach
            <div class="d-flex flex-row-reverse pb-3">
                <button class="btn btn-dark" type="submit" id="submit-btn">Submit</button>
            </div>
        </form>
    </section>
    
    <footer class="p-4 bg-dark text-white text-center mt-auto">
        <div class="container">
            <p class="lead m-0">Copyright &copy; 2024 DQPMS</p>

        </div>
    </footer>

    {{-- modal to show --}}
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Incomplete Answers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    You have unanswered questions. Do you want to proceed to review or go back to change your answers?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="change-answers-btn">Change Answers</button>
                    <button type="button" id="proceed-btn" class="btn btn-primary">Proceed to Review</button>
                </div>
            </div>
        </div>
    </div>  
    <script>
        document.getElementById('countdown-form').addEventListener('submit', function(event) {
            const radios = document.querySelectorAll('input[type="radio"]:checked');
            let allAnswered = true;
        
            radios.forEach(function(radio) {
                if (radio.value == "0") {
                    allAnswered = false;
                }
            });
        
            if (!allAnswered) {
                event.preventDefault();
                $('#confirmationModal').modal('show');
            }
        });
        
        document.getElementById('proceed-btn').addEventListener('click', function() {
            $('#confirmationModal').modal('hide');
            document.getElementById('countdown-form').submit();
        });
        
        document.getElementById('change-answers-btn').addEventListener('click', function() {
            $('#confirmationModal').modal('hide');
        });
        </script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>