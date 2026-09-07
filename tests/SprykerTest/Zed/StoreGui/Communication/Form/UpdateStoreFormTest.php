<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\StoreGui\Communication\Form;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\StoreTransfer;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

/**
 * Verifies that the read-only store name survives a form submit. The browser does not send a
 * disabled input, so a name field that is only disabled through its HTML attributes gets mapped
 * back onto the store transfer as `null`.
 *
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group StoreGui
 * @group Communication
 * @group Form
 * @group UpdateStoreFormTest
 * Add your own group annotations below this line
 */
class UpdateStoreFormTest extends Unit
{
    protected const int ID_STORE = 1;

    protected const string STORE_NAME = 'DE';

    protected const string STORE_NAME_FROM_REQUEST = 'HACKED';

    protected FormFactoryInterface $formFactory;

    protected function _before(): void
    {
        $this->formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new ValidatorExtension(Validation::createValidatorBuilder()->getValidator()))
            ->getFormFactory();
    }

    public function testGivenDisabledNameFieldWhenFormIsSubmittedWithoutNameThenStoreNameIsKept(): void
    {
        // Arrange
        $storeTransfer = $this->createStoreTransfer();
        $storeForm = $this->createStoreForm($storeTransfer);

        // Act
        $storeForm->submit([
            UpdateStoreFormStub::FIELD_ID_STORE_NAME => (string)static::ID_STORE,
        ]);

        // Assert
        $this->assertTrue($storeForm->isValid());
        $this->assertSame(static::STORE_NAME, $storeTransfer->getName());
    }

    public function testGivenDisabledNameFieldWhenFormIsSubmittedWithAnotherNameThenStoreNameIsKept(): void
    {
        // Arrange
        $storeTransfer = $this->createStoreTransfer();
        $storeForm = $this->createStoreForm($storeTransfer);

        // Act
        $storeForm->submit([
            UpdateStoreFormStub::FIELD_ID_STORE_NAME => (string)static::ID_STORE,
            UpdateStoreFormStub::FIELD_NAME_NAME => static::STORE_NAME_FROM_REQUEST,
        ]);

        // Assert
        $this->assertTrue($storeForm->isValid());
        $this->assertSame(static::STORE_NAME, $storeTransfer->getName());
    }

    protected function createStoreTransfer(): StoreTransfer
    {
        return (new StoreTransfer())
            ->setIdStore(static::ID_STORE)
            ->setName(static::STORE_NAME);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface<\Generated\Shared\Transfer\StoreTransfer>
     */
    protected function createStoreForm(StoreTransfer $storeTransfer)
    {
        return $this->formFactory->create(UpdateStoreFormStub::class, $storeTransfer, [
            'data_class' => StoreTransfer::class,
        ]);
    }
}
