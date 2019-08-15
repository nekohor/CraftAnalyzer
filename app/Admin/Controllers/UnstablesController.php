<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Grid;

use App\Unstable;


class UnstablesController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->body($this->grid());
    }

        /**
     * Make a grid builder.
     *
     * @return Grid
     */

    protected function grid()
    {
        $grid = new Grid(new Unstable);

        $grid->line('产线');
        $grid->start_date('开始日期');
        $grid->shift('班次');
        $grid->duty('班组');
        $grid->area('区域');
        $grid->catego('类别');
        $grid->steel_grade('钢种');
        $grid->aim_thick('目标厚度');
        $grid->aim_width('目标宽度');
        $grid->coil_id('热卷号');
        $grid->events('不稳定事件');
        // $grid->describe('描述');

        return $grid;
    }

}
