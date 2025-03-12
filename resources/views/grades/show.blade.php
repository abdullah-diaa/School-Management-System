@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Student Details - {{ $student->first_name }} {{ $student->last_name }}</h2>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Personal Information</h5>
                <ul class="list-group list-group-flush">
                    <!-- ... Other personal information ... -->
                </ul>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Academic Information</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Academic Class:</strong>
                        @if ($student->AcademicClassesTable)
                            {{ $student->AcademicClassesTable->name }}
                        @else
                            N/A
                        @endif
                    </li>
                    <li class="list-group-item"><strong>Guardian:</strong>
                        @if ($student->guardian)
                            {{ $student->guardian->first_name }} {{ $student->guardian->last_name }}
                        @else
                            N/A
                        @endif
                    </li>
                </ul>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Subjects and Grades</h5>
                <ul class="list-group list-group-flush">
                    @forelse ($student->grades as $grade)
                        <li class="list-group-item">
                            <strong>Subject:</strong>
                            @if ($grade->subject)
                                {{ $grade->subject->name }}
                            @else
                                N/A
                            @endif

                            <strong>Grade:</strong>
                            @if ($grade->grade)
                                {{ $grade->grade }}
                            @else
                                N/A
                            @endif
                        </li>
                    @empty
                        <li class="list-group-item">No subjects and grades available.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Additional sections or information can be added here -->

        <div class="text-end">
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
