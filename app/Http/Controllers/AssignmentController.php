<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAssignmentRequest;
use App\Models\Assignment;
use App\Models\Teacher;
use App\Models\AcademicClass;
use App\Models\Subject;
use Carbon\Carbon;
class AssignmentController extends Controller
{
  public function __construct()
{
    $this->middleware('checkUserData');
}

    public function index()
{
    $user = auth()->user();

    if ($user->role === 'Teacher'  && \App\Models\Teacher::where('user_id', auth()->user()->id)->exists()) {
        $teacher = $user->teacher()->first(); // Retrieve the first teacher record for the authenticated user
        $assignments = $teacher->assignments;
    } elseif ($user->role === 'Student'  && \App\Models\Student::where('user_id', auth()->user()->id)->exists()) {
        $academicClassId = $user->student()->first()->academic_classes_id; // Retrieve the academic_classes_id property from the student record
        $assignments = Assignment::whereHas('academicClass', function ($query) use ($academicClassId) {
            $query->where('id', $academicClassId);
        })->get();
    } else {
        $assignments = Assignment::all();
    }

    $now = Carbon::now();

    foreach ($assignments as $assignment) {
        $assignment->deadline_passed = $assignment->deadline < $now;
    }

    return view('assignments.index', ['assignments' => $assignments]);
}




    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);

        return view('assignments.show', ['assignment' => $assignment]);
    }

public function create()
{
    $user = auth()->user();

    if ($user->role === 'Admin') {
        $teachers = Teacher::all();
    } elseif ($user->role === 'Teacher') {

        $teacher = $user->teacher->first();
    } else {

        return redirect()->back()->with('error', 'You are not authorized to create assignments.');
    }

    $academicClasses = AcademicClass::all();
    $subjects = Subject::all();

    return view('assignments.create', [
        'teachers' => $teachers ?? null,
        'teacher' => $teacher ?? null,
        'academicClasses' => $academicClasses,
        'subjects' => $subjects,
    ]);
}



    public function store(CreateAssignmentRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['deadline'] = Carbon::parse($validatedData['deadline']);

        $assignment = Assignment::create($validatedData);

        return redirect()->route('assignments.index', ['assignment' => $assignment->id])
            ->with('success', 'تم إنشاء الواجب الدراسي بنجاح');
    }


    

public function edit($id)
{
    $assignment = Assignment::findOrFail($id);
    $user = auth()->user();


    if ($user->role === 'Admin') {

        $teachers = Teacher::all();
    } elseif ($user->role === 'Teacher') {

        $teacher = $user->teacher->first();
    } else {
        return redirect()->back()->with('error', 'You are not authorized to edit assignments.');
    }

    $academicClasses = AcademicClass::all();
    $subjects = Subject::all();

    return view('assignments.edit', [
        'assignment' => $assignment,
        'teachers' => $teachers ?? null,
        'teacher' => $teacher ?? null,
        'academicClasses' => $academicClasses,
        'subjects' => $subjects,
    ]);
}


    public function update(CreateAssignmentRequest $request, $id)
    {
        $validatedData = $request->validated();

        $assignment = Assignment::findOrFail($id);
        $assignment->update($validatedData);

        return redirect()->route('assignments.index', ['assignment' => $assignment->id])
            ->with('success', 'تم تحديث الواجب الدراسي بنجاح');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();

        return redirect()->route('assignments.index')
            ->with('success', 'تم حذف الواجب الدراسي بنجاح');
    }

}
