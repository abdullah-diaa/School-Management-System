<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScheduleController extends Controller
{
  
  public function __construct()
{
    $this->middleware('checkUserData');
}

    public function index()
{
    $schedules = Schedule::all();
    
    return view('schedules.index', compact('schedules'));
}


    public function create()
    {
        return view('schedules.create');
    }



public function store(ScheduleRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('file_path')) {
        $originalFileName = pathinfo($request->file('file_path')->getClientOriginalName(), PATHINFO_FILENAME); // Extract original filename without extension
        $timestamp = now()->format('YmdHis'); // Get current timestamp
        $fileName = $originalFileName . '_' . $timestamp . '.' . $request->file('file_path')->getClientOriginalExtension(); // Combine original filename with timestamp and extension
        $filePath = $request->file('file_path')->storeAs('file_path', $fileName, 'public');
        $data['file_path'] = $filePath;
    }

    Schedule::create($data);

    return redirect()->route('schedules.index')->with('success', 'تم إنشاء الجدول الدراسي بنجاح');
}



    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }


    public function update(ScheduleRequest $request, Schedule $schedule)
{
    $data = $request->validated();

    if ($request->hasFile('file_path')) {
        $originalFileName = pathinfo($request->file('file_path')->getClientOriginalName(), PATHINFO_FILENAME); // Extract original filename without extension
        $timestamp = now()->format('YmdHis'); // Get current timestamp
        $fileName = $originalFileName . '_' . $timestamp . '.' . $request->file('file_path')->getClientOriginalExtension(); // Combine original filename with timestamp and extension
        $filePath = $request->file('file_path')->storeAs('file_path', $fileName, 'public');
        $data['file_path'] = $filePath;
    }

    $schedule->update($data);

    return redirect()->route('schedules.index')->with('success', 'تم تحديث الجدول الدراسي بنجاح');
}



    public function destroy(Schedule $schedule)
    {
        Storage::delete($schedule->file_path); // Delete associated file
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'تم حذف الجدول الدراسي بنجاح');
    }
}
