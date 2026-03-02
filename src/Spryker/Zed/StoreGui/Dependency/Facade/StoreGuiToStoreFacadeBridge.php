<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\StoreGui\Dependency\Facade;

use Generated\Shared\Transfer\StoreResponseTransfer;
use Generated\Shared\Transfer\StoreTransfer;

class StoreGuiToStoreFacadeBridge implements StoreGuiToStoreFacadeInterface
{
    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     */
    public function __construct($storeFacade)
    {
        $this->storeFacade = $storeFacade;
    }

    public function isMultiStorePerZedEnabled(): bool
    {
        return $this->storeFacade->isMultiStorePerZedEnabled();
    }

    /**
     * @return array<\Generated\Shared\Transfer\StoreTransfer>
     */
    public function getAllStores(): array
    {
        return $this->storeFacade->getAllStores();
    }

    public function getStoreById(int $idStore): StoreTransfer
    {
        return $this->storeFacade->getStoreById($idStore);
    }

    public function createStore(StoreTransfer $storeTransfer): StoreResponseTransfer
    {
        return $this->storeFacade->createStore($storeTransfer);
    }

    public function updateStore(StoreTransfer $storeTransfer): StoreResponseTransfer
    {
        return $this->storeFacade->updateStore($storeTransfer);
    }

    public function isDynamicStoreEnabled(): bool
    {
        return $this->storeFacade->isDynamicStoreEnabled();
    }
}
