@extends('layouts.app')

@section('content')
<h1>Tasks</h1>

<a href="{{ route('tasks.create') }}">Neue Task erstellen</a>

<hr>

<!-- Filter-Buttons -->
<div>
    <a href="{{ route('tasks.index') }}">Alle Tasks</a>
    <a href="{{ route('tasks.filter', 'open') }}">Offene Tasks</a>
    <a href="{{ route('tasks.filter', 'done') }}">Erledigte Tasks</a>
</div>
<hr>

<ul>
    @foreach ($tasks as $task)
        <li style="{{ $task->is_done ? 'text-decoration: line-through; color:gray' : '' }}">
            {{ $task->title }}
            @if ($task->due_date)
                (fällig: {{ $task->due_date }})
            @endif
            @if ($task->is_done)
                ✅ erledigt!
            @else
                ⌛ offen!
            @endif

            <!-- Bearbeiten -->
            <a href="{{ route('tasks.edit', $task->id) }}">✏️</a>

            <!-- Löschen -->
            <form method="post" action="{{ route('tasks.destroy', $task->id) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Task wirklich löschen?')">🗑️</button>
            </form>

            <!-- Schnell erledigt setzen -->
            <form method="post" action="{{ route('tasks.update', $task->id) }}" style="display:inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="is_done" value="{{ $task->is_done ? 0 : 1 }}">
                <button type="submit">{{ $task->is_done ? '❌ Offen' : '✔️ Erledigt' }}</button>
            </form>
        </li>
    @endforeach
</ul>

<!-- Erfolgsmeldung anzeigen -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@endsection
