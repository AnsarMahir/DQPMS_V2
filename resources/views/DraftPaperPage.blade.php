<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css\Hamas_style.css ') }}">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <x-nav-bar/>

    

    <section class="p-5 pt-lg-5">
        <div class="container pt-5">
            <div class="row">

                @if ($PastpaperData->isEmpty())

                    <p>No Draft Papers Found</p>
                    
                @endif


                @foreach ($PastpaperData as $paper)
                
                <div class="col-lg-4 mb-3 ">

                    <div class="col" style="border-radius: 5px; background-color:#7e53ff">

                        <div class="d-flex flex-column">
                            <a href="/paper/{{$paper->P_id}}/{{$paper->question_type}}" style="text-decoration: none">
                            <div class="d-flex flex-column p-4 text-light paperCard">
                                <h5 >{{$paper->name}}</h4>
                                <p> {{$paper->year}} | {{$paper->language}} | {{$paper->question_type}} | {{$paper->no_of_questions}} Questions</p>                               
                            </div>
                            </a>
                            <button class="deleteButton py-1" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-trash-fill fs-5"></i>
                            </button>
                        </div>

                    </div>
                    
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Do you want to delete the Draft Paper?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-danger" onclick="deleteDraft({{$paper->P_id}})">Delete Paper</button>
                            </div>
                          </div>
                        </div>
                    </div>
                
                    
                @endforeach
            </div>        
            
            

        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function deleteDraft(Paper_id){

            var deleteUrl = 'http://127.0.0.1:8000/paper/' + Paper_id;

            console.log(deleteUrl);
            
                
            $.ajax({
            url: deleteUrl,    
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            success: function(response) {
                alert('Paper deleted successfully');
                // Perform any actions after successful deletion
                // For example, refreshing the page
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while deleting the paper');
            }   
            });
            
        }

    </script>
</body>
</html>