@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <main id="main-content" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Subject Details</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to Subjects</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $subject->name }}</h5>
                        <p class="card-text">{{ $subject->description }}</p>
                    </div>
                </div>

                <!-- Display Associated Grades -->
                @if($subject->grades->isNotEmpty())
                    <div class="mt-4">
                        <h3>Associated Grades</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student</th>
                                    <th>Grade</th>
                                    <th>Remark</th>
                                    <!-- Add more columns as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subject->grades as $grade)
                                    <tr>
                                        <td>{{ $grade->id }}</td>
                                        <td>{{ $grade->student->name }}</td>
                                        <td>{{ $grade->grade }}</td>
                                        <td>{{ $grade->remark }}</td>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="mt-4">No grades associated with this subject.</p>
                @endif
            </main>
        </div>
    </div>
@endsection
