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

                    <p>No Published Papers Found</p>
                    
                @endif


                @foreach ($PastpaperData as $paper)
                
                <div class="col-lg-4 mb-3 ">

                    <div class="col" style="border-radius: 5px; background-color:#7e53ff">

                        <div class="d-flex flex-column">
                            <a href="/CreatorPublished/{{$paper->P_id}}/{{$paper->question_type}}" style="text-decoration: none">
                            <div class="d-flex flex-column p-4 text-light paperCard">
                                <h5 >{{$paper->name}}</h4>
                                <p> {{$paper->year}} | {{$paper->language}} | {{$paper->question_type}} | {{$paper->no_of_questions}} Questions</p>
                                <p><b>Status:</b> {{$paper->CreatorState}}</p>                          
                            </div>
                            </a>
                        </div>

                    </div>
                </div>  
                    
                @endforeach
            </div>        
            
            

        </div>
    </section>
</body>
</html>