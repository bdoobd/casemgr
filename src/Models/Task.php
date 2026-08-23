<?php

namespace App\Models;

use DateTimeImmutable;

class Task
{
    public int $id = 0;
    public int $case_id = 0;
    public string $client = '';
    public string $shipper = '';
    public int $network_id = 0;
    public int $method_id = 0;
    public int $term_id = 0;
    public int $destination_id = 0;
    public DateTimeImmutable $start_date;
    public ?DateTimeImmutable $departire_date;
    public int $cargo_id = 0;
    public int $transport_id = 0;
    public int $document_id = 0;
    public string $invoice_number = '';
    public bool $archived = false;
    public int $task_id = 0;
    public string $comment = '';
    public int $user_id = 0;
    public int $status_id = 0;

    public static function table_name(): string
    {
        return 'cases';
    }
}
