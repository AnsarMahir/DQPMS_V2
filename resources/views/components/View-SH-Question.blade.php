
<div class="row justify-content-center pb-4">
    <div class="col-lg-8 p-4 border shadow">
            
        <div class="d-flex justify-content-between align-items-center" style="column-gap: 1rem;">
            <div class="d-flex flex-fill"> 
                <input type="text" class="form-control rounded-0 noBorder" placeholder="Enter the question here.." id="name" name="{{'question'.$i}}" value="{{$data[$i]['description']}}" disabled>
            </div>
            
            <div class="d-flex align-items-center" style="column-gap: 1rem;">
                    <div class="form-group" style="width:6rem;">
                        <select class="form-control" id="questionNature" name="{{'questionNature'.$i}}" disabled style="text-align-last: center">    
                            <option value='IQ' {{$data[$i]['nature'] == 'IQ' ? 'selected' : ''}}>IQ</option>
                            <option value='GK' {{$data[$i]['nature'] == 'GK' ? 'selected' : ''}}>GK</option>
                            <option value='Math' {{$data[$i]['nature'] == 'Math' ? 'selected' : ''}}>Math</option>
                            <option value='Politics' {{$data[$i]['nature'] == 'Politics' ? 'selected' : ''}}>Politics</option>
                            <option value='Economics' {{$data[$i]['nature'] == 'Economics' ? 'selected' : ''}}>Economics</option>
                            <option value='Demographic' {{$data[$i]['nature'] == 'Demographic' ? 'selected' : ''}}>Demographic</option>
                        </select>
                    </div>
                    

            </div>
            
        </div>

        @if($data[$i]['reference'])
        <div class="row">
            <img src="{{$data[$i]['reference']['reference_HTML']}}" alt="" id="{{$i.'questionPreviewImageTag'}}" class="img-fluid">
        </div>
        @else
        <div class="row">
            <img src="" alt="" id="{{$i.'questionPreviewImageTag'}}" class="img-fluid">
        </div>
        @endif
        
        <div class="py-3">
            <div class="d-flex flex-fill">    
                <input type="text" name="{{$i.'answer'}}" id="" class="form-control rounded-0 noBorder" placeholder="Provide the correct answer here.." value="{{$data[$i]['correct_answer']}}" disabled> 
            </div>
        </div>

        @error($i.'answer')
            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
        @enderror 

       
                           

    </div>
    

</div>

<script>

    function questionPreviewImage(uploadImgElement){

        let questionId = uploadImgElement.id.match(/\d+/)[0] ;//Get Question ID. match is used to get the integer values at the begining if the string

        let previewImageTag = questionId . concat('questionPreviewImageTag') ; //Get the img tag of that id
        
        const imgTag = document.getElementById(previewImageTag); // get img tag Element Object

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
