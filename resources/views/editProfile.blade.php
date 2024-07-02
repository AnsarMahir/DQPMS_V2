<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-card {
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
            max-width: 600px;
            margin: auto;
        }
        .profile-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }
        .change-photo-btn {
            display: block;
            margin: 6px auto 0;
            font-size: 0.75rem;
            padding: 4px 8px;
        }
        .form-control {
            font-size: 0.75rem;
            padding: 4px 8px;
        }
        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        }
        .form-label {
            font-size: 0.75rem;
        }
        .btncolor {
            color: white;
            background-color: #7748ff;
            border-color: #7748ff;
            font-size: 0.75rem;
            padding: 4px 8px;
        }
        .btncolor:hover {
            border-color: #7748ff;
        }
        h3 {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="profile-card">
        <h3 class="text-center mb-3">Edit your Profile</h3>
        @include('partials.errors')
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="https://via.placeholder.com/80" class="profile-photo" alt="Profile Photo">
                <button class="btn btncolor change-photo-btn">Change Photo</button>
            </div>
            <div class="col-md-9">
                <form action="{{route('users.editProfile')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="mb-2">
                        <label for="phone" class="form-label">Contact:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{$user->password}}" >
                    </div>
                    <div class="mb-2">
                        <label for="confirmpassword" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btncolor">Cancel</button>
                        <button type="submit" class="btn btncolor">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
