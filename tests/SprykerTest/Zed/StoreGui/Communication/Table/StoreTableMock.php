<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\StoreGui\Communication\Table;

use Spryker\Zed\StoreGui\Communication\Table\StoreTable;
use Symfony\Component\HttpFoundation\Request;

class StoreTableMock extends StoreTable
{
    protected function getRequest(): Request
    {
        return new Request();
    }

    public function fetchData(): array
    {
        return $this->init()->prepareData($this->config);
    }
}
