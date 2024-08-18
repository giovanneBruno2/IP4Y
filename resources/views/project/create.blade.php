@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{route('project.index')}}" class="btn btn-secondary mb-3 mt-2">Voltar</a>
            </div>
            <div class="col-6">
                <form action="{{route('project.store')}}" method="POST" >
                    @csrf

                    <div class="mb-2">
                        <label for="ds_name" class="form-label">{{__('Titulo')}}</label>
                        <input class="form-control" id="project_title" required  type="text" name="project_title" value="" autofocus>
                    </div>
                    <div class="mb-2">
                        <label for="ds_url" class="form-label">{{__('Descrição')}}</label>
                        <input class="form-control" id="description"  type="text" name="description" value="" required >
                    </div>
                    <button class="btn btn-primary mt-1" id="btn" type="submit">Salvar</button>
                </form>
            </div>

        </div>
    </div>
@endsection
