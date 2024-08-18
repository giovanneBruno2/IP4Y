@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{route('project.index')}}" class="btn btn-secondary mb-3 mt-2">Cancelar Criação</a>
            </div>
            <div class="col-6">
                <form action="{{route('task.update', $task->id)}}" method="POST" >
                    @csrf
                    @method('patch')

                    <div class="mb-2">
                        <label for="ds_name" class="form-label">{{__('Titulo')}}</label>
                        <input class="form-control" id="task_title" required  type="text" name="task_title" value="{{$task->getTitle()}}" autofocus>
                    </div>
                    <div class="mb-2">
                        <label for="ds_url" class="form-label">{{__('Descrição')}}</label>
                        <input class="form-control" id="task_description"  type="text" name="task_description" value="{{$task->getDescription()}}" required >
                    </div>
                    <div class="mb-2">
                        <label for="ds_url" class="form-label">{{__('Data Vencimento')}}</label>
                        <input class="form-control" id="due_date"  type="date" name="due_date" value="{{$task->getDueDate()}}" required >
                    </div>
                    <div class="mb-2">
                        <label for="project" class="form-label">Projeto</label>
                        <select class="form-control" id="project_id" name="project_id" aria-label="Default select example" required>
                            @foreach($projects as $project)
                                @if($project->id == $task->getProjectId())
                                    <option value="{{$project->id}}" selected>{{$project->getProjectTitle()}}</option>
                                @else
                                    <option value="{{$project->id}}">{{$project->getProjectTitle()}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="project" class="form-label">Usuario</label>
                        <select class="form-control" id="assigned_to" name="assigned_to" aria-label="Default select example" required>
                            @foreach($users as $user)
                                @if($user->id == $task->getAssignedTo())
                                    <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                @else
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary mt-1" id="btn" type="submit">Salvar</button>
                </form>
            </div>

        </div>
    </div>
@endsection
