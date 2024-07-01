<!DOCTYPE html>
<html lang="en">

<body>

@extends('layouts.app')

@section('content')
    <h1>Edit FAQ</h1>
    <form action="{{ route('FAQ.update', $FAQ->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="question" class="form-control" value="{{ $FAQ->question }}" required>
        </div>
        <div class="form-group">
            <label for="answer">Answer</label>
            <textarea name="answer" class="form-control" required>{{ $FAQ->answer }}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-primary" href="{{ route('FAQ.index') }}">Back</a>
    </form>
@endsection



</body>
</html>
