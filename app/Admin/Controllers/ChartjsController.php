<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Callout;

use Encore\Admin\Widgets\Echarts\Echarts;

class ChartjsController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header($title = 'Chartjs')
            ->row(
                $this->info('https://github.com/laravel-admin-extensions/chartjs', $title)
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
                     $echarts = (new Echarts('柱状图', '数据来自新浪云大数据平台'))
                                 ->setData($jsonArr)
                                 ->bindLegend($head);
                     $row->column(4, new Box('toolbox', $echarts));
                 }
            )->row(
                function (Row $row) {
                    $toolbox = view('admin.chartjs.bar');
                    $row->column(8, new Box('toolbox', $toolbox));
                }
            )->row(function (Row $row) {

                $bar = view('admin.chartjs.bar');
                $row->column(1/3, new Box('Bar chart', $bar));

                $scatter = view('admin.chartjs.scatter');
                $row->column(1/3, new Box('Scatter chart', $scatter));

                $bar = view('admin.chartjs.line');
                $row->column(1/3, new Box('Line chart', $bar));

            })->row(function (Row $row) {

                $bar = view('admin.chartjs.doughnut');
                $row->column(1/3, new Box('Doughnut chart', $bar));

                $scatter = view('admin.chartjs.combo-bar-line');
                $row->column(1/3, new Box('Chart.js Combo Bar Line Chart', $scatter));

                $bar = view('admin.chartjs.line-stacked');
                $row->column(1/3, new Box('Chart.js Line Chart - Stacked Area', $bar));

            });
    }

    protected function info($url, $title)
    {
        $content = "<a href=\"{$url}\" target='_blank'>{$url}</a>";

        return new Callout($content, $title, 'info');
    }
}
