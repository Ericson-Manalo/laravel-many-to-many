<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $projects = Project::paginate(10);
        // dd($projects);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'title' => ['required', 'unique:projects', 'min:6'],
            'description' => ['max:500'],
            'category' => ['required'],
            'created_date' => ['required'],
            'image' => ['image'],
            'technologies' => ['exists:technologies,id'],
            'type_id' => ['required', 'exists:types,id']
        ]);

        $img_path = Storage::put('uploads', $request['image']);
        $data['image'] = $img_path;

        $newProject = Project::create($data);


        if ($request->has('technologies')){
            $newProject->technologies()->sync( $request->technologies);
        }

        return redirect()->route('admin.projects.index', $newProject);

        // $data = $request-> all();

        // $newProject = new Project();
        // $newProject->title = $data['title'];
        // $newProject->description = $data['description'];
        // $newProject->type = $data['type'];
        // $newProject->language = $data['language'];
        // $newProject->created_data = $data['created_data'];
        // $newProject->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
        // dd($request->all());

        $data = $request->validate([
            'title' => ['required', 'unique:projects', 'min:6', Rule::unique('projects')->ignore($project->id)],
            'description' => ['max:500'],
            'category' => ['required'],
            'created_date' => ['required'],
            'image' => ['image'],
            'technologies' => ['exists:technologies,id'],
            'type_id' => ['required', 'exists:types,id']

        ]);

        if ($request->hasFile('image')){
            Storage::delete($post->image);
            $img_path = Storage::put('uploads', $request['image']);
            $data['image'] = $img_path;
        }


        $project->update($data);

        if ($request->has('technologies')){
            $project->technologies()->sync( $request->technologies);
        }
        return redirect()->route('admin.projects.show', compact('project'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // dd($project);
        $project->delete();
        return redirect()->route('admin.projects.index', compact('project'));
    }


    public function deleted(){
        $projects = Project::onlyTrashed()->paginate(10);
        return view('admin.projects.deleted', compact('projects'));
    }



    public function restore($id){
        // dd($project);

        $project = Project::onlyTrashed()->findOrFail($id);
        // dd($project);
        $project->restore();
        return redirect()->route('admin.projects.index', $project); 
    }

    public function erased($id){
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();
        return redirect()->route('admin.projects.index');
    }
}
