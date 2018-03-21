@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.approved')</th>
                            <td field-key='approved'>{{ Form::checkbox("approved", 1, $user->approved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#useractions" aria-controls="useractions" role="tab" data-toggle="tab">Ações do usuário</a></li>
<li role="presentation" class=""><a href="#internalnotifications" aria-controls="internalnotifications" role="tab" data-toggle="tab">Notifications</a></li>
<li role="presentation" class=""><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">Tarefas</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="useractions">
<table class="table table-bordered table-striped {{ count($user_actions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.user-actions.created_at')</th>
                        <th>@lang('global.user-actions.fields.user')</th>
                        <th>@lang('global.user-actions.fields.action')</th>
                        <th>@lang('global.user-actions.fields.action-model')</th>
                        <th>@lang('global.user-actions.fields.action-id')</th>
                        
        </tr>
    </thead>

    <tbody>
        @if (count($user_actions) > 0)
            @foreach ($user_actions as $user_action)
                <tr data-entry-id="{{ $user_action->id }}">
                    <td>{{ $user_action->created_at or '' }}</td>
                                <td field-key='user'>{{ $user_action->user->name or '' }}</td>
                                <td field-key='action'>{{ $user_action->action }}</td>
                                <td field-key='action_model'>{{ $user_action->action_model }}</td>
                                <td field-key='action_id'>{{ $user_action->action_id }}</td>
                                
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="internalnotifications">
<table class="table table-bordered table-striped {{ count($internal_notifications) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.internal-notifications.fields.text')</th>
                        <th>@lang('global.internal-notifications.fields.link')</th>
                        <th>@lang('global.internal-notifications.fields.users')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($internal_notifications) > 0)
            @foreach ($internal_notifications as $internal_notification)
                <tr data-entry-id="{{ $internal_notification->id }}">
                    <td field-key='text'>{{ $internal_notification->text }}</td>
                                <td field-key='link'>{{ $internal_notification->link }}</td>
                                <td field-key='users'>
                                    @foreach ($internal_notification->users as $singleUsers)
                                        <span class="label label-info label-many">{{ $singleUsers->name }}</span>
                                    @endforeach
                                </td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('internal_notifications.show',[$internal_notification->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('internal_notifications.edit',[$internal_notification->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['internal_notifications.destroy', $internal_notification->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="tasks">
<table class="table table-bordered table-striped {{ count($tasks) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.tasks.fields.name')</th>
                        <th>@lang('global.tasks.fields.description')</th>
                        <th>@lang('global.tasks.fields.status')</th>
                        <th>@lang('global.tasks.fields.tag')</th>
                        <th>@lang('global.tasks.fields.attachment')</th>
                        <th>@lang('global.tasks.fields.due-date')</th>
                        <th>@lang('global.tasks.fields.user')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
                <tr data-entry-id="{{ $task->id }}">
                    <td field-key='name'>{{ $task->name }}</td>
                                <td field-key='description'>{!! $task->description !!}</td>
                                <td field-key='status'>{{ $task->status->name or '' }}</td>
                                <td field-key='tag'>
                                    @foreach ($task->tag as $singleTag)
                                        <span class="label label-info label-many">{{ $singleTag->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='attachment'>@if($task->attachment)<a href="{{ asset(env('UPLOAD_PATH').'/' . $task->attachment) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='due_date'>{{ $task->due_date }}</td>
                                <td field-key='user'>{{ $task->user->name or '' }}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('tasks.show',[$task->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('tasks.edit',[$task->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['tasks.destroy', $task->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
