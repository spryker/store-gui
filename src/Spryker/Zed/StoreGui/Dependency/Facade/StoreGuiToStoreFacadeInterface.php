<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\StoreGui\Dependency\Facade;

use Generated\Shared\Transfer\StoreResponseTransfer;
use Generated\Shared\Transfer\StoreTransfer;

interface StoreGuiToStoreFacadeInterface
{
    public function isMultiStorePerZedEnabled(): bool;

    /**
     * @return array<\Generated\Shared\Transfer\StoreTransfer>
     */
    public function getAllStores(): array;

    public function getStoreById(int $idStore): StoreTransfer;

    public function createStore(StoreTransfer $storeTransfer): StoreResponseTransfer;

    public function updateStore(StoreTransfer $storeTransfer): StoreResponseTransfer;

    public function isDynamicStoreEnabled(): bool;
}
