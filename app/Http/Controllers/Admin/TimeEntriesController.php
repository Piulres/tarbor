<?php

namespace App\Http\Controllers\Admin;

use App\TimeEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimeEntriesRequest;
use App\Http\Requests\Admin\UpdateTimeEntriesRequest;

class TimeEntriesController extends Controller
{
    /**
     * Display a listing of TimeEntry.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


                $time_entries = TimeEntry::all();

        return view('admin.time_entries.index', compact('time_entries'));
    }

    /**
     * Show the form for creating new TimeEntry.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $work_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.time_entries.create', compact('work_types', 'projects'));
    }

    /**
     * Store a newly created TimeEntry in storage.
     *
     * @param  \App\Http\Requests\StoreTimeEntriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeEntriesRequest $request)
    {
        $time_entry = TimeEntry::create($request->all());



        return redirect()->route('admin.time_entries.index');
    }


    /**
     * Show the form for editing TimeEntry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $work_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $time_entry = TimeEntry::findOrFail($id);

        return view('admin.time_entries.edit', compact('time_entry', 'work_types', 'projects'));
    }

    /**
     * Update TimeEntry in storage.
     *
     * @param  \App\Http\Requests\UpdateTimeEntriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeEntriesRequest $request, $id)
    {
        $time_entry = TimeEntry::findOrFail($id);
        $time_entry->update($request->all());



        return redirect()->route('admin.time_entries.index');
    }


    /**
     * Display TimeEntry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $time_entry = TimeEntry::findOrFail($id);

        return view('admin.time_entries.show', compact('time_entry'));
    }


    /**
     * Remove TimeEntry from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $time_entry = TimeEntry::findOrFail($id);
        $time_entry->delete();

        return redirect()->route('admin.time_entries.index');
    }

    /**
     * Delete all selected TimeEntry at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = TimeEntry::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
