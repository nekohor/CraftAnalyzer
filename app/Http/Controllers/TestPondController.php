<?php
/**
 * Created by PhpStorm.
 * User: nekohor
 * Date: 2019/8/12
 * Time: 16:45
 */

namespace App\Http\Controllers;

use App\HotRoll\Repositories\Ponder;

class TestPondController
{

    public function testPond()
    {
        $ponder = new Ponder();
        return json_encode($ponder->getPondData(1580, ["M19045772M", "M19045773M", "M19045774M"]));
    }
}