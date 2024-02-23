
@php $answerindex = 0; 
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
</head>

<body class="d-flex flex-column min-vh-100">

    <section class="p-5 mt-auto">
        <div class="container">
            
            
            @foreach ($questions as $question)
            
            
            <div class="row">
                <div class="col-12">
                    <div class="mb-4 shadow-lg rounded border border-3 bgbody">

                        
                        <div class="py-3 px-4">
                        <h4>Question {{$counter}}
                      </h4>
                      
                      @foreach($useranswers as $key => $value)
                      @if($question->mcq_questions_id == $key)
                          @if($question->correct_answer == $value)
                              <p> Correct Answer</p>
                          @else
                              <p> Wrong Answer</p>
                          @endif
                      @endif
                  @endforeach
                        <p> {{ $question->description }}</p>
                        </div>

                        <div class="px-4">
                            
                                @csrf
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault2" value="1" {{ old("answers.$question->mcq_questions_id") == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    {{ $answers[$answerindex]->description }}
                                                </label>
                                              </div>
    
                                        </div>
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault1" value="2" {{ old("answers.$question->mcq_questions_id") == '2' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{ $answers[$answerindex + 1]->description }}
                                                </label>
                                              </div>
    
                                        </div>
                                    </div>
                                    <div class="row">
    
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault1" value="3" {{ old("answers.$question->mcq_questions_id") == '3' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{ $answers[$answerindex + 2]->description }}
                                                </label>
                                              </div>
    
                                        </div>
                                        <div class="col-lg-6">
    
                                            <div class="form-check">
                                                <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault2" value="4" {{ old("answers.$question->mcq_questions_id") == '4' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    {{ $answers[$answerindex + 3]->description }}
                                                </label>
                                            </div>
    
                                        </div>
                                    </div>
                                </div>
                                
                               
                        </div>

                </div>
                </div>
                @php $answerindex += 4;
                $counter++; @endphp

            @endforeach
           
        
            </div>
            
            
            <div class="row" style="margin-top: 2rem;">
                <div class="col d-flex justify-content-center">
                    {{-- <ul class="pagination"> --}}
                        {{-- <li class="page-item">
                          <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li> --}}
                        {{-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                        <li class="page-item"><a class="page-link" href="#">8</a></li>
                        <li class="page-item"><a class="page-link" href="#">9</a></li>
                        <li class="page-item"><a class="page-link" href="#">10</a></li>
                        <li class="page-item">
                            
                          <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                    </ul> --}}
                    
                </div>
            </div>
            
            
        </div>
        {{-- {{$questions->links()}}  --}}
    </section>
    
    

    <footer class="p-4 bg-dark text-white text-center mt-auto">
        <div class="container">
            <p class="lead m-0">Copyright &copy; 2024 DQPMS</p>

        </div>
    </footer>  
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>