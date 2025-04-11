<?php
namespace App\Enum;
enum Approval{
    case Approved = 'Diterima';
    case Rejected = 'Ditolak';
    case Pending = 'Menunggu';
}
?>
