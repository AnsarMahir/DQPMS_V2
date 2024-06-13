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
                                    
                                        {{ $answers[$answerindex]->description }}
                                    </label>
                                  </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="form-check">
                                    <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault1" value="2">
                                    <label class="form-check-label" for="flexRadioDefault1">
                        
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
                                         
                                        {{ $answers[$answerindex + 2]->description }}
                                    </label>
                                  </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="form-check">
                                    <input class="form-check-input shadow" type="radio" name="answers[{{ $question->mcq_questions_id }}]" id="flexRadioDefault2" value="4">
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
<div class="d-flex flex-row-reverse pb-3">
    <button class="btn btn-dark" type="submit" id="submit-btn">Submit</button>
</div>
</form>