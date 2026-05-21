<?php

namespace App\Http\Controllers;

use App\Enums\ProjectStatus;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = request('status') ? ProjectStatus::tryFrom(request('status')) : null;
        $statuses = ProjectStatus::cases();
        $projects = Project::with('client', 'user')->filterStatus($status)->paginate(7);
        return view('projects.index', [
            'projects' => $projects,
            'statuses' => $statuses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $users = User::all();
        $statuses = ProjectStatus::cases();
        return view('projects.create', [
            'clients' => $clients,
            'users' => $users,
            'statuses' => $statuses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        Project::create($request->validated());
        return redirect()->route('projects.index')->with('status', 'Dự án đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('client', 'user', 'tasks');
        return view('projects.show', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $project->load('client', 'user');
        $clients = Client::all();
        $users = User::all();
        $statuses = ProjectStatus::cases();
        return view('projects.edit', [
            'clients' => $clients,
            'users' => $users,
            'statuses' => $statuses,
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
       $project->update($request->validated());
       return redirect()->route('projects.index')->with('status', 'Dự án đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        abort_unless(auth()->user()?->can('delete'), 403);

        $project->delete();
        return redirect()->route('projects.index')->with('status', 'Dự án đã được xóa thành công.');
    }
}
