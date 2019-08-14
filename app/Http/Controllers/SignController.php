<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DailySign;


class SignController extends Controller
{
    private $plat = '';
    private $userid = '';

    public function NewSign(Request $request)
    {
        switch ($request->post('plat')) {
            case 'qqapp':
                $this->plat = 'qqapp';
                break;
            case 'wxapp':
                $this->plat = 'qqapp';
                break;
            case 'web':
                $this->plat = 'qqapp';
                break;
            case 'blive':
                $this->plat = 'qqapp';
                break;
            default:
                break;
        }
        if (!$this->AuthClient()) {
            $this->response->errorForbidden('客户端验证失败');
        }
        try {
            $ret = $this->AddNewSign([
                'platform' => $this->plat,
                'userid' => $request->post('uid'),
                'name' => $request->post('name'),
                'avatar' => $request->post('avatar'),
                'date' => date('Y-m-d'),
                'time' => date('H:i:s')
            ]);
            return array($ret);
        } catch (\Exception $e) {
            $this->response->errorInternal($e->getMessage());
        }
    }

    public function TodayDetail(Request $request)
    {
        $detail = [];
        $detail['isSigned'] = DailySign::where(['date' => date('Y-m-d'), 'userid' => $request->post('uid')])->count() == 0 ? false : true;
        $detail['todayRank'] = $detail['isSigned'] ? DailySign::where(['date' => date('Y-m-d'), 'userid' => $request->post('uid')])->get('rank')[0]['rank'] : 0;
        $detail['todayCount'] = DailySign::where(['date' => date('Y-m-d')])->count();
        $detail['signCount'] = DailySign::where(['userid' => $request->post('uid')])->count();
        return $detail;
    }

    public function TodayRank()
    {
        $rlist = [];
        foreach (DailySign::where(['date' => date('Y-m-d')])->get() as $item) {
            $rlist[] = [
                'name' => empty($item['name']) ? 'unknown' : $item['name'],
                'rank' => $item['rank'],
                'avatar' => $item['avatar'],
                'plat' => $this->PlatRealName($item['platform']),
                'date' => $item['date'],
                'time' => $item['time']
            ];
        }
        return $rlist;
    }

    private function PlatRealName($plat = null)
    {
        switch ($plat) {
            case 'qqapp':
                return 'QQ小程序';
            case 'wxapp':
                return '微信小程序';
            default:
                return null;
        }
    }

    public function SignHistory(Request $request)
    {
        $mlist = [];
        foreach (DailySign::where(['platform' => $request->get('plat'), 'userid' => $request->get('uid')])->get() as $item) {
            $mlist[] = [
                'name' => empty($item['name']) ? 'unknown' : $item['name'],
                'rank' => $item['rank'],
                'avatar' => empty($item['avatar']) ? null : $item['avatar'],
                'plat' => $item['platform'],
                'date' => $item['date'],
                'time' => $item['time']
            ];
        }
        return $mlist;
    }

    private function AuthClient()
    {
        if (empty($this->plat)) {
            return false;
        }

        return true;
    }

    private function AddNewSign($item)
    {
        if ((int)substr($item['time'], 0, 2) < -1) {
            throw new \Exception('请在4点之后打卡');
        }
        $query = DailySign::where(['date' => date('Y-m-d'), 'userid' => $item['userid']])->get();
        $rank = DailySign::where('date', '=', date('Y-m-d'))->count();
        if (count($query) > 0) {
            return ['已经在今天' . $query[0]['time'] . '打卡成功', $rank];
        }
        $item['rank'] = $rank + 1;
        DailySign::create($item);
        return ['打卡成功', $item['rank']];
    }


}
