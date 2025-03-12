<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AcademicClassController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LibraryController;
use App\Http\Middleware\CheckUserData;
use App\Http\Middleware\Authenticate;

/*

Route::post('academic_classes/{academicClass}/add-attendance', [AcademicClassController::class, 'addAttendance'])->name('academic_classes.addAttendance');

*/
/*
Route::post('attendances', [AttendanceController::class, 'store'])->name('attendances.store');

*/

// routes/web.php





Route::middleware(['checkUserData'])->group(function () {
Route::resource('events', EventController::class);
Route::resource('schedules', ScheduleController::class);

Route::resource('assignments', AssignmentController::class);
Route::get('academic_classes/{academic_class_id}/attendances/{date?}', [AcademicClassController::class, 'showAttendances'])->name('academic_classes.show_attendances');
Route::get('students/{student_id}/grades', [StudentController::class, 'showGrades'])->name('students.show_grades');

Route::get('/settings', function () {
    return view('settings.edit');
})->name('settings.edit');
});

Route::resource('teachers', TeacherController::class);



Route::delete('/grades/deleteSelected', [GradeController::class, 'deleteSelected'])->name('grades.deleteSelected');
/* the route for adding grades*/
Route::get('students/{student}/add-grades', [StudentController::class, 'addGrades'])->name('students.addGrades');

Route::get('academic_classes/{academicClass}/add-attendance', [AcademicClassController::class, 'addAttendance'])->name('academic_classes.addAttendance');

Route::delete('/attendances/deleteSelected', [AttendanceController::class, 'deleteSelected'])->name('attendances.deleteSelected');








Route::resource('events', EventController::class);
Route::resource('schedules', ScheduleController::class);

Route::resource('assignments', AssignmentController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('grades', GradeController::class);
Route::resource('attendances', AttendanceController::class);
Route::resource('courses', CourseController::class);


Route::get('/certificates/{student}', [CertificateController::class, 'generate'])->name('certificates.generate');

Route::resource('subjects', SubjectController::class);




Route::get('/dashboard/users', [DashboardController::class, 'users'])->name('dashboard.users');





    // Your authenticated routes here


Route::middleware(['auth'])->group(function () {
    // Your authenticated routes here
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/students/create', 'StudentController@create')->name('students.create');
});





Route::put('/students/{student}', 'StudentController@update')->name('students.update');







Route::get('/students/{student}/performance', 'StudentController@performance')->name('students.performance');

Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');




Route::resource('students', 'App\Http\Controllers\StudentController')->except(['show']);
Route::get('/students/{student}/attendance', 'App\Http\Controllers\StudentController@attendance')->name('students.attendance');
Route::get('/students/{student}/advancedGrading', 'App\Http\Controllers\StudentController@advancedGrading')->name('students.advancedGrading');
Route::get('/students/performanceAnalysis', 'App\Http\Controllers\StudentController@performanceAnalysis')->name('students.performanceAnalysis');



Route::resource('academic_classes', AcademicClassController::class);




Route::resource('guardians', GuardianController::class);

Route::delete('/guardians/bulk-delete', [GuardianController::class, 'bulkDelete'])->name('guardians.bulkDelete');
// Define email verification routes
Auth::routes(['verify' => true]);





Route::middleware('auth')->group(function () {
    // Your authenticated routes here
});


Auth::routes();








// This si for  dashboard and user management
Route::get('/dashboard/users', [DashboardController::class, 'index'])->name('dashboard.users.index');
Route::get('/dashboard/users/create', [DashboardController::class, 'create'])->name('dashboard.users.create');
Route::post('/dashboard/users', [DashboardController::class, 'store'])->name('dashboard.users.store');
Route::get('/dashboard/users/{user}', [DashboardController::class, 'show'])->name('dashboard.users.show');
Route::get('/dashboard/users/{user}/edit', [DashboardController::class, 'edit'])->name('dashboard.users.edit');
Route::put('/dashboard/users/{user}', [DashboardController::class, 'update'])->name('dashboard.users.update');


Route::delete('/dashboard/users/{user}', [DashboardController::class, 'destroy'])->name('dashboard.users.destroy');







// Authentication Routes



Route::get('/dashboard', [DashboardController::class, 'index_1'])->name('dashboard.index');


Route::get('/library',[LibraryController::class,'index'])->name('library.index');









Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Registration Routes
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

// Password Reset Routes
Route::get('/password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');

Route::get('/password/change', 'App\Http\Controllers\Auth\ChangePasswordController@showChangeForm')->name('password.change');
Route::post('/password/change', 'App\Http\Controllers\Auth\ChangePasswordController@change')->name('password.update');



