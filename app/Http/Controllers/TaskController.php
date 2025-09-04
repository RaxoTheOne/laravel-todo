<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Eingabe aus Suchfeld lesen
    $search = $request->input('search');

    // Query aufbauen
    $query = Task::query();

    if ($search) {
        $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%');
    }

    // Filter nach Status (falls gesetzt)
    $filter = $request->input('filter');
    if ($filter === 'done') {
        $query->where('is_done', true);
    } elseif ($filter === 'open') {
        $query->where('is_done', false);
    }

    // Aufgaben laden
    $tasks = $query->orderBy('is_done')->orderBy('due_date')->paginate(5);

    return view('tasks.index', compact('tasks', 'search', 'filter'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation der Eingaben
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        // Task speichern
        Task::create($validated);

        // Zurück zur Task-Liste mit Erfolgsmeldung
        return redirect()->route('tasks.index')->with('success', 'Task erfolgreich erstellt');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Prüfen: Kommt nur ein Status-Update oder auch andere Eingaben?
        if ($request->has('is_done') && !$request->has('title')) {
            $task->is_done = $request->input('is_done');
            $task->save();
            return redirect()->route('tasks.index')->with('success', 'Task wurde aktualisiert!');

        }

        // Validation der Eingaben
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'is_done' => 'nullable|boolean',
        ]);

        // Task aktualisieren
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task erfolgreich aktualisiert');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Task löschen
        $task->delete();

        // Zurück zur Task-Liste mit Erfolgsmeldung
        return redirect()->route('tasks.index')->with('success', 'Task erfolgreich gelöscht');
    }

    /**
     * Filter die Tasks nach Status
     */
    public function filter($status)
    {
        if ($status === 'open') {
            $tasks = Task::where('is_done', false)->orderBy('due_date')->get();
        } elseif ($status === 'done') {
            $tasks = Task::where('is_done', true)->orderBy('due_date')->get();
        } else {
            $tasks = Task::orderBy('is_done')->orderBy('due_date')->get();
        }
        return view('tasks.index', compact('tasks', 'status'));
    }

    public function updateStatus(Task $task)
    {
        $task->is_done = !$task->is_done; // erledigt/offen umschalten
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task wurde geändert!');
    }
}
