<?php

namespace App\Http\Controllers\Admin;

use App\TimeProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimeProjectsRequest;
use App\Http\Requests\Admin\UpdateTimeProjectsRequest;

class TimeProjectsController extends Controller
{
    /**
     * Display a listing of TimeProject.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


                $time_projects = TimeProject::all();

        return view('admin.time_projects.index', compact('time_projects'));
    }

    /**
     * Show the form for creating new TimeProject.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.time_projects.create');
    }

    /**
     * Store a newly created TimeProject in storage.
     *
     * @param  \App\Http\Requests\StoreTimeProjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeProjectsRequest $request)
    {
        $time_project = TimeProject::create($request->all());



        return redirect()->route('admin.time_projects.index');
    }


    /**
     * Show the form for editing TimeProject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $time_project = TimeProject::findOrFail($id);

        return view('admin.time_projects.edit', compact('time_project'));
    }

    /**
     * Update TimeProject in storage.
     *
     * @param  \App\Http\Requests\UpdateTimeProjectsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeProjectsRequest $request, $id)
    {
        $time_project = TimeProject::findOrFail($id);
        $time_project->update($request->all());



        return redirect()->route('admin.time_projects.index');
    }


    /**
     * Display TimeProject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $time_entries = \App\TimeEntry::where('project_id', $id)->get();

        $time_project = TimeProject::findOrFail($id);

        return view('admin.time_projects.show', compact('time_project', 'time_entries'));
    }


    /**
     * Remove TimeProject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $time_project = TimeProject::findOrFail($id);
        $time_project->delete();

        return redirect()->route('admin.time_projects.index');
    }

    /**
     * Delete all selected TimeProject at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = TimeProject::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
