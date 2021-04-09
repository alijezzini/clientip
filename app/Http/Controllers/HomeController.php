<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\clientip;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ips = DB::table('clientip')
    ->get()
    ->toArray();
        return view('home',['ips'=>$ips]);
    }
    function submit(Request $req){
        
        $client = new clientip;
        $client->name= $req->name;
        $client->ip= $req->ip;
        $client->type= $req->type;
        $client->gateway= $req->gateway;
        if( $req->has('vpn') ){
            $client->vpn= 1;
        }
        else{
            $client->vpn= 0;
        }
        $client->save();
        $req->session()->flash('alert-success', 'Client Successfully Added!');
        return redirect()->route('clientip');
    }
    function editClient(Request $req){
        
        $vpn;
        if( $req->has('editvpn') ){
            $vpn= 1;
        }
        else{
            $vpn= 0;
        }

        DB::table('clientip')
        ->where('id', $req->cl_id)
        ->update([
            'name' => $req->name,
            'ip' =>$req->ip,
            'type'=>$req->type,
            'gateway'=>$req->gateway,
            'vpn'=>$vpn
                ]);
        $req->session()->flash('alert-success', 'Client Edited Successfully!');
        return redirect()->route('clientip');
    }

    function deleteclient(Request $req){
        $ids = explode(",",$req->ids);
        $restricted = array();
            foreach($ids as $id){
                DB::table('clientip')->where('id', $id)->delete();
            }
            return response()->json("success");
        
        
    }
}
