<?php
// src/DataTransformer/BookDtoInputDataTransformer.php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\BookDto;

final class BookInputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $BookDto = new BookDto();
        $BookDto->isbn = $data->isbn;

        return $BookDto;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a BookDto we transformed the data already
        if ($data instanceof BookDto) {
          return false;
        }

        return BookDto::class === $to && null !== ($context['input']['class'] ?? null);
    }
}