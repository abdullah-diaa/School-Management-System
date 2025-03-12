@extends('layouts.app')

@section('content')
<link href="{{ asset('css/users/edit.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card" dir="rtl">
      @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')        
                <div class="card-header">تعديل معلومات المستخدم</div> <!-- Edit Academic Class Data -->

                <div class="card-body">
                    <form method="POST" action="{{ route('dashabord.users.update', $user->id) }}" enctype="multipart/form-data">
٢
                        @csrf
                        @method('PUT')
                        
  <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">إسم المستخدم</label>
                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name', $user->user_name) }}"  autocomplete="user_name" autofocus>
                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        
  <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">البريد الألكتروني</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}"  autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        
                        
  <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">تاريخ الميلاد</label>
                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '' }}" autocomplete="date_of_birth" autofocus>
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group row">
                            <label for="region" class="col-md-4 col-form-label text-md-right">المنطقة</label>
                            <div class="col-md-6">
                                <input id="region" type="text" class="form-control @error('region') is-invalid @enderror" name="region" value="{{ old('region', $user->region) }}"  autocomplete="region" autofocus>
                                @error('region')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        
                        
 <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">الدور</label>
                            <div class="col-md-6">
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" autocomplete="role" autofocus>
                                    <option value="">اختر المعلم</option>
                                                                           <option value="Admin" @if($user->role == "Admin") selected @endif>ادمن</option>
                                                                           <option value="Teacher" @if($user->role == "Teacher") selected @endif>اختر الدور</option>
                                                                           <option value="Student" @if($user->role == "Student") selected @endif>طالب</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
 <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                              
                                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" autocomplete="status" autofocus>
                                    <option value="">اختر حالة الحساب</option>
                                                                           <option value="1" @if($user->status == "1") selected @endif>نشط</option>
                                                                           <option value="0" @if($user->status == "0") selected @endif>غير نشط</option>
                                                                       
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                          <div class="form-group row">
                            <label for="profile_picture" class="col-md-4 col-form-label text-md-right">صورة الملف الشخصي</label>
                            <div class="col-md-6">
                                <input id="profile_picture" type="file" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture" value="{{ $user->profile_picture}}" autocomplete="profile_picture" autofocus>
                                @error('profile_picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
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
<script src="{{ asset('js/academic_classes/edit.js') }}"></script>
@endpush
