<?php

namespace App\Http\Controllers\Admin;

use App\CrmNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCrmNotesRequest;
use App\Http\Requests\Admin\UpdateCrmNotesRequest;

class CrmNotesController extends Controller
{
    /**
     * Display a listing of CrmNote.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


                $crm_notes = CrmNote::all();

        return view('admin.crm_notes.index', compact('crm_notes'));
    }

    /**
     * Show the form for creating new CrmNote.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $customers = \App\CrmCustomer::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.crm_notes.create', compact('customers'));
    }

    /**
     * Store a newly created CrmNote in storage.
     *
     * @param  \App\Http\Requests\StoreCrmNotesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCrmNotesRequest $request)
    {
        $crm_note = CrmNote::create($request->all());



        return redirect()->route('admin.crm_notes.index');
    }


    /**
     * Show the form for editing CrmNote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $customers = \App\CrmCustomer::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');

        $crm_note = CrmNote::findOrFail($id);

        return view('admin.crm_notes.edit', compact('crm_note', 'customers'));
    }

    /**
     * Update CrmNote in storage.
     *
     * @param  \App\Http\Requests\UpdateCrmNotesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCrmNotesRequest $request, $id)
    {
        $crm_note = CrmNote::findOrFail($id);
        $crm_note->update($request->all());



        return redirect()->route('admin.crm_notes.index');
    }


    /**
     * Display CrmNote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crm_note = CrmNote::findOrFail($id);

        return view('admin.crm_notes.show', compact('crm_note'));
    }


    /**
     * Remove CrmNote from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crm_note = CrmNote::findOrFail($id);
        $crm_note->delete();

        return redirect()->route('admin.crm_notes.index');
    }

    /**
     * Delete all selected CrmNote at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = CrmNote::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
