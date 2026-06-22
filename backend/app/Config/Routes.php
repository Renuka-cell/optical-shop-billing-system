<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\StaffController;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
#$routes->get('test-db','Test::index');
$routes->options('api/login', static function () {
    return service('response');
});

$routes->post('api/login', 'AuthController::login');
$routes->get(
    'api/admin-dashboard',
    'DashboardController::index'
);

$routes->options(
    'api/create-invoice',
    static function () {
        return service('response');
    }
);

$routes->post(
    'api/create-invoice',
    'InvoiceController::createInvoice'
);

$routes->get(
    'api/search-customer',
    'InvoiceController::searchCustomer'
);

$routes->get(
    'api/customer-history',
    'InvoiceController::customerHistory'
);

$routes->options(
    'api/update-payment/(:num)',
    static function () {
        return service('response');
    }
);

$routes->put(
    'api/update-payment/(:num)',
    'InvoiceController::updatePayment/$1'
);

$routes->options(
    'api/download-invoice/(:num)',
    static function () {
        return service('response');
    }
);

$routes->get(
    'api/download-invoice/(:num)',
    'InvoiceController::downloadInvoice/$1'
);

$routes->options(
    'api/create-staff',
    static function () {
        return service('response');
    }
); 

$routes->post(
    'api/create-staff',
    'StaffController::createStaff'
);

$routes->get(
    'api/staff-list',
    'StaffController::getStaffList'
);

$routes->options(
    'api/delete-staff/(:num)',
    static function () {
        return service('response');
    }
);

$routes->delete(
    'api/delete-staff/(:num)',
    'StaffController::deleteStaff/$1'
);

$routes->options(
    'api/update-staff/(:num)',
    static function () {
        return service('response');
    }
);

$routes->put(
    'api/update-staff/(:num)',
    'StaffController::updateStaff/$1'
);

$routes->options(
    'api/reset-staff-password/(:num)',
    static function () {
        return service('response');
    }
);

$routes->put(
    'api/reset-staff-password/(:num)',
    'StaffController::resetPassword/$1'
);

$routes->get(
    'api/all-invoices',
    'InvoiceController::allInvoices'
);

$routes->options(
    'api/update-invoice/(:num)',
    static function () {
        return service('response');
    }
);

$routes->put(
    'api/update-invoice/(:num)',
    'InvoiceController::updateInvoice/$1'
);

$routes->options(
    'api/delete-invoice/(:num)',
    static function () {
        return service('response');
    }
);

$routes->delete(
    'api/delete-invoice/(:num)',
    'InvoiceController::deleteInvoice/$1'
);

$routes->get(
    'api/shop-settings',
    'ShopSettingsController::getShopSettings'
);

$routes->options(
    'api/shop-settings',
    static function () {
        return service('response');
    }
);

$routes->put(
    'api/shop-settings',
    'ShopSettingsController::saveShopSettings'
);