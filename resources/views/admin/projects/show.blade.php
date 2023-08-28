@extends('layouts.app')

@section('content')
<div class="col-7 m-auto mt-5">
    <div class="card text-center">
        <div class="card-header">
            #{{$project->id}} - {{$project->title}} - {{$project->type->name}}
        </div>

        
        <div class="card-body">
            <h5 class="card-title">
                {{$project->title}}
            </h5>
            <p class="card-text">
                {{$project->description}}
            </p>
            <img src="{{asset('storage/' . $project->image)}}" alt="{{$project->image}}">
                
            <p class="card-text">
                {{$project->category}} - {{$project->language}}
            </p>
            <div class="card-footer text-muted">
                {{$project->created_date}}
            </div>
            
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('admin.projects.edit', $project->id) }}" class="badge bg-success p-2 m-1">Edit</a>
            <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"class="badge bg-danger p-2 m-1">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection