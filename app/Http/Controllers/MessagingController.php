<?php

namespace App\Http\Controllers;

use App\Directory;
use App\IncomingMsg;
use App\OutgoingMsg;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MessagingController extends Controller
{
    public  function incoming()
    {
        $incoming = IncomingMsg::all();

        return view('messaging.incoming')->with([
            'incoming' => $incoming,
        ]);
    }

    public function incomingDT()
    {


        $incoming = IncomingMsg::all();

        return DataTables::of($incoming)
            ->editColumn('source', function ($incoming) {
                return $incoming->source;
            })

            ->editColumn('destination', function ($incoming) {
                return $incoming->destination;
            })

            ->editColumn('msg', function ($incoming) {
                return $incoming->msg;
            })
            ->editColumn('created_at', function ($incoming) {
                return $incoming->created_at;
            })

            ->editColumn('processed', function ($incoming) {
                return $incoming->processed;
            })
            ->make(true);
    }

    public  function outgoing()
    {
        $outgoing = IncomingMsg::all();

        return view('messaging.outgoing')->with([
            'outgoing' => $outgoing,
        ]);
    }

    public function outgoingDT()
    {


        $outgoing = OutgoingMsg::all();

        return DataTables::of($outgoing)
            ->editColumn('source', function ($outgoing) {
                return $outgoing->source;
            })

            ->editColumn('destination', function ($outgoing) {
                return $outgoing->destination;
            })

            ->editColumn('msg', function ($outgoing) {
                return $outgoing->msg;
            })
            ->editColumn('created_at', function ($outgoing) {
                return $outgoing->created_at;
            })

            ->editColumn('status', function ($outgoing) {
                return $outgoing->status;
            })
            ->make(true);
    }
}
