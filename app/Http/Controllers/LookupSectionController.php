<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LookupSection as Section;

class LookupSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:superadmin']);
    }

    public function index()
    {
        $sections = Section::all();

        return view('modules.settings.lookupSection.index', [
            'sections' => $sections
        ]);
    }

    public function edit($id)
    {
        $section = Section::find($id);

        return view('modules.settings.lookupSection.edit', [
            'section' => $section
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'section_displayed_name' => 'required|string|min:3'
        ]);

        $section = Section::find($id);
        $section->displayed_name = $request->section_displayed_name;
        $section->save();

        return redirect()
            ->route('sections.index')
            ->with('success', 'Seksyen telah berjaya dikemaskini.');
    }
}
