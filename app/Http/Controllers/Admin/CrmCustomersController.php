<?php

namespace App\Http\Controllers\Admin;

use App\CrmCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCrmCustomersRequest;
use App\Http\Requests\Admin\UpdateCrmCustomersRequest;

class CrmCustomersController extends Controller
{
    /**
     * Display a listing of CrmCustomer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


                $crm_customers = CrmCustomer::all();

        return view('admin.crm_customers.index', compact('crm_customers'));
    }

    /**
     * Show the form for creating new CrmCustomer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $crm_statuses = \App\CrmStatus::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.crm_customers.create', compact('crm_statuses'));
    }

    /**
     * Store a newly created CrmCustomer in storage.
     *
     * @param  \App\Http\Requests\StoreCrmCustomersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCrmCustomersRequest $request)
    {
        $crm_customer = CrmCustomer::create($request->all());



        return redirect()->route('admin.crm_customers.index');
    }


    /**
     * Show the form for editing CrmCustomer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $crm_statuses = \App\CrmStatus::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $crm_customer = CrmCustomer::findOrFail($id);

        return view('admin.crm_customers.edit', compact('crm_customer', 'crm_statuses'));
    }

    /**
     * Update CrmCustomer in storage.
     *
     * @param  \App\Http\Requests\UpdateCrmCustomersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCrmCustomersRequest $request, $id)
    {
        $crm_customer = CrmCustomer::findOrFail($id);
        $crm_customer->update($request->all());



        return redirect()->route('admin.crm_customers.index');
    }


    /**
     * Display CrmCustomer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $crm_statuses = \App\CrmStatus::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');$crm_notes = \App\CrmNote::where('customer_id', $id)->get();$crm_documents = \App\CrmDocument::where('customer_id', $id)->get();

        $crm_customer = CrmCustomer::findOrFail($id);

        return view('admin.crm_customers.show', compact('crm_customer', 'crm_notes', 'crm_documents'));
    }


    /**
     * Remove CrmCustomer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crm_customer = CrmCustomer::findOrFail($id);
        $crm_customer->delete();

        return redirect()->route('admin.crm_customers.index');
    }

    /**
     * Delete all selected CrmCustomer at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = CrmCustomer::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
