@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.time-entries.title')</h3>
    @can('time_entry_create')
    <p>
        <a href="{{ route('admin.time_entries.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'TimeEntry'])
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($time_entries) > 0 ? 'datatable' : '' }} @can('time_entry_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('time_entry_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.time-entries.fields.work-type')</th>
                        <th>@lang('global.time-entries.fields.project')</th>
                        <th>@lang('global.time-entries.fields.start-time')</th>
                        <th>@lang('global.time-entries.fields.end-time')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($time_entries) > 0)
                        @foreach ($time_entries as $time_entry)
                            <tr data-entry-id="{{ $time_entry->id }}">
                                @can('time_entry_delete')
                                    <td></td>
                                @endcan

                                <td field-key='work_type'>{{ $time_entry->work_type->name or '' }}</td>
                                <td field-key='project'>{{ $time_entry->project->name or '' }}</td>
                                <td field-key='start_time'>{{ $time_entry->start_time }}</td>
                                <td field-key='end_time'>{{ $time_entry->end_time }}</td>
                                                                <td>
                                    @can('time_entry_view')
                                    <a href="{{ route('admin.time_entries.show',[$time_entry->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('time_entry_edit')
                                    <a href="{{ route('admin.time_entries.edit',[$time_entry->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('time_entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.time_entries.destroy', $time_entry->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('time_entry_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.time_entries.mass_destroy') }}';
        @endcan

    </script>
@endsection