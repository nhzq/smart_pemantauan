<table>
    <thead>
        <tr>
            <th colspan="7">Senarai Projek</th>
        </tr>
        <tr>
            <th style="min-width:900px;">Nama Projek</th>
            <th>Pindah Peruntukan - Dari (RM)</th>
            <th>Pindah Peruntukan - Ke (RM)</th>
            <th>Anggaran Kos (RM)</th>
            <th>Kos Projek (RM)</th>
            <th>Jumlah Belanja (RM)</th>
            <th>Baki Belanja (RM)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $project)
            <?php 
                $from_transfer = 0;
                $to_transfer = 0;

                if (!empty($data->bspkTransfers)) {
                    $from_transfer = $data->bspkTransfers()
                        ->where('from_project_id', $data->id)
                        ->where('active', 1)
                        ->where('bspk_transfers.created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                        ->sum('transfer_amount');

                    $to_transfer = $data->bspkTransfers()
                        ->where('to_project_id', $data->id)
                        ->where('active', 1)
                        ->where('bspk_transfers.created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                        ->sum('transfer_amount');
                }
            ?>
            <tr>
                <td>{{ $project->name }}</td>
                <td>{{ '-' . currency($from_transfer) }}</td>
                <td>{{ currency($to_transfer) }}</td>
                <td>{{ currency($project->estimate_cost) }}</td>
                <td>{{ currency($project->actual_project_cost) }}</td>
                <td>{{ '0.00' }}</td>
                <td>{{ '0.00' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>