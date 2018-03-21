@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.crm-customers.title')</h3>
    @can('crm_customer_create')
    <p>
        <a href="{{ route('admin.crm_customers.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'CrmCustomer'])
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($crm_customers) > 0 ? 'datatable' : '' }} @can('crm_customer_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('crm_customer_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

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
                                @can('crm_customer_delete')
                                    <td></td>
                                @endcan

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
                                    @can('crm_customer_view')
                                    <a href="{{ route('admin.crm_customers.show',[$crm_customer->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('crm_customer_edit')
                                    <a href="{{ route('admin.crm_customers.edit',[$crm_customer->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('crm_customer_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.crm_customers.destroy', $crm_customer->id])) !!}
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
@stop

@section('javascript') 
    <script>
        @can('crm_customer_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.crm_customers.mass_destroy') }}';
        @endcan

    </script>
@endsection