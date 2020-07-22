<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\IncomingMsg;
use App\Directory;
use Illuminate\Mail\Message;
use AfricasTalking\SDK\AfricasTalking;
use Yajra\DataTables\Facades\DataTables;


class DirectoryController extends Controller
{
    public function send_sms($final_msg, $phone_no)
    {
        // $to=$request->input('to');
        // $message =$request->input('message');

        $username = env('AT_USER');
        $apiKey = env('AT_API_KEY');
        $AT = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms = $AT->sms();
        // Use the service
        $send = $sms->send([
            'from' => '40149',
            'to' => $phone_no,
            'message' => $final_msg
        ]);

        return $send['status'];
    }
    public function process_incoming($id)
    {
        $message = IncomingMsg::find($id);
        $phone_no = $message->source;
        $trimmed_msg = trim($message->msg);
        $string = 'CHECK';
        $regex = "#^" . $string . "(.*)$#i";
        $result = preg_match($regex, $trimmed_msg);
        if ($result == 0) {
            if (ctype_digit($trimmed_msg) && strlen($trimmed_msg) == 5) {
                $get_content = Directory::select('facility_phone', 'facility_name', 'county', 'sub_county', 'email_address', 'partner')->where('mfl_code', $trimmed_msg)->first();
                $final_msg = 'Facility Number: '  . $get_content->facility_phone . ' ' . 'Facility Name: ' . $get_content->facility_name . ' ' . 'County: ' .
                    $get_content->county . ' ' . 'Sub County: ' . $get_content->sub_county . ' ' . 'Email: '  . $get_content->email_address . ' ' . 'Partner: '  . $get_content->partner;

                $sending_msg = $this->send_sms($final_msg, $phone_no);
                echo $sending_msg;
            }
        } else if ($result == 1) {
            $arr_content = explode('/', $trimmed_msg);
            $arr_facility = $arr_content[1];
            $arr_fnl_content = preg_replace('/[^A-Za-z0-9\-]/', '', $arr_facility);
            $get_details = Directory::select('facility_phone', 'facility_name', 'county', 'sub_county', 'email_address', 'partner', 'mfl_code')->where('facility_name', 'LIKE', "%{$arr_fnl_content}%")->get();
            foreach ($get_details as $detail) {

                $final_msg = 'Facility Name: ' . $detail->facility_name . ' ' . 'MFL Code: ' . $detail->mfl_code . ' ' . 'County: ' . $detail->county;
                $sending_msg = $this->send_sms($final_msg, $phone_no);
                echo $sending_msg;
            }
        }
        IncomingMsg::where('id', $id)->update(array('processed' => 'Processed'));
    }


    public  function facilities()
    {
        $facilities = Directory::all();

        return view('directory.facilities')->with([
            'facilities' => $facilities,
        ]);
    }

    public function facilitiesDT() {


        $facilities = Directory::all();

        return DataTables::of($facilities)
            ->editColumn('mfl_code', function($facility) {
                return $facility->mfl_code;
            })

            ->editColumn('facility_name', function($facility) {
                return $facility->facility_name;
            })

            ->editColumn('county', function($facility) {
                return $facility->county;
            })
            ->editColumn('sub_county', function($facility) {
                return $facility->sub_county;
            })

            ->editColumn('facility_phone', function($facility) {
                return $facility->facility_phone;
            })

            ->addColumn('actions', function($facility){ // add custom column
                $actions = '<div class="pull-right">
                        <button source="' . route('edit-facility' ,  $facility->id) . '"
                    class="btn btn-warning btn-link btn-sm edit-facility-btn" acs-id="'.$facility->id .'">
                    <i class="material-icons">edit</i> Edit</button>';
                $actions .= '<form action="'. route('delete-facility',  $facility->id) .'" style="display: inline;" method="post" class="del_facility_form">';
                $actions .= method_field('DELETE');
                $actions .= csrf_field() .'<button class="btn btn-danger btn-sm">Delete</button></form>';
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
            'facility_name' =>'required',
            'mfl_code' =>'required',
            'partner' =>'required',
            'county' =>'required',
            'sub_county' =>'required',
            'location' =>'nullable',
            'sub_location' =>'nullable',
            'alt_facility_phone' =>'nullable',
            'email_address' =>'required',
            'clinic' =>'required',
        ]);

        $directory = new Directory();
        $directory->facility_phone = $request->facility_phone;
        $directory->facility_name = $request->facility_name;
        $directory->mfl_code = $request->mfl_code;
        $directory->partner = $request->partner;
        $directory->county = $request->county;
        $directory->sub_county = $request->sub_county;
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
            'facility_name' =>'required',
            'mfl_code' =>'required',
            'partner' =>'required',
            'county' =>'required',
            'sub_county' =>'required',
            'location' =>'nullable',
            'sub_location' =>'nullable',
            'alt_facility_phone' =>'nullable',
            'email_address' =>'required',
            'clinic' =>'required',
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
