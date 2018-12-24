<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BspkTransfer as Bspk;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BspkTransferController extends Controller
{
    public function index() 
    {
        $bspk = Bspk::where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->paginate(20);

        return view('modules.financial.transfer.BSPK.index', [
            'bspk' => $bspk
        ]);
    }
}
