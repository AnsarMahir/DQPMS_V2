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
        .alert-success {
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="profile-card">
        <h3 class="text-center mb-3">Edit your Profile</h3>

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success" role="alert">
                {{ __('Profile updated successfully.') }}
            </div>
        @endif

       

        <div class="row">
            <div class="col-md-3 text-center">
                <img src="https://via.placeholder.com/80" class="profile-photo" alt="Profile Photo" id="profile-photo">
                <form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="file" class="form-control d-none" id="photo" name="photo" accept="image/*">
                    <button type="button" class="btn btncolor change-photo-btn" id="change-photo-btn">Change Photo</button>
                    <button type="submit" class="btn btncolor mt-2 d-none" id="upload-photo-btn">Upload Photo</button>
                </form>
            </div>
            <div class="col-md-9">
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')
                    <div class="mb-2">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    <div class="mb-2">
                    <label for="phone" class="form-label">Contact:</label>
                         <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                         @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                    </div>
                    <div class="mb-2">
                    <label for="position" class="form-label">Position:</label>
                       <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position', $user->position) }}">
                           @error('position')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                    </div>
                    <div class="mb-2">
                    <label for="workplace" class="form-label">Workplace:</label>
                      <input type="text" class="form-control @error('workplace') is-invalid @enderror" id="workplace" name="workplace" value="{{ old('workplace', $user->workplace) }}">
                        @error('workplace')
                       <div class="invalid-feedback">{{ $message }}</div>
                       @enderror
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btncolor">Cancel</button>
                        <button type="submit" class="btn btncolor">Save</button>
                    </div>
                    <br><br>
                </form>
                @if (session('status') === 'password-updated')
                   <div class="alert alert-success" role="alert">
                     {{ __('Password updated successfully.') }}
                   </div>
                 @endif
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="mb-2">
                    <label for="current_password" class="form-label">Current Password:</label>
                    <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password" autocomplete="current-password">
                     @error('current_password', 'updatePassword')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                    </div>
                    <div class="mb-2">
                    <label for="password" class="form-label">New Password:</label>
                    <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
                    @error('password', 'updatePassword')
                       <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mb-2">
                    <label for="password_confirmation" class="form-label">Confirm New Password:</label>
                      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                        @error('password_confirmation', 'updatePassword')
                       <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
<script>
    document.getElementById('change-photo-btn').addEventListener('click', function() {
        document.getElementById('photo').click();
    });

    document.getElementById('photo').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-photo').src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
            document.getElementById('upload-photo-btn').classList.remove('d-none');
        }
    });
</script>
</body>
</html>
