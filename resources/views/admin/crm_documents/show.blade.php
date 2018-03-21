@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.crm-documents.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.crm-documents.fields.customer')</th>
                            <td field-key='customer'>{{ $crm_document->customer->first_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.crm-documents.fields.name')</th>
                            <td field-key='name'>{{ $crm_document->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.crm-documents.fields.description')</th>
                            <td field-key='description'>{!! $crm_document->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.crm-documents.fields.file')</th>
                            <td field-key='file'>@if($crm_document->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $crm_document->file) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.crm_documents.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
