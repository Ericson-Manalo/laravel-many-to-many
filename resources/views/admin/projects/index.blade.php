@extends('layouts.app')

@section('content')
<div class="col-10 m-auto mt-5">
    <table class="table table-hover align-middle">
        <thead class="table-dark align-middle">
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Project's Title</th>
                <th scope="col">Description</th>
                <th scope="col">Type</th>
                <th scope="col">Language used</th>
                <th scope="col">Data created</th>
                <th scope="col">Settings</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>
                    {{$project->id}}
                </td>
                <th>
                    {{$project->title}}
                </th>
                <td>
                    {{$project->description}}
                </td>
                <td>
                    {{$project->category}}
                </td>
                <td>
                    {{$project->language}}
                </td>
                <td>
                    {{$project->created_date}}
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.projects.show', $project->id) }}" class="badge bg-primary p-2 m-1 text-decoration: none">View</a>
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="badge bg-success p-2 m-1">Edit</a>
                    <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"class="badge bg-danger p-2 m-1">Delete</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{$projects->links()}}
    <a href="{{ route('admin.projects.create')}}" class="badge bg-success p-2 m-1">Create a new project</a>
</div>
@endsection