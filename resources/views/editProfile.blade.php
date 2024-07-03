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
      
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="https://via.placeholder.com/80" class="profile-photo" alt="Profile Photo">
                <button class="btn btncolor change-photo-btn">Change Photo</button>
            </div>
            <div class="col-md-9">
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
             @csrf
            </form>
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')
                    <div class="mb-2">
                        <label for="name" class="form-label" :value="__('Name')" >Name:</label>
                        <input type="text" class="form-control" id="name" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" >
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label" :value="__('Email')">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" :value="old('email', $user->email)" required autocomplete="username">
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    
                    <div class="mb-2">
                        <label for="phone" class="form-label">Contact:</label>
                        <input type="text" class="form-control" id="phone" name="phone" >
                    </div>
                    <div class="mb-2">
                        <label for="position" class="form-label">Position:</label>
                        <input type="text" class="form-control" id="position" name="position" >
                    </div>
                    <div class="mb-2">
                        <label for="workplace" class="form-label">Workplace:</label>
                        <input type="text" class="form-control" id="workplace" name="workplace" >
                    </div>
                </form>
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="mb-2">
                 
                        <label for="password" class="form-label" :value="__('Current Password')">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" >
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" />
                    </div>
                   
                    <div class="mb-2">
                        <label for="confirmpassword" class="form-label" :value="__('Confirm Password')">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" autocomplete="new-password">
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"  />
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btncolor" >Cancel</button>
                        <button type="submit" class="btn btncolor" >Save</button>
                        @if (session('status') === 'profile-updated')
                           <p
                              x-data="{ show: true }"
                              x-show="show"
                              x-transition
                              x-init="setTimeout(() => show = false, 2000)"
                              class="text-sm text-gray-600 dark:text-gray-400"
                              >{{ __('Saved.') }}</p>
                        @endif
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
