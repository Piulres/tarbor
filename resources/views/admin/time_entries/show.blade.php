@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.time-entries.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.time-entries.fields.work-type')</th>
                            <td field-key='work_type'>{{ $time_entry->work_type->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.time-entries.fields.project')</th>
                            <td field-key='project'>{{ $time_entry->project->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.time-entries.fields.start-time')</th>
                            <td field-key='start_time'>{{ $time_entry->start_time }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.time-entries.fields.end-time')</th>
                            <td field-key='end_time'>{{ $time_entry->end_time }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.time_entries.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
