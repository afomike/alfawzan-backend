<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt - <?php echo e($receiptNumber); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .receipt-info {
            margin-bottom: 30px;
        }
        .receipt-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .receipt-info td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .receipt-info td:first-child {
            font-weight: bold;
            width: 40%;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature img {
            max-width: 200px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Alfawzan Driving School Ltd.</h1>
        <p style="margin: 5px 0; font-size: 14px; color: #666;">Driving Knowledge, Building Confidence & Ensuring Safety.</p>
        <h2>Payment Receipt</h2>
    </div>

    <div class="receipt-info">
        <table>
            <tr>
                <td>Receipt Number:</td>
                <td><?php echo e($receiptNumber); ?></td>
            </tr>
            <tr>
                <td>Payment Reference:</td>
                <td><?php echo e($payment->payment_reference); ?></td>
            </tr>
            <tr>
                <td>Customer Name:</td>
                <td><?php echo e($payment->user->name); ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo e($payment->user->email); ?></td>
            </tr>
            <tr>
                <td>Payment Method:</td>
                <td><?php echo e(ucfirst($payment->payment_method)); ?></td>
            </tr>
            <tr>
                <td>Date:</td>
                <td><?php echo e($payment->created_at->format('F d, Y H:i:s')); ?></td>
            </tr>
            <?php if($payment->description): ?>
            <tr>
                <td>Description:</td>
                <td><?php echo e($payment->description); ?></td>
            </tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="amount">
        Amount Paid: ₦<?php echo e(number_format($payment->amount, 2)); ?>

    </div>

    <div class="signature">
        <?php if($signaturePath && file_exists(storage_path('app/public/' . $signaturePath))): ?>
        <div>
            <img src="<?php echo e(storage_path('app/public/' . $signaturePath)); ?>" alt="Digital Signature">
            <p>Digital Signature</p>
        </div>
        <?php else: ?>
        <div>
            <p>Digital Signature</p>
            <p>Verified</p>
        </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>This is a computer-generated receipt. No signature is required.</p>
        <p>Thank you for your payment!</p>
        <p style="margin-top: 20px; font-size: 10px; color: #999;">
            Built by <a href="https://abdulrazaqoladimeji.vercel.app/" style="color: #666;">Olademeji Abulrazaq</a>
        </p>
    </div>
</body>
</html>

<?php /**PATH /Users/macintosh/Documents/Projects/alfawzan/alfawzan-backend/resources/views/receipts/pdf.blade.php ENDPATH**/ ?>