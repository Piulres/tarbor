<?php

namespace App\Http\Controllers\Admin;

use App\CrmStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCrmStatusesRequest;
use App\Http\Requests\Admin\UpdateCrmStatusesRequest;

class CrmStatusesController extends Controller
{
    /**
     * Display a listing of CrmStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


                $crm_statuses = CrmStatus::all();

        return view('admin.crm_statuses.index', compact('crm_statuses'));
    }

    /**
     * Show the form for creating new CrmStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crm_statuses.create');
    }

    /**
     * Store a newly created CrmStatus in storage.
     *
     * @param  \App\Http\Requests\StoreCrmStatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCrmStatusesRequest $request)
    {
        $crm_status = CrmStatus::create($request->all());



        return redirect()->route('admin.crm_statuses.index');
    }


    /**
     * Show the form for editing CrmStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $crm_status = CrmStatus::findOrFail($id);

        return view('admin.crm_statuses.edit', compact('crm_status'));
    }

    /**
     * Update CrmStatus in storage.
     *
     * @param  \App\Http\Requests\UpdateCrmStatusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCrmStatusesRequest $request, $id)
    {
        $crm_status = CrmStatus::findOrFail($id);
        $crm_status->update($request->all());



        return redirect()->route('admin.crm_statuses.index');
    }


    /**
     * Display CrmStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crm_customers = \App\CrmCustomer::where('crm_status_id', $id)->get();

        $crm_status = CrmStatus::findOrFail($id);

        return view('admin.crm_statuses.show', compact('crm_status', 'crm_customers'));
    }


    /**
     * Remove CrmStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crm_status = CrmStatus::findOrFail($id);
        $crm_status->delete();

        return redirect()->route('admin.crm_statuses.index');
    }

    /**
     * Delete all selected CrmStatus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = CrmStatus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
