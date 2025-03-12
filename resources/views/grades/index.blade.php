@extends('layouts.app')

@section('content')

<link href="{{ asset('css/grades/index.css') }}" rel="stylesheet">
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
                @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
                    <div class="card-header">الدرجات</div>
                    <div class="card-body">
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">إدارة الدرجات</h4>

                        </div>

                        <form action="{{ route('grades.index') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="البحث بالطالب">
                                <button type="submit" class="btn btn-outline-secondary">بحث</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                          
                          <form action="{{ route('grades.deleteSelected') }}" method="POST">
    @csrf
    @method('DELETE')
                            <table class="table table-striped" style="text-align:center;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الطالب</th>
                                        <th>الصف والشعبة</th>

                                        <th>المادة</th>
                                        <th>الفترة</th>
                                        <th>الدرجة</th>
                                        <th>حدد الدرجات لحذفها</th>
                                        <th style="width:20%;">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grades as $grade)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $grade->student_name }}</td>
                                      
                                        <td>-{{ $grade->academicClass->class_level }}-{{ $grade->academicClass->class_name }}</td>
                                        <td>
                                          {{ optional($grade->subject)->name}}</td>
<td>
            @if($grade->period === '1stmonth')
                الشهر الأول
            @elseif($grade->period === '2ndmonth')
                الشهر الثاني
            @elseif($grade->period === 'midterm')
                منتصف العام
            @elseif($grade->period === '3rdmonth')
                الشهر الثالث
            @elseif($grade->period === '4thmonth')
                الشهر الرابع
            @elseif($grade->period === 'finalexam')
                الإمتحان النهائي
            @endif
        </td>
                                     <td>{{ number_format($grade->grade,0) }}</td>
<td>
                    <input type="checkbox" name="selectedGrades[]" value="{{ $grade->id }}">
                </td>
              
                                        <td>
                                            <div>

                                                <form action="{{ route('grades.destroy', $grade) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"  class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذه الدرجة؟')">حذف</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            
@if(!empty(count($grades)))
    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد أنك تريد حذف الدرجات المحددة؟')">حذف المحدد</button>
    @endif
</form>
                        </div>


                        
                        <!-- Pagination -->
                        <ul class="pagination">
                            <li class="{{ $grades->previousPageUrl() ? '' : 'disabled' }}">
                                <a href="{{ $grades->previousPageUrl() }}">السابق</a>
                            </li>
                            @for ($i = 1; $i <= $grades->lastPage(); $i++)
                                <li class="{{ $grades->currentPage() == $i ? 'active' : '' }}">
                                    <a href="{{ $grades->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ $grades->nextPageUrl() ? '' : 'disabled' }}">
                                <a href="{{ $grades->nextPageUrl() }}">التالي</a>
                            </li>
                        </ul>
                        <p>عرض {{ $grades->firstItem() }} - {{ $grades->lastItem() }} من {{ $grades->total() }} درجات</p>
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

<script src="{{ asset('js/grades/index.js') }}"></script>
@endpush

