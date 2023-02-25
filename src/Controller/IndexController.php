<?php

namespace App\Controller;

use App\DTO\Foo;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsController]
readonly class IndexController
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    #[Route(path: '/')]
    public function __invoke(): JsonResponse
    {
        $dto = new Foo();

        /* And if you pass boolean value then you don't see that error anymore */
        //$dto = new Foo(true);

        $violations = $this->validator->validate($dto);

        $data = ($violations->count() > 0)
            ? array_map(
                static fn (ConstraintViolationInterface $violation): string => $violation->getMessage(),
                iterator_to_array($violations),
            ) : $dto->getActive();

        return new JsonResponse($data);
    }
}
