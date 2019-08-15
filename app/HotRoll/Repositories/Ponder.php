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

    public function getSocketData($req)
    {
        set_time_limit(0);

        $host = "127.0.0.1";
        $port = 8999;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
        $connection = socket_connect($socket, $host, $port) or die("Could not connect to server\n");

        socket_write($socket, str_replace("\\/", "/", json_encode($req))) or die("Send failed\n");

        $respondLen = 0;
        $respond = '';
        while ($buff = socket_read($socket, 1024)) {
            $respondLen += strlen($buff);
            $respond .= $buff;
        }
        socket_close($socket);

        return json_decode($respond);
    }
}