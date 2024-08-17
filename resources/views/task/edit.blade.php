
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex">
                    <form action="{{ route('task.update', $task->id) }}" method="POST" >
                        @csrf
                        @method('patch')

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="title" :value="__('Titulo')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="task_title" :value="$task->title" required autofocus autocomplete="title" />
                        </div>

                        <!-- Descrição -->
                        <div class="mt-4">
                            <x-input-label for="desc" :value="__('Descrição')" />
                            <x-text-input id="desc" class="block mt-1 w-full" type="text" name="task_description" :value="$task->description" required autofocus autocomplete="title" />
                        </div>


                        <!-- Data -->
                        <div class="mt-4">
                            <x-input-label for="desc" :value="__('Data Vencimento')" />
                            <x-text-input id="desc" class="block mt-1 w-full" type="text" name="due_date" :value="$task->due_date" required autofocus autocomplete="title" />
                        </div>

                        <!-- Projeto -->
                        <div class="mt-4">
                            <x-input-label for="desc" :value="__('Projeto')" />
                            @foreach($projects as $project)
                                @if($project->id == $task->projects_id)
                                <x-text-input id="desc" class="block mt-1 w-full" type="hidden" readonly="true"  name="project_id" :value="$project->id" required autofocus autocomplete="title" />
                                <x-text-input id="desc" class="block mt-1 w-full" readonly="true" type="text" name="project" :value="$project->project_title" required autofocus autocomplete="title" />
                                @else
                                <x-text-input id="desc" class="block mt-1 w-full" type="hidden" readonly="true"  name="project_id" :value="$project->id" required autofocus autocomplete="title" />
                                <x-text-input id="desc" class="block mt-1 w-full" type="text" name="project" :value="$project->project_title" required autofocus autocomplete="title" />
                                @endif
                            @endforeach
                        </div>

                        <!-- User -->
                        <div class="mt-4">
                            <x-input-label for="desc" :value="__('Usuario')" />
                            @foreach($users as $user)
                                <x-text-input id="desc" class="block mt-1 w-full" type="text" name="assigned_to" :value="$user->id" required autofocus autocomplete="title" />
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Salvar Edicao') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
</x-app-layout>
