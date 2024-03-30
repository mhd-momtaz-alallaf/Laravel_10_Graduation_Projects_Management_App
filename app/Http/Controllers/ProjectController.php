<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{

    public function index(){
        $projects = Project::all();
        return view('admin.projects.index',['projects'=>$projects]);
    }

    public function show(Project $project){

        return view('layouts.blog-post',['project'=>$project]);
    }

    public function create(){

        return view('admin.projects.create');
    }

    public function store(){
        $this->authorize('create',Project::class); //just the users that logged in can create a project.

        $inputs = request()->validate([
           'title'=>'required|max:255',
            'project_image'=>'file',
            'description'=>'required'
        ]);
        if(\request('project_image')){
            $inputs['project_image'] =request('project_image')->store('images');
        }
        auth()->user()->projects()->create($inputs);
        Session()->flash('create-massage','The Project '.$inputs['title'].' Was created Successfully');
        return redirect()->route('project.index');
    }

    public function update(Project $project){
        $inputs = request()->validate([
            'title'=>'required|max:255',
            'project_image'=>'file',
            'description'=>'required'
        ]);
        if(\request('project_image')){
            $inputs['project_image'] =request('project_image')->store('images');
            $project->project_image = $inputs['project_image'];
        }
        $project->title = $inputs['title'];
        $project->description = $inputs['description'];

        $this->authorize('update',$project);

        $project->save();
        //$project->update();
        //auth()->user()->projects()->save($project);
        Session()->flash('update-massage','The Project '.$inputs['title'].' Was updated Successfully');
        return redirect()->route('project.index');
    }

    public function edit(Project $project){

        /*if (auth()->user()->can('view',$project)){
            return view('admin.projects.edit',['project'=>$project]);
        }*/
        $this->authorize('view',$project);
        return view('admin.projects.edit',['project'=>$project]);
    }

    public function select(Project $project,){
        $project->status = 'selected';
        $project->student = User::find(request('userid'))->name;
        $user = User::find(request('userid'));
        $user->update(['status' => 1]);
        $project->save();
        Session()->flash('select-massage','The Project '.$project['title'].' Was Selected Successfully');
        return back();
    }

    public function destroy(Project $project){

        $this->authorize('delete',$project);
        $project->delete();
        Session::flash('delete-massage','The Project Was Deleted Successfully');
        return back();

    }
}
