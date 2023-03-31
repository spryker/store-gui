<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\StoreGui\Communication\Plugin\Form;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Kernel\Communication\Form\FormTypeInterface;
use Spryker\Zed\StoreGui\Communication\Form\Type\StoreRelationDropdownType;

/**
 * @method \Spryker\Zed\StoreGui\Communication\StoreGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\StoreGui\StoreGuiConfig getConfig()
 */
class StoreRelationDropdownFormTypePlugin extends AbstractPlugin implements FormTypeInterface
{
    /**
     * {@inheritDoc}
     * - Gets store relation dropdown type.
     *
     * @api
     *
     * @return string
     */
    public function getType()
    {
        return StoreRelationDropdownType::class;
    }
}
