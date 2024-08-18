@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a class="btn btn-primary mb-3 mt-2 " href="{{route('project.create')}}" type="button" >
                     Novo Projeto
                </a>
                <a class="btn btn-primary mb-3 mt-2" href="{{route('task.create')}}" type="button">
                    Nova Task
                </a>
            </div>
            <table id="table" class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Criado em</th>
                    <th>Última Atualização</th>
                    <th>Projeto Finalizado?</th>
                    <th>Tasks</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody class="items">
                @foreach($projects as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->getProjectTitle()}}</td>
                        <td>{{$project->getDescription()}}</td>
                        <td>{{date('d/m/Y', strtotime($project->created_at))}}</td>
                        <td>{{date('d/m/Y', strtotime($project->updated_at))}}</td>
                        <td>{{$project->getCompletationDate() ? date('d/m/Y', strtotime($project->getCompletationDate())) : 'Não'}}</td>
                        <td><a href="{{ route('project.task', $project->id) }}" class="btn btn-danger" type="button" >Ver</a></td>
                        <td class="d-flex"><a class="btn btn-primary" style="height: 100%" href="{{route('project.edit', $project->id)}}"><i class="bi bi-pencil-square"></i></a> |
                            <form action="{{ route('project.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Certeza?');">
                                @csrf
                                @method('DELETE')
                            <button type="submit" class="btn btn-danger" >
                                <i class="bi bi-trash"></i>
                            </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-6">
                <form action="{{route('export.pdf')}}" method="POST" >
                @csrf
                <label for="inputState">Exportar Tarefas em PDF</label>
                <select id="inputState" name="task_status" class="form-control">
                    <option selected></option>
                    <option value="concluido">Concluida</option>
                    <option value="pendente">Pendente</option>
                    <option value="em_progresso">Em Progresso</option>
                </select>
                    <input class="form-control mt-2" id="due_date"  type="date" name="conclusion_date" value="" >
                    <button class="btn btn-primary mt-1" id="btn" type="submit">Exportar</button>
                </form>
            </div>
            <div class="col-6">
                <form action="{{route('export.excel')}}" method="POST" >
                    @csrf
                    <label for="inputState">Exportar Tarefas em Excel</label>
                    <select id="inputState" name="task_status" class="form-control">
                        <option selected></option>
                        <option value="concluido">Concluida</option>
                        <option value="pendente">Pendente</option>
                        <option value="em_progresso">Em Progresso</option>
                    </select>
                    <input class="form-control mt-2" id="due_date"  type="date" name="conclusion_date" value="" >
                    <button class="btn btn-primary mt-1" id="btn" type="submit">Exportar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
