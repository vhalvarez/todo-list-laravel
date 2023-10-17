<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255', // Valida que 'title' sea requerido y tenga un máximo de 255 caracteres
                'description' => 'required'
            ]);

            $user = auth()->user();

            // Crea una nueva tarea y asigna los datos del formulario
            $task = Task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'user_id' => $user->id, // Assign the current user's ID
            ]);

            return redirect()->route('home')->with('status', 'Tarea creada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'A ocurrido un error al procesar la tarea.');
        }
    }


    public function update(Request $request, Task $task)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
            ]);

            $task->fill($request->only(['title', 'description']))->save();

            return redirect()->route('home')->with('status', 'Tarea actualizada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'A ocurrido un error al procesar la tarea.');
        }
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return redirect()->route('home')->with('status', 'Tarea eliminada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'A ocurrido un error al procesar la tarea.');
        }
    }
}
