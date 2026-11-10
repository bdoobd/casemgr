<?php

namespace Src\DTO;

class ChangeUserPasswordDTO
{
    public function __construct(
        public readonly string $password,
        public readonly string $password_confirm
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            password: $data['password'],
            password_confirm: $data['password_confirm']
        );
    }
}
