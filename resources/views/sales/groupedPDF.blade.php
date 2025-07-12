<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sales Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .receipt-title {
            font-size: 18px;
            color: #666;
        }
        
        .sale-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        
        .sale-info-left,
        .sale-info-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        
        .sale-info-right {
            text-align: right;
        }
        
        .info-label {
            font-weight: bold;
            color: #666;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        
        .items-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        .items-table .text-right {
            text-align: right;
        }
        
        .items-table .text-center {
            text-align: center;
        }
        
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        
        .total-row {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .total-label,
        .total-value {
            display: table-cell;
            padding: 5px 10px;
        }
        
        .total-label {
            text-align: right;
            font-weight: bold;
            width: 80%;
        }
        
        .total-value {
            text-align: right;
            width: 20%;
        }
        
        .grand-total {
            border-top: 2px solid #333;
            font-size: 18px;
            font-weight: bold;
        }
        
        .notes-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
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
        <div class="company-name">XI-TEK</div>
        <div class="receipt-title">SALES RECEIPT</div>
    </div>

    <div class="sale-info">
        <div class="sale-info-left">
            <div><span class="info-label">Receipt Code:</span> {{ substr($session_id, -8) }}</div>
            <div><span class="info-label">Date:</span> {{ $sale_date ? $sale_date->format('M j, Y g:i A') : 'N/A' }}</div>
            @if($customer_name)
                <div><span class="info-label">Customer:</span> {{ $customer_name }}</div>
            @endif
            @if($customer_phone)
                <div><span class="info-label">Phone:</span> {{ $customer_phone }}</div>
            @endif
        </div>
        <div class="sale-info-right">
            <div><span class="info-label">Status:</span> COMPLETED</div>
            <div><span class="info-label">Payment Method:</span> Cash</div>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 40%;">Product</th>
                <th style="width: 15%;" class="text-center">Qty</th>
                <th style="width: 20%;" class="text-right">Unit Price</th>
                <th style="width: 25%;" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>
                    <strong>{{ $item->product->name }}</strong>
                    @if($item->product->category)
                        <br><small style="color: #666;">{{ $item->product->category }}</small>
                    @endif
                </td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">Frw {{ number_format($item->unit_price, 2) }}</td>
                <td class="text-right">Frw {{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">
            <div class="total-label">Subtotal:</div>
            <div class="total-value">Frw {{ number_format($total, 2) }}</div>
        </div>
        <div class="total-row">
            <div class="total-label">Tax (0%):</div>
            <div class="total-value">Frw 0.00</div>
        </div>
        <div class="total-row grand-total">
            <div class="total-label">TOTAL:</div>
            <div class="total-value">Frw {{ number_format($total, 2) }}</div>
        </div>
    </div>

  

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>Generated on {{ now()->format('M j, Y g:i A') }}</p>
    </div>
</body>
</html>