@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection

