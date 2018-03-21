<?php

namespace App\Http\Controllers\Admin;

use App\CrmDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCrmDocumentsRequest;
use App\Http\Requests\Admin\UpdateCrmDocumentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class CrmDocumentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of CrmDocument.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


                $crm_documents = CrmDocument::all();

        return view('admin.crm_documents.index', compact('crm_documents'));
    }

    /**
     * Show the form for creating new CrmDocument.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $customers = \App\CrmCustomer::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.crm_documents.create', compact('customers'));
    }

    /**
     * Store a newly created CrmDocument in storage.
     *
     * @param  \App\Http\Requests\StoreCrmDocumentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCrmDocumentsRequest $request)
    {
        $request = $this->saveFiles($request);
        $crm_document = CrmDocument::create($request->all());



        return redirect()->route('admin.crm_documents.index');
    }


    /**
     * Show the form for editing CrmDocument.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $customers = \App\CrmCustomer::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');

        $crm_document = CrmDocument::findOrFail($id);

        return view('admin.crm_documents.edit', compact('crm_document', 'customers'));
    }

    /**
     * Update CrmDocument in storage.
     *
     * @param  \App\Http\Requests\UpdateCrmDocumentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCrmDocumentsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $crm_document = CrmDocument::findOrFail($id);
        $crm_document->update($request->all());



        return redirect()->route('admin.crm_documents.index');
    }


    /**
     * Display CrmDocument.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crm_document = CrmDocument::findOrFail($id);

        return view('admin.crm_documents.show', compact('crm_document'));
    }


    /**
     * Remove CrmDocument from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crm_document = CrmDocument::findOrFail($id);
        $crm_document->delete();

        return redirect()->route('admin.crm_documents.index');
    }

    /**
     * Delete all selected CrmDocument at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = CrmDocument::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
