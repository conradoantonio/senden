<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Guest - Login
Route::get('/', function () {
    return redirect('login');
});

Route::post('/test/done', 'HomeController@done');

$router->get('logout', 'Auth\LoginController@logout');

$router->group(['prefix' => 'admin', 'middleware' => 'auth'], function ($router) { 
	// Admin
	$router->get('/', 'HomeController@dashboard');
	$router->get('/profile', 'HomeController@profile');

	// Senden Admin & BusinessAdmin
	$router->group(['middleware' => 'role:SendenAdmin,Administrador'], function ($router) {
		//Messages
		$router->get('mensajes','MessagesController@index');
		$router->post('mensajes/store','MessagesController@store');
		$router->post('mensajes/status','MessagesController@status');

		// Users with SendenAdmin privilege
		$router->get('users/senden', 'UsersController@admin_users');
		$router->post('users/save_super_user', 'UsersController@store_superuser');
		$router->post('users/edit_super_user', 'UsersController@update_superuser');
		$router->post('users/ban_admin', 'UsersController@ban_admin');

		// Users with AdminBussiness Privileges
		$router->get('users/business', 'UsersController@business_users');
		$router->post('users/save_business_user', 'UsersController@store_businessuser');
		$router->post('users/edit_business_user', 'UsersController@update_businessuser');
		$router->post('users/ban_business_user', 'UsersController@ban_business_user');

		// User types
		$router->get('user-types', 'UsersController@types');
		// Vechicles
		$router->get('vehicles', function () {
			return ['vehicles' => \App\Vehicle::all()];
		});

		//Ordenes finalizadas
		$router->get('orders-done', 'DoneOrdersController@index');
		$router->post('orders-done/reload_table', 'DoneOrdersController@reloadDoneOrdersTable');
		$router->get('orders-done/export/{business_id?}/{sendenboy_id?}/{start_date?}/{end_date?}/{is_paid_business?}/{is_paid_sendenboy?}', 'DoneOrdersController@export');
		$router->get('orders-done/show/{id}', 'DoneOrdersController@show');

		//Incidencias
		$router->get('incidencias', 'IncidencesController@index');
		$router->post('incidencias/store', 'IncidencesController@store');
		$router->post('incidencias/update', 'IncidencesController@update');
		$router->get('incidencias/show/{id}', 'IncidencesController@show');
	});

	// Senden Admin
	$router->group(['middleware' => 'role:SendenAdmin'], function ($router) {
		//Information enterprise
		$router->get('senden/information', 'HomeController@info_enterprise');
		$router->post('senden/information/store', 'HomeController@save_info_enterprise');
		$router->post('senden/information/update', 'HomeController@update_info_enterprise');

		//Sendenboys
		$router->get('sendenboys', 'SendenboysController@index');
		$router->post('sendenboys/store', 'SendenboysController@store');
		$router->post('sendenboys/update', 'SendenboysController@update');
		$router->post('sendenboys/change_status', 'SendenboysController@change_status');
		$router->get('sendenboys/form_sendenboy/{sendenboy_id?}', 'SendenboysController@form');

		//Sendenboys
		$router->get('users/sendenshop', 'UsersController@users_sendenshop');
		$router->post('users/sendenshop/change_status', 'UsersController@change_status');

		// Faqs
		$router->get('faqs', 'FaqsController@index');
		$router->post('faqs', 'FaqsController@store');
		$router->post('faqs/delete-multiple', 'FaqsController@deleteSelections');
		$router->post('faqs/{faq}', 'FaqsController@update');
		$router->delete('faqs/{faq}', 'FaqsController@destroy');

		// Approve products
		$router->get('products/approve', 'ProductsController@approveProducts');
		$router->post('products/validate/{product}', 'ProductsController@validateProduct');

		// Businesses
		$router->get('businesses', 'BusinessesController@index');
		$router->get('businesses/create', 'BusinessesController@create');
		$router->get('businessesData', 'BusinessesController@indexData');
		$router->get('businesses/edit/{id}', 'BusinessesController@edit');
		$router->post('businesses/status', 'BusinessesController@status');
		$router->post('businesses/store', 'BusinessesController@store');
		$router->post('businesses/update', 'BusinessesController@update');
		$router->post('businesses/delete-multiple', 'BusinessesController@deleteSelections');
		$router->post('businesses/{business}', 'BusinessesController@update');
		$router->delete('businesses/{business}', 'BusinessesController@destroy');

		// Businesses
		$router->get('businesses', 'BusinessesController@index');
		$router->get('businessesData', 'BusinessesController@indexData');
		$router->post('businesses', 'BusinessesController@store');
		$router->post('businesses/delete-multiple', 'BusinessesController@deleteSelections');
		$router->post('businesses/{business}', 'BusinessesController@update');
		$router->delete('businesses/{business}', 'BusinessesController@destroy');

		// Categories
		$router->get('categories', function () {
			return ['categories' => \App\Category::all()];
		});

		//Pagos a negocios
		$router->get('pagar/negocios', 'PagosController@pagar_negocios');
		$router->get('pagar/negocios/historial', 'PagosController@historial_pago_negocios');
		$router->post('pagar/negocios/filter', 'PagosController@filter_business_order');
		$router->post('pagar/negocios/mark_as_paid', 'PagosController@mark_as_paid');
		$router->post('pagar/negocios/source', 'PagosController@source');
		
		//Pagos a sendenboys
		$router->get('pagar/sendenboys', 'PagosController@pagar_sendenboys');
		$router->get('pagar/sendenboys/historial', 'PagosController@historial_pago_sendenboys');
		$router->post('pagar/sendenboys/filter', 'PagosController@filter_sendenboy_order');
		$router->post('pagar/sendenboys/mark_as_paid', 'PagosController@mark_as_paid_sendenboy_orders');
		$router->post('pagar/sendenboys/source', 'PagosController@source_orders_sendenboy');

		// Notifications
		$router->group(['prefix' => 'notificaciones_app'], function ($router) {
			$router->get('/', 'NotificationsController@index');
			$router->post('/enviar/general', 'NotificationsController@enviar_notificacion_general');
			$router->post('/enviar/individual', 'NotificationsController@enviar_notificacion_individual');
		});
	});

	// Business Admin
	$router->group(['middleware' => 'role:Administrador'], function ($router) {
		// Users with AdminBussiness and Salesman Privileges
		$router->get('users/mybusiness', 'UsersController@my_users_as_admin_business');
		$router->post('users/mybusiness/change', 'UsersController@change_is_open');
		$router->post('users/mybusiness/save_user', 'UsersController@mybusiness_save');
		$router->post('users/mybusiness/edit_user', 'UsersController@mybusiness_edit');
		$router->post('users/mybusiness/ban_user', 'UsersController@mybusiness_ban');
		
		// Products
		$router->get('products', 'ProductsController@index');
		$router->post('products', 'ProductsController@store');
		$router->post('products/delete-multiple', 'ProductsController@deleteSelections');
		$router->post('products/{product}', 'ProductsController@update');
		$router->delete('products/{product}', 'ProductsController@destroy');
		$router->get('products/export/excel', 'ProductsController@exportProducts');
		$router->get('products/download/template', 'ProductsController@downloadTemplate');
		$router->post('products/import/excel', 'ProductsController@importProducts');

		// Upload images by dropzone
		$router->get('/cargar_imagenes', 'ImageController@index');
		$router->post('/subir_imagenes', 'ImageController@subir_imagenes');

		// Business Holidays
		$router->get('business-holidays', 'BusinessHolidaysController@index');
		$router->post('business-holidays', 'BusinessHolidaysController@store');
		$router->post('business-holidays/delete-multiple', 'BusinessHolidaysController@deleteSelections');
		$router->post('business-holidays/{holiday}', 'BusinessHolidaysController@update');
		$router->delete('business-holidays/{holiday}', 'BusinessHolidaysController@destroy');

		// Business Service Date
		$router->get('business-service-date', 'businessDatesController@index');
		$router->post('business-service-date', 'businessDatesController@store');
		$router->post('business-service-date/delete-multiple', 'businessDatesController@deleteSelections');
		$router->post('business-service-date/{businessDate}', 'businessDatesController@update');
		$router->delete('business-service-date/{businessDate}', 'businessDatesController@destroy');

		// Solutions
		$router->get('solutions', 'SolutionsController@index');
		$router->post('solutions', 'SolutionsController@store');
		$router->post('solutions/delete-multiple', 'SolutionsController@deleteSelections');
		$router->post('solutions/{solution}', 'SolutionsController@update');
		$router->delete('solutions/{solution}', 'SolutionsController@destroy');

		// My earnings ($)
		$router->get('my_earnings', 'PagosController@my_earnings');
		$router->post('my_earnings/order/details', 'PagosController@order_details');
		$router->post('my_earnings/export', 'PagosController@export_orders');

		//Edit my info
		$router->post('my_info/edit', 'UsersController@edit_business_user_info');
	});


	// Senden Admin & BusinessAdmin & BusinessSeller
	$router->group(['middleware' => 'role:SendenAdmin,Administrador,Vendedor'], function ($router) {
		// Orders
		$router->get('orders', 'OrdersController@index');
		$router->get('getOrderDetails', 'OrdersController@getOrderDetails');
		$router->post('orders/reload_table', 'OrdersController@reloadOrdersTable');
		$router->post('orders/cancel_order', 'OrdersController@cancelOrder');

		$router->get('liberarOrdenes/{order_id?}', 'LiberarPedidosController@index');
		$router->get('getOrderDetailsFree', 'LiberarPedidosController@getOrderDetails');
	});
});


Auth::routes();

Route::get('/home', 'HomeController@index');
