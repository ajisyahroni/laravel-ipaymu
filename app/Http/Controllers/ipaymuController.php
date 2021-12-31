<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ipaymuController extends Controller
{
    public function showProductPage()
    {
        return view('buy-product');
    }

    public function checkTrxDetail(Request $req)
    {
        $va           = '0000002138308595';
        $secret       = 'SANDBOXD4BA15FF-71F1-41CB-BD97-ECD97C8C701B-20211230103616';

        $url          = 'https://sandbox.ipaymu.com/api/v2/transaction';
        $method       = 'POST';

        //Request Body//
        $body['transactionId']    = $req->trxId;
        //End Request Body//

        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
        $signature    = hash_hmac('sha256', $stringToSign, $secret);
        $timestamp    = Date('YmdHis');
        //End Generate Signature


        $ch = curl_init($url);
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );


        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);


        if ($err)
            return dd($err);
        else
            return response()->json(json_decode($ret));
    }

    public function checkBalance()
    {
        $va           = '0000002138308595';
        $secret       = 'SANDBOXD4BA15FF-71F1-41CB-BD97-ECD97C8C701B-20211230103616';

        $url          = 'https://sandbox.ipaymu.com/api/v2/balance';
        $method       = 'POST';

        //Request Body//
        $body['account']    = $va;
        //End Request Body//


        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
        $signature    = hash_hmac('sha256', $stringToSign, $secret);
        $timestamp    = Date('YmdHis');
        //End Generate Signature


        $ch = curl_init($url);
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );


        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);


        if ($err)
            return dd($err);
        else
            return response()->json(json_decode($ret));
    }

    public function handleTrx()
    {
        $va           = '0000002138308595';
        $secret       = 'SANDBOXD4BA15FF-71F1-41CB-BD97-ECD97C8C701B-20211230103616';

        $url          = 'https://sandbox.ipaymu.com/api/v2/payment';
        $method       = 'POST';

        //Request Body//
        $body['product']    = array('headset', 'softcase');
        $body['qty']        = array('1', '3');
        $body['price']      = array('100000', '20000');
        $body['returnUrl']  = route('ipaymu-trx-success');
        $body['cancelUrl']  = route('ipaymu-trx-error');
        $body['notifyUrl']  = route('notify');
        //End Request Body//


        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
        $signature    = hash_hmac('sha256', $stringToSign, $secret);
        $timestamp    = Date('YmdHis');
        //End Generate Signature


        $ch = curl_init($url);
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );


        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);



        if ($err) {
            return dd($err);
        } else {

            //Response
            $ret = json_decode($ret);
            if ($ret->Status == 200) {
                $sessionId  = $ret->Data->SessionID;
                $url        =  $ret->Data->Url;
                header('Location:' . $url);
                return dd($ret);
            } else {
                return dd($ret);
            }
            //End Response
        }
    }


    public function notify(Request $req)
    {
        return response()->json(json_decode($req));
    }
}
