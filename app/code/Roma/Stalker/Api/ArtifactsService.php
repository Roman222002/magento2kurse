<?php
namespace Roma\Stalker\Api;

/*
 *
 */
interface ArtifactsService
{
    /**
     * @param int $stalkerId
     * @return mixed
     */
    public function getArtifactsList($stalkerId);

}