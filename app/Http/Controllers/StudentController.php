<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use App\Models\AcademicClass;
use App\Models\Guardian;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\User;
use App\Models\Performance;


class StudentController extends Controller
{
  
  
  
  
    public function index(Request $request)
{
    // Get the search query from the request
    $search = $request->input('search');

    // Query students based on the search query and paginate the results
    if(!$search){
    $students = Student::when($search, function ($query, $search) {
        return $query->where('first_name', 'like', '%' . $search . '%')
                     ->orWhere('last_name', 'like', '%' . $search . '%')->orWhere('admission_number', 'like', '%' . $search . '%');
    })->paginate(30); 
    
    return view('students.index', compact('students', 'search'));}
    else{
      $students = Student::when($search, function ($query, $search) {
        return $query->where('first_name', 'like', '%' . $search . '%')
                     ->orWhere('last_name', 'like', '%' . $search . '%')->orWhere('admission_number', 'like', '%' . $search . '%');
    })->paginate(100000); 
    return view('students.index', compact('students', 'search'));}
      
      
    }


    

public function addGrades($studentId)
{
    // Fetch the student
    $student = Student::findOrFail($studentId);

    
    $academicClass = $student->academicClass;

    
    $subjects = $academicClass->subjects;

    return view('grades.create', compact('student', 'academicClass', 'subjects'));
}


public function showGrades($student_id)
    {
        // Retrieve the student
        $student = Student::findOrFail($student_id);

        // Retrieve all grades for the student
        $grades = Grade::where('student_id', $student_id)->get();


         $academicClass = $student->academicClass;


    $subjects = $academicClass->subjects;
     
     $periods=['1stmonth','2ndmonth','midterm','3rdmonth','4thmonth','finalexam'];  return view('students.show_grades', compact('student', 'subjects','academicClass','grades','periods'));
    }





    

//for later purpose  


/*
    public function advancedGrading(Student $student)
    {
        // Fetching advanced grading data (Example: Top 3 grades)
        $topGrades = $student->grades()->orderBy('grade', 'desc')->limit(3)->get();

        return view('students.advancedGrading', compact('student', 'topGrades'));
    }

*/

    


public function create()
{
    if (auth()->user()->role === 'Student') {
        // Check if the student has already created their data
        $studentExists = Student::where('user_id', auth()->user()->id)->exists();

    
        if ($studentExists) {
            return redirect()->route('dashboard.index')->with('error', 'لقد قمت باضافة معلوماتك سابقاً');
        }
    }
    
$academicClasses = AcademicClass::all();
    $guardians = Guardian::all(); 
    $users = User::all(); 

    return view('students.create', compact('academicClasses', 'guardians', 'users'));
}

    public function store(StudentRequest $request)
    {
      
      $data = $request->validated();
      
        Student::create($data);
if (auth()->user()->role === 'Student') {
  
  return redirect()->route('dashboard.index')->with('success', '.تمت اضافة معلومات الطالب بنجاح');
  
}
        return redirect()->route('students.index')->with('success', '.تمت اضافة معلومات الطالب بنجاح');
    }



public function show(Student $student)
{
    return view('students.show', compact('student'));
}


    public function edit($id)
{

    $user = auth()->user();


    if ($user->role === 'Student') {

        $student = Student::where('user_id', $user->id)->first();
        
        

        if ($student && $student->id == $id) {
$student = Student::findOrFail($id);
        
        $academicClasses = AcademicClass::all(); 
      $users =auth()->user()->id;
    return view('students.edit', compact('student', 'academicClasses','users'));
        } else {
            // If not authorized, redirect or display an error message
            return redirect()->route('students.index')->with('error', 'خطأ في التحليل الرجاء المحاولة مرة اخرى لاحقاٍ');
        }
    } else {
        // If the user does not have the role "Student", proceed with editing
        $student = Student::findOrFail($id);
        
        $academicClasses = AcademicClass::all(); // Replace with your actual query to get academic classes
    $guardians = Guardian::all(); // Replace with your actual query to get guardians
      $users =User::all();
    return view('students.edit', compact('student', 'academicClasses', 'guardians','users'));
        
      
    }
}


    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->validated());
if (auth()->user()->role === 'Student') {
  
  return redirect()->route('dashboard.index')->with('success', '.تم تحديث معلومات الطالب بنجاح');
}
        return redirect()->route('students.index')->with('success', '.تم تحديث معلومات الطالب بنجاح');
    }
   
    
    public function destroy(Student $student)
{
  if(auth()->check() && auth()->user()->role === 'Admin')  {    
    $student->delete();

    return redirect()->route('students.index')->with('success', '.تم حذف معلومات الطالب بنجاح');}
}

}
