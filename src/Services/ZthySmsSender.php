<?php
namespace Reasno\SmsSender\Services;

use Reasno\SmsSender\Contracts\SmsSender;
use Illuminate\Support\Facades\Log;
use Datetime;

class ZthySmsSender implements SmsSender
{
    public function __construct($config)
    {
        $this->api = $config['api'];
        $this->account = $config['account'];
        $this->password = $config['password'];
        $this->apiTimeout = $config['timeout'];
        $this->params = [
            'username' => $this->account,
        ];
    }
    public function send(string $number, string $content)
    {
        $params = $this->params;
        $params['tkey'] = (new Datetime())->format('YmdHis');
        $params['password'] = md5(md5($this->password).$params['tkey']);
        $params['mobile'] =  $number;
        $params['content'] = $content;
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'timeout' => $this->apiTimeout,
                'header' => ['Host' => 'api.zthysms.com'], 
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($this->api.'?'.http_build_query($params), false, $context);
        if ($result === false) {
            return false;
        } else {
            Log::debug('send sms failed.', ['reason'=>$result]);
            return true;
        }
    }
}
