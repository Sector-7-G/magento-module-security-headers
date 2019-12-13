<?php
/**
 * Copyright © 2019 Brett Patterson. All rights reserved.
 */

namespace Sector7G\SecurityHeaders\Api;

use Sector7G\SecurityHeaders\Api\Data\HeaderInterface;

interface HeaderRepositoryInterface
{
    /**
     * @param HeaderInterface $header
     * @return bool
     */
    public function delete(HeaderInterface $header);

    /**
     *
     * @param int $headerId
     *
     * @return \Sector7G\SecurityHeaders\Api\Data\HeaderInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function getById($headerId);

    /**
     * Retrieve pages matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Sector7G\SecurityHeaders\Api\Data\HeaderSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param HeaderInterface $header
     * @return HeaderInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function save(HeaderInterface $header);
}