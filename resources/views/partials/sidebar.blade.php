@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <select class="searchable-field form-control"></select>
            </li>

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('permission_access')
                <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.permissions.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_action_access')
                <li class="{{ $request->segment(2) == 'user_actions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.user_actions.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span class="title">
                                @lang('global.user-actions.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('time_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clock-o"></i>
                    <span class="title">@lang('global.time-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('time_work_type_access')
                <li class="{{ $request->segment(2) == 'time_work_types' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.time_work_types.index') }}">
                            <i class="fa fa-th"></i>
                            <span class="title">
                                @lang('global.time-work-types.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('time_project_access')
                <li class="{{ $request->segment(2) == 'time_projects' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.time_projects.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.time-projects.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('time_entry_access')
                <li class="{{ $request->segment(2) == 'time_entries' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.time_entries.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.time-entries.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('time_report_access')
                <li class="{{ $request->segment(2) == 'time_reports' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.time_reports.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.time-reports.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('expense_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span class="title">@lang('global.expense-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('expense_category_access')
                <li class="{{ $request->segment(2) == 'expense_categories' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.expense_categories.index') }}">
                            <i class="fa fa-list"></i>
                            <span class="title">
                                @lang('global.expense-category.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('income_category_access')
                <li class="{{ $request->segment(2) == 'income_categories' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.income_categories.index') }}">
                            <i class="fa fa-list"></i>
                            <span class="title">
                                @lang('global.income-category.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('income_access')
                <li class="{{ $request->segment(2) == 'incomes' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.incomes.index') }}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span class="title">
                                @lang('global.income.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('expense_access')
                <li class="{{ $request->segment(2) == 'expenses' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.expenses.index') }}">
                            <i class="fa fa-arrow-circle-left"></i>
                            <span class="title">
                                @lang('global.expense.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('monthly_report_access')
                <li class="{{ $request->segment(2) == 'monthly_reports' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.monthly_reports.index') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">
                                @lang('global.monthly-report.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('task_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span class="title">@lang('global.task-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('task_access')
                <li class="{{ $request->segment(2) == 'tasks' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.tasks.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.tasks.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('task_status_access')
                <li class="{{ $request->segment(2) == 'task_statuses' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.task_statuses.index') }}">
                            <i class="fa fa-server"></i>
                            <span class="title">
                                @lang('global.task-statuses.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('task_tag_access')
                <li class="{{ $request->segment(2) == 'task_tags' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.task_tags.index') }}">
                            <i class="fa fa-server"></i>
                            <span class="title">
                                @lang('global.task-tags.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('task_calendar_access')
                <li class="{{ $request->segment(2) == 'task_calendars' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.task_calendars.index') }}">
                            <i class="fa fa-calendar"></i>
                            <span class="title">
                                @lang('global.task-calendar.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('basic_crm_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('global.basic-crm.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('crm_status_access')
                <li class="{{ $request->segment(2) == 'crm_statuses' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.crm_statuses.index') }}">
                            <i class="fa fa-folder"></i>
                            <span class="title">
                                @lang('global.crm-statuses.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('crm_customer_access')
                <li class="{{ $request->segment(2) == 'crm_customers' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.crm_customers.index') }}">
                            <i class="fa fa-user-plus"></i>
                            <span class="title">
                                @lang('global.crm-customers.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('crm_note_access')
                <li class="{{ $request->segment(2) == 'crm_notes' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.crm_notes.index') }}">
                            <i class="fa fa-building-o"></i>
                            <span class="title">
                                @lang('global.crm-notes.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('crm_document_access')
                <li class="{{ $request->segment(2) == 'crm_documents' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.crm_documents.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                @lang('global.crm-documents.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan

            

            
            @php ($unread = App\MessengerTopic::countUnread())
            <li class="{{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
                <a href="{{ route('admin.messenger.index') }}">
                    <i class="fa fa-envelope"></i>

                    <span>Messages</span>
                    @if($unread > 0)
                        {{ ($unread > 0 ? '('.$unread.')' : '') }}
                    @endif
                </a>
            </li>
            <style>
                .page-sidebar-menu .unread * {
                    font-weight:bold !important;
                }
            </style>



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

