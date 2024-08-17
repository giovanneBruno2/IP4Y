<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="table-auto">
                        <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>aÇÕES</th>
                            <th>
                                <a href="{{route('project.create')}}" class="btn btn-secondary mb-3 mt-2">Criar Novo</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="items">
                        @foreach($projects as $project)
                        <tr>
                            <td >{{$project->getProjectTitle()}}</td>
                            <td>{{$project->getDescription()}}</td>
                            <td>{{$project->getDate() ? $project->getDate() : 'Não tem' }}</td>
                            <td><a class="btn btn-primary" href="{{ route('project.edit', $project->id) }}" ><i class="bi bi-pencil-square"></i>EDIT</a>  | <a href="{{ route('project.task', $project->id) }}" class="btn btn-danger" type="button" >TASK </a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
        </div>
    </div>
</x-app-layout>

