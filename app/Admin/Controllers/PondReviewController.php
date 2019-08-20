<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Admin;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Callout;

use Encore\Admin\Widgets\Echarts\Echarts;

use App\HotRoll\Repositories\Ponder;


class PondReviewController extends Controller
{

    public function index(Content $content)
    {
//        Admin::script(<<<EOF
//        const app = new Vue({
//            el: '#app'
//        });
//EOF
//        );
        return $content
            ->header(__("hotroll.review"))
            ->row(
                view('pond.index'));
    }

}
