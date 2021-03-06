<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\AdminBundle\ResourceMetadata;

use Sulu\Bundle\AdminBundle\ResourceMetadata\Datagrid\Datagrid;
use Sulu\Bundle\AdminBundle\ResourceMetadata\Datagrid\DatagridInterface;
use Sulu\Bundle\AdminBundle\ResourceMetadata\Endpoint\EndpointInterface;
use Sulu\Bundle\AdminBundle\ResourceMetadata\Form\Form;
use Sulu\Bundle\AdminBundle\ResourceMetadata\Form\FormInterface;
use Sulu\Bundle\AdminBundle\ResourceMetadata\Schema\Schema;
use Sulu\Bundle\AdminBundle\ResourceMetadata\Schema\SchemaInterface;

class ResourceMetadata implements ResourceMetadataInterface, DatagridInterface, FormInterface, SchemaInterface, EndpointInterface
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var Datagrid
     */
    private $datagrid;

    /**
     * @var Form
     */
    private $form;

    /**
     * @var Schema
     */
    private $schema;

    /**
     * @var string
     */
    private $endpoint;

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getDatagrid(): ?Datagrid
    {
        return $this->datagrid;
    }

    public function setDatagrid(?Datagrid $datagrid): void
    {
        $this->datagrid = $datagrid;
    }

    public function getForm(): Form
    {
        return $this->form;
    }

    public function setForm(Form $form): void
    {
        $this->form = $form;
    }

    public function getSchema(): Schema
    {
        return $this->schema;
    }

    public function setSchema(Schema $schema): void
    {
        $this->schema = $schema;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }
}
