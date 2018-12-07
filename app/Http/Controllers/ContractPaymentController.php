<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ContractPaymentController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.contract-payment.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.contract-payment.create', [
            'project' => $project
        ]);
    }
}
