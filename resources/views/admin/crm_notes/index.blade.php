@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.crm-notes.title')</h3>
    @can('crm_note_create')
    <p>
        <a href="{{ route('admin.crm_notes.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'CrmNote'])
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($crm_notes) > 0 ? 'datatable' : '' }} @can('crm_note_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('crm_note_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.crm-notes.fields.customer')</th>
                        <th>@lang('global.crm-notes.fields.note')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($crm_notes) > 0)
                        @foreach ($crm_notes as $crm_note)
                            <tr data-entry-id="{{ $crm_note->id }}">
                                @can('crm_note_delete')
                                    <td></td>
                                @endcan

                                <td field-key='customer'>{{ $crm_note->customer->first_name or '' }}</td>
                                <td field-key='note'>{!! $crm_note->note !!}</td>
                                                                <td>
                                    @can('crm_note_view')
                                    <a href="{{ route('admin.crm_notes.show',[$crm_note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('crm_note_edit')
                                    <a href="{{ route('admin.crm_notes.edit',[$crm_note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('crm_note_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.crm_notes.destroy', $crm_note->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('crm_note_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.crm_notes.mass_destroy') }}';
        @endcan

    </script>
@endsection