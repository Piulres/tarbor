@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.expense.title')</h3>
    @can('expense_create')
    <p>
        <a href="{{ route('admin.expenses.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'Expense'])
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($expenses) > 0 ? 'datatable' : '' }} @can('expense_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('expense_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.expense.fields.expense-category')</th>
                        <th>@lang('global.expense.fields.entry-date')</th>
                        <th>@lang('global.expense.fields.amount')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($expenses) > 0)
                        @foreach ($expenses as $expense)
                            <tr data-entry-id="{{ $expense->id }}">
                                @can('expense_delete')
                                    <td></td>
                                @endcan

                                <td field-key='expense_category'>{{ $expense->expense_category->name or '' }}</td>
                                <td field-key='entry_date'>{{ $expense->entry_date }}</td>
                                <td field-key='amount'>{{ $expense->amount }}</td>
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
                    @else
                        <tr>
                            <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('expense_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.expenses.mass_destroy') }}';
        @endcan

    </script>
@endsection