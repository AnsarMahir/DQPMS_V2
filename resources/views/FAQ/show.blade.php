<!DOCTYPE html>
<html lang="en">

<body>

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card mt-4">
        <div class="card-body">
                  <h5 class="card-title">{{ $FAQ->question }}</h5>
                  <p class="card-text">{{ $FAQ->answer }}</p>
        </div>
    </div>
    <br>
    <a class="btn btn-primary" href="{{ route('FAQ.index') }}">Back</a>
</div>
@endsection


</body>
</html>
