@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="{{route('project.index')}}" class="btn btn-secondary mb-3 mt-2">Voltar</a>
        </div>
        <div class="col-6">
            <form action="{{ route('project.update', $project->id) }}" method="POST" >
                @csrf
                @method('patch')
                <div class="mb-2">
                    <label for="ds_name" class="form-label">{{__('Titulo')}}</label>
                    <input class="form-control" id="project_title" required  type="text" name="project_title" value="{{old('project_title', $project->project_title)}}" autofocus>
                </div>
                <div class="mb-2">
                    <label for="ds_url" class="form-label">{{__('Descrição')}}</label>
                    <input class="form-control" id="description"  type="text" name="description" value="{{old('description', $project->description)}}" required >
                </div>
                <div class="mb-2">
                    <label for="ds_status" class="form-label">Projeto Finalizado?</label>
                    <select class="form-control" id="completion_dates" name="completion_dates" aria-label="Default select example">
                        <option value="no">Não</option>
                        <option value="yes">Sim</option>
                    </select>
                </div>

                <button class="btn btn-primary mt-1" id="btn" type="submit">Salvar</button>
            </form>
        </div>

    </div>
</div>
@endsection
