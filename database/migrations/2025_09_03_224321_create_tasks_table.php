<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // TODO: ID der Aufgabe
            $table->string('title'); // TODO: Titel der Aufgabe
            $table->text('description')->nullable(); // TODO: Beschreibung der Aufgabe
            $table->date('due_date')->nullable(); // TODO: Fälligkeitsdatum der Aufgabe
            $table->boolean('is_done')->default(false); // TODO: Status der Aufgabe
            $table->timestamps(); // TODO: Zeitstempel für die Erstellung und Aktualisierung der Aufgabe
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
