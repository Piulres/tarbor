@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.crm-notes.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.crm-notes.fields.customer')</th>
                            <td field-key='customer'>{{ $crm_note->customer->first_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.crm-notes.fields.note')</th>
                            <td field-key='note'>{!! $crm_note->note !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.crm_notes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
