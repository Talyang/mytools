<?php


namespace Flyty\Mytools;


class Uuid
{
    private $salt;

    public function __construct($salt = '')
    {
        $this->salt = $salt;
    }

    /**
     * 样例：1618388518.05446076a6260d48a
     * @return string
     */
    public function v0(): string
    {
        return uniqid((string) (microtime(true)));
    }

    /**
     * 样例：2e1e92c04dfba5d5e5fa511ed5708cc46076a66e39f73
     * @return string
     */
    public function v1(): string
    {
        return uniqid(md5((string) (microtime(true))));
    }

    /**
     * 样例：ed37c51b7ebacb88826a303f6f89f5f0
     * @return string
     */
    public function v2(): string
    {
        return md5($this->salt . uniqid(md5((string) (microtime(true))), true));
    }

    /**
     * 样例：8b93f4f3-7845c80b-31cf6f4d-50e1e795
     * @param int $cut
     * @param string $flavour
     * @return string
     */
    public function v3($cut, $flavour): string
    {
        $str    = $this->v2();
        $length = 32;
        $tmp    = [];
        while ($length > 0) {
            $part = substr($str, 32 - $length, $cut);
            array_push($tmp, $part);
            $length -= $cut;
        }

        return implode($flavour, $tmp);
    }

    /**
     * 样例：8dc379f4-1726-f59e-2fef-924deb35c1a0
     * @param $cut | 分隔的数组
     * @param $flavour
     * @return string
     */
    public function v4($cut, $flavour): string
    {
        $str    = $this->v2();
        $uuid   = '';
        $length = 32;
        foreach ($cut as $cut_val){
            $uuid .= substr($str, 32 - $length, $cut_val) . $flavour;
            $length -= $cut_val;
        }
        return trim($uuid, $flavour);
    }
}