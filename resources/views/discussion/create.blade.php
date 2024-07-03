<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Discussion Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card-container {
            display: flex;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            max-width: 1200px;
            width: 90%;
        }
        .image-container {
            flex: 1;
            background-image: url("{{ asset('Assets/images/forumicon.jpg') }}");
            background-size: contain; /* Ensure the entire image is visible */
            background-repeat: no-repeat; /* Prevent image from repeating */
            background-position: center; /* Center the image */
            padding: 30px; /* Add padding to avoid cropping */
        }
        .form-container {
            flex: 2;
            padding: 50px;
        }
        .form-container h1 {
            color: #343a40;
            font-size: 30px;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
            color: #495057;
        }
        .form-control:focus {
            border-color: #7748ff;
            box-shadow: 0 0 0 0.2rem rgba(119, 72, 255, 0.25);
        }
        .btn-color {
            color: white;
            background-color: #7748ff;
            border-color: #7748ff;
        }
        .btn-color:hover {
            border-color: #7748ff;
            background-color: #563d7c;
        }
        .alert-success {
            color: #5a4b81;
            background-color: #d9c9ff;
            border-color: #c2a7ff;
            border-radius: 5px;
        }
        .button-container {
            margin-top: 10px; /* Reduce margin to be closer to the create post button */
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="form-container">
            <h1>Create a New Discussion Post</h1>

            <!-- Display success message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form to create a new discussion post -->
            <form action="{{ route('discussion.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required placeholder="Enter the title of your discussion">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required placeholder="Enter the description of your discussion"></textarea>
                </div>
                <button type="submit" class="btn btn-color">Create Post</button>
            </form>

            <!-- Button to view discussion forum -->
            <div class="button-container mt-3">
                <a href="{{ route('forum') }}" class="btn btn-color">View Discussion Forum</a>
            </div>
        </div>
        <div class="image-container"></div>
    </div>

    <!-- Bootstrap JS (for potential dynamic interactions) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
