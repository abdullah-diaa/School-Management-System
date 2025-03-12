<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\AcademicClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;


class DashboardController extends Controller
{
 public function __construct()
{
    $this->middleware('checkUserData');
} 
  
  
  /*
  
public function __construct()
        {
            $this->middleware('admin')->only(['index','create' ,'show', 'edit','destroy']);
        } 
  

*/
  

public function index_1()
{
    // Fetch counts for students, teachers, and academic classes
    $totalUsers = User::count();
    $activeUsers = User::where('status', '1')->count();
    $notactiveUsers = User::where('status', '0')->count();
    $totalStudents = Student::count();
    $totalTeachers = Teacher::count();
    $totalClasses = AcademicClass::count();
    

    // You may need to customize the logic to fetch counts based on your application's requirements

    return view('dashboard.index', compact('totalUsers','activeUsers','notactiveUsers','totalStudents', 'totalTeachers', 'totalClasses'));
}


    public function index(Request $request)
{
  
      $search = $request->input('search');

    // Query students based on the search query and paginate the results
    if(!$search){
    $users = User::when($search, function ($query, $search) {
        return $query->where('user_name', 'like', '%' . $search . '%')
                     ->orWhere('email', 'like', '%' . $search . '%')->orWhere('region', 'like', '%' . $search . '%')->orWhere('status', 'like', '%' . $search . '%');
    })->paginate(30); 

      return view('dashboard.users.index', compact('users', 'search'));}
      else{
      $users = User::when($search, function ($query, $search) {
        return $query->where('user_name', 'like', '%' . $search . '%')
                     ->orWhere('email', 'like', '%' . $search . '%')->orWhere('region', 'like', '%' . $search . '%')->orWhere('status', 'like', '%' . $search . '%');
    })->paginate(100000); 
    return view('dashboard.users.index', compact('users', 'search'));}
    }

    public function create()
{

    return view('dashboard.users.create');
}



public function store(UserRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $data['profile_picture'] = $profilePicturePath;
    }
        $password = $data['password'];
       $data['password'] = Hash::make($password);
    User::create($data);

    return redirect()->route('dashboard.users.index')->with('success', 'تم إنشاء حساب المستخدم بنجاح');
}


    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(UserRequest $request, $user)
{
    $user = User::findOrFail($user);

    $data = $request->validated();

    try {
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $profilePicturePath;
        }
     
        $user->update($data);
if(auth()->check() && auth()->user()->role === 'Admin'){
  return redirect()->route('dashboard.users.index')->with('success', 'تم تحديث حساب المستخدم بنجاح');
  

}else if(auth()->check() && (auth()->user()->role === 'Teacher' || auth()->user()->role === 'Student')){
  return redirect()->route('dashboard.index')->with('success', 'تم تحديث حساب المستخدم بنجاح');
  

}
        
    } catch (\Exception $e) {
        return back()->with('error', 'حدث خطأ ما أثناء عملية تحديث معلومات المستخدم' . $e->getMessage())->withInput();
    }
}

  


    public function destroy(User $user)
    {
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();
        return redirect()->route('dashboard.users.index')->with('success', 'تم حذف حساب المستخدم بنجاح');
    }
}
