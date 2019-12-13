<?php
/**
 * Copyright © 2019 Brett Patterson. All rights reserved.
 */

namespace Sector7G\SecurityHeaders\Api\Data;

/**
 * Interface HeaderInterface
 *
 * @package Sector7G\SecurityHeaders\Api\Data
 */
interface HeaderInterface
{
    const TABLE_NAME = 'sector7g_securityheaders_header';

    const KEY_HEADER_ID = 'header_id';
    const KEY_STORE_ID = 'store_id';
    const KEY_NAME = 'name';
    const KEY_VALUE = 'value';
    const KEY_IS_ACTIVE = 'is_active';

    /**
     * @return int|null
     */
    public function getHeaderId();

    /**
     * @return int|null
     */
    public function getStoreId();

    /**
     * @return string|null
     */
    public function getName();

    /**
     * @return string|null
     */
    public function getValue();

    /**
     * @return bool
     */
    public function getIsActive();

    /**
     * @param int $id
     * @return $this
     */
    public function setHeaderId($id);

    /**
     * @param int $id
     * @return $this
     */
    public function setStoreId($id);

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value);

    /**
     * @param bool $bool
     * @return $this
     */
    public function setIsActive($bool);
}