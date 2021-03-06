<?php
/**
 * Created by PhpStorm.
 * User: nekohor
 * Date: 2019/8/12
 * Time: 11:04
 */

namespace App\HotRoll\Repositories;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\HotRoll\Repositories\Factors;

class CoilRequest
{

    public $line;
    public $coilId;

    public function __construct($coilId)
    {
        $this->line = $this->judgeLine($coilId);
        $this->coilId = $coilId;
    }

    public function judgeLine($coilId)
    {
        $lineTag = substr($coilId,0,1);
        $line = "";
        switch ($lineTag)
        {
            case "H":
                $line = "2250";
                break;
            case "M":
                $line = "1580";
                break;
            default:
                throw new \Exception("The coil is from wrong line with un-matched coil head tag");
        }
        return $line;
    }

    public function getCurDir()
    {
        $dbName = $this->line .'hrm';
        $record = DB::connection($dbName)
            ->select('select start_date from cid where coil_id = ?', [$this->coilId])[0];

        return $this->concatDirPath($record->start_date);
    }

    public function concatDirPath($startDateStr)
    {
        $startDate = Carbon::parse($startDateStr);
        $month = $startDate->format('Ym');
        $date = $startDate->format('Ymd');
        return "e:/".$this->line."hrm"."/".$month."/".$date;
    }

    public function getRequest()
    {
        $req = [];
        $req["coilId"] = $this->coilId;
        $req["curDir"] = $this->getCurDir();
        $req["factors"] = Factors::get();

        return $req;

    }
}