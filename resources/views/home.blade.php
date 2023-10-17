@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tareas') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h2>{{ __('Crear Tarea') }}</h2>

                    <!-- Formulario para crear tareas -->
                    <form method="post" action="{{ route('tasks.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" name="title" class="form-control" id="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" class="form-control" id="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success my-4">Add Task</button>
                    </form>

                    <h3>{{ __('Lista de tareas') }}</h3>

                    <!-- Lista de tareas existentes -->
                    @if(count($tasks) > 0)
                    @foreach($tasks as $task)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Nombre:</strong> {{ $task->title }}<br>
                            <strong>Descripción:</strong> {{ $task->description }}
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn btn-info">Editar</a>
                            <form method="post" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    @else
                    No tiene tareas pendientes
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
