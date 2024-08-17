<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h1>Tarefa do Projeto:  {{$project->project_title}}</h1>
                <a href="{{route('task.create')}}">Criar task</a>
                @foreach($project->tasks as $task)
                    <p>{{ $task->title }}</p>
                    <p>{{ $task->status }}</p>
                    <p>{{ $task->due_date }}</p>
                    <p>Assigned to: {{ $task->assignedUser->name }}</p>
                    <p> <a href="{{ route('task.edit', $task->id) }}"> Editar Task</a></p>
                    <form action="{{ route('task.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Certeza?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endforeach
            </div>
            <a href="{{ route('task.exportTasks', 'pdf') }}">Exportar Tarefas PDF</a>
            <a href="{{ route('task.exportTasks', 'excel') }}">Exportar Tarefas Excel</a>
</x-app-layout>
