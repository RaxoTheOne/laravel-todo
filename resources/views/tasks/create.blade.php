@extends('layouts.app')

@section('content')
<h1>Neue Task</h1>

<form method="post" action="{{ route('tasks.store') }}">
    @csrf
    <label>
        Titel:
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title') <div style="color:red">{{ $message }}</div> @enderror
    </label>
    <br>
    <label>
        Beschreibung:
        <textarea name="description">{{ old('description') }}</textarea>
    </label>
    <br>
    <label>
        Fälligkeitsdatum:
        <input type="date" name="due_date" value="{{ old('due_date') }}">
    </label>
    <br>
    <button type="submit">Speichern</button>
</form>

<a href="{{ route('tasks.index') }}">Zurück zur Liste</a>
@endsection
