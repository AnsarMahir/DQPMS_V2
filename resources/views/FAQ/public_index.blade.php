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
</div>
@endsection



</body>
</html>
