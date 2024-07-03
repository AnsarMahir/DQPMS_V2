<x-index>

    <x-flash-message/>

    <x-nav-bar/>

    <section class="pt-sm-5 bgbody">
        <div class="container pt-5" >
            <div class="p-5 text-center ">
                <h4 class="textsub">Add Paper Titles</h4>
            </div>
            
            <div class="px-5 justify-content-center">

                <form action="/addPaperTitle" method="POST" class="row g-3 col-lg-6 mx-auto mt-0"> 

                    @csrf

                    <div class="col-12 m-0">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Paper Title" class="form-control" name="paperInput" value="{{old('paperInput')}}">
                        </div>
                        @error('paperInput')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                        @enderror
                    </div>

                    <div class="col-12">
                        <p><b>Select Question Nature(s)</b></p>
                        
                        @foreach($questionTypes as $nature)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{$nature}}" name="questionNatures[]">
                                <label class="form-check-label" for="inlineCheckbox1">{{$nature}}</label>
                            </div>
                        @endforeach
                        
                        
                        @error('questionNatures')
                            <p class="text-danger fs-6 ms-1 mb-1">{{$message}}</p>                                
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-lg btncolor col-xs mx-auto mt-4 mb-5 w-50">
                        <h4>Add Paper</h4>
                    </button>
                      
                </form>
                

                <div class="row mx-auto" style="width: 50%;"> <!-- Adjust the width as needed -->
                    
                        <h4 class="py-2 px-0 textsub text-center">Existing Paper Titles</h4>

                        <div class="table-responsive px-0" style="overflow-y: auto; max-height: 300px">
                            <table class="table table-bordered w-100 align-middle">
                                <thead class="align-middle">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Paper Title</th>
                                        <th scope="col" class="text-center" style="width: 100px">Delete Paper</th>
                                    </tr>
                                </thead>
                                <tbody id="papersTableBody">
                                    <!-- Rows will be appended here by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    
                </div>


            </div>
                
        </div>  

    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        $(document).ready(function() {

            var getURL = 'http://127.0.0.1:8000/getPaperTitle';

            $.ajax({
                url: getURL,
                method: "GET",
                headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                
                success: function(data) {

                    var tableBody = $('#papersTableBody');
                    tableBody.empty(); // Clear the table body

                    console.log(data);

                    if(data.length === 0){

                        var row =   '<tr>' +
                                    '<td colspan="3" class="text-center"><p>No paper titles added yet</p></td>' +
                                    '</tr>';

                        tableBody.append(row);
                       

                    }else{  
                        data.forEach(function(paper, index) {

                        var row = '<tr>' +
                                '<th scope="row" class="text-center">' + (index + 1) + '</th>' +
                                '<td scope="row" class="text-center">' + paper.Paper_Title + '</td>' +
                                '<td scope="row" class="text-center" style="width: 100px"><button class="btn" type="button" onclick="deleteTitle(' + paper.id + ')"><i class="bi bi-trash-fill fs-5 text-danger"></button></i></td>' +
                                '</tr>';

                        tableBody.append(row);
                        });
                    }
                    
                }
            });
        });

        function deleteTitle(paperID){

            console.log(paperID);

            var deleteURL = 'http://127.0.0.1:8000/deletePaperTitle/' + paperID;

            $.ajax({
            url: deleteURL,    
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            success: function(response) {
                
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while deleting the paper');
            }   
            });




        }
    </script>

    
</x-index>