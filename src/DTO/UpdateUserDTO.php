<?php

namespace App\DTO;

class UpdateUserDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?int $role_id,
    ) {}


    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            role_id: (int) $data['role_id']
        );
    }
}
