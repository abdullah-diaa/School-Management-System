<?php
namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        return view('library.index');
    }

    public function create()
    {
        // Implement create method
    }

    public function store(Request $request)
    {
        // Implement store method
    }

    public function show(Library $library)
    {
        
    }

    public function edit(Library $library)
    {
        // Implement edit method
    }

    public function update(Request $request, Library $library)
    {
        // Implement update method
    }

    public function destroy(Library $library)
    {
        // Implement destroy method
    }
}
