<!-- resources/views/students/performance.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Students Performance Analysis</h2>

        <table id="performanceTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Performance</th>
                    <th>Subject</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($performanceData as $studentData)
                    <tr>
                        <td>{{ $studentData['student_name'] }}</td>
                        <td>
                            @if (is_array($studentData['performance']))
                                {{ implode(', ', $studentData['performance']) }}
                            @else
                                {{ $studentData['performance'] }}
                            @endif
                        </td>
                        <td colspan="2"></td> <!-- Empty columns for spacing -->

                        @forelse ($studentData['grades'] as $grade)
                            </tr><tr>
                                <td colspan="2"></td> <!-- Empty columns for spacing -->
                                <td>{{ $grade['subject'] }}</td>
                                <td>{{ $grade['grade'] }}</td>
                            </tr>
                        @empty
                            <td colspan="4">No grades available</td>
                        @endforelse
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <!-- DataTables initialization script -->
    <script>
        $(document).ready(function () {
            $('#performanceTable').DataTable();
        });
    </script>
@endsection
