<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\User;

class CustomerController extends Controller
{
    public function index(Request $request)
    {

        $context = array(
            "data" => array(),
            "tglawal" => "",
            "tglakhir" => "",
        );

        if($request->tglawal != "" && $request->tglakhir != "")
        {
            $tglawal = date("Y-m-d", strtotime($request->tglawal));
            $tglakhir = date("Y-m-d", strtotime($request->tglakhir));

            $customer = Customers::join("users", "users.id", "=", "customer.id")
                    ->whereDate("users.created_at",">=", $tglawal)
                    ->whereDate("users.created_at","<=", $tglakhir)
                    ->paginate(10, array("users.id as id", "users.first_name as first_name", "customer.address as alamat", "users.phone as telp"));

            $context = array(
                "data" => $customer,
                "tglawal" => date("d-m-Y", strtotime($request->tglawal)),
                "tglakhir" => date("d-m-Y", strtotime($request->tglakhir)),
            );    
        }

        return view("customer.list")->with($context);
    }

    public function getCustomer(Request $request)
    {

        $getCustomer = Customers::join("users", "users.id", "=", "customer.id")
                       ->orderBy("users.first_name", "ASC")
                       ->paginate(10, array("users.id as id", "users.first_name as nama", "customer.address as alamat", "users.phone as telp"));

        $response = array(
            "response" => $getCustomer
        );

        return response()->json($response);

    }

    public function create(Request $request)
    {

        $user     = new User;

        $user->first_name = $request->nama;
        $user->last_name  = $request->lnama;
        $user->account_type = 4;
        $user->account_role = "customer";
        
        $user->phone    = $request->telp;
        $user->created_at = date("Y-m-d H:i:s", strtotime($request->tgl));

        $user->save();
        $id = $user->id;

        
        $customer = new Customers;

        $customer->id       = $id;
        $customer->address  = $request->alamat;

        $customer->save();


        $return = array(
            "status" => true,
            "message" => "data berhasil ditambahkan",
            "data" => array(
                "nama"   => $request->nama,
                "alamat" => $request->alamat,
                "telp"   => $request->telp,
            )
        );

        return response()->json($return);
    }

    public function show(Request $request)
    {
        $id = $request->id;

        $getCustomer = Customers::join("users", "users.id", "=", "customer.id")
                        ->where("users.id", $id)
                        ->get();

        $response = array(
            "data" => array(
                "id"        => $getCustomer->first()->id,
                "f_name"    => $getCustomer->first()->first_name,
                "l_name"    => $getCustomer->first()->last_name,
                "alamat"    => $getCustomer->first()->address,
                "telp"      => $getCustomer->first()->phone,
                "created_at"=> date("d-m-Y H:i:s", strtotime($getCustomer->first()->created_at)),
            )
        );

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $user     = User::find($id);

        $user->first_name = $request->f_name;
        $user->last_name  = $request->l_name;
        $user->account_type = 4;
        $user->account_role = "customer";
        
        $user->phone    = $request->telp;
        $user->created_at = date("Y-m-d H:i:s", strtotime($request->tgl));

        $user->save();
        
        $customer = Customers::find($id);

        $customer->address  = $request->alamat;

        $customer->save();


        $return = array(
            "status" => true,
            "message" => "data berhasil diupdate",
            "data" => array(
                "nama"   => $request->f_name,
                "alamat" => $request->alamat,
                "telp"   => $request->telp,
            )
        );

        return response()->json($return);
    }

    public function search(Request $request)
    {
        $tglawal = date("Y-m-d", strtotime($request->tglawal));
        $tglakhir = date("Y-m-d", strtotime($request->tglakhir));


        $customer = Customers::join("users", "users.id", "=", "customer.id")
                    ->whereDate("users.created_at",">=", $tglawal)
                    ->whereDate("users.created_at","<=", $tglakhir)
                    ->get();

        $response = array(
            "data" => $customer
        );

        return response()->json($response);
    }

    public function getdetail(Request $request)
    {
        $id = $request->id;

        $customer = Customers::join("users", "users.id", "=", "customer.id")
                    ->where("users.id", $id)
                    ->get();


        $return = array(
            "data" => array(
                "nama"   => $customer->first()->first_name,
                "last_name"   => $customer->first()->last_name,
                "alamat" => $customer->first()->address,
                "telp"   => $customer->first()->phone,
                "created_at"   => $customer->first()->created_at,
            )
        );

        return response()->json($return);
    }
}
