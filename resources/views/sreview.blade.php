@php 
$counter=1;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css\Question_style.css ') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
    <script>
        window.history.forward(); 
        function noBack() { 
            window.history.forward(); 
        } 

        function myfunction() {
        // Redirect to the desired location
        window.location.replace("http://127.0.0.1:8000/Student");
        // Return false to prevent the form from submitting via default behavior
        return false;
    }
    </script>
</head>

<body class="d-flex flex-column min-vh-100">

    <section class="p-5 mt-auto">
        <div class="container">
            <form autocomplete="off" action="" method="" id="countdown-form" >
           
            @foreach($questions as $question)
            <div class="row">
                <div class="col-12">
                    <div class="mb-4 shadow-lg rounded border border-3 bgbody">


                        <div class="py-3 px-4">
                        <h4>Question {{$counter}} </h4>
                        <p>{{$question->description}}</p>
                        </div>

                        <div class="px-4">
                            
                                <div class="mb-3">
                                 <label for="answer" class="form-label">Answer provided :</label>
                                 <p> <b> {{ old("answer$counter")}} </b></p>
                                 <label for="answer" class="form-label">Guided Answer:</label>
                                 @foreach($answer as $item)
                                 @if($question->sh_questions_id == $item->question_id)
                                 <p> <b> {{$item->description}} </b></p> 
                                 @endif
                                 @endforeach
                                </div>

                        </div>

                </div>
                </div>
                
            </div>
            @php 
            $counter++;
            @endphp
            @endforeach
        
        </form>
        <div class="d-flex justify-content-center pb-3">
            <button class="btn btn-dark" type="button" onclick="myfunction()" id="submit-btn">Finish Review</button>
        </div>
            
            
        </div>
    </section>
    
    

    <footer class="p-4 bg-dark text-white text-center mt-auto">
        <div class="container">
            <p class="lead m-0">Copyright &copy; 2024 DQPMS</p>

        </div>
    </footer>  
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>