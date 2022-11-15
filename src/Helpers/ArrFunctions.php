<?php

if(!function_exists('remove_value')){
    /**
     * Remove a value from the list
     * 移除数组中的某个键值
     * @param array $array The array in which we have to remove value
     * @param mixed $value The value to remove from the list
     */
    function remove_value(array &$array, $value){
        $index = array_search($value, $array);
        if (false !== $index) {
            unset($array[$index]);
        }
    }
}

if(!function_exists('arr_sort_by_field')){
    /**
     * 二维数组按照某个字段排序
     * @param array $arr   要排序的数组
     * @param mixed $field 要排序的字段
     * @param int   $arg   排序规则
     * @return array
     */
    function arr_sort_by_field(array $arr, $field, $arg = SORT_ASC): array
    {
        if (!empty($arr)) {
            foreach ($arr as $v) {
                $sort[] = $v[$field];
            }
            array_multisort($sort, $arg, $arr);
        }
        return $arr;
    }
}

if(function_exists('array_unique_by_column')){
    /**
     * 二维数组根据指定key去重
     * @param $arr
     * @param $col
     * @return array|bool
     * @throws Exception
     */
    function array_unique_by_column($arr, $col)
    {
        try {
            if (!is_array($arr) || empty($arr)) {
                return false;
            }

            $temp = [];
            foreach ($arr as $k => $v) {
                $temp[$v[$col]] = $v;
            }
            return array_values($temp);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}