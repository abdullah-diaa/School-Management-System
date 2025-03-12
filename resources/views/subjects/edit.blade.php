@extends('layouts.app')

@section('content')
<link href="{{ asset('css/subjects/edit.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" dir="rtl">
      @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')        
                <div class="card-header">تعديل بيانات الموضوع</div> <!-- Edit Subject Data -->

                <div class="card-body">
                    <form method="POST" action="{{ route('subjects.update', $subject->id) }}">

                        @csrf
                        @method('PUT')

                        <!-- Subject Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">اسم الموضوع</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $subject->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Subject Description -->
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">وصف الموضوع</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"  autocomplete="description" autofocus>{{ old('description', $subject->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Include other input fields for editing the subject -->

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">حفظ التعديلات</button> <!-- Save Changes -->
                            </div>
                        </div>
                    </form>
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
<script src="{{ asset('js/subjects/edit.js') }}"></script>
@endpush

