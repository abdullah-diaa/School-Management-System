@extends('layouts.app')

@section('content')

<link href="{{ asset('css/academic_classes/index.css') }}" rel="stylesheet">

                @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
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
                    <div class="card-header">الصفوف الأكاديمية</div>
                    <div class="card-body">
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">إدارة الصفوف الأكاديمية</h4>
                            <a href="{{ route('academic_classes.create') }}" class="btn btn-primary">إضافة صف أكاديمي</a>
                        </div>

                        <form action="{{ route('academic_classes.index') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="البحث بالاسم">
                                <button type="submit" class="btn btn-outline-secondary">بحث</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الصف</th>
                                        <th>مستوى الصف</th>
                                        <th>وصف الصف</th>
                                        <th>معلم الصف</th>
                                        <th>السعة</th>
                                        <th>تاريخ البدء</th>
                                        <th>تاريخ الانتهاء</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($academicClasses as $academicClass)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $academicClass->class_name }}</td>
                                        <td>{{ $academicClass->class_level }}</td>
                                        <td>{{ $academicClass->class_description }}</td>
                                        <td>{{ optional($academicClass->classTeacher)->first_name }}&nbsp;{{ optional($academicClass->classTeacher)->last_name }}</td>
                                        <td>{{ $academicClass->capacity }}</td>
                                        <td>{{ $academicClass->start_date }}</td>
                                        <td>{{ $academicClass->end_date }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('academic_classes.show', $academicClass->id) }}" class="btn btn-info">عرض</a>
                                                
                                                
                                                
                                              <a href="{{ route('academic_classes.addAttendance', ['academicClass' => $academicClass->id]) }}" class="btn btn-warning me-2 btn-add-attendance">إضافة الحضور</a>
  
                                                
<a href="{{ route('academic_classes.show_attendances', ['academic_class_id' => $academicClass->id, 'date' => $date ?? '']) }}" class="btn btn-primary me-2 btn-show-attendances">عرض الحضور</a>


                                    
                               
                                    
            <a href="{{ route('academic_classes.edit', $academicClass) }}" class="btn btn-sm btn-primary me-2">تعديل</a>
                                                <form action="{{ route('academic_classes.destroy', $academicClass) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا الصف الأكاديمي؟')">حذف</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <ul class="pagination">
                            <li class="{{ $academicClasses->previousPageUrl() ? '' : 'disabled' }}">
                                <a href="{{ $academicClasses->previousPageUrl() }}">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $academicClasses->lastPage(); $i++)
                                <li class="{{ $academicClasses->currentPage() == $i ? 'active' : '' }}">
                                    <a href="{{ $academicClasses->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ $academicClasses->nextPageUrl() ? '' : 'disabled' }}">
                                <a href="{{ $academicClasses->nextPageUrl() }}">Next</a>
                            </li>
                        </ul>
                        <p>Showing {{ $academicClasses->firstItem() }} - {{ $academicClasses->lastItem() }} of {{ $academicClasses->total() }} academic classes</p>
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


<script src="{{ asset('js/academic_classes/index.js') }}"></script>
@endpush
