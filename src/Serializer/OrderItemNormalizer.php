<?php

namespace App\Serializer;

use App\Entity\OrderItem;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class OrderItemNormalizer implements ContextAwareNormalizerInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @inheritDoc
     * @param OrderItem $object
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        $context[AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER] = function ($object, $format, $context) {
            return $object->getId();
        };

        $data = $this->normalizer->normalize($object, $format, $context);

        return $data;
    }

    /**
     * @inheritdoc
     */
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof OrderItem;
    }
}