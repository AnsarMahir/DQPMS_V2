
@php $answerindex = 0; 
@endphp



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css\Question_style.css ') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
    <script type="text/javascript">

        Cookies.set('question', 1);
    </script>
    <script>
        function removestorage(){
            localStorage.removeItem('initialTime');
            
        }
        $(document).ready(function() {
            removestorage();
        });

        
    function myfunction() {
        // Redirect to the desired location
        window.location.replace("http://127.0.0.1:8000/Student");
        // Return false to prevent the form from submitting via default behavior
        return false;
    }
</script>
    </script>
    
</head>

<body class="d-flex flex-column min-vh-100">

    <section class="p-5 mt-auto">
        <div class="container">
            @foreach ($questions as $question)
            <div class="row">
                <div class="col-12">
                    <div id="questionbox{{$loop->iteration}}" class=" fixed-size-container mb-4 shadow-lg rounded border border-3 bgbody">
                        <div class="py-3 px-4"> 
                         <h4 id="q{{$loop->iteration}}">Question {{$loop->iteration}}
                      @foreach($useranswers as $key => $value)
                      @if($question->mcq_questions_id == $key)
                          @if($question->correct_answer == $value)
                          <i class="fas fa-check" style="color: green;"></i>
                            <script>
                               var temp= document.getElementById("q{{$loop->iteration}}");
                                    temp.style.color="green";
                            </script>
                          @else
                          <i class="fas fa-times" style="color: red;"></i>
                              <script>
                                var temp= document.getElementById("q{{$loop->iteration}}");
                                temp.style.color="red";
                             </script>
                            <div class="mb-4 shadow-lg rounded border border-3 bgbody">
                                <h4>GPT explanation</h4>
                                <livewire:gpt-answer :description="$question->description" lazy="on-load" />
                            </div> 
                          @endif
                      @endif
                  @endforeach
                         </h4>
                        <p> {{ $question->description }}</p>
                        </div>

                        <div class="px-4">
                                @csrf
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="val1[{{ $question->mcq_questions_id }}]" value="1" {{ old("answers.$question->mcq_questions_id") == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" id ="val1label[{{$question->mcq_questions_id}}]" for="val11">
                                                    {{ $answers[$answerindex]->description }}
                                                    <script>
                                                       var answer= document.getElementById("val1[{!! $question->mcq_questions_id !!}]");
                                                       var lable = document.getElementById("val1label[{!!$question->mcq_questions_id!!}]");
                                                       if({{$question->correct_answer}}==answer.value){
                                                        lable.style.color="green";
                                                        lable.classList.add("fw-bold");
                                                        
                                                       
                                                       }
                                                       else if(({{$question->correct_answer}}!== answer.value) && answer.checked){
                                                        lable.style.color="red";
                                                       }
                                                    </script>   
                                                </label>
                                              </div>
    
                                        </div>
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="val2[{{ $question->mcq_questions_id }}]" value="2" {{ old("answers.$question->mcq_questions_id") == '2' ? 'checked' : '' }}>
                                                <label class="form-check-label" id ="val2label[{{$question->mcq_questions_id}}]" for="val2">
                                                    {{ $answers[$answerindex + 1]->description }}
                                                    <script>
                                                       var answer= document.getElementById("val2[{!! $question->mcq_questions_id !!}]");
                                                       var lable = document.getElementById("val2label[{!!$question->mcq_questions_id!!}]");
                                                       if({{$question->correct_answer}}==answer.value){
                                                        lable.style.color="green";
                                                        
                                                       }
                                                       else if(({{$question->correct_answer}}!=answer.value) && answer.checked){
                                                        lable.style.color="red";
                                                       }
                                                    </script>
                                                </label>
                                              </div>
    
                                        </div>
                                    </div>
                                    <div class="row">
    
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="val3[{{ $question->mcq_questions_id }}]" value="3" {{ old("answers.$question->mcq_questions_id") == '3' ? 'checked' : '' }}>
                                                <label class="form-check-label" id ="val3label[{{$question->mcq_questions_id}}]" for="val3">
                                                    {{ $answers[$answerindex + 2]->description }}
                                                    <script>
                                                        var answer= document.getElementById("val3[{!! $question->mcq_questions_id !!}]");
                                                        var lable = document.getElementById("val3label[{!!$question->mcq_questions_id!!}]");
                                                        if({{$question->correct_answer}}==answer.value){
                                                            lable.style.color="green";
                                                         
                                                        }
                                                        else if(({{$question->correct_answer}}!=answer.value) && answer.checked){
                                                            lable.style.color="red";
                                                        }
                                                        </script>
                                                </label>
                                              </div>
    
                                        </div>
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="val4[{{ $question->mcq_questions_id }}]" value="4" {{ old("answers.$question->mcq_questions_id") == '4' ? 'checked' : '' }}>
                                                <label class="form-check-label" id ="val4label[{{$question->mcq_questions_id}}]" for="val4">
                                                    {{ $answers[$answerindex + 3]->description }}
                                                    <script>
                                                        var answer= document.getElementById("val4[{!! $question->mcq_questions_id !!}]");
                                                        var lable = document.getElementById("val4label[{!!$question->mcq_questions_id!!}]");
                                                        if({{$question->correct_answer}}==answer.value){
                                                         lable.style.color="green";
                                                         
                                                        }
                                                        else if(({{$question->correct_answer}}!=answer.value) && answer.checked){
                                                            lable.style.color="red";
                                                        }
                                                        </script>
                                                </label>
                                            </div>
    
                                        </div>
                                    </div>
                                </div>
                                
                               
                        </div>

                </div>
                </div>
                @php
                 $answerindex += 4;
                @endphp
            @endforeach
        
            </div>
            
            
        </div>
        <div class="d-flex justify-content-center pb-3">
            <button class="btn btn-dark" type="button" onclick="myfunction()" id="submit-btn">Finish Review</button>
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