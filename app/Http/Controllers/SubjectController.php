<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller
{
  
    public function index(Request $request)
    {
      
      
      
      $search = $request->input('search');

    if(!$search){
    $subjects = Subject::when($search, function ($query, $search) {
        return $query->where('name', 'like', '%' . $search . '%')
                     ->orWhere('description', 'like', '%' . $search . '%');
    })->paginate(30); // Change pagination limit based on search

    // Pass the students and search query to the view
    return view('subjects.index', compact('subjects', 'search'));}
    else{
      $subjects = Subject::when($search, function ($query, $search) {
        return $query->where('name', 'like', '%' . $search . '%')
                     ->orWhere('description', 'like', '%' . $search . '%');
    })->paginate(100000); 
    return view('subjects.index', compact('subjects', 'search'));}
      
      
      
      
      
      
        $subjects = Subject::paginate(10);
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(SubjectRequest $request)
    {
        Subject::create($request->validated());
        return redirect()->route('subjects.index')->with('success', 'تم انشاء الموضوع الدراسي بنجاح');
    }



    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }



    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }
    
    
    

    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());
        return redirect()->route('subjects.index')->with('success', 'تم تعديل الموضوع الدراسي بنجاح');
    }
    
    
    

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'تم حذف الموضوع الدراسي بنجاح');
    }
}
