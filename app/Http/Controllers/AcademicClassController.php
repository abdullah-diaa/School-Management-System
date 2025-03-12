<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Attendance;
use App\Http\Requests\AcademicClassRequest;

class AcademicClassController extends Controller
{
  
  
    public function index(Request $request)
{
    // Get the search query from the request
    $search = $request->input('search');

    // Query academic classes based on the search query and paginate the results
    
    if(!$search){
    $academicClasses = AcademicClass::when($search, function ($query, $search) {
        return $query->where('class_name', 'like', '%' . $search . '%')
                     ->orWhere('class_level', 'like', '%' . $search . '%')
                     ->orWhere('class_description', 'like', '%' . $search . '%');
    })->paginate(10); // Change pagination limit based on search

    // Pass the academic classes and search query to the view
    return view('academic_classes.index', compact('academicClasses', 'search'));}
    else{
      $academicClasses = AcademicClass::when($search, function ($query, $search) {
        return $query->where('class_name', 'like', '%' . $search . '%')
                     ->orWhere('class_level', 'like', '%' . $search . '%')
                     ->orWhere('class_description', 'like', '%' . $search . '%');
    })->paginate(10000); // Change pagination limit based on search

    // Pass the academic classes and search query to the view
    return view('academic_classes.index', compact('academicClasses', 'search'));
    }
}










public function create()
{
    $teachers = Teacher::all(); // Fetch all teachers to populate the select input
    $subjects = Subject::all(); // Fetch all subjects to populate the multiple select input
    return view('academic_classes.create', compact('teachers', 'subjects'));
}




    public function store(AcademicClassRequest $request)
{
    // Create the academic class
    $academicClass = AcademicClass::create($request->validated());

    // Retrieve the selected subjects from the form
    $selectedSubjects = $request->input('subjects', []);

    // Associate each selected subject with the academic class
    $academicClass->subjects()->sync($selectedSubjects);

    // Redirect back with success message
    return redirect()->route('academic_classes.index')->with('success', 'تم انشاء صف اكاديمي بنجاح');
}


    public function show(AcademicClass $academicClass)
    {
        return view('academic_classes.show', compact('academicClass'));
    }

    public function edit($id)
{
    $academicClass = AcademicClass::findOrFail($id); // Find the academic class by its ID
    $teachers = Teacher::all(); 
    $subjects = Subject::all(); 
    return view('academic_classes.edit', compact('academicClass', 'teachers','subjects'));
}


    public function update(AcademicClassRequest $request, AcademicClass $academicClass)
    {
        $academicClass->update($request->validated());

       $selectedSubjects = $request->input('subjects', []);

    // Associate each selected subject with the academic class
    $academicClass->subjects()->sync($selectedSubjects);
        return redirect()->route('academic_classes.index')->with('success', '
         تم تحديث معلومات الصف الاكاديمي بنجاح');
    }
    
    
    
    

    public function addAttendance($academicClassId)
    {
        // Retrieve the academic class
        $academicClass = AcademicClass::findOrFail($academicClassId);

        // Retrieve all students belonging to this academic class
        $students = Student::where('academic_classes_id', $academicClassId)->get();

        return view('attendances.create', compact('academicClass', 'students'));
    }



public function showAttendances($academicClassId)
{
    // Retrieve the academic class
    $academicClass = AcademicClass::findOrFail($academicClassId);

    // Retrieve distinct dates for attendance records related to this academic class
    $dates = Attendance::where('academic_classes_id', $academicClassId)
                        ->orderBy('date', 'desc')
                        ->distinct('date')
                        ->pluck('date');


    $attendanceData = [];

    // Loop through each distinct date
    foreach ($dates as $date) {
        // Retrieve attendance records for the current date and academic class
        $attendanceRecords = Attendance::where('academic_classes_id', $academicClassId)
                                        ->where('date', $date)
                                        ->get();

        // Push attendance data for the current date to the array
        $attendanceData[] = [
            'date' => $date,
            'attendanceRecords' => $attendanceRecords,
        ];
    }

    // Pass the academic class and attendance data to the view
    return view('academic_classes.show_attendances', compact('academicClass', 'attendanceData'));
}




    public function destroy(AcademicClass $academicClass)
    {
            if(auth()->check() && auth()->user()->role === 'Admin')  {    
        $academicClass->delete();

        return redirect()->route('academic_classes.index')->with('success', 'تم حذف الصف الاكاديمي بنجاح');}
    }
}
