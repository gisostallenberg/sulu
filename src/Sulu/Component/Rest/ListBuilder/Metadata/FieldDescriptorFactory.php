<?php

namespace Sulu\Component\Rest\ListBuilder\Metadata;

use Sulu\Component\Rest\ListBuilder\Doctrine\FieldDescriptor\DoctrineFieldDescriptor;
use Sulu\Component\Rest\ListBuilder\Doctrine\FieldDescriptor\DoctrineJoinDescriptor;
use Sulu\Component\Rest\ListBuilder\Metadata\Doctrine\DoctrinePropertyMetadata;
use Sulu\Component\Rest\ListBuilder\Metadata\General\PropertyMetadata as GeneralPropertyMetadata;

class FieldDescriptorFactory implements FieldDescriptorFactoryInterface
{
    /**
     * @var ProviderInterface
     */
    private $metadataProvider;

    public function __construct(ProviderInterface $metadataProvider)
    {
        $this->metadataProvider = $metadataProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getFieldDescriptorForClass($className)
    {
        $metadata = $this->metadataProvider->getMetadataForClass($className);

        $fieldDescriptor = [];
        /** @var PropertyMetadata $propertyMetadata */
        foreach ($metadata->propertyMetadata as $propertyMetadata) {
            if (!$propertyMetadata->has(DoctrinePropertyMetadata::class)
                || !$propertyMetadata->has(GeneralPropertyMetadata::class)
            ) {
                continue;
            }

            /** @var DoctrinePropertyMetadata $doctrineMetadata */
            $doctrineMetadata = $propertyMetadata->get(DoctrinePropertyMetadata::class);
            /** @var GeneralPropertyMetadata $generalMetadata */
            $generalMetadata = $propertyMetadata->get(GeneralPropertyMetadata::class);

            $joins = [];
            foreach ($doctrineMetadata->getJoins() as $joinMetadata) {
                $joins[] = new DoctrineJoinDescriptor(
                    $joinMetadata->getEntityName(),
                    $joinMetadata->getEntityField(),
                    $joinMetadata->getCondition(),
                    $joinMetadata->getMethod(),
                    $joinMetadata->getConditionMethod()
                );
            }

            $fieldDescriptor[] = new DoctrineFieldDescriptor(
                $doctrineMetadata->getFieldName(),
                $generalMetadata->getName(),
                $doctrineMetadata->getEntityName(),
                $generalMetadata->getTranslation(),
                $joins,
                $generalMetadata->isDisabled(),
                $generalMetadata->isDefault(),
                $generalMetadata->getType(),
                $generalMetadata->getWith(),
                $generalMetadata->getMinWidth(),
                $generalMetadata->isSortable(),
                $generalMetadata->isEditable(),
                $generalMetadata->getCssClass()
            );
        }

        return $fieldDescriptor;
    }
}
