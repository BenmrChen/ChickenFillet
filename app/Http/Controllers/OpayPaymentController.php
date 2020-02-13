<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Item;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpayAllInOne;
use OpayEncryptType;
use Exception;
use OpayPaymentMethod;

class OpayPaymentController extends Controller
{
    public function pay(Request $request) {
        //基本參數(請依系統規劃自行調整)
        $MerchantTradeNo = "Test".time();
        // 存入訂單資料
        $item['user_id'] = $request->input('user_id');
        $item['shop_name'] = $request->input('shop_name');
        $item['product_name'] = $request->input('product_name');
        $item['qty']  = $request->input('qty');
        $item['price'] = 65;
        $item['order_name'] = 'test_order';
        $item['merchant_trade_no'] = $MerchantTradeNo;
        $order = Order::createOrder($item);

        $price = 65;
        $qty   = $request->input('qty');
        $name  = $request->input('product_name');

        try {

            $obj = new OpayAllInOne();

            //服務參數
            $obj->ServiceURL  = "https://payment-stage.opay.tw/Cashier/AioCheckOut/V5";         //服務位置
            $obj->HashKey     = '5294y06JbISpM5x9' ;                                            //測試用Hashkey，請自行帶入OPay提供的HashKey
            $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                            //測試用HashIV，請自行帶入OPay提供的HashIV
            $obj->MerchantID  = '2000132';                                                      //測試用MerchantID，請自行帶入OPay提供的MerchantID
            $obj->EncryptType = OpayEncryptType::ENC_SHA256;                                    //CheckMacValue加密類型，請固定填入1，使用SHA256加密



            $obj->Send['ReturnURL']         = 'https://b30097bf.ngrok.io/api/receive'; //付款完成通知回傳的網址
            $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;                                       //訂單編號
            $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                                    //交易時間
            $obj->Send['TotalAmount']       = $price * $qty;                                                   //交易金額
            $obj->Send['TradeDesc']         = "Hen好吃，史勾以!";                                        //交易描述
            $obj->Send['ChoosePayment']     = OpayPaymentMethod::ALL;                                 //付款方式:全功能

            //訂單的商品資料
            array_push($obj->Send['Items'], array('Name' => $name, 'Price' => (int)$price,
                'Currency' => "元", 'Quantity' => (int) $qty, 'URL' => ""));

            //產生訂單(auto submit至OPay)
            $obj->CheckOut();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function pay_cvs(Request $request) {
        try {

            $obj = new OpayAllInOne();

            //服務參數
            $obj->ServiceURL  = "https://payment-stage.opay.tw/Cashier/AioCheckOut/V5";         //服務位置
            $obj->HashKey     = '5294y06JbISpM5x9' ;                                            //測試用Hashkey，請自行帶入OPay提供的HashKey
            $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                            //測試用HashIV，請自行帶入OPay提供的HashIV
            $obj->MerchantID  = '2000132';                                                      //測試用MerchantID，請自行帶入OPay提供的MerchantID
            $obj->EncryptType = OpayEncryptType::ENC_SHA256;                                    //CheckMacValue加密類型，請固定填入1，使用SHA256加密

            //基本參數(請依系統規劃自行調整)
            $MerchantTradeNo = "Test".time();

            $obj->Send['ReturnURL']         = 'http://7107c276.ngrok.io/api/receive'; //付款完成通知回傳的網址
            $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;                                       //訂單編號
            $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                                    //交易時間
            $obj->Send['TotalAmount']       = 2000;                                                   //交易金額
            $obj->Send['TradeDesc']         = "good to drink" ;                                       //交易描述
            $obj->Send['ChoosePayment']     = OpayPaymentMethod::CVS ;                                //付款方式:CVS超商代碼

            //訂單的商品資料
            array_push($obj->Send['Items'], array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000",
                'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));

            //CVS超商代碼延伸參數(可依系統需求選擇是否代入)
            $obj->SendExtend['Desc_1']            = '';      //交易描述1 會顯示在超商繳費平台的螢幕上。預設空值
            $obj->SendExtend['Desc_2']            = '';      //交易描述2 會顯示在超商繳費平台的螢幕上。預設空值
            $obj->SendExtend['Desc_3']            = '';      //交易描述3 會顯示在超商繳費平台的螢幕上。預設空值
            $obj->SendExtend['Desc_4']            = '';      //交易描述4 會顯示在超商繳費平台的螢幕上。預設空值
            $obj->SendExtend['PaymentInfoURL']    = 'http://7107c276.ngrok.io/api/receive';      //預設空值
            $obj->SendExtend['ClientRedirectURL'] = '';      //預設空值
            $obj->SendExtend['StoreExpireDate']   = '';      //預設空值

            //產生訂單(auto submit至OPay)
            $obj->CheckOut();

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function receive(Request $request) {

        try {

            $obj = new OpayAllInOne();

            /* 服務參數 */
            $obj->HashKey     = '5294y06JbISpM5x9' ;
            $obj->HashIV      =  'v77hoKGq4kWxNNIS' ;
            $obj->MerchantID  = '2000132';
            $obj->EncryptType = OpayEncryptType::ENC_SHA256;

            /* 取得回傳參數 */
            $arFeedback = $obj->CheckOutFeedback();
            // 參數寫入檔案
//            if(true)
//            {
//                $sLog_Path  = __DIR__.'/sample_payment_return.log' ; // LOG路徑
//                $sLog = '+++++++++++++++++++++++++++++++++++++++ 接收回傳參數 ' . date('Y-m-d H:i:s') . ' ++++++++++++++++++++++++++++++++++++++++++++' . "\n";
//                $fp=fopen($sLog_Path, "a+");
//                fputs($fp, $sLog);
//                fclose($fp);
//                Log::info($sLog);
//
//                $sLog_File =  print_r($arFeedback, true). "\n";
//                $fp=fopen($sLog_Path, "a+");
//                fputs($fp, $sLog_File);
//                fclose($fp);
//            }
            echo '1|OK' ;
//            $orderId = Order::getOrderId();
            $MerchantTradeNo = $request['MerchantTradeNo'];
            Log::info($request['MerchantTradeNo']);
//            $order = updateOrderStatus($MerchantTradeNo);
//            Log::info($order);
            $status = Order::updateOrderStatus($MerchantTradeNo);
            Log::info($status);

//            print "1|OK";
//            return '1|OK';

        } catch (Exception $e) {
            if(true)
            {
                $sLog_Path  = __DIR__.'/sample_payment_return.log' ; // LOG路徑
                $sLog = '+++++++++++++++++++++++++++++++++++++++ 接收回傳參數(ERROR) ' . date('Y-m-d H:i:s') . ' ++++++++++++++++++++++++++++++++++++++++++++' . "\n";
                $fp=fopen($sLog_Path, "a+");
                fputs($fp, $sLog);
                fclose($fp);
                Log::info($sLog);

                $sLog_File =  $e->getMessage(). "\n";
                $fp=fopen($sLog_Path, "a+");
                fputs($fp, $sLog_File);
                fclose($fp);
                Log::info($sLog_File);
            }
//            Log::info('test222');
        }
    }
}
