@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.crm-statuses.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.crm-statuses.fields.title')</th>
                            <td field-key='title'>{{ $crm_status->title }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#crmcustomers" aria-controls="crmcustomers" role="tab" data-toggle="tab">Clientes</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="crmcustomers">
<table class="table table-bordered table-striped {{ count($crm_customers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.crm-customers.fields.first-name')</th>
                        <th>@lang('global.crm-customers.fields.last-name')</th>
                        <th>@lang('global.crm-customers.fields.crm-status')</th>
                        <th>@lang('global.crm-customers.fields.email')</th>
                        <th>@lang('global.crm-customers.fields.phone')</th>
                        <th>@lang('global.crm-customers.fields.address')</th>
                        <th>@lang('global.crm-customers.fields.skype')</th>
                        <th>@lang('global.crm-customers.fields.website')</th>
                        <th>@lang('global.crm-customers.fields.description')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($crm_customers) > 0)
            @foreach ($crm_customers as $crm_customer)
                <tr data-entry-id="{{ $crm_customer->id }}">
                    <td field-key='first_name'>{{ $crm_customer->first_name }}</td>
                                <td field-key='last_name'>{{ $crm_customer->last_name }}</td>
                                <td field-key='crm_status'>{{ $crm_customer->crm_status->title or '' }}</td>
                                <td field-key='email'>{{ $crm_customer->email }}</td>
                                <td field-key='phone'>{{ $crm_customer->phone }}</td>
                                <td field-key='address'>{{ $crm_customer->address }}</td>
                                <td field-key='skype'>{{ $crm_customer->skype }}</td>
                                <td field-key='website'>{{ $crm_customer->website }}</td>
                                <td field-key='description'>{!! $crm_customer->description !!}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('crm_customers.show',[$crm_customer->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('crm_customers.edit',[$crm_customer->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['crm_customers.destroy', $crm_customer->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.crm_statuses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
