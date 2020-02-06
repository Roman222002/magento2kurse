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
     * @param int $stalkerId
     * @param string $grouping
     * @param string $nickname
     * @param string $name
     * @return mixed
     */
    public function  setStalker($stalkerId, $grouping, $nickname, $name);
}