
@extends('layouts.app')

@section('content')
    <h1>{{ $course->name }} ({{ $course->code }})</h1>

    <p>Description: {{ $course->description }}</p>

    <p>Assigned Teacher: {{ $course->teacher->name }}</p>

    <h2>Students</h2>
    <ul>
        @foreach ($students as $student)
            <li>{{ $student->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('courses.index') }}">Back to Courses</a>
@endsection
