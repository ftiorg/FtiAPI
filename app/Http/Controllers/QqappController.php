<?php

namespace App\Http\Controllers;

use App\QqappOpenId;
use Illuminate\Http\Request;
use GuzzleHttp;

class QqappController extends Controller
{
    public function GetOpenId(Request $request)
    {
        try {
            $client = new GuzzleHttp\Client();
            $res = $client->request('GET', 'https://api.q.qq.com/sns/jscode2session?appid=' . env('QQAPP_ID') . '&secret=SECRET&js_code=' . $request->post('code') . '&grant_type=authorization_code');
            if ($res->getStatusCode() == 200) {
                $object = json_decode($res->getBody(), true);
                if ($object['errcode'] == 0) {
                    QqappOpenId::create([
                        'code' => $request->post('code'),
                        'openid' => $object['openid'],
                        'key' => $object['session_key'],
                        'unionid' => $object['unionid']
                    ]);
                    return ['openid' => $object['openid']];
                } else {
                    throw new \Exception('获取OpenID失败');
                }
            } else {
                throw new \Exception('服务器返回' . $res->getStatusCode());
            }
        } catch (\Exception $e) {
            $this->response->errorInternal($e->getMessage());
        }
    }
}
