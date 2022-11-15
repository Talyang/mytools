<?php


namespace Flyty\Mytools;


class TreeToList
{
    private $tree;

    private $parent_index; // 父级节点索引名称

    private $node_index; // 子集节点索引名称

    private $node_name; // 节点名称

    private $layer_name = '';

    private $count;

    public function __construct(array $tree = [], $parent_id = 'parent_id', $node_index = 'id', $node_name = 'child')
    {
        $this->tree = $tree;
        $this->parent_index = $parent_id;
        $this->node_name = $node_name;
        $this->node_index = $node_index;
    }

    public function toList(): array
    {
        $this->count = 0;
        $this->recurse($data, $this->tree);

        return $data;
    }

    private function recurse(?array &$data = [], array $tree = [], int $layer = 0, int $parent_id = 0): void
    {
        foreach ($tree as $t) {
            ++$this->count;
            $node                      = $t;
            $node[$this->node_index]   = $this->count;
            $node[$this->parent_index] = $parent_id;
            unset($node[$this->node_name]);
            if ('' !== $this->layer_name) {
                $node[$this->layer_name] = $layer;
            }
            $data[] = $node;
            if (isset($t[$this->node_name]) && !empty($t[$this->node_name])) {
                $this->recurse($data, $t[$this->node_name], $layer + 1, $this->count);
            }
        }
    }
}