@extends('layouts.app')

@section('content')

<link href="{{ asset('css/teachers/index.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

                <div class="card-header">المعلمين</div> <!-- Teachers -->

                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">إدارة المعلمين</h4> <!-- Manage Teachers -->
                        <a href="{{ route('teachers.create') }}" class="btn btn-primary">إضافة معلم</a> <!-- Add Teacher -->
                    </div>

                    <form action="{{ route('teachers.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="البحث بالاسم"> <!-- Search by name -->
                            <button type="submit" class="btn btn-outline-secondary">بحث</button> <!-- Search -->
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                               <th>رقم القبول</th>     
                                    
                                    <th>اسم المعلم</th> <!-- Teacher's Name -->
                                    <th>
                                      إسم المستخدم
                                    </th>
                                    
                                    <th>
                                      البريد الألكتروني
                                      
                                      
                                    </th>
                                    
                                    <th>رقم الهاتف</th> <!-- Phone Number -->
                                    <th>المادة التدريسية</th> <!-- Subject -->
                                    <th>الجنس</th> <!-- Gender -->
                                    <th>العنوان</th> <!-- Address -->
                                    <th>التأهيل</th> <!-- Qualification -->
                                    
                          
                                    <th>الإجراءات</th> <!-- Actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $teacher->admission_number}}</td>
                                    <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                                    <td>{{ optional($teacher->user)->user_name }}</td>
                                    <td>{{ optional($teacher->user)->email }}</td>
                                    
                                    
<td>{{ $teacher->phone }}</td>
                                    <td>{{ $teacher->subject->name }}</td>
                                    <td>{{ $teacher->gender === "male" ? 'ذكر' : 'أنثى' }}</td>
                                    <td>{{ $teacher->address }}</td>
                                    <td>{{ $teacher->qualification }}</td>

                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">

                                                                             <a href="{{ route('dashboard.users.show', $teacher->user_id) }}" class="btn btn-info">عرض</a>
                                                                             
                                                                             <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-secondary me-2">تعديل</a>
                                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا المعلم؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">حذف</button>
                                            </form>
                                                                    
                    </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
<ul class="pagination" style="flex-wrap: wrap;">
    <li class="{{ $teachers->previousPageUrl() ? '' : 'disabled' }}" style="margin-bottom:100px !important;">
        <a href="{{ $teachers->previousPageUrl() }}">Previous</a>
    </li>
    @for ($i = 1; $i <= $teachers->lastPage(); $i++)
        <li class="{{ $teachers->currentPage() == $i ? 'active' : '' }}">
            <a href="{{ $teachers->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="{{ $teachers->nextPageUrl() ? '' : 'disabled' }}">
        <a href="{{ $teachers->nextPageUrl() }}">Next</a>
    </li>
</ul>


<p>Showing {{ $teachers->firstItem() }} - {{ $teachers->lastItem() }} of {{ $teachers->total() }} teachers</p>
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

<script src="{{ asset('js/teachers/index.js') }}"></script>
@endpush
