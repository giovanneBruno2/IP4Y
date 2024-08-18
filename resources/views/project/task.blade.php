@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-secondary" role="alert">
                    Tarefa do Projeto:  <b>{{$project->getProjectTitle()}}</b>
                </div>
            </div>
            <table id="table" class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Prazo</th>
                    <th>Última Atualização</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody class="items">
                @foreach($project->tasks as $task)
                    @php
                        $dueDate = new DateTime($task->due_date);
                    @endphp
                    <tr class="taskDiv" data-due-date="{{ $dueDate->format('Y-m-d') }}" data-status="{{$task->getStatus()}}" >
                        <td>{{$task->id}}</td>
                        <td>{{$task->getTitle()}}</td>
                        <td>{{$task->getDescription()}}</td>
                        <td>{{date('d/m/Y', strtotime($task->due_date))}}</td>
                        <td>{{date('d/m/Y', strtotime($task->updated_at))}}</td>
                        <td><b>{{$task->getStatus()}}</b></td>
                        <td class="d-flex">
                            <a class="btn btn-primary" style="height: 100%;" href="{{route('task.edit', $task->id)}}"><i class="bi bi-pencil-square"></i></a> |
                            <form action="{{ route('task.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Certeza?');">
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
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll('.taskDiv');
        const today = new Date();
        rows.forEach(row => {
            const dueDateStr = row.getAttribute('data-due-date');
            const statusStr = row.getAttribute('data-status');
            const dueDate = new Date(dueDateStr);
            if (dueDate < today && statusStr != 'concluido') {
                row.style.backgroundColor = 'lightcoral';
            } else if  (statusStr == 'concluido') {
                row.style.backgroundColor = 'cornflowerblue';
            } else if  (statusStr == 'em progresso')  {
                row.style.backgroundColor = 'lightyellow';
            }
        });
    });
</script>
