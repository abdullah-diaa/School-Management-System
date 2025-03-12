<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\EventRequest;
use Carbon\Carbon;
class EventController extends Controller
{

     public function __construct()
{
    $this->middleware('checkUserData');
}

     
     public function index()
{
  
  $events = Event::all();
    $now = Carbon::now();

    foreach ($events as $event) {
        $event-> end_datetime_passed = $event->end_datetime < $now;
    }

    return view('events.index', ['events' => $events]);
}

    
    public function create()
    {
        return view('events.create');
    }

    public function store(EventRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;

        Event::create($validatedData);

        return redirect()->route('events.index')
            ->with('success', 'تم إنشاء الحدث بنجاح');
    }


    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }


    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }


    public function update(EventRequest $request, $id)
    {
        $validatedData = $request->validated();

        $event = Event::findOrFail($id);
        $event->update($validatedData);

        return redirect()->route('events.index')
            ->with('success', 'تم تحديث معلومات الحدث بنجاح');
    }


    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'تم حذف الحدث بنجاح');
    }
}
