<?php
namespace Roma\Stalker\Api\Data;

/**
 * Interface ArtifactsInterface
 */
interface ArtifactsInterface
{
    const ENTITY_ID = 'entity_id';

    const STALKER_ID = 'stalker_id';

    const TITLE = 'title';

    const DESCRIPTION = 'description';

    const CREATED_AT = 'created_at';


    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get stalker id
     *
     * @return int
     */
    public function getStalkerId();

    /**
     * Get title
     *
     * @return int
     */
    public function getTitle();

    /**
     * Get artifacts description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get created at date
     *
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * Set entity id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set stalker id
     *
     * @param int $stalkerId
     * @return ArtifactsInterface
     */
    public function setStalkerId(int $stalkerId): ArtifactsInterface;

    /**
     * Set artifact title
     *
     * @param string $title
     * @return ArtifactsInterface
     */
    public function setTitle(string $title): ArtifactsInterface;

    /**
     * Set artifacts description
     *
     * @param string $description
     * @return ArtifactsInterface
     */
    public function setDescription(string $description): ArtifactsInterface;

    /**
     * Set created at date
     *
     * @param \DateTime $createdAt
     * @return ArtifactsInterface
     */
    public function setCreatedAt(\DateTime $createdAt): ArtifactsInterface;

}