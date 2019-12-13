<?php
/**
 * Copyright © 2019 magento2. All rights reserved.
 */

namespace Sector7G\SecurityHeaders\Model\ResourceModel\Header;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Sector7G\SecurityHeaders\Model\Header;

class Collection extends AbstractCollection
{
    protected $_eventPrefix = 'sector7g_securityheaders_header_collection';

    protected function _construct()
    {
        $this->_init(Header::class, \Sector7G\SecurityHeaders\Model\ResourceModel\Header::class);
    }
}