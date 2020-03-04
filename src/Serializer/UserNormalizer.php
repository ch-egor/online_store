<?php

namespace App\Serializer;

use App\Entity\User;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class UserNormalizer implements ContextAwareNormalizerInterface
{
    /** @var ObjectNormalizer */
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @inheritDoc
     * @param User $object
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        unset($data['password']);
        unset($data['salt']);

        return $data;
    }

    /**
     * @inheritdoc
     */
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof User;
    }
}