
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

                    <form action="{{ route('project.update', $project->id) }}" method="POST" >
                        @csrf
                        @method('patch')


                        <div>
                            <x-input-label for="title" :value="__('Titulo')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="project_title" :value="old('project_title', $project->project_title)" required autofocus autocomplete="title" />

                        </div>

                        <!-- Descrição -->
                        <div class="mt-4">
                            <x-input-label for="desc" :value="__('Descrição')" />
                            <x-text-input id="desc" class="block mt-1 w-full" type="text" name="description" :value="old('description', $project->description) " required autofocus autocomplete="Description" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Salvar Edição') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <form action="{{ route('project.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Certeza?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit">Delete</button>
                    </form>
            </div>
        </div>
</x-app-layout>
