<?php

namespace App\DTO;

use DateTimeImmutable;

class ShowUserWithRoleDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $username,
        public readonly DateTimeImmutable $created,
        public readonly ?DateTimeImmutable $modified,
        public readonly string $role
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int)$data['id'],
            username: $data['username'],
            created: new DateTimeImmutable($data['created']),
            modified: isset($data['modified']) ? new DateTimeImmutable($data['modified']) : null,
            role: $data['role']
        );
    }
}
