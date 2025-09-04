@extends('layouts.app')

@section('content')
<h1>Tasks</h1>

<a href="{{ route('tasks.create') }}">Neue Task erstellen</a>

<ul>
    @foreach ($tasks as $task)
        <li style="{{ $task->is_done ? 'text-decoration: line-through; color:gray' : '' }}">
            {{ $task->title }}
            @if ($task->due_date)
                (fällig: {{ $task->due_date }})
            @endif
            @if ($task->is_done)
                ✅
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
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif
@endsection
