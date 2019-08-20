<?php
/**
 * Created by PhpStorm.
 * User: nekohor
 * Date: 2019/8/12
 * Time: 9:50
 */

namespace App\HotRoll\Repositories;

use App\HotRoll\Repositories\CoilRequest;


class Ponder
{
    public function __construct()
    {
    }

    public function getPondData($line, $coilIds)
    {
        $req = [];
        $req["requests"] = [];
        foreach($coilIds as $coilId) {
            $coilReq = new CoilRequest($line, $coilId);
            $req["requests"] []= $coilReq->getRequest();
        }
        $resp = $this->getSocketData($req);
        return $resp;
    }

    public function getEncodedRequestsData($req)
    {
        return str_replace("\\/", "/", json_encode($req));
    }

    public function getSocketData($req)
    {
        set_time_limit(0);

        $host = "127.0.0.1";
        $port = 8999;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
        $connection = socket_connect($socket, $host, $port) or die("Could not connect to server\n");

        $jsonRequests = $this->getEncodedRequestsData($req);
        socket_write($socket, $jsonRequests) or die("Send failed\n");

        $respondLen = 0;
        $respond = '';
        while ($buff = socket_read($socket, 1024)) {
            $respondLen += strlen($buff);
            $respond .= $buff;
        }
        socket_close($socket);

        return json_decode($respond);
    }

    public function getPostData($req)
    {
        $host = "127.0.0.1";

        $port = 8999;

        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $host.":".strval($port));
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        $post_data = $req;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        print_r($data);
    }
}