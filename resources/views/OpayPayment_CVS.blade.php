<!DOCTYPE html>
<html>
<head>
    <title>OpayPayment Exercise</title>
    <meta charset="UTF-8">
</head>
<body>
<form method="POST" action="/api/pay_CVS">
    @csrf
    <h1>CVS Payment</h1>
    <p>店舖名:
        <select name="shop_name" id="">
            <option value="TW_No_1">台灣第一家雞排</option>
            <option value="World_No_1">世界第一家雞排</option>
        </select>
    </p>
    <p>雞排種類:
        <select name="product_name" id="">
            <option name="chrispy" value="脆皮雞排">脆皮雞排</option>
            <option name="traditional" value="傳統雞排">傳統雞排</option>
        </select>
    </p>
    <p>數量:
        <select name="qty" id="">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </p>
    <input type="hidden" value="http://547776ad.ngrok.io" name="ClintBackURL">
    <button type="submit">Submit</button>
</form>
</body>
</html>
