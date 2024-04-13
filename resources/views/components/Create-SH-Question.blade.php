
<div class="row justify-content-center pb-4">
    <div class="col-lg-8 p-4 border shadow">
            
        <div class="d-flex justify-content-between align-items-center" style="column-gap: 1rem;">
            <div class="d-flex flex-fill"> 
                <input type="text" class="form-control rounded-0 noBorder" placeholder="Enter the question here.." id="name" name="{{'question'.$i}}" value="{{old('question'.$i)}}">
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
                        <input type="file" name="{{$i.'Q_Reference'}}" id="{{$i.'Q_Reference'}}" class="d-none">
                    </button>

            </div>
            
        </div>

        @error('question'.$i)
            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
        @enderror     
        
        <div class="pb-3">
            <div class="d-flex flex-fill">    
                <input type="text" name="{{$i.'answer'}}" id="" class="form-control rounded-0 noBorder" placeholder="Provide the correct answer here.." value="{{old($i.'answer')}}"> 
            </div>
        </div>

        @error($i.'answer')
            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
        @enderror 

       
                           

    </div>
    

</div>

<script>

</script>