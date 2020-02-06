<?php
namespace Roma\Stalker\Api;

/**
 * Interface StalkerServiceInterface
 */
interface StalkerServiceInterface
{
    /**
     * @param int $stalkerId
     * @return mixed
     */
    public function getStalkerList($stalkerId);

    /**
     * @param $stalkerId
     * @param $grouping
     * @param $nickname
     * @param $name
     * @return mixed
     */
    public function  setStalker($stalkerId, $grouping, $nickname, $name);
}