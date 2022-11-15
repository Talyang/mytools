<?php


namespace App\Rpc\Service;

use Hyperf\RpcServer\Annotation\RpcService;
use JiuJiu\Tools\DateTime;
use JiuJiu\Tools\ListToTree;
use JiuJiu\Tools\TreeToList;

/**
 * Class IndexService
 * @package App\Rpc\Service
 * @RpcService(name="IndexService", protocol="jsonrpc", server="jsonrpc")
 */
class IndexService
{
    /**
     * 数组转树结构
     * @return array|array[]
     */
    public function listToTree(){
        $data       = [
            ['id' => 1, 'parent_id' => 0],
            ['id' => 2, 'parent_id' => 3],
            ['id' => 3, 'parent_id' => 1],
            ['id' => 4, 'parent_id' => 2],
            ['id' => 5, 'parent_id' => 1],
            ['id' => 6, 'parent_id' => 7],
            ['id' => 7, 'parent_id' => 5],
        ];
        $listTotree = new ListToTree($data);
        $res = $listTotree ->toTree();
        return responseInfo($res);
    }

    /**
     * 结构树转数组
     * @return array|array[]
     */
    public function treeToList(){
        $data       = [
            [
                'id'        => 1,
                'parent_id' => 0,
                'child'     => [
                    0 => [
                        'id'        => 3,
                        'parent_id' => 1,
                        'child'     => [
                            0 => [
                                'id'        => 2,
                                'parent_id' => 3,
                                'child'     => [
                                    0 => [
                                        'id'        => 4,
                                        'parent_id' => 2,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $treeToList = new TreeToList($data);
        $res = $treeToList ->toList();
        return responseInfo($res);
    }

    /**
     * 时间段选取
     * @return array|array[]
     */
    public function dateTime(){
        $dateTime = new DateTime();
        $hour = $dateTime ->hourBeginEnd(12);
        $date = $dateTime ->dayBeginEnd();
        $year = $dateTime ->yearBeginEnd(2020);
        $month = $dateTime ->monthBeginEnd();
        $data = [
            $hour, $date, $year, $month
        ];
        foreach ($data as &$va){
            $va['begin'] = date('Y-m-d H:i:s', $va['begin']);
            $va['end'] = date('Y-m-d H:i:s', $va['end']);
        }
        return responseInfo($data);
    }

    /**
     * 获取uuid
     * @return array|array[]
     */
    public function uuid(){
        return responseInfo(jiujiu_uuid(4));
    }

    public function underline_to_hump(){
        return responseInfo(underline_to_hump('test_index'));
    }
}