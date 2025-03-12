@extends('layouts.app')

@section('content')

<link href="{{ asset('css/subjects/index.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Notification Container -->
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
                @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
                    <div class="card-header">المواد الدراسية</div>
                    <div class="card-body">
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">إدارة المواد الدراسية</h4>
                            <a href="{{ route('subjects.create') }}" class="btn btn-primary">إضافة مادة دراسية</a>
                        </div>

                        <form action="{{ route('subjects.index') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="البحث بالاسم">
                                <button type="submit" class="btn btn-outline-secondary">بحث</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped" style="text-align:center;" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th >اسم المادة</th>
                                        <th>وصف المادة</th>
                                        <th style="width:20%;">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $subject)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td>
                                            <div class="d-flex">

                                                <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-primary me-2">تعديل</a>
                                                <form action="{{ route('subjects.destroy', $subject) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"  class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذه المادة الدراسية؟')">حذف</button>
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
                            <li class="{{ $subjects->previousPageUrl() ? '' : 'disabled' }}">
                                <a href="{{ $subjects->previousPageUrl() }}">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $subjects->lastPage(); $i++)
                                <li class="{{ $subjects->currentPage() == $i ? 'active' : '' }}">
                                    <a href="{{ $subjects->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ $subjects->nextPageUrl() ? '' : 'disabled' }}">
                                <a href="{{ $subjects->nextPageUrl() }}">Next</a>
                            </li>
                        </ul>
                        <p>Showing {{ $subjects->firstItem() }} - {{ $subjects->lastItem() }} of {{ $subjects->total() }} subjects</p>
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

<script src="{{ asset('js/subjects/index.js') }}"></script>
@endpush
