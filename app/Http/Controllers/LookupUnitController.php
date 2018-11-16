<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LookupUnit as Unit;
use App\Models\LookupSection as Section;

class LookupUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:superadmin']);
    }

    public function index()
    {
        $units = Unit::all();

        return view('modules.settings.lookupUnit.index', [
            'units' => $units
        ]);
    }

    public function edit($id)
    {
        $unit = Unit::find($id);
        $sections = Section::all();

        return view('modules.settings.lookupUnit.edit', [
            'unit' => $unit,
            'sections' => $sections
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'unit_displayed_name' => 'required|string|min:3',
            'unit_assign_to' => 'required|not_in:0'
        ]);

        $unit = Unit::find($id);
        $unit->lookup_section_id = $request->unit_assign_to;
        $unit->displayed_name = $request->unit_displayed_name;
        $unit->save();

        return redirect()
            ->route('units.index')
            ->with('success', 'Unit has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
