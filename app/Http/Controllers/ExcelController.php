<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Exports\ProjectsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export(Request $request)
    {
        $data = Project::query();

        if (!empty($request->get_year)) {
            $data = $data->where('created_at', 'LIKE', '%' . $request->get_year . '%');
        }

        if (!empty($request->get_name)) {
            $data = $data->where('name', 'LIKE', '%' . $request->get_name . '%');
        }

        $data = $data->where('active', 1)->get();

        return Excel::download(new ProjectsExport($data), 'projects.xlsx');
        // return view('templates.project', [
        //     'data' => $data
        // ]);
    }    
}
