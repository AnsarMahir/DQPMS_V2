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
            padding: 30px;
            max-width: 800px;
            margin: auto;
        }
        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .change-photo-btn {
            display: block;
            margin: 10px auto 0;
        }
        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        }
        .btn-primary {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }
        .btn-primary:hover {
            background-color: #5a32a3;
            border-color: #5a32a3;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="profile-card">
        <h3 class="text-center mb-4">Edit your Profile</h3>
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="https://via.placeholder.com/150" class="profile-photo" alt="Profile Photo">
                <button class="btn btn-primary change-photo-btn">Change Photo</button>
            </div>
            <div class="col-md-8">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Contact:</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="mobile-phone" class="form-label">Confirm password:</label>
                        <input type="text" class="form-control" id="confirmpassword" name="confirmpassword" >
                    </div>
                    
                    <!-- <div class="mb-3">
                        <label for="default-view" class="form-label">Default Edit Form View:</label>
                        <select class="form-select" id="default-view">
                            <option>[No Default View]</option>
                        </select>
                    </div> -->
                    
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
