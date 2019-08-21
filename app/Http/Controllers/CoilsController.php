<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CoilsController extends Controller
{
    public function queryCoilIds(Request $request)
    {
        $isValid = true;
        $isQuery = true;
        $coilIds = [];

        $line = $request->input("line","no line");

        if ($request->has("startDate") & $request->has("endDate"))
        {
            $startDate = $request->input("startDate");
            $endDate = $request->input("endDate");
            $coilIds = $this->queryCoilIdsWithDates($line, $startDate, $endDate);

        } else if ($request->has("singleCoilId"))
        {
            $singleCoilId = $request->input("singleCoilId");
            $coilIds = $this->queryCoilIdsWithInput($line, $singleCoilId);

        } else {
            $isValid = false;
        }

        if ($coilIds === [])
        {
            $isQuery = false;
        }

        return response()->json([
            'line'    => $line,
            'coilIds' => $coilIds,
            'isValid' => $isValid,
            'isQuery' => $isQuery
        ]);
    }

    /**
     * @param $line
     * @param $startDate
     * @param $endDate
     * @return array
     */

    public function queryCoilIdsWithDates($line, $startDate, $endDate)
    {
        $dbName = $this->getHrmDatabaseName($line);
        $coilIds = DB::connection($dbName)
            ->select("select coil_id from cid where datetime >= ? and datetime <= ?", [$startDate, $endDate]);
        return $coilIds;

    }

    /**
     * return current coilId and prev 2 coil ids ans next 2 coil ids ,totally 5 coil ids
     * @param $line
     * @param $singleCoilId
     * @return array
     */
    public function queryCoilIdsWithInput($line, $singleCoilId)
    {
        $dbName = $this->getHrmDatabaseName($line);

        $curId = DB::connection($dbName)
            ->select('select id from cid where coil_id = ?', [$singleCoilId])[0]->id;

        $firstId = $curId - 2;
        $lastId = $curId + 2;
        $coilIds = DB::connection($dbName)
            ->select('select coil_id from cid where id >=  ? and id <= ?', [$firstId, $lastId]);

        return $coilIds;
    }

    public function getHrmDatabaseName(string $line)
    {
        return $line .'hrm';
    }

    public function testReturnCoilIds()
    {
        $dbName = $this->getHrmDatabaseName("2250");
        $coilIds = DB::connection($dbName)
            ->select('select start_date from cid where coil_id = ?', ["H19016591N"]);
        dd(json_encode($coilIds));
    }
}