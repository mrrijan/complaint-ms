<?php

namespace App\Exports;

use App\Models\ComplaintStatusLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComplaintStatusLogsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ComplaintStatusLog::with('complaint', 'changedBy')->get()->map(function ($log) {
            return [
                'Complaint Title' => $log->complaint->title,
                'Changed By' => $log->changedBy->name,
                'Old Status' => $log->old_status,
                'New Status' => $log->new_status,
                'Remark' => $log->remark,
                'Changed At' => $log->created_at->toDateTimeString(),
            ];
        });
    }

    public function headings(): array
    {
        return ['Complaint Title', 'Changed By', 'Old Status', 'New Status', 'Remark', 'Changed At'];
    }
}
