<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;

class GradeController extends Controller
{
    
    

    
    public function index(Request $request)
{
$search = $request->input('search');

    // Query students based on the search query and paginate the results
    if(!$search){
    $grades = Grade::when($search, function ($query, $search) {
        return $query->where('student_name', 'like', '%' . $search . '%')
                     ->orWhere('period', 'like', '%' . $search . '%')->orWhere('grade', 'like', '%' . $search . '%');
    })->paginate(300); // Change pagination limit based on search
    
    return view('grades.index', compact('grades', 'search'));}
    
    else{
      $grades = Grade::when($search, function ($query, $search) {
        return $query->where('student_name', 'like', '%' . $search . '%')
                     ->orWhere('period', 'like', '%' . $search . '%')->orWhere('grade', 'like', '%' . $search . '%');
    })->paginate(100000); // Change pagination limit based on search

    // Pass the students and search query to the view
    return view('grades.index', compact('grades', 'search'));}
    
}
  

public function store(Request $request)
{
    // Validate the incoming data
    $validatedData = $request->validate([
        'student_id' => 'required|exists:students,id',
        'student_name' => 'required|string',
        'academic_class_id' => 'required|exists:academic_classes,id',
        'grades' => 'required|array',
        'grades.*.subject_id' => 'required|exists:subjects,id',
        'grades.*.grade' => 'required|numeric|min:0|max:100',
'grades.*.period' => 'required|in:1stmonth,2ndmonth,midterm,3rdmonth,4thmonth,finalexam',


    ]);




    // Extract the student ID and academic class ID from the request
    $studentId = $validatedData['student_id'];
    $studentName = $validatedData['student_name'];
    $academicClassId = $validatedData['academic_class_id'];

    // Extract the grades from the request
    $grades = $validatedData['grades'];

    // Loop through each subject's grade and store it in the database
    foreach ($grades as $gradeData) {
        // Log the grade data
        Log::info('Grade data:', $gradeData);
        
        Grade::updateOrCreate(
            [
                'student_id' => $studentId,
                'academic_class_id' => $academicClassId,
                'subject_id' => $gradeData['subject_id'],
'period' => $gradeData['period'],

            ],
            [
                'student_name' => $studentName,
                'grade' => $gradeData['grade'],
                'remark' => $gradeData['remark'] ?? null,

            ]
        );
    }

  
    return redirect()->back()->with('success', '.تم إضافة الدرجات بنجاح');
}






    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('grades.index')
                         ->with('success', 'Grade deleted successfully');
    }
    
public function deleteSelected(Request $request)
{
    $selectedIds = $request->input('selectedGrades');

     if ($selectedIds) {
        Grade::whereIn('id', $selectedIds)->delete();
        
        return redirect()->back()->with('success', 'تم حذف السجلات المحددة بنجاح');
    } else {
      
        return redirect()->back()->withErrors(['لا يوجد سجلات محددة.']);
    }
}

}
