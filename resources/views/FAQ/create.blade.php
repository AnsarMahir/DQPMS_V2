<!DOCTYPE html>
<html lang="en">

<body>

@extends('layouts.app')

@section('content')
    <h1>Create New FAQ</h1>
    <form action="{{ route('FAQ.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="question" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="answer">Answer</label>
            <textarea name="answer" class="form-control" required></textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-primary" href="{{ route('FAQ.index') }}">Back</a>
    </form>
@endsection


</body>
</html>
