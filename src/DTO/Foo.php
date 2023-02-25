<?php
declare(strict_types = 1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

readonly class Foo
{
    public function __construct(
        #[Assert\NotNull]
        private ?bool $active = null,
    ) {
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }
}
