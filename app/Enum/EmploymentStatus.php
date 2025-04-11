<?php
namespace App\Enum;

enum EmploymentStatus: string{
    case PERMANENT = 'Karyawan Tetap';
    case CONTRACT = 'Karyawan Kontrak';
    case INTERN = 'Mahasiswa Magang';
}




?>
