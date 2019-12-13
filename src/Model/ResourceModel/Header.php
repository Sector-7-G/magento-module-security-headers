<?php
/**
 * Copyright © 2019 magento2. All rights reserved.
 */

namespace Sector7G\SecurityHeaders\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Sector7G\SecurityHeaders\Api\Data\HeaderInterface;

class Header extends AbstractDb
{
    protected function _construct()
    {
        $this->_init(HeaderInterface::TABLE_NAME, HeaderInterface::KEY_HEADER_ID);
    }
}