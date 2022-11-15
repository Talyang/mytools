<?php

if(!function_exists('fly_uuid')){
    /**
     * @param int $version | 版本号
     * @param string $salt | 加盐
     * @param int $v3_cut | v3的分隔位
     * @param int[] $v4_cut | v4的分隔位 （数组的值相加为32）
     * @param string $flavour | 分隔符
     * @return string
     */
    function fly_uuid(int $version = 0, $salt = '',  $flavour = '-', $v3_cut = 8, $v4_cut = [8, 4, 4, 4, 12]){
        $uuid_model = new \Flyty\Mytools\Uuid($salt);
        switch ($version){
            case 0:
                $uuid = $uuid_model ->v0();// 1618388518.05446076a6260d48a
                break;
            case 1:
                $uuid = $uuid_model ->v1();// 2e1e92c04dfba5d5e5fa511ed5708cc46076a66e39f73
                break;
            case 2:
                $uuid = $uuid_model ->v2(); // ed37c51b7ebacb88826a303f6f89f5f0
                break;
            case 3:
                $uuid = $uuid_model ->v3($v3_cut, $flavour); // 8b93f4f3-7845c80b-31cf6f4d-50e1e795
                break;
            case 4:
                $uuid = $uuid_model ->v4($v4_cut, $flavour); // 8dc379f4-1726-f59e-2fef-924deb35c1a0
                break;
            default:
                $uuid = $uuid_model ->v0();
                break;
        }
        return $uuid;
    }
}


if(!function_exists('underline_to_hump')){
    /**
     * 下划线变驼峰
     * @param string $str
     * @return string
     */
    function underline_to_hump(string $str){
        $tmp = explode('_', $str);
        $res = '';
        foreach ($tmp as $key => $item){
            if($key > 0){
                $res .= ucfirst($item);
            }else{
                $res .= $item;
            }
        }
        return $res;
    }
}

if(!function_exists('hump_to_underline')){
    /**
     * 驼峰变下划线
     * @param string $str
     * @return string
     */
    function hump_to_underline(string $str){
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . '_' . "$2", $str));
    }
}