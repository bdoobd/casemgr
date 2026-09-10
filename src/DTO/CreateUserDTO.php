<?php 

namespace App\DTO;

class CreateUserDTO
{

    public function __construct(
        public readonly string $username,
        public readonly string $password_hash,
        public readonly int $role_id
    )
    {}
    /**
     * Создаёт объект пользователя из массива
     * Внимание поле password хешируется в поле password_hash
     * Передавать после проверки совпадения пароля и подтверждения
     * 
     * @param array $data массив данных пользователя, должен содержать ключи username, password, role_id
     * 
     * @return CreateUserDTO
     */
    public static function fromArray(array $data): self {
        return new self(
            username: trim($data['username']), 
            password_hash: password_hash($data['password'], PASSWORD_DEFAULT), 
            role_id: (int)($data['role_id'] ?? 3)
        );
    }
    
}