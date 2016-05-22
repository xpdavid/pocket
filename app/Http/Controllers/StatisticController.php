<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;
use App\Location;
use App\Organization;
use App\Tag;
use App\Type;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public static $bullet_in_charts = [
        "round", "square", "triangleUp", "triangleDown", "bubble"
    ];

    public function getStatistic() {
        $data = App::make('App\Http\Controllers\PocketController')->selectData();
        return view('admin.statistic.index', compact('data'));
    }

    public function postRequest(Request $request) {
        $this->validate($request, [
            'useFilter' => 'required'
        ]);
        if($request->get('useFilter') == "true") {
            $search_result = App::make('App\Http\Controllers\PocketController')
                ->APISearch($request->all())
                ->get();
            $result_group_by_month = $search_result->groupBy(function($item) {
                return Carbon::parse($item->date)->format('Y-m'); // grouping by month
            });
            $graphData = [];
            foreach ($result_group_by_month as $date=>$collection) {
                $data_item = [
                    'date' => $date,
                    'count' => $collection->count()
                ];
                array_push($graphData, $data_item);
            }
            $process = [];
            foreach ($graphData as $data) {
                array_push($process, $data['date']);
            }
            $graphData = $this->padGapWithZero($process, $graphData, ['count']);
            return [
                'status' => 1,
                'graphSetting' => [$this->generateGraphSetting(0, "所有奖状", 'count')],
                'data' => $graphData
            ];
        } else {
            $allGraphData = [];
            $allGraphSetting = [];
            $this->searchAndCategorize($request, $request->get('mainAnalysis'), $allGraphData, $allGraphSetting);
            $process = [];
            foreach ($allGraphData as $data) {
                array_push($process, $data['date']);
            }
            $md5_keys = array_map(function($value) {
                return md5($value);
            }, $request->get($request->get('mainAnalysis') . '_list'));
            $allGraphData = $this->padGapWithZero($process, $allGraphData, $md5_keys);
            return [
                'status' => 1,
                'graphSetting' => $allGraphSetting,
                'data' => $allGraphData
            ];
        }
    }

    public function getRequest(Request $request) {
        return $this->postRequest($request);
    }

    public function searchAndCategorize($request, $list_name, &$allGraphData, &$allGraphSetting) {
        $i = 0;
        $allGraphData_temp = [];
        foreach ($request->get($list_name . '_list') as $name) {
            $graphData = [];
            $filter = App::make('App\Http\Controllers\PocketController')->APISearch($request->except($list_name . '_list'));
            $filter_current = $filter->whereHas($list_name. 's', function($q) use ($name) {
                $q->where('name', $name);
            })->get();
            $result_group_by_month = $filter_current->groupBy(function($item) {
                return Carbon::parse($item->date)->format('Y-m'); // grouping by month
            });
            foreach ($result_group_by_month as $date=>$collection) {
                $date_item_ele = [];
                $date_item_ele[md5($name)] = $collection->count();
                $graphData[$date] = $date_item_ele;
            }
            $this->array_mergeWithKey($graphData, $allGraphData_temp);
            array_push($allGraphSetting, $this->generateGraphSetting($i, $name, md5($name)));
            $i++;
            if ($i >= 5) break;
        }
        foreach ($allGraphData_temp as $key=>$values) {
            $ele = [];
            $ele['date'] = $key;
            foreach ($values as $key_t => $value) {
                $ele[$key_t] = $value;
            }
            array_push($allGraphData, $ele);
        }

    }


    public function generateGraphSetting($bullet, $title, $valueField) {
        return [
            "valueAxis" => "v1",
            "lineColor" => rand_hex_color(),
            "bullet" => self::$bullet_in_charts[$bullet],
            "bulletBorderThickness" => 1,
            "hideBulletsCount" => 30,
            "title" => $title,
            "valueField" => $valueField,
            "fillAlphas" => 0
        ];
    }

    public function array_mergeWithKey($arr1, &$arr2) {
        foreach ($arr1 as $key=>$value) {
            if(array_key_exists($key, $arr2)) {
                $arr2_ele = $arr2[$key];
                $arr2[$key] = $arr2_ele + $value;
            } else {
                $arr2[$key] = $value;
            }
        }
    }


    public function padGapWithZero($sequence, $originData, $keys) {
        if(empty($sequence)) {
            return null;
        }
        $max_date = maxInStringArray($sequence);
        $min_date = minInStringArray($sequence);
        $maxDate = Carbon::parse($max_date);
        $minDate = Carbon::parse($min_date);
        while($minDate->lt($maxDate)) {
            if (!in_arrayi($minDate->format('Y-m') , $sequence)) {
                $pads = [
                    'date' => $minDate->format('Y-m')
                ];
                foreach ($keys as $key) {
                    $pads[$key] = 0;
                }
                array_push($originData, $pads);
            }
            $minDate->addMonth();
        }
        foreach ($originData as $index=>$item) {
            foreach ($keys as $key) {
                if (!array_key_exists($key, $item)) {
                    $originData[$index][$key] = 0;
                }
            }
        }
        return $originData;
    }

}
