<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\InvoiceModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ShopSettingsModel;
use App\Libraries\PdfGenerator;

class InvoiceController extends ResourceController
{
    public function createInvoice()
    {
        $data = $this->request->getJSON(true);

        $customerModel = new CustomerModel();
        $invoiceModel = new InvoiceModel();

        // FIND CUSTOMER
        $customer = $customerModel
            ->where('mobile', $data['mobile'])
            ->first();

        // CREATE CUSTOMER IF NOT EXISTS
        if (!$customer) {

            $customerId = $customerModel->insert([
                'name'   => $data['name'],
                'mobile' => $data['mobile'],
                'email'  => $data['email']
            ]);

        } else {

            $customerId = $customer['id'];
        }

        // CALCULATE TOTALS
        $frameTotal =
            ($data['frame_quantity'] ?? 0)
            *
            ($data['frame_price'] ?? 0);

        $glassTotal =
            ($data['glass_quantity'] ?? 0)
            *
            ($data['glass_price'] ?? 0);

        $totalAmount =
            $frameTotal + $glassTotal;

        $paidAmount =
            $data['paid_amount'] ?? 0;

        $dueAmount =
            $totalAmount - $paidAmount;

        // PAYMENT STATUS
        if ($dueAmount <= 0) {

            $paymentStatus = 'PAID';

        } elseif ($paidAmount > 0) {

            $paymentStatus = 'PARTIAL';

        } else {

            $paymentStatus = 'PENDING';
        }

        // INVOICE NUMBER
        $invoiceNumber =
            'INV-' .
            date('YmdHis');

        // SAVE INVOICE
        $invoiceId =
            $invoiceModel->insert([

                'customer_id' => $customerId,

                'invoice_number' => $invoiceNumber,

                'frame_type' => $data['frame_type'] ?? '',
                'frame_quantity' => $data['frame_quantity'] ?? 0,
                'frame_price' => $data['frame_price'] ?? 0,

                'glass_type' => $data['glass_type'] ?? '',
                'glass_quantity' => $data['glass_quantity'] ?? 0,
                'glass_price' => $data['glass_price'] ?? 0,

                'lens_type' => $data['lens_type'] ?? '',

                'total_amount' => $totalAmount,
                'paid_amount' => $paidAmount,
                'due_amount' => $dueAmount,

                'payment_status' => $paymentStatus,
                'payment_mode' => $data['payment_mode'] ?? 'Cash',

                'right_sph' => $data['right_sph'] ?? '',
                'right_cyl' => $data['right_cyl'] ?? '',
                'right_axis' => $data['right_axis'] ?? '',
                'right_add' => $data['right_add'] ?? '',

                'left_sph' => $data['left_sph'] ?? '',
                'left_cyl' => $data['left_cyl'] ?? '',
                'left_axis' => $data['left_axis'] ?? '',
                'left_add' => $data['left_add'] ?? '',

                'date' => date('Y-m-d')
            ]);

        return $this->respond([
            'success' => true,
            'invoice_id' => $invoiceId,
            'invoice_number' => $invoiceNumber,
            'message' => 'Invoice created successfully'
        ]);
    }

    public function searchCustomer()
    {
        $name = $this->request->getGet('name');
        $mobile = $this->request->getGet('mobile');

        $customerModel = new \App\Models\CustomerModel();

        if (!empty($mobile) && !empty($name))
        {
            $customer = $customerModel
                ->where('mobile', $mobile)
                ->where('name', $name)
                ->first();
        }
        elseif (!empty($mobile))
        {
            $customer = $customerModel
                ->where('mobile', $mobile)
                ->first();
        }
        elseif (!empty($name))
        {
            $customer = $customerModel
                ->where('name', $name)
                ->first();
        }
        else
        {
            return $this->respond([
                'error' => 'Name or Mobile required'
            ], 400);
        }

        if (!$customer)
        {
            return $this->respond([
                'error' => 'Customer not found'
            ], 404);
        }

        return $this->respond([
            'id' => $customer['id'],
            'name' => $customer['name'],
            'mobile' => $customer['mobile'],
            'email' => $customer['email']
        ]);
    }

    public function customerHistory()
    {
        $name = $this->request->getGet('name');
        $mobile = $this->request->getGet('mobile');

        $customerModel = new CustomerModel();
        $invoiceModel = new InvoiceModel();

        // FIND CUSTOMER

        if (!empty($mobile) && !empty($name)) {

            $customer = $customerModel
                ->where('mobile', $mobile)
                ->where('name', $name)
                ->first();

        } elseif (!empty($mobile)) {

            $customer = $customerModel
                ->where('mobile', $mobile)
                ->first();

        } elseif (!empty($name)) {

            $customer = $customerModel
                ->where('name', $name)
                ->first();

        } else {

            return $this->respond([
                'error' => 'Name or mobile required'
            ], 400);
        }

        if (!$customer) {

            return $this->respond([
                'error' => 'Customer not found'
            ], 404);
        }

        // GET ALL INVOICES

        $invoices = $invoiceModel
            ->where('customer_id', $customer['id'])
            ->findAll();

        $history = [];

        foreach ($invoices as $invoice) {

            $history[] = [

                'invoice_id' => $invoice['id'],

                'invoice_number' =>
                    $invoice['invoice_number'],

                'date' =>
                    $invoice['date'],

                'frame_type' =>
                    $invoice['frame_type'],

                'frame_price' =>
                    $invoice['frame_price'],

                'glass_type' =>
                    $invoice['glass_type'],

                'glass_price' =>
                    $invoice['glass_price'],

                'lens_type' =>
                    $invoice['lens_type'],

                'total_amount' =>
                    $invoice['total_amount'],

                'paid_amount' =>
                    $invoice['paid_amount'],

                'due_amount' =>
                    $invoice['due_amount'],

                'payment_mode' =>
                    $invoice['payment_mode'],

                'payment_status' =>
                    $invoice['payment_status'],

                'right_sph' =>
                    $invoice['right_sph'],

                'right_cyl' =>
                    $invoice['right_cyl'],

                'right_axis' =>
                    $invoice['right_axis'],

                'right_add' =>
                    $invoice['right_add'],

                'left_sph' =>
                    $invoice['left_sph'],

                'left_cyl' =>
                    $invoice['left_cyl'],

                'left_axis' =>
                    $invoice['left_axis'],

                'left_add' =>
                    $invoice['left_add']
            ];
        }

        return $this->respond([

            'customer_name' =>
                $customer['name'],

            'customer_mobile' =>
                $customer['mobile'],

            'customer_email' =>
                $customer['email'],

            'history' =>
                $history
        ]);
    }


    public function updatePayment($invoiceId)
    {
        $invoiceModel = new InvoiceModel();

        $invoice = $invoiceModel->find($invoiceId);

        if (!$invoice) {

            return $this->respond([
                'error' => 'Invoice not found'
            ], 404);
        }

        $data = $this->request->getJSON(true);

        $amount = (float)($data['amount'] ?? 0);

        if ($amount <= 0) {

            return $this->respond([
                'error' => 'Invalid amount'
            ], 400);
        }

        $newPaid =
            (float)$invoice['paid_amount']
            + $amount;

        $total =
            (float)$invoice['total_amount'];

        $newDue =
            $total - $newPaid;

        if ($newDue < 0) {
            $newDue = 0;
        }

        if ($newDue == 0) {
            $status = 'PAID';
        }
        elseif ($newPaid > 0) {
            $status = 'PARTIAL';
        }
        else {
            $status = 'PENDING';
        }

        $invoiceModel->update(
            $invoiceId,
            [
                'paid_amount' => $newPaid,
                'due_amount' => $newDue,
                'payment_status' => $status
            ]
        );

        return $this->respond([
            'success' => true,
            'message' => 'Payment updated successfully'
        ]);
    }


    public function downloadInvoice($invoiceId)
    {
        $invoiceModel = new InvoiceModel();
        $customerModel = new CustomerModel();
        $shopModel = new ShopSettingsModel();

        $invoice = $invoiceModel->find($invoiceId);

        if (!$invoice) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'error' => 'Invoice not found'
                ]);
        }

        $customer = $customerModel
            ->find($invoice['customer_id']);

        $shop = $shopModel
            ->first();

        $pdf = new \App\Libraries\PdfGenerator(
            'P',
            'mm',
            'A4',
            true,
            'UTF-8',
            false
        );

        $pdf->SetCreator('Optical Shop');
        $pdf->SetAuthor('Optical Shop');
        $pdf->SetTitle('Invoice');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $pdf->SetFont('dejavusans', '', 10);

        $html = "
        <h1>Invoice</h1>

        <h3>Shop Details</h3>

        <b>{$shop['shop_name']}</b><br>
        {$shop['address']}<br>
        {$shop['phone']}<br>
        {$shop['email']}<br>
        GST: {$shop['gst_number']}<br><br>

        <h3>Customer Details</h3>

        {$customer['name']}<br>
        {$customer['mobile']}<br>
        {$customer['email']}<br><br>

        <h3>Invoice Details</h3>

        Invoice No:
        {$invoice['invoice_number']}<br>

        Date:
        {$invoice['date']}<br>

        Payment Status:
        {$invoice['payment_status']}<br>

        Payment Mode:
        {$invoice['payment_mode']}<br><br>

        <table border='1' cellpadding='5'>

            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>

            <tr>
                <td>{$invoice['frame_type']}</td>
                <td>{$invoice['frame_quantity']}</td>
                <td>{$invoice['frame_price']}</td>
            </tr>

            <tr>
                <td>{$invoice['glass_type']}</td>
                <td>{$invoice['glass_quantity']}</td>
                <td>{$invoice['glass_price']}</td>
            </tr>

        </table>

        <br>

        Total:
        {$invoice['total_amount']}<br>

        Paid:
        {$invoice['paid_amount']}<br>

        Due:
        {$invoice['due_amount']}
        ";

        $pdf->writeHTML($html);

        $pdf->Output(
            'invoice_' . $invoiceId . '.pdf',
            'D'
        );

        exit;
    }

    public function allInvoices()
    {
        $invoiceModel = new InvoiceModel();
        $customerModel = new CustomerModel();

        $invoices =
            $invoiceModel
            ->orderBy(
                'id',
                'DESC'
            )
            ->findAll();

        $data = [];

        foreach ($invoices as $inv) {

            $customer =
                $customerModel
                ->find(
                    $inv['customer_id']
                );

            $data[] = [

                'invoice_id' =>
                    $inv['id'],

                'invoice_number' =>
                    $inv['invoice_number'],

                'customer_name' =>
                    $customer['name'] ?? '',

                'customer_mobile' =>
                    $customer['mobile'] ?? '',

                'date' =>
                    $inv['date'],

                'frame_type' =>
                    $inv['frame_type'],

                'frame_quantity' =>
                    $inv['frame_quantity'],

                'frame_price' =>
                    $inv['frame_price'],

                'glass_type' =>
                    $inv['glass_type'],

                'glass_quantity' =>
                    $inv['glass_quantity'],

                'glass_price' =>
                    $inv['glass_price'],

                'lens_type' =>
                    $inv['lens_type'],

                'total_amount' =>
                    $inv['total_amount'],

                'paid_amount' =>
                    $inv['paid_amount'],

                'due_amount' =>
                    $inv['due_amount'],

                'payment_status' =>
                    $inv['payment_status'],

                'payment_mode' =>
                    $inv['payment_mode'],

                'right_sph' =>
                    $inv['right_sph'],

                'right_cyl' =>
                    $inv['right_cyl'],

                'right_axis' =>
                    $inv['right_axis'],

                'right_add' =>
                    $inv['right_add'],

                'left_sph' =>
                    $inv['left_sph'],

                'left_cyl' =>
                    $inv['left_cyl'],

                'left_axis' =>
                    $inv['left_axis'],

                'left_add' =>
                    $inv['left_add'],

                'created_by' =>
                    $inv['created_by'] ?? 'Unknown'
            ];
        }

        return $this->response
            ->setJSON($data);
    }

    public function deleteInvoice($invoiceId)
    {
        $invoiceModel =
            new InvoiceModel();

        $invoice =
            $invoiceModel->find(
                $invoiceId
            );

        if (!$invoice) {

            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'error' =>
                    'Invoice not found'
                ]);
        }

        $invoiceModel->delete(
            $invoiceId
        );

        return $this->response
            ->setJSON([
                'message' =>
                'Invoice deleted successfully'
            ]);
    }

    public function updateInvoice(
        $invoiceId
    )
    {
        $invoiceModel =
            new InvoiceModel();

        $invoice =
            $invoiceModel->find(
                $invoiceId
            );

        if (!$invoice) {

            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'error' =>
                    'Invoice not found'
                ]);
        }

        $data =
            $this->request
            ->getJSON(true);

        $frameTotal =
            $data['frame_quantity']
            *
            $data['frame_price'];

        $glassTotal =
            $data['glass_quantity']
            *
            $data['glass_price'];

        $totalAmount =
            $frameTotal +
            $glassTotal;

        $paidAmount =
            $invoice['paid_amount'];

        $dueAmount =
            $totalAmount -
            $paidAmount;

        if ($dueAmount <= 0)
        {
            $status = 'PAID';
        }
        elseif ($paidAmount > 0)
        {
            $status = 'PARTIAL';
        }
        else
        {
            $status = 'PENDING';
        }

        $invoiceModel->update(
            $invoiceId,
            [

                'frame_type' =>
                    $data['frame_type'],

                'frame_quantity' =>
                    $data['frame_quantity'],

                'frame_price' =>
                    $data['frame_price'],

                'glass_type' =>
                    $data['glass_type'],

                'glass_quantity' =>
                    $data['glass_quantity'],

                'glass_price' =>
                    $data['glass_price'],

                'lens_type' =>
                    $data['lens_type'],

                'right_sph' =>
                    $data['right_sph'],

                'right_cyl' =>
                    $data['right_cyl'],

                'right_axis' =>
                    $data['right_axis'],

                'right_add' =>
                    $data['right_add'],

                'left_sph' =>
                    $data['left_sph'],

                'left_cyl' =>
                    $data['left_cyl'],

                'left_axis' =>
                    $data['left_axis'],

                'left_add' =>
                    $data['left_add'],

                'total_amount' =>
                    $totalAmount,

                'due_amount' =>
                    $dueAmount,

                'payment_status' =>
                    $status
            ]
        );

        return $this->response
            ->setJSON([
                'message' =>
                'Invoice updated successfully'
            ]);
    }
}