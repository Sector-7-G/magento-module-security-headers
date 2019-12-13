<?php
/**
 * Copyright © 2019 Brett Patterson. All rights reserved.
 */

namespace Sector7G\SecurityHeaders\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for Header search results
 *
 * @package Sector7G\SecurityHeaders\Api\Data
 */
interface HeaderSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get headers list
     *
     * @return \Sector7G\SecurityHeaders\Api\Data\HeaderInterface[]
     */
    public function getItems();

    /**
     * Set headers list
     *
     * @param \Sector7G\SecurityHeaders\Api\Data\HeaderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}