<?php

namespace App\Imports;

use App\Alumni;
use App\User;
use App\Notifications\ImportHasFailedNotification;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Carbon\Carbon;

class AlumniImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithEvents, SkipsOnFailure
{
    use RemembersChunkOffset;
    use RemembersRowNumber;
    use SkipsFailures;
    use SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct(User $importedBy = null)
    {
        $this->importedBy = $importedBy;
    }

    public function model(array $row)
    {
        $chunkOffset = $this->getChunkOffset();
        $currentRowNumber = $this->getRowNumber();

        return new Alumni([
            'nim'           => $row['nim'],
            'nama_alumni'   => $row['nama_alumni'],
            'tmp_lahir'     => $row['tempat_lahir'],
            'tgl_lahir'     => $row['tanggal_lahir'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'alamat'        => $row['alamat'],
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function(ImportFailed $event) {
                $this->importedBy->notify(new ImportHasFailedNotification);
            },
        ];
    }
}
