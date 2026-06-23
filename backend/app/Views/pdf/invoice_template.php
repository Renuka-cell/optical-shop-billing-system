<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

body{
    font-family: sans-serif;
    font-size:11px;
    color:#333;
}

.header{
    background:#071D39;
    color:white;
    padding:20px;
}

.header-table{
    width:100%;
}

.shop-name{
    font-size:26px;
    font-weight:bold;
    color:white;
}

.shop-type{
    color:#18B7D9;
    font-weight:bold;
    font-size:10px;
}

.shop-details{
    color:#E2E8F0;
    font-size:12px;
    line-height:1.5;
}

.invoice-title{
    font-size:34px;
    font-weight:bold;
    text-align:right;
    color:white;
}

.invoice-number{
    color:#18B7D9;
    text-align:right;
    font-weight:bold;
}

.invoice-date{
    text-align:right;
    color:white;
}

.blue-strip{
    height:12px;
    background:#18B7D9;
}

.section-title{
    color:#18B7D9;
    font-weight:bold;
    margin-top:18px;
    margin-bottom:8px;
}

.info-table{
    width:100%;
    margin-top:15px;
}

.info-table td{
    border:none;
    vertical-align:top;
}

.label{
    color:#18B7D9;
    font-size:10px;
    font-weight:bold;
}

.customer-name{
    font-size:18px;
    font-weight:bold;
}

.line{
    border-bottom:1px solid #BFEAF4;
    margin-top:15px;
    margin-bottom:15px;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table th{
    background:#1D3C67;
    color:white;
    padding:8px;
    text-align:center;
    border:1px solid #CDECF4;
}

.table td{
    padding:8px;
    border:1px solid #CDECF4;
}

.light-row{
    background:#F8FCFD;
}

.lens-box{
    background:#E8F8FC;
    padding:10px;
}

.eye-col{
    background:#18B7D9;
    color:white;
    font-weight:bold;
    text-align:center;
}

.summary{
    width:45%;
    margin-left:auto;
    margin-top:20px;
}

.summary td{
    border:none;
    padding:4px;
}

.summary-value{
    text-align:right;
    font-weight:bold;
}

.grand-total{
    background:#071D39;
    color:white;
    padding:10px;
}

.grand-total td{
    border:none;
}

.grand-value{
    color:#18B7D9;
    font-weight:bold;
    text-align:right;
}

.terms{
    margin-top:25px;
    color:#666;
    font-size:10px;
}

</style>
</head>

<body>

<!-- HEADER -->

<div class="header">

<table class="header-table">

<tr>

<td width="60%">

<div class="shop-name">
<?= esc($shop['shop_name'] ?? 'Optical Shop') ?>
</div>

<div class="shop-type">
OPTICALS
</div>

<br>

<div class="shop-details">

<?= esc($shop['address'] ?? '') ?><br>
Phone: <?= esc($shop['phone'] ?? '') ?><br>
Email: <?= esc($shop['email'] ?? '') ?><br>
GST: <?= esc($shop['gst_number'] ?? '') ?>

</div>

</td>

<td width="40%" align="right">

<div class="invoice-title">
INVOICE
</div>

<div class="invoice-number">
<?= esc($invoice['invoice_number']) ?>
</div>

<div style="height:8px;"></div>

<div class="invoice-date">
Date : <?= esc($invoice['date']) ?>
</div>

</td>

</tr>

</table>

</div>

<div class="blue-strip"></div>

<!-- CUSTOMER -->

<table class="info-table">

<tr>

<td width="65%">

<div class="label">BILL TO</div>

<div class="customer-name">
<?= esc($customer['name']) ?>
</div>

<?= esc($customer['mobile']) ?><br>
<?= esc($customer['email']) ?>

</td>

<td width="35%">

<div class="label">PAYMENT STATUS</div>

<b><?= esc($invoice['payment_status']) ?></b>

<br><br>

<div class="label">PAYMENT MODE</div>

<b><?= esc($invoice['payment_mode']) ?></b>

</td>

</tr>

</table>

<div class="line"></div>

<!-- FRAME -->

<div class="section-title">
FRAME DETAILS
</div>

<table class="table">

<tr>
<th>Frame Type</th>
<th>Quantity</th>
<th>Price</th>
<th>Total</th>
</tr>

<tr class="light-row">

<td><?= esc($invoice['frame_type'] ?: '--') ?></td>

<td align="center">
<?= esc($invoice['frame_quantity']) ?>
</td>

<td align="right">
Rs. <?= number_format($invoice['frame_price'],2) ?>
</td>

<td align="right">
Rs. <?= number_format($frameTotal,2) ?>
</td>

</tr>

</table>

<br>

<!-- GLASS -->

<div class="section-title">
GLASS DETAILS
</div>

<table class="table">

<tr>
<th>Glass Type</th>
<th>Quantity</th>
<th>Price</th>
<th>Total</th>
</tr>

<tr class="light-row">

<td><?= esc($invoice['glass_type'] ?: '--') ?></td>

<td align="center">
<?= esc($invoice['glass_quantity']) ?>
</td>

<td align="right">
Rs. <?= number_format($invoice['glass_price'],2) ?>
</td>

<td align="right">
Rs. <?= number_format($glassTotal,2) ?>
</td>

</tr>

</table>

<br>

<!-- LENS -->

<div class="section-title">
LENS TYPE
</div>

<div class="lens-box">
<?= esc($invoice['lens_type'] ?: '--') ?>
</div>

<br>

<!-- PRESCRIPTION -->

<div class="section-title">
EYE PRESCRIPTION
</div>

<table class="table">

<tr>
<th>EYE</th>
<th>SPH</th>
<th>CYL</th>
<th>AXIS</th>
<th>ADD</th>
</tr>

<tr>

<td class="eye-col">RE</td>

<td><?= esc($invoice['right_sph'] ?: '--') ?></td>
<td><?= esc($invoice['right_cyl'] ?: '--') ?></td>
<td><?= esc($invoice['right_axis'] ?: '--') ?></td>
<td><?= esc($invoice['right_add'] ?: '--') ?></td>

</tr>

<tr>

<td class="eye-col">LE</td>

<td><?= esc($invoice['left_sph'] ?: '--') ?></td>
<td><?= esc($invoice['left_cyl'] ?: '--') ?></td>
<td><?= esc($invoice['left_axis'] ?: '--') ?></td>
<td><?= esc($invoice['left_add'] ?: '--') ?></td>

</tr>

</table>

<!-- TOTALS -->

<table class="summary">

<tr>
<td>Subtotal</td>
<td class="summary-value">
Rs. <?= number_format($invoice['total_amount'],2) ?>
</td>
</tr>

<tr>
<td>Paid</td>
<td class="summary-value">
Rs. <?= number_format($invoice['paid_amount'],2) ?>
</td>
</tr>

<tr>
<td>Balance Due</td>
<td class="summary-value">
Rs. <?= number_format($invoice['due_amount'],2) ?>
</td>
</tr>

<tr class="grand-total">

<td>
<b>GRAND TOTAL</b>
</td>

<td class="grand-value">
Rs. <?= number_format($invoice['total_amount'],2) ?>
</td>

</tr>

</table>

<!-- TERMS -->

<div class="terms">

• Goods once sold will not be exchanged.<br>
• Please keep invoice for warranty purpose.<br>
• Lens warranty covers manufacturing defects only.<br>
• Thank you for choosing
<?= esc($shop['shop_name'] ?? 'Optical Shop') ?>.

</div>

</body>
</html>