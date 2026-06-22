<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\InvoiceModel;
use App\Models\CustomerModel;

class DashboardController extends ResourceController
{
    public function index()
    {
        $invoiceModel = new InvoiceModel();
        $customerModel = new CustomerModel();

        $totalSales = $invoiceModel
            ->selectSum('total_amount')
            ->first();

        $todaySales = $invoiceModel
            ->selectSum('total_amount')
            ->where('DATE(created_at)', date('Y-m-d'))
            ->first();

        return $this->respond([
            'total_sales' =>
                $totalSales['total_amount'] ?? 0,

            'total_invoices' =>
                $invoiceModel->countAll(),

            'total_customers' =>
                $customerModel->countAll(),

            'today_sales' =>
                $todaySales['total_amount'] ?? 0,
        ]);
    }
}