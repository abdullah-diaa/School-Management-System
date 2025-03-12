@extends('layouts.app')

@section('content')

<link href="{{ asset('css/attendances/index.css') }}" rel="stylesheet">

                    @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')        
<!-- Notification Container -->
<div id="notification-container">

<!-- Display error notification if any -->
@if ($errors->any())
    <div class="notification error">
        <i class="fas fa-exclamation-circle"></i> <!-- Error Icon -->
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li> <!-- Error Messages -->
            @endforeach
        </ul>
        <!-- Close Button -->
    </div>
@endif

<!-- Display success notification if any -->
@if(session('success'))
    <div class="notification success">
        <i class="fas fa-check-circle"></i> <!-- Success Icon -->
        {{ session('success') }} <!-- Success Message -->

    </div>
@endif
</div>
@endif
                              
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if(auth()->check() && auth()->user()->role === 'Admin' && auth()->user()->status == '1')
                    <div class="card-header">الحضور</div>
                    <div class="card-body">
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">إدارة الحضور</h4>

                        </div>

                        <form action="{{ route('attendances.index') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="البحث بالطالب">
                                <button type="submit" class="btn btn-outline-secondary">بحث</button>
                            </div>
                        </form>

                        <form action="{{ route('attendances.deleteSelected') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="table-responsive">
                                <table class="table table-striped" style="text-align:center;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم الطالب</th>
                                            <th>الصف والشعبة</th>
                                            <th>التاريخ</th>
                                            <th>الحالة</th>
                                            <th>الملاحظات</th>
                                            <th>حدد الحضور لحذفها</th>
                                            <th style="width:20%;">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attendances as $attendance)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attendance->student->first_name }} {{ $attendance->student->last_name }}</td>
                                            <td>-{{ $attendance->academicClass->class_level }}&nbsp; -{{ $attendance->academicClass->class_name }}</td>
                                            <td>{{ $attendance->date }}</td>
                                            <td>{{ $attendance->status ? 'حاضر' : 'غائب' }}</td>
                                            <td>{{ $attendance->remarks }}</td>
                                            <td>
                                                <input type="checkbox" name="selectedAttendances[]" value="{{ $attendance->id }}">
                                            </td>
                                            <td>
                                                <div>
                                                    <form action="{{ route('attendances.destroy', $attendance) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا الحضور؟')">حذف</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if(!empty(count($attendances)))
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد أنك تريد حذف الحضور المحددة؟')">حذف المحدد</button>
                            @endif
                        </form>

                        <!-- Pagination -->
                        <ul class="pagination">
                            <li class="{{ $attendances->previousPageUrl() ? '' : 'disabled' }}">
                                <a href="{{ $attendances->previousPageUrl() }}">السابق</a>
                            </li>
                            @for ($i = 1; $i <= $attendances->lastPage(); $i++)
                                <li class="{{ $attendances->currentPage() == $i ? 'active' : '' }}">
                                    <a href="{{ $attendances->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ $attendances->nextPageUrl() ? '' : 'disabled' }}">
                                <a href="{{ $attendances->nextPageUrl() }}">التالي</a>
                            </li>
                        </ul>
                        <p>عرض {{ $attendances->firstItem() }} - {{ $attendances->lastItem() }} من {{ $attendances->total() }} حضور</p>


                    </div>
                           @else

                {{-- Handle unauthorized access here --}}
                <div class="card-header">خطأ في التحميل</div>
                <div class="card-body">
                    <p>.عذرًا، يبدو أن هناك خطأ في تحميل الصفحة المطلوبة</p>
                </div>
                                @if(auth()->check())
                <script>
                    setTimeout(function() {
                        window.location.href = "{{ route('dashboard.index') }}"; // Replace 'login' with your actual route name
                    }, 3000); // 3000 milliseconds = 3 seconds
                </script>
    @else            
      <script>
                    setTimeout(function() {
                        window.location.href = "{{ route('login') }}"; // Replace 'login' with your actual route name
                    }, 3000); // 3000 milliseconds = 3 seconds
                </script>
    
@endif
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
  $('#notification-container').delay(4000).fadeOut(300)

</script>

<script src="{{ asset('js/attendances/index.js') }}"></script>
@endpush
