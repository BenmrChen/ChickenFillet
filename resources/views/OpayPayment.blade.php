<!DOCTYPE html>
<html>
<head>
    <title>OpayPayment Exercise</title>
    <meta charset="UTF-8">
</head>
<body>
<form method="POST" action="/api/pay">
    @csrf
    <input type="checkbox" value="1" name="order_id[]">
    <input type="checkbox" value="2" name="order_id[]">
    <input type="checkbox" value="3" name="order_id[]">
    <input type="hidden" value="https://64b30ea0.ngrok.io/" name="ClintBackURL">
    <button type="submit">Submit</button>
</form>
</body>
</html>
