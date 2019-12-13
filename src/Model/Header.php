<?php
/**
 * Copyright © 2019 magento2. All rights reserved.
 */

namespace Sector7G\SecurityHeaders\Model;

use Magento\Framework\Model\AbstractModel;
use Sector7G\SecurityHeaders\Api\Data\HeaderInterface;
use Sector7G\SecurityHeaders\Exception\HeaderLengthException;

class Header extends AbstractModel implements HeaderInterface
{
    /**
     * @return $this
     * @throws HeaderLengthException
     */
    public function beforeSave()
    {
        if (
            (
                $this->dataHasChangedFor(self::KEY_NAME)
                || $this->dataHasChangedFor(self::KEY_VALUE)
            )
            && strlen($this->getName() . ': ' . $this->getValue()) > 8190
        ) {
            throw new HeaderLengthException(
                __('Safe header length of 8190 bytes has been exceeded.')
            );
        }

        return parent::beforeSave();
    }

    public function getHeaderId()
    {
        return $this->getData(self::KEY_HEADER_ID);
    }

    public function getIsActive()
    {
        return $this->getData(self::KEY_IS_ACTIVE);
    }

    public function getName()
    {
        return $this->getData(self::KEY_NAME);
    }

    public function getStoreId()
    {
        return $this->getData(self::KEY_STORE_ID);
    }

    public function getValue()
    {
        return $this->getData(self::KEY_VALUE);
    }

    public function setHeaderId($id)
    {
        $this->setData(self::KEY_HEADER_ID, $id);
        return $this;
    }

    public function setIsActive($bool)
    {
        $this->setData(self::KEY_IS_ACTIVE, $bool);
        return $this;
    }

    public function setName($name)
    {
        $this->setData(self::KEY_NAME, $name);
        return $this;
    }

    public function setStoreId($id)
    {
        $this->setData(self::KEY_STORE_ID, $id);
        return $this;
    }

    public function setValue($value)
    {
        $this->setData(self::KEY_VALUE, $value);
        return $this;
    }

    protected function _construct()
    {
        $this->_init(\Sector7G\SecurityHeaders\Model\ResourceModel\Header::class);
    }
}