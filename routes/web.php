<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

Route::group(['middleware' => ['auth', 'approved'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('tasks', 'Admin\TasksController');
    Route::post('tasks_mass_destroy', ['uses' => 'Admin\TasksController@massDestroy', 'as' => 'tasks.mass_destroy']);
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('task_statuses', 'Admin\TaskStatusesController');
    Route::post('task_statuses_mass_destroy', ['uses' => 'Admin\TaskStatusesController@massDestroy', 'as' => 'task_statuses.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('task_tags', 'Admin\TaskTagsController');
    Route::post('task_tags_mass_destroy', ['uses' => 'Admin\TaskTagsController@massDestroy', 'as' => 'task_tags.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('task_calendars', 'Admin\TaskCalendarsController');
    Route::resource('user_actions', 'Admin\UserActionsController');
    Route::resource('crm_statuses', 'Admin\CrmStatusesController');
    Route::post('crm_statuses_mass_destroy', ['uses' => 'Admin\CrmStatusesController@massDestroy', 'as' => 'crm_statuses.mass_destroy']);
    Route::resource('crm_customers', 'Admin\CrmCustomersController');
    Route::post('crm_customers_mass_destroy', ['uses' => 'Admin\CrmCustomersController@massDestroy', 'as' => 'crm_customers.mass_destroy']);
    Route::resource('crm_notes', 'Admin\CrmNotesController');
    Route::post('crm_notes_mass_destroy', ['uses' => 'Admin\CrmNotesController@massDestroy', 'as' => 'crm_notes.mass_destroy']);
    Route::resource('crm_documents', 'Admin\CrmDocumentsController');
    Route::post('crm_documents_mass_destroy', ['uses' => 'Admin\CrmDocumentsController@massDestroy', 'as' => 'crm_documents.mass_destroy']);
    Route::resource('time_work_types', 'Admin\TimeWorkTypesController');
    Route::post('time_work_types_mass_destroy', ['uses' => 'Admin\TimeWorkTypesController@massDestroy', 'as' => 'time_work_types.mass_destroy']);
    Route::resource('time_projects', 'Admin\TimeProjectsController');
    Route::post('time_projects_mass_destroy', ['uses' => 'Admin\TimeProjectsController@massDestroy', 'as' => 'time_projects.mass_destroy']);
    Route::resource('time_entries', 'Admin\TimeEntriesController');
    Route::post('time_entries_mass_destroy', ['uses' => 'Admin\TimeEntriesController@massDestroy', 'as' => 'time_entries.mass_destroy']);
    Route::resource('time_reports', 'Admin\TimeReportsController');
    Route::resource('expense_categories', 'Admin\ExpenseCategoriesController');
    Route::post('expense_categories_mass_destroy', ['uses' => 'Admin\ExpenseCategoriesController@massDestroy', 'as' => 'expense_categories.mass_destroy']);
    Route::resource('income_categories', 'Admin\IncomeCategoriesController');
    Route::post('income_categories_mass_destroy', ['uses' => 'Admin\IncomeCategoriesController@massDestroy', 'as' => 'income_categories.mass_destroy']);
    Route::resource('incomes', 'Admin\IncomesController');
    Route::post('incomes_mass_destroy', ['uses' => 'Admin\IncomesController@massDestroy', 'as' => 'incomes.mass_destroy']);
    Route::resource('expenses', 'Admin\ExpensesController');
    Route::post('expenses_mass_destroy', ['uses' => 'Admin\ExpensesController@massDestroy', 'as' => 'expenses.mass_destroy']);
    Route::resource('monthly_reports', 'Admin\MonthlyReportsController');
    Route::get('internal_notifications/read', 'Admin\InternalNotificationsController@read');
    Route::resource('internal_notifications', 'Admin\InternalNotificationsController');
    Route::post('internal_notifications_mass_destroy', ['uses' => 'Admin\InternalNotificationsController@massDestroy', 'as' => 'internal_notifications.mass_destroy']);

    Route::model('messenger', 'App\MessengerTopic');
    Route::get('messenger/inbox', 'Admin\MessengerController@inbox')->name('messenger.inbox');
    Route::get('messenger/outbox', 'Admin\MessengerController@outbox')->name('messenger.outbox');
    Route::resource('messenger', 'Admin\MessengerController');

    Route::post('csv_parse', 'Admin\CsvImportController@parse')->name('csv_parse');
    Route::post('csv_process', 'Admin\CsvImportController@process')->name('csv_process');

    Route::get('search', 'MegaSearchController@search')->name('mega-search');
    Route::get('language/{lang}', function ($lang) {
        return redirect()->back()->withCookie(cookie()->forever('language', $lang));
    })->name('language');});
