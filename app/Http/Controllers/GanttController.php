<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class GanttController extends Controller
{
    public function planning($project_id)
    {
        $project = Project::find($project_id);
        $activity = $project->schedules;

        $result = [];

        $parent_activities = $project->schedules()
            ->where('parent_id', 0)
            ->get();

        foreach ($parent_activities as $parent) {
            $sub_activities = $project->schedules()
                ->where('parent_id', $parent->id)
                ->get();

            $result[] = [
                'name' => $parent->activity
            ];

            foreach ($sub_activities as $sub) {
                $result[] = [
                    'desc' => $sub->activity,
                    'values' => [
                        [
                            'from' => '/Date(' . strtotime($sub->start_date) . '000)/',
                            'to' => '/Date(' . strtotime($sub->end_date) . '000)/',
                            'label' => '',
                            'customClass' => 'ganttGreen'
                        ]
                    ]
                ];
            }
        }

        $data = json_encode($result);

        return view('modules.gantt.planning', [
            'project' => $project,
            'data' => $data
        ]);
    }

    public function collection($project_id)
    {
        $project = Project::find($project_id);
        $activity = $project->schedules;

        $result = [];

        $parent_activities = $project->schedules()
            ->where('parent_id', 0)
            ->get();

        foreach ($parent_activities as $parent) {
            $sub_activities = $project->schedules()
                ->where('parent_id', $parent->id)
                ->get();

            $result[] = [
                'name' => $parent->activity
            ];

            foreach ($sub_activities as $sub) {
                $result[] = [
                    'desc' => $sub->activity,
                    'values' => [
                        [
                            'from' => '/Date(' . strtotime($sub->start_date) . '000)/',
                            'to' => '/Date(' . strtotime($sub->end_date) . '000)/',
                            'label' => '',
                            'customClass' => 'ganttGreen'
                        ]
                    ]
                ];
            }
        }

        $data = json_encode($result);

        return view('modules.gantt.collection', [
            'project' => $project,
            'data' => $data
        ]);
    }
}
