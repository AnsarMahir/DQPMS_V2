<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="Question_style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <section class="p-5 mt-auto">
        <div class="container">

            <div class="d-grid d-sm-block pb-3">
                <button class="btn btn-primary ms-0 bgbody text-dark" type="button">00:00</button>
              </div>
            @foreach($questions as $question)
            <div class="row">
                <div class="col-12">
                    <div class="mb-4 shadow-lg rounded border border-3 bgbody">


                        <div class="py-3 px-4">
                        <h4>Question 1 </h4>
                        <p>{{$question->description}}</p>
                        </div>

                        <div class="px-4">
                            <form action="" method="post">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Answer</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"  >
                                    <div id="emailHelp" class="form-text">Please write answer without space</div>
                                  </div>

                                
                                
                                <div class="d-flex flex-row-reverse pb-3">
                                    <button class="btn btn-dark">Submit</button>
                                </div>
                               
                                
                            </form>
                        </div>

                </div>
                </div>
                
            </div>
            @endforeach
            
            
        </div>
    </section>
    
    

    <footer class="p-4 bg-dark text-white text-center mt-auto">
        <div class="container">
            <p class="lead m-0">Copyright &copy; 2024 DQPMS</p>

        </div>
    </footer>  
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>