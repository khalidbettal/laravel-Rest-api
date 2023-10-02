<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class ProjectController extends Controller
{

  public function __construct()
  {
      $this->authorizeResource(Project::class, 'project');
  }

 public function store(StoreProjectRequest $request){
       $validated = $request->validated();
       $project = Auth::user()->projects()->create( $validated );
         return new ProjectResource( $project );
 }

    public function update(UpdateTaskRequest $request, Project $project){
        $validated = $request->validated();
        $project->update( $validated );
        return new ProjectResource( $project );

    }

    public function show(Request $request, Project $project){
        return (new ProjectResource( $project ))
        ->load('tasks')
        ->load('members');

    }

    public function index(Request $request){
        $projects = QueryBuilder::for(Project::class)
            ->allowedIncludes(['tasks', 'members'])
            ->paginate(10);
        return new ProjectCollection( $projects );
    }

    public function destroy(Request $request, Project $project){
        $project->delete();
        return response()->noContent();
    }
}


