<!DOCTYPE html>
<html lang="en">

<body>

    @extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>FAQs</h1>

    <!-- Display FAQs for Users -->
    <div class="public-faqs">
        @foreach ($FAQ as $faq)
        <div class="card mt-4">
            <div class="card-body">
                <div class="faq-item">
                    <h5 class="card-title">{{ $faq->question }}</h5>
                    <p class="card-text">{{ $faq->answer }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <hr>

    <!-- Admin FAQ Management Interface -->
    <h1>Manage FAQs</h1>
    <a href="{{ route('FAQ.create') }}" class="btn btn-primary">Create New FAQ</a>
    <p></p>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Question</th>
            <th>Answer</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($FAQ as $faq)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->answer }}</td>
                <td>
                    <form action="{{ route('FAQ.destroy', $faq->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('FAQ.show', $faq->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('FAQ.edit', $faq->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection


</body>
</html>

