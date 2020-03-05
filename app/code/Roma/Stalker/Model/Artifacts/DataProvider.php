<?php
namespace Roma\Stalker\Model\Artifacts;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\UrlInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Roma\Stalker\Api\Data\ArtifactsInterface;
use Roma\Stalker\Model\ArtefactsModel;
use Roma\Stalker\Model\ResourceModel\Artefacts\CollectionFactory as ArtifactsCollectionFactory;
use Roma\Stalker\Model\ResourceModel\Artefacts\Collection as ArtifactsCollection;

/**
 * Class DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var ArtifactsCollection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array|null
     */
    protected $loadedData;

    /**
     * Url Builder
     *
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ArtifactsCollectionFactory $artifactsCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param UrlInterface $urlBuilder
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ArtifactsCollectionFactory $artifactsCollectionFactory,
        DataPersistorInterface $dataPersistor,
        UrlInterface $urlBuilder,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $artifactsCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        if ($this->loadedData === null) {
            $this->loadedData = [];
            $items = $this->collection->getItems();
            /** @var ArtifactsInterface $artifacts */
            foreach ($items as $artifacts) {
                $this->loadedData[$artifacts->getId()] = $this->prepareData($artifacts);
            }

            $data = $this->dataPersistor->get('artifacts');
            if (!empty($data)) {
                $artifacts = $this->collection->getNewEmptyItem();
                $artifacts->setData($data);
                $this->loadedData[$artifacts->getId()] = $this->prepareData($artifacts);
                $this->dataPersistor->clear('artifacts');
            }
        }

        return $this->loadedData;
    }

    /**
     * @param ArtifactsInterface|ArtefactsModel $artifacts
     * @return array
     */
    private function prepareData($artifacts)
    {
        $data = $artifacts->getData();
        return $data;
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function getFileUrl($fileName)
    {
        return $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . 'artifacts/' . $fileName;
    }
}