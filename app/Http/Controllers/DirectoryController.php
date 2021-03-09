<?php

namespace App\Http\Controllers;

use App\County;
use App\SubCounty;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\IncomingMsg;
use App\Directory;
use Illuminate\Mail\Message;
use AfricasTalking\SDK\AfricasTalking;
use PHPUnit\Framework\Constraint\Count;
use Yajra\DataTables\Facades\DataTables;


class DirectoryController extends Controller
{
    public function send_sms($final_msg, $phone_no)
    {
        // $to=$request->input('to');
        // $message =$request->input('message');

        $username = 'mhealthkenya';
        $apiKey = 'a134a43032612487eb3f4d5fcc4c6c7538d56afdd871dcd284ab171d778c4e51';
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
            if (ctype_digit($trimmed_msg) && strlen($trimmed_msg) > 0) {
                $get_content = Directory::select('facility_phone', 'facility_name', 'county', 'sub_county', 'email_address', 'partner')->where('mfl_code', $trimmed_msg)->first();
                $final_msg = 'Facility Number: '  . $get_content->facility_phone . ' ' . 'Facility Name: ' . $get_content->facility_name . ' ' . 'County: ' .
                    $get_content->county . ' ' . 'Sub County: ' . $get_content->sub_county . ' ' . 'Email: '  . $get_content->email_address . ' ' . 'Partner: '  . $get_content->partner;

                $sending_msg = $this->send_sms($final_msg, $phone_no);
                echo $sending_msg;
            }
        } else if ($result == 1) {
            $arr_content = explode('/', $trimmed_msg);
            $arr_facility = $arr_content[1];
            $arr_county = $arr_content[2];
            if (empty($arr_county)) {
                $arr_fnl_content = preg_replace('/[^A-Za-z0-9\s]/', '', $arr_facility);
                $get_details = Directory::select('facility_phone', 'facility_name', 'county', 'sub_county', 'email_address', 'partner', 'mfl_code')->where('facility_name', 'LIKE', "%{$arr_fnl_content}%")->get();
                foreach ($get_details as $detail) {
                    $final_msg = 'Facility Name: ' . $detail->facility_name . ' ' . 'MFL Code: ' . $detail->mfl_code . ' ' . 'County: ' . $detail->county;
                    $sending_msg = $this->send_sms($final_msg, $phone_no);
                    echo $sending_msg;
                }
            } else {
                $arr_fnl_content = preg_replace('/[^A-Za-z0-9\s]/', '', array($arr_facility, $arr_county));
                $get_details = Directory::select('facility_phone', 'facility_name', 'county', 'sub_county', 'email_address', 'partner', 'mfl_code')->where([['facility_name', 'LIKE', "%{$arr_facility}%"], ['county', 'LIKE', "%{$arr_county}%"]])->get();
                foreach ($get_details as $detail) {
                    $final_msg = 'Facility Name: ' . $detail->facility_name . ' ' . 'MFL Code: ' . $detail->mfl_code . ' ' . 'County: ' . $detail->county;
                    $sending_msg = $this->send_sms($final_msg, $phone_no);
                    echo $sending_msg;
                }
            }
        }
        IncomingMsg::where('id', $id)->update(array('processed' => 'Processed'));
    }

}
