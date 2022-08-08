<!DOCTYPE html>
<html>

<head>
    <title>XM Order</title>
</head>

<body>
    <h3>Order Successful</h3>
    <p>Amount & Currency: {{ number_format((float) $amount, 2, '.', '') . ' ' . $currency }}</p>
</body>

</html>
