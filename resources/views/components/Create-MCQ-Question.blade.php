
<div class="row justify-content-center pb-4">
    <div class="col-lg-8 p-4 border shadow">
            
                <div class="d-flex justify-content-between align-items-center" style="column-gap: 1rem;">
                    <div class="d-flex flex-fill"> 
                        <input type="text" class="form-control rounded-0 noBorder" placeholder="Enter the Question Here.." name="{{'question'.$i}}" value="{{old('question'.$i)}}">
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

                            <button class="btn pb-3" type="button" onclick="document.getElementById('{{$i.'Q_Reference'}}').click();">
                                <i class="bi-image fs-3"></i>
                                <input type="file" name="{{$i.'Q_Reference'}}" id="{{$i.'Q_Reference'}}" class="d-none" accept="image/*" onchange="questionPreviewImage(this)">
                            </button>

                    </div>
                   
                </div>
                @error('question'.$i)
                    <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                @enderror 
                
                <div class="row">
                    <img src="" alt="" id="{{$i.'questionPreviewImageTag'}}" class="img-fluid">
                </div>

                <div class="row" style="column-gap: 2rem;"> 
                    <div class="col-lg-5 mt-3">
                        <div class="form-check d-flex align-items-center mb-0" style="column-gap: 1rem;">
                            
                            <input class="form-check-input shadow border border-dark" type="radio" name="{{$i.'answerRadio'}}" id="{{'flexRadioCheckedDisabled'.$i.'1'}}" value="1" disabled>
                            
                            <input type="text" class="form-control rounded-0 noBorder" placeholder="Option 1"  name="{{$i.'answer1'}}" value="{{old($i.'answer1')}}">


                            <button class="btn pb-3" type="button" onclick="document.getElementById('{{$i.'A_Reference1'}}').click();">
                                <i class="bi-image fs-4"></i>
                                <input type="file" name="{{$i.'A_Reference1'}}" id="{{$i.'A_Reference1'}}" class="d-none" onchange="answerPreviewImage(this)">
                            </button>

                            

                        </div>
                        @error($i.'answer1')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                        @enderror
                    </div> 

                    <div class="col-lg-5 mt-3">
                        <div class="form-check d-flex align-items-center mb-0" style="column-gap: 1rem;">
                            
                            <input class="form-check-input shadow border border-dark" type="radio" name="{{$i.'answerRadio'}}" id="{{'flexRadioCheckedDisabled'.$i.'2'}}" value="2" disabled>
                            
                            <input type="text" class="form-control rounded-0 noBorder" placeholder="Option 2" name="{{$i.'answer2'}}" value="{{old($i.'answer2')}}">
                            
                            <button class="btn pb-3" type="button" onclick="document.getElementById('{{$i.'A_Reference2'}}').click();">
                                <i class="bi-image fs-4"></i>
                                <input type="file" name="{{$i.'A_Reference2'}}" id="{{$i.'A_Reference2'}}" class="d-none" onchange="answerPreviewImage(this)">
                            </button> 

                        </div>
                        @error($i.'answer2')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                        @enderror
                    </div>
                </div>

                <div class="row mx-4" style="column-gap: 2rem">

                    <div class="col-lg-5">  

                        <img src="" alt="" id="{{$i.'answerPreviewImageTag1'}}" class="img-fluid">

                    </div>

                    <div class="col-lg-5">

                        <img src="" alt="" id="{{$i.'answerPreviewImageTag2'}}" class="img-fluid">

                    </div>             
                    

                </div>

                <div class="row " style="column-gap: 2rem;">
                    <div class="col-lg-5 mt-3">
                        <div class="form-check d-flex align-items-center mb-0" style="column-gap: 1rem;">
                            
                            <input class="form-check-input shadow border border-dark " type="radio" name="{{$i.'answerRadio'}}" id="{{'flexRadioCheckedDisabled'.$i.'3'}}" value="3" disabled>
                            
                            <input type="text" class="form-control rounded-0 noBorder" placeholder="Option 3"  name="{{$i.'answer3'}}" value="{{old($i.'answer3')}}">
                            
                            <button class="btn pb-3" type="button" onclick="document.getElementById('{{$i.'A_Reference3'}}').click();">
                                <i class="bi-image fs-4"></i>
                                <input type="file" name="{{$i.'A_Reference3'}}" id="{{$i.'A_Reference3'}}" class="d-none" onchange="answerPreviewImage(this)">
                            </button>  

                        </div>
                        
                        @error($i.'answer3')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                        @enderror

                    </div> 

                    <div class="col-lg-5 mt-3">
                        <div class="form-check d-flex align-items-center mb-0" style="column-gap: 1rem;">
                            <input class="form-check-input shadow border border-dark" type="radio" name="{{$i.'answerRadio'}}" id="{{'flexRadioCheckedDisabled'.$i.'4'}}" value="4" disabled>

                            <input type="text" class="form-control rounded-0 noBorder" placeholder="Option 4" name="{{$i.'answer4'}}"value="{{old($i.'answer4')}}">
                            
                            <button class="btn pb-3" type="button" onclick="document.getElementById('{{$i.'A_Reference4'}}').click();">
                                <i class="bi-image fs-4"></i>
                                <input type="file" name="{{$i.'A_Reference4'}}" id="{{$i.'A_Reference4'}}" class="d-none" onchange="answerPreviewImage(this)">
                            </button>   

                        </div>
                        @error($i.'answer4')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                        @enderror
                    </div> 
                </div>

                <div class="row mx-4" style="column-gap: 2rem">

                    <div class="col-lg-5">  

                        <img src="" alt="" id="{{$i.'answerPreviewImageTag3'}}" class="img-fluid">

                    </div>

                    <div class="col-lg-5">

                        <img src="" alt="" id="{{$i.'answerPreviewImageTag4'}}" class="img-fluid">

                    </div>             
                    

                </div>

                 

                <div class="d-flex mt-3 align-items-center">
                    <button class="btn btn-sm pt-0" type="button" name="{{'addAnswer'.$i}}" id="{{'addAnswerId'.$i}}" onclick="enableAnswers(this.id)"><i class="bi bi-clipboard-check fs-3"></i> Set Answer</button>
                    @error($i.'answerRadio')
                    <p class="text-danger fs-6 ms-1 mb-1" style="margin-top: 0.5rem">{{$message}}</p> 
                    @enderror
                </div>
                

       
                           

    </div>
    

</div>

<script>
    function enableAnswers(id){

        let i = parseInt(id.match(/\d+$/)[0]); // Get Question Id
        var j = 1;

        //Enable all answer Radio Buttons of the specific question Id
        while(j<=4){
        let answerid = 'flexRadioCheckedDisabled'.concat(i).concat(j);

        let answers = document.getElementById(answerid);

        answers.removeAttribute('disabled');

        j++;
        }

    };

</script>

<script>

    function questionPreviewImage(uploadImgElement){

        let questionId = uploadImgElement.id.match(/\d+/)[0] ;//Get Question ID. match is used to get the integer values at the begining if the string

        let previewImageTag = questionId . concat('questionPreviewImageTag') ; //Get the img tag of that id
        
        const imgTag = document.getElementById(previewImageTag); // get img tag Element Object

        createBlob(imgTag,uploadImgElement);
        
    }    
    

    function answerPreviewImage(uploadImgElement){

        let questionId = uploadImgElement.id.match(/\d+/)[0] ;//Get Question ID. match is used to get the integer values at the begining of the id string

        let answerId = uploadImgElement.id.match(/\d+$/)[0] ; //Get Answer ID from the end of the id string

        let previewImageTag = questionId . concat('answerPreviewImageTag') . concat(answerId);

        const imgTag = document.getElementById(previewImageTag);

        createBlob(imgTag,uploadImgElement);

    }

    function createBlob(imgTag, uploadImgElement){

        const blob = new Blob([uploadImgElement.files[0]], { type: "image/jpeg" }); //Create Binary Large Object 

        const blobURL = URL.createObjectURL(blob); //Create URL of the BLOB

        console.log(blobURL);

        imgTag.style.display = "block";

        imgTag.src = blobURL;//Pass BLOB URL to image Tag


    }

</script>