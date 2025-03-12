@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Attendance Details</h1>

        @if($attendance)

            <ul>
                <li><strong>Academic Class:</strong> {{ $attendance->academicClass->class_name }}</li>
                <li><strong>Date:</strong> {{ $attendance->date }}</li>
                <li><strong>Status:</strong> {{ $attendance->status ? 'Present' : 'Absent' }}</li>
                <li><strong>Remarks:</strong> {{ $attendance->remarks ?: 'N/A' }}</li>
            </ul>

            <h2>Students Present</h2>

            <ul>
                @foreach($attendance->students as $student)
                    <li>{{ $student->first_name }} {{ $student->last_name }}</li>
                @endforeach
            </ul>

        @else

            <p>Attendance record not found.</p>

        @endif

        <a href="{{ route('attendances.index') }}" class="btn btn-primary">Back to Attendances</a>

    </div>

@endsection
