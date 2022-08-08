<!DOCTYPE html>
<html>

<head>
    <title>XM Order</title>
</head>

<body>
    <p>Amount & Currency: {{ number_format((float) $amount, 2, '.', '') . ' ' . $currency }}</p>
</body>

</html>
