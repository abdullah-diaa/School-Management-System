@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Assignment Details</h1>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Assignment Information</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Title:</strong> {{ $assignment->title }}</li>
                    <li class="list-group-item"><strong>Description:</strong> {{ $assignment->description }}</li>
                    <li class="list-group-item"><strong>Deadline:</strong> {{ $assignment->deadline }}</li>
                    <li class="list-group-item"><strong>Teacher:</strong>
    @if($assignment->teacher && $assignment->teacher->user)
        {{ $assignment->teacher->user->name }}
    @else
        N/A
    @endif
</li>

<li class="list-group-item"><strong>Subject:</strong>
    @if($assignment->subject)
        {{ $assignment->subject->name }}
    @else
        N/A
    @endif
</li>

<li class="list-group-item"><strong>Academic Class:</strong>
    @if($assignment->academicClass)
        {{ $assignment->academicClass->name }}
    @else
        N/A
    @endif
</li>


                    <!-- Add more details based on your Assignment model -->
                </ul>
            </div>
        </div>

        <!-- Add more sections for other information if needed -->

        <a href="{{ route('assignments.edit', ['assignment' => $assignment->id]) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('assignments.destroy', ['assignment' => $assignment->id]) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
        </form>
    </div>
@endsection
