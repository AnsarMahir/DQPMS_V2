
<div class="row justify-content-center pb-4">
    <div class="col-lg-8 p-4 border shadow">
            
                <div class="d-flex justify-content-between align-items-center" style="column-gap: 1rem;">
                    <div class="d-flex flex-fill"> 
                        <input type="text" class="form-control rounded-0" placeholder="Enter the Question Here.." id="name" name="{{'question'.$i}}" value="{{old('question'.$i)}}">
                    </div>
                    <div class="d-flex align-items-center" style="column-gap: 1rem;">
                        <div class="form-group" style="width:6rem;">
                            <select class="form-select" id="questionNature" name="{{'questionNature'.$i}}">    
                                <option>IQ</option>
                                <option>GK</option>
                                <option>Math</option>
                                <option>Logic</option>
                            </select>
                          </div>
                            
                            @error('questionNature'.$i)
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                            @enderror

                          <button class="btn pb-3" type="button"><i class="bi-image fs-3"></i></button>

                    </div>
                   
                </div>
                @error('question'.$i)
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                @enderror   

                <div class="row" style="column-gap: 2rem;">
                    <div class="col-lg-5 mt-3">
                        <div class="form-check d-flex align-items-center mb-0" style="column-gap: 1rem;">
                            <input class="form-check-input shadow border border-dark" type="radio" name="{{$i.'answerRadio'}}" id="{{'flexRadioCheckedDisabled'.$i.'1'}}" value="1" disabled>
                            <input type="text" class="form-control rounded-0 " placeholder="Option 1" id="name" name="{{$i.'answer1'}}" value="{{old($i.'answer1')}}">
                            <button class="btn pb-3" type="button"><i class="bi-image fs-4"></i></button>                        
                        </div>
                        @error($i.'answer1')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                        @enderror
                    </div> 

                    <div class="col-lg-5 mt-3">
                        <div class="form-check d-flex align-items-center mb-0" style="column-gap: 1rem;">
                            <input class="form-check-input shadow border border-dark" type="radio" name="{{$i.'answerRadio'}}" id="{{'flexRadioCheckedDisabled'.$i.'2'}}" value="2" disabled>
                            <input type="text" class="form-control rounded-0 " placeholder="Option 2" id="name" name="{{$i.'answer2'}}" value="{{old($i.'answer2')}}">
                            <button class="btn pb-3" type="button"><i class="bi-image fs-4"></i></button>                        
                        </div>
                        @error($i.'answer2')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                        @enderror
                    </div>
                </div>

                <div class="row " style="column-gap: 2rem;">
                    <div class="col-lg-5 mt-3">
                        <div class="form-check d-flex align-items-center mb-0" style="column-gap: 1rem;">
                            <input class="form-check-input shadow border border-dark " type="radio" name="{{$i.'answerRadio'}}" id="{{'flexRadioCheckedDisabled'.$i.'3'}}" value="3" disabled>
                            <input type="text" class="form-control rounded-0" placeholder="Option 3" id="name" name="{{$i.'answer3'}}" value="{{old($i.'answer3')}}">
                            <button class="btn pb-3" type="button"><i class="bi-image fs-4"></i></button>                        
                        </div>
                        @error($i.'answer3')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                        @enderror
                    </div> 

                    <div class="col-lg-5 mt-3">
                        <div class="form-check d-flex align-items-center mb-0" style="column-gap: 1rem;">
                            <input class="form-check-input shadow border border-dark" type="radio" name="{{$i.'answerRadio'}}" id="{{'flexRadioCheckedDisabled'.$i.'4'}}" value="4" disabled>
                            <input type="text" class="form-control rounded-0" placeholder="Option 4" id="name" name="{{$i.'answer4'}}"value="{{old($i.'answer4')}}">
                            <button class="btn pb-3" type="button"><i class="bi-image fs-4"></i></button>                        
                        </div>
                        @error($i.'answer4')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                        @enderror
                    </div> 
                </div>

                 

                
                
                <!-- <div class="d-flex align-items-center" style="column-gap: 1rem; width: fit-content;">
                    <input class="form-check-input shadow border border-dark" type="radio" name="answerRadio" id="flexRadioCheckedDisabled" disabled>
                    <button class="btn btn-sm btn-link">Add Option</button>
                </div> -->

                <div class="d-flex mt-3 align-items-center">
                    <button class="btn btn-sm pt-0" type="button" name="{{'addAnswer'.$i}}" id="{{'addAnswerId'.$i}}" onclick="enableAnswers(this.id)"><i class="bi bi-clipboard-check fs-3"></i> Set Answer</button>
                    @error($i.'answerRadio')
                    <p class="text-danger fs-6 ms-1 mb-1" style="margin-top: 0.5rem">{{$message}}</p> 
                    @enderror
                </div>
                

       
                           

    </div>
    

</div>

<script>
function enableAnswers(id)
    {
    let i = id.charAt(id.length-1);
    var j = 1;

    while(j<=4){
    let answerid = 'flexRadioCheckedDisabled'.concat(i).concat(j);
    console.log(answerid);

    let answers = document.getElementById(answerid);
    console.log(answers);

    answers.removeAttribute('disabled');
    j++;
    }

    };

</script>