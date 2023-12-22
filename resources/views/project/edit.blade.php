@extends('layouts.mbt')
@section('content')
    <div class="col-lg-6">
        <div class="ibox ">
            
            <form method="post" action="{{ route('project-update', $project->id) }}" enctype="multipart/form-data">
                @csrf
                    @include('project._form')
                
                <a href="{{ route('project-index') }}" class="btn btn-default">Powrót</a>
                <button type="submit" class="btn btn-primary">Zapisz</a>
            </form>
        </div>
    </div>
@endsection


