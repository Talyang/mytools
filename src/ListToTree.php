<?php


namespace Flyty\Mytools;


class ListToTree
{
    private $list; // 源数组

    private $parent_index; // 父级节点索引名称

    private $node_index; // 子集节点索引名称

    private $node_name; // 节点名称

    public function __construct(array $list = [], $parent_id = 'parent_id', $node_index = 'id', $node_name = 'child')
    {
        $this->list = $list;
        $this->parent_index = $parent_id;
        $this->node_name = $node_name;
        $this->node_index = $node_index;
    }

    /**
     * 获取树结构
     * @return array
     */
    public function toTree(): array
    {
        $items = [];
        $data  = $this->list;
        foreach ($data as $value) {
            $items[$value[$this->node_index]] = $value;
        }
        $tree = [];
        foreach ($items as $node_index => $item) {
            if (isset($items[$item[$this->parent_index]])) {
                $items[$item[$this->parent_index]][$this->node_name][] = &$items[$node_index];
            } else {
                $tree[] = &$items[$item[$this->node_index]];
            }
        }
        return $tree;
    }
}