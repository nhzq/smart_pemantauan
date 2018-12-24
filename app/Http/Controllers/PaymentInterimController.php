<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Helpers\Status;

class PaymentInterimController extends Controller
{
    public function store($project_id, Request $request)
    {
        // $project = Project::find($project_id);

        // $project->status = Status::notify_for_payment();
        // $project->save();

        // return redirect()
        //     ->back()
        //     ->with('success', 'Maklumat Pembayaran Kontrak telah dikemaskini kepada pihak kewangan.');
    }
}
