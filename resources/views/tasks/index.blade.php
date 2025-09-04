@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>

    <div class="mb-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Neue Task</a>
    </div>

    <!-- Such- und Filterformular -->
    <form method="GET" action="{{ route('tasks.index') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Nach Titel oder Beschreibung suchen"
                value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="filter" class="form-select">
                <option value="">Alle Aufgaben</option>
                <option value="open" {{ request('filter') === 'open' ? 'selected' : '' }}>Nur offene</option>
                <option value="done" {{ request('filter') === 'done' ? 'selected' : '' }}>Nur erledigte</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Filtern</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </form>

    <ul class="list-group">
        @forelse ($tasks as $task)
            <li
                class="list-group-item d-flex justify-content-between align-items-center
                    {{ $task->is_done ? 'list-group-item-secondary text-decoration-line-through' : '' }}">
                <div>
                    <strong>{{ $task->title }}</strong>
                    @if ($task->due_date)
                        <small>(fällig: {{ $task->due_date }})</small>
                    @endif
                </div>
                <div>
                    @if ($task->is_done)
                        <a href="{{ route('tasks.updateStatus', $task->id) }}" class="btn btn-warning btn-sm">❌ Offen</a>
                    @else
                        <a href="{{ route('tasks.updateStatus', $task->id) }}" class="btn btn-success btn-sm">✔️
                            Erledigt</a>
                    @endif
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">✏️</a>
                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Task wirklich löschen?')">🗑️</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="list-group-item">Keine Tasks gefunden.</li>
        @endforelse
    </ul>
@endsection
