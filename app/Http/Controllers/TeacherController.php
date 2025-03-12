<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\AcademicClass;
use App\Models\User;

class TeacherController extends Controller
{
  
  public function index(Request $request)
{
    // Get the search query from the request
    $search = $request->input('search');


    if(!$search){
    $teachers = Teacher::when($search, function ($query, $search) {
        return $query->where('first_name', 'like', '%' . $search . '%')
                     ->orWhere('last_name', 'like', '%' . $search . '%')->orWhere('admission_number', 'like', '%' . $search . '%');
    })->paginate(30); 
    return view('teachers.index', compact('teachers', 'search'));}
    else{
      $teachers = Teacher::when($search, function ($query, $search) {
        return $query->where('first_name', 'like', '%' . $search . '%')
                     ->orWhere('last_name', 'like', '%' . $search . '%')->orWhere('admission_number', 'like', '%' . $search . '%');
    })->paginate(100000);
    return view('teachers.index', compact('teachers', 'search'));}
      
      
    }
    
    public function create()
    {
      if (auth()->user()->role === 'Teacher') {

        $teacherExists = Teacher::where('user_id', auth()->user()->id)->exists();


        if ($teacherExists) {
            return redirect()->route('dashboard.index')->with('error', 'لقد قمت باضافة معلوماتك سابقاً');
        }
    }
      
      
      
        $subjects = Subject::all();
            $users = User::all();
        return view('teachers.create', compact('subjects','users'));
    }

public function store(TeacherRequest $request)
    {
        Teacher::create($request->validated());
      if (auth()->user()->role === 'Teacher') {
        return redirect()->route('dashboard.index')->with('success', '.تمت اضافة معلومات الطالب بنجاح');
        
      }
        return redirect()->route('teachers.index')->with('success', '.تمت اضافة معلومات الطالب بنجاح');
    }
    
    
    
    
    

    public function show(Teacher $teacher)
{
    return view('teachers.show', compact('teacher'));
}

    



    

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $subjects = Subject::all();
        $users = User::all();

        return view('teachers.edit', compact('teacher','subjects','users'));
    }

    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
      if (auth()->user()->role === 'Teacher') {
return redirect()->route('dashboard.index')->with('success', '.تم تحديث معلومات الأستاذ بنجاح');
        
      }
        return redirect()->route('teachers.index')->with('success', '.تم تحديث معلومات الأستاذ بنجاح');
    }


    
    public function destroy(Teacher $teacher)
{
  if(auth()->check() && auth()->user()->role === 'Admin')  {    
    $teacher->delete();

    return redirect()->route('teachers.index')->with('success', '.تم حذف معلومات الأستاذ بنجاح');}
}
}
