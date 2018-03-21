@extends('layouts.app')

@section('content')
    <div class="row">
         <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added tasks</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.tasks.fields.name')</th> 
                            <th> @lang('global.tasks.fields.description')</th> 
                            <th> @lang('global.tasks.fields.due-date')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($tasks as $task)
                            <tr>
                               
                                <td>{{ $task->name }} </td> 
                                <td>{{ $task->description }} </td> 
                                <td>{{ $task->due_date }} </td> 
                                <td>

                                    @can('task_view')
                                    <a href="{{ route('admin.tasks.show',[$task->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('task_edit')
                                    <a href="{{ route('admin.tasks.edit',[$task->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('task_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tasks.destroy', $task->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added users</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.users.fields.name')</th> 
                            <th> @lang('global.users.fields.email')</th> 
                            <th> @lang('global.users.fields.approved')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tr>
                               
                                <td>{{ $user->name }} </td> 
                                <td>{{ $user->email }} </td> 
                                <td>{{ $user->approved }} </td> 
                                <td>

                                    @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('user_edit')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('user_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added incomes</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.income.fields.entry-date')</th> 
                            <th> @lang('global.income.fields.amount')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($incomes as $income)
                            <tr>
                               
                                <td>{{ $income->entry_date }} </td> 
                                <td>{{ $income->amount }} </td> 
                                <td>

                                    @can('income_view')
                                    <a href="{{ route('admin.incomes.show',[$income->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('income_edit')
                                    <a href="{{ route('admin.incomes.edit',[$income->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('income_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.incomes.destroy', $income->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added expenses</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.expense.fields.entry-date')</th> 
                            <th> @lang('global.expense.fields.amount')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($expenses as $expense)
                            <tr>
                               
                                <td>{{ $expense->entry_date }} </td> 
                                <td>{{ $expense->amount }} </td> 
                                <td>

                                    @can('expense_view')
                                    <a href="{{ route('admin.expenses.show',[$expense->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('expense_edit')
                                    <a href="{{ route('admin.expenses.edit',[$expense->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('expense_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.expenses.destroy', $expense->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added timeentries</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.time-entries.fields.start-time')</th> 
                            <th> @lang('global.time-entries.fields.end-time')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($timeentries as $timeentry)
                            <tr>
                               
                                <td>{{ $timeentry->start_time }} </td> 
                                <td>{{ $timeentry->end_time }} </td> 
                                <td>

                                    @can('time_entry_view')
                                    <a href="{{ route('admin.time_entries.show',[$timeentry->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('time_entry_edit')
                                    <a href="{{ route('admin.time_entries.edit',[$timeentry->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('time_entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.time_entries.destroy', $timeentry->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>


    </div>
@endsection

