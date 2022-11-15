<?php declare(strict_types=1);

/**
 * 测试方法
 * @param string $test
 * @return string
 */
function test(string $test){
    return 'I am the '.$test;
}

if(!function_exists('get_everyday')){
    /**
     * 获取时间段内的每一天
     * @param $start_time
     * @param $end_time
     * @return array
     */
    function get_everyday($start_time, $end_time){
        $time = range(strtotime($start_time), strtotime($end_time), 24*60*60);
        return array_map('deal_time', $time);
    }
}

if(!function_exists('deal_time')){
    function deal_time($time){
        return date('Y-m-d', $time);
    }
}

if(!function_exists('get_date_arr')){
    /**
     * @param int $type 1年, 2月, 3周, 4日
     * @param int $len 默认为3
     * @return mixed
     * @sample var_dump(get_date_arr(1, 3), get_date_arr(2, 3), get_date_arr(3, 3), get_date_arr(4, 3));
     */
    function get_date_arr(int $type = 1, int $len = 3){
        $returnData = [];
        $start_prefix = ' 00:00:00';
        $end_prefix = ' 23:59:59';
        switch ($type){
            case 4:
                $space = ' day';
                for($i = ($len -1); $i >=0; $i--){
                    $start_time = strtotime('-'.($i).$space);
                    $returnData[] = [
                        'start_at' => date('Y-m-d', $start_time).$start_prefix,
                        'end_at' => date('Y-m-d', $start_time).$end_prefix
                    ];
                }
                break;
            case 3:
                $space = ' week last monday';
                for($i = ($len -1); $i >=0; $i--){
                    $start_time = strtotime('-'.($i).$space);
                    $end_time = strtotime(date('Y-m-d', $start_time).$start_prefix.'+ 1 week') -1;
                    $returnData[] = [
                        'start_at' => date('Y-m-d', $start_time).$start_prefix,
                        'end_at' => date('Y-m-d', $end_time).$end_prefix
                    ];
                }
                break;
            case 2:
                $space = ' month';
                for($i = ($len -1); $i >=0; $i--){
                    $start_time = strtotime('-'.($i).$space);
                    $end_time = strtotime(date('Y-m-01', $start_time).$start_prefix.'+ 1 '.$space) -1;
                    $returnData[] = [
                        'start_at' => date('Y-m-01', $start_time).$start_prefix,
                        'end_at' => date('Y-m-d', $end_time).$end_prefix
                    ];
                }
                break;
            default:
                $space = ' year';
                for($i = ($len -1); $i >=0; $i--){
                    $start_time = strtotime('-'.($i).$space);
                    $end_time = strtotime(date('Y-01-01', $start_time).$start_prefix.'+ 1 '.$space) -1;
                    $returnData[] = [
                        'start_at' => date('Y-01-01', $start_time).$start_prefix,
                        'end_at' => date('Y-m-d', $end_time).$end_prefix
                    ];
                }
                break;
        }

        return $returnData;
    }
}
