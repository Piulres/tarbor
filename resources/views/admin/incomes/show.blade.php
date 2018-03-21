@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.income.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.income.fields.income-category')</th>
                            <td field-key='income_category'>{{ $income->income_category->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.income.fields.entry-date')</th>
                            <td field-key='entry_date'>{{ $income->entry_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.income.fields.amount')</th>
                            <td field-key='amount'>{{ $income->amount }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.incomes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
