<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\StoreGui\Communication\Form;

use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\StoreGui\Communication\Form\UpdateStoreForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

/**
 * Skips the store form expander plugins so the form can be built by a standalone Symfony form
 * factory, without resolving the whole StoreGui communication factory.
 */
class UpdateStoreFormStub extends UpdateStoreForm
{
    public const string FIELD_ID_STORE_NAME = self::FIELD_ID_STORE;

    public const string FIELD_NAME_NAME = self::FIELD_NAME;

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
    }

    protected function executeStoreFormExpanderPlugins(FormBuilderInterface $builder, StoreTransfer $storeTransfer)
    {
        return $this;
    }
}
