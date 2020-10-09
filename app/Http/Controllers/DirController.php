<?php

namespace App\Http\Controllers;

use App\County;
use App\Directory;
use App\SubCounty;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DirController extends Controller
{

    public function __construct() {
        $this->photo = asset('assets/img/default-avatar.png');
        $this->middleware(['auth']);
    }


    public  function facilities()
    {
        if (auth()->user()->user_group == 3) { //county admin
            $facilities = Directory::where('county_id', auth()->user()->county_id)->get();
        } elseif (auth()->user()->user_group == 4) { //sub county admin
            $facilities = Directory::where('sub_county_id', auth()->user()->sub_county_id)->get();
        } else { //others
            $facilities = Directory::all();
        }

        return view('directory.facilities')->with([
            'facilities' => $facilities,
        ]);
    }

    public function facilitiesDT()
    {

        if (auth()->user()->user_group == 3) { //county admin
            $facilities = Directory::where('county_id', auth()->user()->county_id)->get();
        } elseif (auth()->user()->user_group == 4) { //sub county admin
            $facilities = Directory::where('sub_county_id', auth()->user()->sub_county_id)->get();
        }elseif (auth()->user()->user_group == 2) { //partner
            $facilities = Directory::where('partner', auth()->user()->partner)->get();
        } else { //others
            $facilities = Directory::all();
        }


        return DataTables::of($facilities)
            ->editColumn('mfl_code', function ($facility) {
                return $facility->mfl_code;
            })

            ->editColumn('facility_name', function ($facility) {
                return $facility->facility_name;
            })

            ->editColumn('county', function ($facility) {
                return optional(County::find($facility->county_id))->name;
            })
            ->editColumn('sub_county', function ($facility) {
                return optional(SubCounty::find($facility->sub_county_id))->name;
            })

            ->editColumn('facility_phone', function ($facility) {
                return $facility->facility_phone;
            })

            ->addColumn('actions', function ($facility) { // add custom column
                $actions = '<div class="pull-right">';

                if (auth()->user()->role->has_perm([4])) {
                    $actions .= '<button source="' . route('edit-facility',  $facility->id) . '"
                    class="btn btn-warning btn-link btn-sm edit-facility-btn" acs-id="' . $facility->id . '">
                    <i class="material-icons">edit</i> Edit</button>';
                }

                if (auth()->user()->role->has_perm([5])) {
                    $actions .= '<form action="' . route('delete-facility',  $facility->id) . '" style="display: inline;" method="post" class="del_facility_form">';
                    $actions .= method_field('DELETE');
                    $actions .= csrf_field() . '<button class="btn btn-danger btn-sm">Delete</button></form>';
                }

                $actions .= '</div>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function add_facility(Request $request)
    {

        $this->validate($request, [
            'facility_phone' => 'required',
            'facility_name' => 'required',
            'mfl_code' => 'required',
            'partner' => 'required',
            'county_id' => 'required',
            'sub_county_id' => 'required',
            'location' => 'nullable',
            'sub_location' => 'nullable',
            'alt_facility_phone' => 'nullable',
            'email_address' => 'required',
            'clinic' => 'required',
        ]);

        $directory = new Directory();
        $directory->facility_phone = $request->facility_phone;
        $directory->facility_name = $request->facility_name;
        $directory->mfl_code = $request->mfl_code;
        $directory->partner = $request->partner;
        $directory->county_id = $request->county_id;
        $directory->sub_county_id = $request->sub_county_id;
        $directory->location = $request->location;
        $directory->sub_location = $request->sub_location;
        $directory->alt_facility_phone = $request->alt_facility_phone;
        $directory->email_address = $request->email_address;
        $directory->clinic = $request->clinic;
        $directory->saveOrFail();

        request()->session()->flash('success', 'Facility has been added to directory.');

        return redirect('facilities');
    }

    public function edit_facility($id)
    {
        $facility = Directory::find($id);
        return $facility;
    }

    public function update_facility(Request $request)
    {
        $data = request()->validate([
            'facility_phone' => 'required',
            'facility_name' => 'required',
            'mfl_code' => 'required',
            'partner' => 'required',
            'county_id' => 'required',
            'sub_county_id' => 'required',
            'location' => 'nullable',
            'sub_location' => 'nullable',
            'alt_facility_phone' => 'nullable',
            'email_address' => 'required',
            'clinic' => 'required',
        ]);

        Directory::where('id', $request->id)->update($data);

        request()->session()->flash('success', 'Facility has been updated.');
        return redirect('facilities');
    }

    public function delete_facility($id)
    {
        try {
            Directory::destroy($id);


            request()->session()->flash('success', 'Facility has been deleted.');
        } catch (QueryException $qe) {
            request()->session()->flash('warning', 'Could not delete facility because it\'s being used in the system!');
        }

        return redirect('facilities');
    }
}
