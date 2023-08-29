@extends('layouts.app')

@section('content')
<div class="col-7 m-auto mt-5">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <!-- @dump($technologies) -->
                
    @error('title')
        <div class="error">{{ $message }}</div>
    @enderror            
    <div class="mb-3">
        <label for="title" class="form-label">Title Project</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>

    @error('image')
        <div class="error">{{ $message }}</div>
    @enderror     

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" placeholder="Insert you image">
    </div>

    @error('type_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
        <div class="mb-5">
            <label for="type_id" class="form-label">
                Category
            </label>
            <select class='form-select' name="type_id" id="type_id">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>


    @error('technology_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="mb-3">
        <label for="technologies" class="form-label mt-4">
            Technology
        </label>
        <div>
        @foreach ($technologies as $technology)
            <input type="checkbox" class="form-check-input ms-5" id="technologies" name="technologies[]" value="{{$technology->id}}">
            <label for="technologies" class="form-label">
                {{$technology->name}}
            </label>
        @endforeach
        </div>
    </div>


    @error('description')
        <div class="error">{{ $message }}</div>
    @enderror   
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" cols="95 "rows="10"></textarea>
    </div>
    <!-- <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <input type="text" class="form-control" id="type" name="type">
    </div> -->
    <div class="form-group">
        <label for="category" class="form-label">Category</label>
            <div class="col-md-10 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-code-o"></i></span>
                    <select class="form-control" id="category" name="category">
                        <option>Public</option>
                        <option>Private</option>
                        <option>Sources</option>
                        <option>OnlForks</option>
                        <option>Archived</option>
                        <option>Can be sponsored</option>
                        <option>Mirrors</option>
                        <option>Templates</option>
                    </select>
                </div>
            </div>
    </div>
    <!-- <div class="mb-3">
        <label for="language" class="form-label">Language</label>
        <input type="text" class="form-control" id="language" name="language">
    </div> -->
    
    <div class="mb-3">
        <label for="created_date" class="form-label">Date of creation</label>
        <input type="date" class="form-control" id="created_date" name="created_date">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-secondary">Reset</button>

    </form>
</div>
@endsection