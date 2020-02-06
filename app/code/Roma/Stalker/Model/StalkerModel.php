<?php
namespace Roma\Stalker\Model;

use Magento\Framework\Model\AbstractModel;
use Roma\Stalker\Model\ResourceModel\Stalker as StalkerResourceModel;
use Roma\Stalker\Api\Data\StalkerInterface;
/**
 * Class StalkerModel
 */
 class StalkerModel extends AbstractModel implements StalkerInterface {

    public function _construct()
    {
        $this->_init(StalkerResourceModel::class);
    }

    public function getId(){
        return $this->getData(self::ENTITY_ID);
    }
    public function getNickname(){
        return $this->getData(self::NICKNAME);
    }
    public function getGrouping(){
        return $this->getData(self::GROUPING);
    }
    public function getName(){
        return $this->getData(self::NAME);
    }
    public function getCreatedAt(){
        return $this->getData(self::CREATED_AT);
    }
    public function setId($id){
        return $this->setData(self::ENTITY_ID, $id);
    }
    public function setNickname($nickname): StalkerInterface{
        return $this->setData(self::NICKNAME, $nickname);
    }
    public function setGrouping($grouping): StalkerInterface{
        return $this->setData(self::GROUPING, $grouping);
    }
    public function setName($name):StalkerInterface{
        return $this->setData(self::NAME, $name);
    }
    public function setCreatedAt(\DateTime $createdAt):StalkerInterface{
        return $this->setData(self::CREATED_AT, $createdAt->format('Y-m-d H:i:s'));
    }
}