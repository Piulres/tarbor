@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.crm-statuses.title')</h3>
    @can('crm_status_create')
    <p>
        <a href="{{ route('admin.crm_statuses.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'CrmStatus'])
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($crm_statuses) > 0 ? 'datatable' : '' }} @can('crm_status_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('crm_status_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.crm-statuses.fields.title')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($crm_statuses) > 0)
                        @foreach ($crm_statuses as $crm_status)
                            <tr data-entry-id="{{ $crm_status->id }}">
                                @can('crm_status_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $crm_status->title }}</td>
                                                                <td>
                                    @can('crm_status_view')
                                    <a href="{{ route('admin.crm_statuses.show',[$crm_status->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('crm_status_edit')
                                    <a href="{{ route('admin.crm_statuses.edit',[$crm_status->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('crm_status_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.crm_statuses.destroy', $crm_status->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('crm_status_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.crm_statuses.mass_destroy') }}';
        @endcan

    </script>
@endsection