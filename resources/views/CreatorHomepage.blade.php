<x-index>

    <x-flash-message/>

    <x-nav-bar/>

    <section class="pt-sm-5 bgbody">
        <div class="container pt-5" >
            <div class="p-5 text-center ">
                <h1 class="p-2 textheading">Welcome Creator!</h1>
                <h4 class="p-2 textsub">Create your paper...</h4>
            </div>
            
            <div class="px-5 justify-content-center">

                <form action="/QuestionCreation" method="GET" class="row g-3 col-lg-6 mx-auto mt-0"> 
                    
                    <div class="col-12 m-0">
                        <div class="form-group">
                            <select class="form-select" name="examName">
                                <option selected disabled>Examination Name</option>

                                @foreach($paperTitles as $title)
                                <option value="{{ $title }}">{{ $title }}</option>
                                @endforeach

                            </select>
                            
                            @error('examName')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                            @enderror  
                        </div>                      
                    </div>

                   
            
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-select" name="questionType">
                                <option selected disabled>Choose the question type</option>
                                <option>MCQ</option>
                                <option>Short Answer</option>
                            </select>
                            @error('questionType')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-select" name="year">
                                <option value="" disabled selected>Select the year</option>
                                
                              </select>
                            @error('year')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-select" id="language" name="language">
                                <option selected disabled>Choose the Language</option>
                                <option>English</option>
                                <option>Sinhala</option>
                                <option>Tamil</option>
                            </select>
                            @error('language')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                             
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type='number' max="40" class="form-control" placeholder="Enter Number of Questions" name="numberOfQuestions">
                            @error('numberOfQuestions')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-lg btncolor col-xs mx-auto my-5 w-50">
                        <h4>Create Paper</h4>
                    </button>
                      
                </form>

            </div>
                
        </div>  

    </section>

    <script>
         document.addEventListener('DOMContentLoaded', (event) => {
            const select = document.querySelector('select[name="year"]');
            const startYear = 1990;
            const currentYear = new Date().getFullYear();

            for (let year = startYear; year <= currentYear; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                select.appendChild(option);
            }
        });
    </script>

    
</x-index>