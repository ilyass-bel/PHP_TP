<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Dto\BookInput;
use App\Dto\BookOutput;

#[ApiResource(input: BookInput::class, output: BookOutput::class)]
final class BookDto
{
    public $id;
}