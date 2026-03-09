<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleRedirectMiddleware;
use App\Models\Reservation;

///////////////////////// imports for logistics Module  ///////////////////////////
use App\Livewire\HomePage;
use App\Livewire\RoomSearch;
use App\Livewire\LoginUser;
use App\Livewire\AuthRegister;
use App\Livewire\Logistics\Fleet;
use App\Livewire\Logistics\Reports;
use App\Livewire\Logistics\FleetItems;
use App\Livewire\General\HotelSections;
use App\Livewire\Logistics\ActivityLog;
use App\Livewire\Logistics\ReportHistory;
use App\Livewire\General\GeneralDashboard;
use App\Livewire\Logistics\MessageHistory;
use App\Livewire\Logistics\SystemMessages;
use App\Livewire\Logistics\LogisticsExpenseCategory;
use App\Livewire\Logistics\LogisticsExpenseItem;
use App\Livewire\Logistics\LogisticsMakeExpense;
use App\Livewire\Logistics\LogisticsIncomeCategory;
use App\Livewire\Logistics\LogisticsIncomeItem;
use App\Livewire\Logistics\LogisticsRecordIncome;
///////////////////////// imports for general Manager Module  ///////////////////////////
use App\Livewire\General\SystemRoles;
use App\Livewire\General\DirectorDashboard;
use App\Livewire\General\ReservationCalendar;
use App\Livewire\General\CreateuserAccount;
use App\Livewire\General\BankDetail;
use App\Livewire\General\GeneralExpenseCategory;
use App\Livewire\General\GeneralExpenseItem;
use App\Livewire\General\GeneralMakeExpense;
use App\Livewire\General\GeneralIncomeCategory;
use App\Livewire\General\GeneralIncomeItem;
use App\Livewire\General\GeneralRecordIncome;
use App\Livewire\General\GenerateReports;

///////////////////////// imports for Auth Module  ///////////////////////////

///////////////////////////////////////solo work //////////////////////////////////////////////////
use App\Livewire\Maintenance\MainDashboard;
use App\Livewire\Maintenance\History;
use App\Livewire\Maintenance\AssetCat;
use App\Livewire\Maintenance\Schedules;
use App\Livewire\Maintenance\Inventories;
use App\Livewire\Maintenance\Technician;
use App\Livewire\Maintenance\MaintenanceReport;
use App\Livewire\Maintenance\AssetManager;
use App\Livewire\Maintenance\InventoryCat;
use App\Livewire\Maintenance\RequestMaintenance;
use App\Livewire\Housekeeping\RoomStatus;
use App\Livewire\Housekeeping\HouseDashboard;
use App\Livewire\Housekeeping\HouseReports;
use App\Livewire\Housekeeping\CleaningSchedule;
use App\Livewire\Housekeeping\HouseKeepingTask;
use App\Livewire\Housekeeping\LaundryRequest;
use App\Livewire\Housekeeping\HouseSystemMessages;
use App\Livewire\Housekeeping\HouseInventoryCats;
use App\Livewire\Housekeeping\HouseInventories;
use App\Livewire\Fnb\Dashboard; 
use App\Livewire\Fnb\Menu;
use App\Livewire\Fnb\Order;
use App\Livewire\Fnb\FnbReports;
use App\Livewire\Fnb\OrderItem;
use App\Livewire\Fnb\FnbExpenseCategory;
use App\Livewire\Fnb\FnbExpenseItem;
use App\Livewire\Fnb\FnbMakeExpense;


use App\Livewire\Fnb\KitchenStoreCategory;
use App\Livewire\Fnb\KitchenStoreItem;
use App\Livewire\Fnb\KitchenManageStore;
use App\Livewire\Fnb\FnbIncomeCategory;
use App\Livewire\Fnb\FnbIncomeItem;
use App\Livewire\Fnb\FnbRecordIncome;
use App\Livewire\Fnb\Supplier;
use App\Livewire\Fnb\FnbReportHistory;
use App\Livewire\Fnb\FbnSystemMessages;
use App\Livewire\Fnb\FinventoryCat;
use App\Livewire\Fnb\Finventories;
use App\Livewire\Sales\SalesDashboard;
use App\Livewire\Sales\SalesReports;
use App\Livewire\Sales\Coupon;
use App\Livewire\Sales\Campaign;
//////////////////////////////////////end solo work ///////////////////////////////////////////////




///// Reservation Module  ///////////////////////////
use App\Livewire\Reservations\ReservationsExpenseCategory;
use App\Livewire\Reservations\ReservationsExpenseItem;
use App\Livewire\Reservations\ReservationsMakeExpense;
use App\Livewire\Reservations\ReservationsIncomeCategory;
use App\Livewire\Reservations\ReservationsIncomeItem;
use App\Livewire\Reservations\ReservationsRecordIncome;
use App\Livewire\Reservations\CreateRooms;
use App\Livewire\Reservations\Reservations;
use App\Livewire\Reservations\SearchReservations;
use App\Livewire\Reservations\ReservedRooms;
use App\Livewire\Reservations\AvailableRooms;
use App\Livewire\Reservations\CheckedoutRooms;
use App\Livewire\Reservations\HomeCreateRooms;
use App\Livewire\Reservations\DueRooms;
use App\Livewire\Reservations\ReservationFeeds;
use App\Livewire\Reservations\ReservationsDashboard;
use App\Livewire\Reservations\CreateReservation;
use App\Livewire\Reservations\UpdateReservation;
use App\Livewire\Reservations\CreateRoomCategory;
use App\Livewire\Reservations\CheckoutReservation;
use App\Livewire\CreateBooking;
use App\Livewire\UpdateBooking;
use App\Livewire\CheckoutBooking;
use App\Livewire\Reservations\CreateRoomAllocation;
use App\Livewire\Reservations\HomeCreateRoomCategory;
use App\Livewire\Reservations\HomeCreateRoomAllocation;
use App\Http\Controllers\PaymentController; //handle Payment API(paystack)
use App\Livewire\LogoutButton;
use App\Livewire\Reservations\RoomSwap;
use App\Livewire\Reservations\ViewReceipt;

// for guest List- i dont want a class for now
Route::get('/reservations/checkedout/print', function () {
    $period = request()->query('period', 'All Time');
    $reservations = json_decode(request()->query('reservations', '[]'), true);
    $reservations = collect($reservations)->map(function ($reservation) {
        return (object) $reservation;
    });

    return view('livewire.reservations.print-checkedout', compact('period', 'reservations'));
})->name('reservations.checkedout.print');

// For Reports


///////////////////////// Acesss Control ///////////////////////////
Route::get('/auth-register', AuthRegister::class);
route::get('/login-user', LoginUser::class)->name('login-user');
route::get('/logout-button', LogoutButton::class)->name('logout-button');


///////////////////////// RESERVATIONS-ONLINE ///////////////////////////
    Route::get('/', RoomSearch::class)->name('room-search');

    Route::get('/create-booking/{category_id}/{nor}/{checkin}/{checkout}', CreateBooking::class)->name('create-booking');
    Route::get('/checkout-booking/{reservation_id}', CheckoutBooking::class)->name('checkout-booking');
    Route::get('/update-booking/{reservation_id}', UpdateBooking::class)->name('update-booking');



// RESERVATIONS MODULE ROUTES (FD Role)
Route::middleware(['auth', 'role.redirect'])->prefix('reservations')->group(function () {
    Route::get('/reservations', Reservations::class)->name('reservations');
    Route::get('/create-reservation/{category_id}/{nor}/{checkin}/{checkout}', CreateReservation::class)->name('create-reservation');
    Route::get('/checkout-reservation/{reservation_id}', CheckoutReservation::class)->name('checkout-reservation');
    Route::get('/update-reservation/{reservation_id}', UpdateReservation::class)->name('update-reservation');
    Route::get('/create-rooms', CreateRooms::class)->name('create-rooms');
    Route::get('/home-create-rooms', HomeCreateRooms::class)->name('home-create-rooms');
    Route::get('/create-room-allocation', CreateRoomAllocation::class)->name('create-room-allocation');
    Route::get('/home-create-room-allocation', HomeCreateRoomAllocation::class)->name('home-create-room-allocation');
    Route::get('/create-room-category', CreateRoomCategory::class)->name('home-room-category');
    Route::get('/home-create-room-category', HomeCreateRoomCategory::class)->name('home-create-room-category');
    Route::get('/available-rooms', AvailableRooms::class)->name('available-rooms');
    Route::get('/reserved-rooms', ReservedRooms::class)->name('reserved-rooms');
    Route::get('/due-rooms', DueRooms::class)->name('due-rooms');
    Route::get('/checkedout-rooms', CheckedoutRooms::class)->name('checkedout-rooms');
    Route::get('/room-swap', RoomSwap::class)->name('room-swap')->name('room-swap');
    Route::get('/reservation-feeds', ReservationFeeds::class)->name('reservation-feeds');
    Route::get('/reservations-dashboard', ReservationsDashboard::class)->name('reservations-dashboard');
    Route::get('/view-receipt/{reservation_id}', ViewReceipt::class)->name('view-receipt');
    
    Route::get('/reservations-expense-item', ReservationsExpenseItem::class)->name('reservations-expense-item');
    Route::get('/reservations-expense-category', ReservationsExpenseCategory::class)->name('reservations-expense-category');
    Route::get('/reservations-make-expense', ReservationsMakeExpense::class)->name('reservations-make-expense');
    Route::get('/reservations-income-item', ReservationsIncomeItem::class)->name('reservations-income-item');
    Route::get('/reservations-income-category', ReservationsIncomeCategory::class)->name('reservations-income-category');
    Route::get('/reservations-record-income', ReservationsRecordIncome::class)->name('reservations-record-income');
    

});

// LOGISTICS MODULE ROUTES (LG Role)
Route::middleware(['auth', 'role.redirect'])->prefix('logistics')->group(function () {
    Route::get('/activity-log', ActivityLog::class)->name('activity-log');
    Route::get('/fleet', Fleet::class)->name('fleet');
    Route::get('/fleet-items', FleetItems::class)->name('fleet-items');
    Route::get('/reports', Reports::class)->name('reports');
    Route::get('/report-history', ReportHistory::class)->name('report-history');
    Route::get('/message-history', MessageHistory::class)->name('message-history');
    Route::get('/system-messages', SystemMessages::class)->name('system-messages');
    
    
    
    Route::get('/logistics-expense-item', LogisticsExpenseItem::class)->name('logistics-expense-item');
Route::get('/logistics-expense-category', LogisticsExpenseCategory::class)->name('logistics-expense-category');
Route::get('/logistics-make-expense', LogisticsMakeExpense::class)->name('logistics-make-expense');
Route::get('/logistics-income-item', LogisticsIncomeItem::class)->name('logistics-income-item');
Route::get('/logistics-income-category', LogisticsIncomeCategory::class)->name('logistics-income-category');
Route::get('/logistics-record-income', LogisticsRecordIncome::class)->name('logistics-record-income');
});

// GENERAL MANAGER MODULE ROUTES (GM Role)
Route::middleware(['auth', 'role.redirect'])->prefix('general')->group(function () {
    Route::get('/general-dashboard', GeneralDashboard::class)->name('general-dashboard');
    Route::get('/director-dashboard', DirectorDashboard::class)->name('director-dashboard');
    Route::get('/createuser-account', CreateuserAccount::class)->name('createuser-account');
    Route::get('/system_roles', SystemRoles::class)->name('system_roles');
    Route::get('/hotel_sections', HotelSections::class)->name('hotel_sections');
    Route::get('/bank-detail', BankDetail::class)->name('bank-detail');
    Route::get('/general-expense-item', GeneralExpenseItem::class)->name('general-expense-item');
    Route::get('/general-expense-category', GeneralExpenseCategory::class)->name('general-expense-category');
    Route::get('/general-make-expense', GeneralMakeExpense::class)->name('general-make-expense');
    Route::get('/general-income-item', GeneralIncomeItem::class)->name('general-income-item');
    Route::get('/general-income-category', GeneralIncomeCategory::class)->name('general-income-category');
    Route::get('/general-record-income', GeneralRecordIncome::class)->name('general-record-income');
    Route::get('/generate-reports', GenerateReports::class)->name('generate-reports');
    Route::get('/reservation-calendar', ReservationCalendar::class)->name('reservation-calendar');
    
    Route::get('/report-preview', function () {
    return view('livewire.general.report-preview');
            })->name('report-preview');
    Route::get('/report-preview', function () {
    return view('livewire.general.report-preview');
            })->name('report-preview');

    Route::get('/occupancy-list', function () {
    return view('livewire.general.occupancy-list');
            })->name('occupancy-list');



});





// Routes for paystack Payments

//Route::get('/pay_later/{amount}/{reference}', [PaymentController::class,'pay_later'])->name('pay_later'); // reference-reservation ID

Route::get('/pay/{amount}/{email}/{reference}', [PaymentController::class, 'pay'])->name('pay'); // reference-reservation ID


Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('reservations.comfirm');
// http://reservations.vinehousegroup.com/comfirm


/////////////////////////////////// Housekeeping
Route::middleware(['auth', 'role.redirect'])->prefix('housekeeping')->group(function () {
    Route::get('/house-dashboard', HouseDashboard::class)->name('house-dashboard');
    Route::get('/room-status', RoomStatus::class)->name('room-status');
    Route::get('/cleaning-schedules', CleaningSchedule::class)->name('cleaning-schedules');
    Route::get('/laundry-request', LaundryRequest::class)->name('laundry-request');
    Route::get('/house-reports', HouseReports::class)->name('house-reports');
    Route::get('/house-keeping-task', HouseKeepingTask::class)->name('house-keeping-task');
    Route::get('/house-system-messages', HouseSystemMessages::class)->name('house-system-messages');
    Route::get('/house-inventory-cats', HouseInventoryCats::class)->name('house-inventory-cats');
    Route::get('/house-inventories', HouseInventories::class)->name('house-inventories');
});


/////////////////////////////////// Sales
Route::middleware(['auth', 'role.redirect'])->prefix('sales')->group(function () {
Route::get('/coupon', Coupon::class)->name('coupon');
Route::get('/campaign', Campaign::class)->name('campaign');
Route::get('/sales-dashboard', SalesDashboard::class)->name('sales-dashboard');
    Route::get('/sales-reports', SalesReports::class)->name('sales-reports');
});



/////////////////////////////////// Food and Beverage
Route::middleware(['auth', 'role.redirect'])->prefix('fnb')->group(function () {
Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/menu', Menu::class)->name('menu');
Route::get('/order', Order::class)->name('order');
Route::get('/supplier', Supplier::class)->name('supplier');
Route::get('/order-item', OrderItem::class)->name('order-item');
Route::get('/fnb-expense-item', FnbExpenseItem::class)->name('fnb-expense-item');
Route::get('/fnb-expense-category', FnbExpenseCategory::class)->name('fnb-expense-category');
Route::get('/fnb-make-expense', FnbMakeExpense::class)->name('fnb-make-expense');


Route::get('/kitchen-store-item', KitchenStoreItem::class)->name('kitchen-store-item');
Route::get('/kitchen-store-category', KitchenStoreCategory::class)->name('kitchen-store-category');
Route::get('/kitchen-manage-store', KitchenManageStore::class)->name('kitchen-manage-store');

Route::get('/fnb-income-item', FnbIncomeItem::class)->name('fnb-income-item');
Route::get('/fnb-income-category', FnbIncomeCategory::class)->name('fnb-income-category');
Route::get('/fnb-record-income', FnbRecordIncome::class)->name('fnb-record-income');
Route::get('/finventory-cat', FinventoryCat::class)->name('finventory-cat');
Route::get('/finventories', Finventories::class)->name('finventories');

    Route::get('/fnb-reports', FnbReports::class)->name('fnb-reports');
    Route::get('/fnb-report-history', FnbReportHistory::class)->name('fnb-report-history');
    Route::get('/fnb-system-messages', FbnSystemMessages::class)->name('fnb-system-messages');
});



/////////////////////////////////// Maintenance
Route::middleware(['auth', 'role.redirect'])->prefix('maintenance')->group(function () {
Route::get('/main-dashboard', MainDashboard::class)->name('main-dashboard');
Route::get('/asset', AssetManager::class)->name('asset');
Route::get('/asset-cat', AssetCat::class)->name('asset-cat');
Route::get('/inventories', Inventories::class)->name('inventories');
Route::get('/inventory-cat', InventoryCat::class)->name('inventory-cat');
Route::get('/schedules', Schedules::class)->name('schedules');
Route::get('/history', History::class)->name('history');
Route::get('/request-maintenance', RequestMaintenance::class)->name('request-maintenance');
Route::get('/technician', Technician::class)->name('technician');
    route::get('/maintenance-report', MaintenanceReport::class)->name('maintenance-report');
});



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
