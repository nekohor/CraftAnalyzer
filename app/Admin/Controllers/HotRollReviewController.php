<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Callout;

use Encore\Admin\Widgets\Echarts\Echarts;

use App\HotRoll\Repositories\Ponder;


class HotRollReviewController extends Controller
{

    private $ponder;

    public function index(Content $content)
    {
        $this->ponder = new Ponder();
        return $content
            ->header(__("hotroll.review"))
            ->row(
                $this->info('追溯', __("hotroll.review"))

             )->row(
                 function (Row $row) {
                     $json = '[{"count_date":"03-28","fans_num":5906,"article_num":363,"forward_num":27928,"comment_num":9123,"like_num":35632},{"count_date":"03-29","fans_num":9565,"article_num":361,"forward_num":16755,"comment_num":7193,"like_num":36540}]';

                     $jsonArr = json_decode($json, 1);
                     // bindData
                     $head = [
                         'count_date' => '日期',
                         'fans_num' => '粉丝',
                         'comment_num' => '评论',
                         'article_num' => '文章',
                         'forward_num' => '转发',
                         'like_num' => '点赞',
                     ];
                     $echarts = (new Echarts('', ''))
                                 ->setData($jsonArr)
                                 ->bindLegend($head);
                     $row->column(4, new Box('toolbox', $echarts));
                 }
            )->row(
                function (Row $row) {
                    $bar = view('hotroll.tool-box');

                    $row->column(12, new Box('操作面板', $bar));
                }
            )->row(function (Row $row) {

                $bar = view('hotroll.fm-stand');
                $row->column(1/3, new Box('F1', $bar));

                $scatter = view('admin.chartjs.scatter');
                $row->column(1/3, new Box('F2', $scatter));

                $bar = view('admin.chartjs.line');
                $row->column(1/3, new Box('F3', $bar));

            })->row(function (Row $row) {

                $bar = view('admin.chartjs.doughnut');
                $row->column(1/3, new Box('F4', $bar));

                $scatter = view('admin.chartjs.combo-bar-line');
                $row->column(1/3, new Box('F5', $scatter));

                $bar = view('admin.chartjs.line-stacked');
                $row->column(1/3, new Box('F6', $bar));

            })->row(function (Row $row) {

                $bar = view('admin.chartjs.doughnut');
                $row->column(1/3, new Box('F7', $bar));


            });
    }

    protected function info($url, $title)
    {
        $content = "<a href=\"{$url}\" target='_blank'>{$url}</a>";

        return new Callout($content, $title, 'info');
    }
}
