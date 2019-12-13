<?php
/**
 * Copyright © 2019 magento2. All rights reserved.
 */

namespace Sector7G\SecurityHeaders\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Data\CollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Store\Model\StoreManagerInterface;
use Sector7G\SecurityHeaders\Api\Data\HeaderInterface;
use Sector7G\SecurityHeaders\Api\Data\HeaderSearchResultsInterface;
use Sector7G\SecurityHeaders\Api\Data\HeaderSearchResultsInterfaceFactory;
use Sector7G\SecurityHeaders\Api\HeaderRepositoryInterface;

class HeaderRepository implements HeaderRepositoryInterface
{
    /** @var CollectionFactory */
    protected $collectionFactory;

    /** @var CollectionProcessorInterface */
    protected $collectionProcessor;

    /** @var AbstractDb */
    protected $resourceModel;

    /** @var HeaderSearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    /** @var StoreManagerInterface */
    protected $storeManager;

    public function __construct(
        AbstractDb $resourceModel,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        HeaderSearchResultsInterfaceFactory $searchResultsFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->resourceModel = $resourceModel;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @param HeaderInterface $header
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(HeaderInterface $header)
    {
        try {
            $this->resourceModel->delete($header);
        } catch (\Exception $e) {
            throw new LocalizedException(
                __('Could not delete header: %1', $e->getMessage())
            );
        }
    }

    /**
     * @param int $headerId
     *
     * @return \Magento\Framework\DataObject|HeaderInterface
     * @throws NoSuchEntityException
     * @throws NotFoundException
     */
    public function getById($headerId)
    {
        $header = $this->collectionFactory->create()
            ->addFieldToFilter(HeaderInterface::KEY_HEADER_ID, $headerId)
            ->getFirstItem();

        if (!($header instanceof HeaderInterface)) {
            throw new NoSuchEntityException(__('Header with specified ID does not exist'));
        }

        if ($header->getHeaderId() != $headerId) {
            throw new NotFoundException(__('Header with specified ID was not found'));
        }

        return $header;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return HeaderSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var HeaderSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria)
            ->setTotalCount($collection->getSize())
            ->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * @param HeaderInterface $header
     *
     * @return HeaderInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function save(HeaderInterface $header)
    {
        if ($header->getStoreId() === null) {
            $header->setStoreId($this->storeManager->getStore()->getId());
        }

        try {
            $this->resourceModel->save($header);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('Could not save the header: %1', $e->getMessage()),
                $e
            );
        }

        return $header;
    }
}