<?php

namespace App\Serializer;

use App\Entity\Article;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ArticleNormalizer implements ContextAwareNormalizerInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @inheritDoc
     * @param Article $object
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        return $data;
    }

    /**
     * @inheritdoc
     */
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Article;
    }
}