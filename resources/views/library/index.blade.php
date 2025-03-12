<!-- resources/views/library/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron text-center">
            <h1 class="display-3">Welcome to Our Beautiful Library</h1>
            <p class="lead">A collection of knowledge and stories awaits you!</p>
            <hr class="my-4">
            <p class="lead">Explore a world of imagination and wisdom with our soon-to-arrive books.</p>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h2 class="card-title">Exciting New Books Coming Soon!</h2>
                        <p class="card-text">Get ready for a journey into captivating stories and enlightening knowledge.</p>
                        <p class="card-text text-muted">Our library is currently being curated with the most incredible selection of books.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <img src="{{ asset('images/library_image.jpg') }}" class="img-fluid" alt="Library Image">
            </div>
            <div class="col-md-6">
                <h2>Our Library Oasis</h2>
                <p>Immerse yourself in a tranquil space designed for both learning and relaxation.</p>
                <p>Stay tuned as we unveil the treasures that will soon fill our shelves.</p>
            </div>
        </div>
    </div>
@endsection
