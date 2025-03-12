<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guardian;
use App\Http\Requests\GuardianRequest;

class GuardianController extends Controller
{
      public function index(Request $request)
{

    $search = $request->input('search');

    // Query students based on the search query and paginate the results
    if(!$search){
    $guardians = Guardian::when($search, function ($query, $search) {
        return $query->where('father_name', 'like', '%' . $search . '%')
                     ->orWhere('mother_name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->orWhere('phone_number', 'like', '%' . $search . '%');
    })->paginate(30); // Change pagination limit based on search

    
    return view('guardians.index', compact('guardians', 'search'));}
    else{
      $guardians= Guardian::when($search, function ($query, $search) {
        return $query->where('father_name', 'like', '%' . $search . '%')
                     ->orWhere('mother_name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->orWhere('phone_number', 'like', '%' . $search . '%');
    })->paginate(100000); // Change pagination limit based on search

    // Pass the students and search query to the view
    return view('guardians.index', compact('guardians', 'search'));}
      
      
    }

  
  
  
    





    public function create()
    {
        return view('guardians.create');
    }







    public function store(GuardianRequest $request)
    {
        try {
            // Your create logic here
            Guardian::create($request->validated());

            return redirect()->route('guardians.index')->with('success', 'تم إنشاء معلومات ولي الأمر بنجاح');
        } catch (\Exception $e) {
            return redirect()->route('guardians.create')->with('error', 'حدث خطأ ما يرجى المحاولة مرة أخرى');
        }
    }

    



    



    public function show(Guardian $guardian)
    {
        return view('guardians.show', compact('guardian'));
    }

    public function edit(Guardian $guardian)
    {
        return view('guardians.edit', compact('guardian'));
    }

    public function update(GuardianRequest $request, Guardian $guardian)
    {
        $guardian->update($request->validated());

        return redirect()->route('guardians.index')->with('success', 'تم تحديث معلومات ولي الأمر بنجاح');
    }

    public function destroy(Guardian $guardian)
    {
        $guardian->delete();

        return redirect()->route('guardians.index')->with('success', 'تم حذف معلومات ولي الأمر بنجاح');
    }
  
}
