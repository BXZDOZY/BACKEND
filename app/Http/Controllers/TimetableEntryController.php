```php
<?php


use Illuminate\Http\Request;
use App\Models\TimetableEntry;

class TimetableEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimetableEntry $request)
    {
        // Check for conflicts
        $conflict = TimetableEntry::where('week_day', $request->week_day)
            ->where(function ($q) use ($request) {
                $q->where('class_id', $request->class_id)
                  ->orWhere('teacher_id', $request->teacher_id)
                  ->orWhere('room', $request->room);
            })
            ->whereDate('valid_from', '<=', $request->valid_to ?? $request->valid_from)
            ->where(function ($q) use ($request) {
                $q->whereNull('valid_to')
                  ->orWhere('valid_to', '>=', $request->valid_from);
            })
            ->whereTime('start_time', '<', $request->end_time)
            ->whereTime('end_time', '>', $request->start_time)
            ->exists();

        if ($conflict) {
            return response()->json(['message' => 'Slot conflict'], 422);
        }

        $entry = TimetableEntry::create($request->validated());

        event(new TimetableUpdated($entry->class_id));

        return response()->json($entry, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
