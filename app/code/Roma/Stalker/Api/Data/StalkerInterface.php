<?php
namespace Roma\Stalker\Api\Data;

/**
 * Interface CarCustomerInterface
 */
interface StalkerInterface
{
    const ENTITY_ID ='entity_id';
    const NICKNAME ='nickname';
    const GROUPING ='grouping';
    const NAME ='name';
    const CREATED_AT ='created_at';

    public function getId();
    public function getNickname();
    public function getGrouping();
    public function getName();
    public function getCreatedAt();
    public function setId($id);

    /**
     * @param $nickname
     * @return StalkerInterface
     */
    public function setNickname($nickname): StalkerInterface;
    public function setGrouping($grouping): StalkerInterface ;
    public function setName($name): StalkerInterface;
    public function setCreatedAt(\DateTime $createdAt): StalkerInterface;
}