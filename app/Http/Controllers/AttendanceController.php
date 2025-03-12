<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\AcademicClass;
use Illuminate\Support\Facades\Log;
use App\Models\Student;

use App\Http\Requests\AttendanceRequest;

class AttendanceController extends Controller
{
  
  public function index(Request $request)
{
    $search = $request->input('search');

    $attendancesQuery = Attendance::query();
    if ($search) {
        $attendancesQuery->whereHas('student', function ($query) use ($search) {
            $query->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%');
        })->orWhereHas('academicClass', function ($query) use ($search) {
            $query->where('class_name', 'like', '%' . $search . '%');
        })->orWhere('date', 'like', '%' . $search . '%')
          ->orWhere('status', 'like', '%' . $search . '%')
          ->orWhere('remarks', 'like', '%' . $search . '%');
    }
    $attendances = $attendancesQuery->paginate($search ? 100000 : 600);


    return view('attendances.index', compact('attendances', 'search'));
}


    


    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'academic_class_id' => 'required|exists:academic_classes,id',
            'date' => 'required|date',
            'attendance.*.status' => 'required|boolean',
            'attendance.*.remarks' => 'nullable|string',
        ]);

        $academicClassId = $validatedData['academic_class_id'];
        $date = $validatedData['date'];



        $attendanceData = $validatedData['attendance'];



        foreach ($attendanceData as $studentId => $attendanceRecord) {

            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'academic_classes_id' => $academicClassId,
                    'date' => $date,
                ],
                [
                    'status' => $attendanceRecord['status'],
                    'remarks' => $attendanceRecord['remarks'] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'تم اضافة/تحديث الحضور بنجاح ');
    }



    

    

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'تم حذف الحضور بنجاح');
    }
    
    
    public function deleteSelected(Request $request)
{
    $selectedIds = $request->input('selectedAttendances');


    if ($selectedIds) {


        Attendance::whereIn('id', $selectedIds)->delete();
        
        return redirect()->back()->with('success', 'تم حذف الحضور المحددة بنجاح');
    } else {

        return redirect()->back()->withErrors(['لا يوجد حضور محددة.']);
    }
}

}
