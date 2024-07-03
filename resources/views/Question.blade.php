
@php 
$answerindex = 0; 
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
    <script>
    // Load the tab switch count from localStorage or initialize it if it doesn't exist
    let tabSwitchCount = localStorage.getItem('tabSwitchCount') ? parseInt(localStorage.getItem('tabSwitchCount')) : 0;
    const maxTabSwitches = 1;

    // Function to handle blur event
    function handleBlur() {
        tabSwitchCount++;
        localStorage.setItem('tabSwitchCount', tabSwitchCount);
        if (tabSwitchCount <= maxTabSwitches) {
            document.getElementById('warning-modal-message').innerText = `Warning: You have ${maxTabSwitches - tabSwitchCount + 1} more chance(s) left.`;
            var warningModal = new bootstrap.Modal(document.getElementById('warningModal'));
            warningModal.show();
        } else {
            document.getElementById('countdown-form').submit();
        }
    }

    
    window.addEventListener('blur', handleBlur);

    // Optionally, you might want to clear the tabSwitchCount when the form is submitted
    document.getElementById('countdown-form').addEventListener('submit', function() {
        localStorage.removeItem('tabSwitchCount');
    });
</script>
    
    <script>
        //making the page non copyable
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Disables common keyboard shortcuts for copying and developer tools
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && (e.key === 'c' || e.key === 'x' || e.key === 'a' || e.key === 'u') ||
                e.key === 'PrintScreen' || e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I') ||
                (e.ctrlKey && e.shiftKey && e.key === 'J') || (e.ctrlKey && e.shiftKey && e.key === 'C')) {
                e.preventDefault();
            }
        });

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
<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="warningModalLabel">Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="warning-modal-message">
                Modal body text goes here.
            </div>
        </div>
    </div>
</div>

<body class="d-flex flex-column min-vh-100 non-copy">
    <div class="header-bar">
        <div class="timer" id="countdown">{{$time}}:00</div>
        <div class="question-nav">
            @foreach ($questions as $question)
                <a href="#question{{ $loop->iteration }}">Q{{ $loop->iteration }}</a>
            @endforeach
        </div>
    </div>
    

    <section class="p-5 mt-auto ">
        <div class="container">
            
            <form action="/Review" method="POST" id="countdown-form" >
            @foreach ($questions as $question)
            <div id="question{{ $loop->iteration }}" class="row"> {{-- Question box starts here--}}
                <div class="col-12">
                    <div class="mb-4 shadow-lg rounded border border-3 bgbody">
                        <div class="py-3 px-4">
                        <div class="d-flex justify-content-between">
                        <h4>Question {{$loop->iteration}} </h4>
                         <h4 >    @if($question->nature == 'GK')
                             @foreach ($ppyear as $p)
                             @if ($question->pastpaper_reference == $p->P_id)
                             {{$p->year}}
                            @endif
                            @endforeach
                            @endif
                         </h4>
                        </div>
                        <p> {{ $question->description }}</p>
                        @foreach($qreference as $q)
                        @if($question->referenceid == $q['R_id'])
                        <img src="{{ asset($q->reference_HTML) }}" alt="" class="img-fluid">
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
                                                    @endforeach 
                                                    {{ $answers[$answerindex]->description }} --}}
                                                </label>
                                              </div>
    
                                        </div>
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault1" value="2">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{-- @foreach($answerreference as $a)
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
                                                     {{-- @foreach($answerreference as $a)
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
                                                     {{-- @foreach($answerreference as $a)
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
            </div>
            @endforeach
            <div class="d-flex flex-row-reverse pb-3">
                <button class="btn btncolor " type="submit" id="submit-btn">Submit</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- The content will be dynamically updated by the script -->
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary" id="change-answers-btn">Change Answers</button>
                    <button type="button" id="proceed-btn" class="btn btn-primary">Proceed to Review</button>
                </div>
            </div>
        </div>
    </div>  
    
    <script>
        document.getElementById('countdown-form').addEventListener('submit', function(event) {
            const questions = document.querySelectorAll('.row[id^="question"]'); // Selecting all question rows
            let allAnswered = true;
            let unansweredQuestions = [];
    
            questions.forEach(function(question) {
                const radios = question.querySelectorAll('input[type="radio"]');
                let answered = false;
                radios.forEach(function(radio) {
                    if (radio.checked && radio.value != "0") {
                        answered = true;
                    }
                });
                if (!answered) {
                    allAnswered = false;
                    let questionNumber = question.id.replace('question', '');
                    unansweredQuestions.push(questionNumber);
                }
            });
    
            if (!allAnswered) {
                event.preventDefault();
                const modalBody = document.querySelector('#confirmationModal .modal-body');
                modalBody.innerHTML = `You have unanswered questions: ${unansweredQuestions.join(', ')}. Do you want to proceed to review or go back to change your answers?`;
                $('#confirmationModal').modal('show');
            }
        });
    
        document.getElementById('proceed-btn').addEventListener('click', function() {
            $('#confirmationModal').modal('hide');
            document.getElementById('countdown-form').submit();
        });
    
    </script>
 <script>
    document.addEventListener('DOMContentLoaded', () => {
        const bubbles = document.querySelectorAll('.bubble');

        bubbles.forEach(bubble => {
            bubble.addEventListener('click', () => {
                const targetId = bubble.getAttribute('data-target');
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const bubbles = document.querySelectorAll('.question-nav a');
    const headerHeight = document.querySelector('.header-bar').offsetHeight;

    bubbles.forEach(bubble => {
        bubble.addEventListener('click', (event) => {
            event.preventDefault();
            const targetId = bubble.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.scrollY - headerHeight;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>
</body>
</html>