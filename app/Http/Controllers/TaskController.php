<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Alle Tasksabrufen
        $tasks = Task::all();

        // View zurückgeben und Tasks übergeben
        return view('tasks.index', compact('tasks'));
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
}
