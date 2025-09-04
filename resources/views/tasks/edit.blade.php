@extends('layouts.app')

@section('content')
<h1>Task bearbeiten</h1>

<form method="post" action="{{ route('tasks.update', $task->id) }}">
    @csrf
    @method('PUT')

    <label>
        Titel:
        <input type="text" name="title" value="{{ old('title', $task->title) }}">
        @error('title') <div style="color:red">{{ $message }}</div> @enderror
    </label>
    <br>

    <label>
        Beschreibung:
        <textarea name="description">{{ old('description', $task->description) }}</textarea>
    </label>
    <br>

    <label>
        Fälligkeitsdatum:
        <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}">
    </label>
    <br>

    <label>
        Erledigt:
        <input type="checkbox" name="is_done" value="1" {{ $task->is_done ? 'checked' : '' }}>
    </label>
    <br>

    <button type="submit">Speichern</button>
</form>

<a href="{{ route('tasks.index') }}">Zurück zur Liste</a>
@endsection
