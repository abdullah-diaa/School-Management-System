<!-- resources/views/guardians/index.blade.php -->

@extends('layouts.app')

@section('content')

<link href="{{ asset('css/guardians/index.css') }}" rel="stylesheet">
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
                <div class="card-header">أولياء الأمور</div>
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">إدارة أولياء الأمور</h4>
                        <a href="{{ route('guardians.create') }}" class="btn btn-primary">إضافة ولي أمر</a>
                    </div>

                    <form action="{{ route('guardians.index') }}" method="GET" class="mb-4">
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
                                    <th>اسم الأب</th>
                                    <th>اسم الأم</th>
                                    <th>البريد الألكتروني</th>
                                    <th>رقم الهاتف</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guardians as $guardian)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $guardian->father_name }}</td>
                                    <td>{{ $guardian->mother_name }}</td>
                                    <td>{{ $guardian->email}}</td>
                                    <td>{{ $guardian->phone_number}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('guardians.show', $guardian->id) }}" class="btn btn-info">عرض</a>
                                            <a href="{{ route('guardians.edit', $guardian->id) }}" class="btn btn-sm btn-primary me-2">تعديل</a>
                                            <form action="{{ route('guardians.destroy', $guardian->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل انت متأكد من حذف بيانات ولي الامر هذه؟')">حذف</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                                            <ul class="pagination">
                            <li class="{{ $guardians->previousPageUrl() ? '' : 'disabled' }}">
                                <a href="{{ $guardians->previousPageUrl() }}">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $guardians->lastPage(); $i++)
                                <li class="{{ $guardians->currentPage() == $i ? 'active' : '' }}">
                                    <a href="{{ $guardians->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ $guardians->nextPageUrl() ? '' : 'disabled' }}">
                                <a href="{{ $guardians->nextPageUrl() }}">Next</a>
                            </li>
                        </ul>
                        <p>Showing {{ $guardians->firstItem() }} - {{ $guardians->lastItem() }} of {{ $guardians->total() }} guardians</p>
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
                    <!-- Pagination -->
             
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script>
  $('#notification-container').delay(4000).fadeOut(300)



</script>
@endpush