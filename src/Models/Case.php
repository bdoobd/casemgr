<?php 

namespace App\Models;

class Case {
    public int $id = 0;
    public string $case_id = ''; #Строка типа ATC1234567
    public string $client = '':
    public string $shipper = '';
    public int $network_id = 0;
    public int $method_id = 0;
    public int $term_id = 0;
    public int $destination_id = 0;
    public datetime $start_date
    public datetime $departure_date;
    public int $cargo_id = 0;
    public int $transport_id = 0;
    public int $document_id = 0;
    public string $invoice_number = '';
    public bool $archived = false;
    public int $task_id = 0;
    public string $comments = '';
    public int $user_id = 0;
    public int $status_id = 0;

    public static function table_name(): string {
        return 'cases';
    }
}