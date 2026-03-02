<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\StoreGui\Communication;

use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\StoreGui\Communication\Expander\StoreListDataExpander;
use Spryker\Zed\StoreGui\Communication\Expander\StoreListDataExpanderInterface;
use Spryker\Zed\StoreGui\Communication\Form\CreateStoreForm;
use Spryker\Zed\StoreGui\Communication\Form\DataProvider\StoreFormDataProvider;
use Spryker\Zed\StoreGui\Communication\Form\DataProvider\StoreRelationDropdownDataProvider;
use Spryker\Zed\StoreGui\Communication\Form\Transformer\IdStoresDataTransformer;
use Spryker\Zed\StoreGui\Communication\Form\UpdateStoreForm;
use Spryker\Zed\StoreGui\Communication\Table\StoreTable;
use Spryker\Zed\StoreGui\Communication\Tabs\StoreFormTabs;
use Spryker\Zed\StoreGui\Dependency\Facade\StoreGuiToStoreFacadeInterface;
use Spryker\Zed\StoreGui\Dependency\Service\StoreGuiToUtilEncodingServiceInterface;
use Spryker\Zed\StoreGui\StoreGuiDependencyProvider;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @method \Spryker\Zed\StoreGui\StoreGuiConfig getConfig()
 */
class StoreGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createStoreTable(): StoreTable
    {
        return new StoreTable(
            $this->getStorePropelQuery(),
            $this->getStoreTableExpanderPlugins(),
            $this->getStoreFacade(),
        );
    }

    public function createStoreRelationDropdownDataProvider(): StoreRelationDropdownDataProvider
    {
        return new StoreRelationDropdownDataProvider($this->getStoreFacade());
    }

    /**
     * @return \Symfony\Component\Form\DataTransformerInterface<array<int, int>|null, string|null>
     */
    public function createIdStoresDataTransformer(): DataTransformerInterface
    {
        return new IdStoresDataTransformer($this->getUtilEncodingService());
    }

    public function getStorePropelQuery(): SpyStoreQuery
    {
        return $this->getProvidedDependency(StoreGuiDependencyProvider::PROPEL_QUERY_STORE);
    }

    public function getUtilEncodingService(): StoreGuiToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(StoreGuiDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    public function createStoreFormDataProvider(): StoreFormDataProvider
    {
        return new StoreFormDataProvider($this->getStoreFacade());
    }

    public function createStoreFormTabs(): StoreFormTabs
    {
        return new StoreFormTabs(
            $this->getStoreFormTabsExpanderPlugins(),
        );
    }

    public function getCreateStoreForm(?StoreTransfer $data = null, array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(CreateStoreForm::class, $data, $options);
    }

    public function getUpdateStoreForm(?StoreTransfer $data = null, array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(UpdateStoreForm::class, $data, $options);
    }

    public function getStoreFacade(): StoreGuiToStoreFacadeInterface
    {
        return $this->getProvidedDependency(StoreGuiDependencyProvider::FACADE_STORE);
    }

    /**
     * @return array<\Spryker\Zed\StoreGuiExtension\Dependency\Plugin\StoreFormExpanderPluginInterface>
     */
    public function getStoreFormExpanderPlugins(): array
    {
        return $this->getProvidedDependency(StoreGuiDependencyProvider::PLUGINS_STORE_FORM_EXPANDER);
    }

    /**
     * @return array<\Spryker\Zed\StoreGuiExtension\Dependency\Plugin\StoreFormViewExpanderPluginInterface>
     */
    public function getStoreFormViewExpanderPlugins(): array
    {
        return $this->getProvidedDependency(StoreGuiDependencyProvider::PLUGINS_STORE_FORM_VIEW_EXPANDER);
    }

    /**
     * @return array<\Spryker\Zed\StoreGuiExtension\Dependency\Plugin\StoreFormTabExpanderPluginInterface>
     */
    public function getStoreFormTabsExpanderPlugins(): array
    {
        return $this->getProvidedDependency(StoreGuiDependencyProvider::PLUGINS_STORE_FORM_TABS_EXPANDER);
    }

    /**
     * @return array<\Spryker\Zed\StoreGuiExtension\Dependency\Plugin\StoreTableExpanderPluginInterface>
     */
    public function getStoreTableExpanderPlugins(): array
    {
        return $this->getProvidedDependency(StoreGuiDependencyProvider::PLUGINS_STORE_TABLE_EXPANDER);
    }

    /**
     * @return array<\Spryker\Zed\StoreGuiExtension\Dependency\Plugin\StoreViewExpanderPluginInterface>
     */
    public function getStoreViewExpanderPlugins(): array
    {
        return $this->getProvidedDependency(StoreGuiDependencyProvider::PLUGINS_STORE_VIEW_EXPANDER);
    }

    public function createStoreListDataExpander(): StoreListDataExpanderInterface
    {
        return new StoreListDataExpander($this->getStoreFacade(), $this->getRequest());
    }

    public function getRequest(): ?Request
    {
        return $this->getRequestStack()->getCurrentRequest();
    }

    public function getRequestStack(): RequestStack
    {
        return $this->getProvidedDependency(StoreGuiDependencyProvider::SERVICE_REQUEST_STACK);
    }
}
