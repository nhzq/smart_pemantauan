<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\Project;

class MailController extends Controller
{
    public function contractEnd($project_id)
    {
        $project = Project::find($project_id);
        $contractor = '';

        if (!empty($project->contractorAppointment)) {
            $contractor = $project->contractorAppointment;
        }

        Mail::send('modules.emails.contract_ends', ['project' => $project, 'contractor' => $contractor], function ($message) use ($contractor) {
            $message->from('first.noorhaziq@gmail.com', 'Dari SUK');
            $message->to($contractor->company_email)->subject('Peringatan Tempoh Akhir Kontrak');
        });

        return redirect()->back();
    }
}
