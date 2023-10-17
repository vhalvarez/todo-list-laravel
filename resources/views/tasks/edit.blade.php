@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Tarea</div>

                <div class="card-body">
                    <form method="post" action="{{ route('tasks.update', ['task' => $task->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mt-2">
                            <label for="title">Título</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $task->title }}">
                        </div>

                        <div class="form-group mt-2">
                            <label for="description">Descripción</label>
                            <textarea name="description" class="form-control" id="description">{{ $task->description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Actualizar Tarea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
