<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

use DB;

class ListController extends Controller
{
    public function listproduk(Request $request)
    {
        $product = DB::table("orders")
                   ->select("product.id", 
                            "product.product_name",
                            DB::raw("COUNT(order_detail.product_id) as total")
                    )
                   ->join("order_detail", "orders.id", "=", "order_detail.order_id")
                   ->join("product", "product.id", "=", "order_detail.product_id")
                   ->orderBy("total", "DESC")
                   ->groupBy("product.id")
                   ->LIMIT(10)
                   ->get();

        $context = array(
            "data" => $product
        );

        return view("olahdata.product")->with($context);
    }

    public function listcustomer(Request $request)
    {
        $customer = DB::table("orders")
                   ->select(
                       "users.first_name",
                       DB::raw("SUM(order_detail.qty) as total")
                    )
                   ->join("customer", "customer.id", "=","orders.customer_id")
                   ->join("users", "users.id", "=", "customer.id")
                   ->join("order_detail", "order_detail.order_id", "=", "orders.id")
                   ->where("users.account_role", "customer")
                   ->orderBy("total","DESC")
                   ->groupBy("customer.id")
                   ->limit(10)
                   ->get();

        $context = array(
            "data" => $customer
        );

        return view("olahdata.customer")->with($context);
    }

    public function listagent(Request $request)
    {
        $agent = DB::table("agent")
                   ->select(
                       "agent.store_name",
                        DB::raw("COUNT(orders.customer_id) as total")
                   )
                   ->join("users", "users.id", "=", "agent.id")
                   ->join("orders", "orders.agent_id", "=", "users.id")
                   ->where("users.account_role", "agent")
                   ->orderBy("total", "DESC")
                   ->groupBy("orders.agent_id")
                   ->limit(10)
                   ->get();

        $context = array(
            "data" => $agent
        );

        return view("olahdata.agent")->with($context);
    }

    public function listorder(Request $request)
    {
        $tglawal = "";
        $tglakhir = "";
        $invoice = "";

        if($request->tglawal != "" && $request->tglakhir != "")
        {
            
            $tglawal = date("Y-m-d", strtotime($request->input("tglawal")));
            $tglakhir = date("Y-m-d", strtotime($request->input("tglakhir")));
        }

        if($request->invoice != "" )
        {
            $invoice = $request->input("invoice");
        }


        $order = DB::table("orders")
                 ->select(
                     "orders.invoice_id",
                     "orders.name",
                     "orders.phone",
                     "orders.agent_name",
                     "orders.payment_method",
                     "orders.payment_discount",
                     "orders.payment_final",
                     "orders.delivery_date",
                 )
                 ->join("users", "users.id", "=", "orders.customer_id")
                 ->join("customer", "customer.id", "=", "users.id")
                 ->where("users.account_role", "customer")
                 ->when($tglawal, function($query, $tglawal){
                    return $query->where("orders.delivery_date", ">=", $tglawal);
                 })
                 ->when($tglakhir, function($query, $tglakhir){
                    return $query->where("orders.delivery_date", "<=", $tglakhir);
                 })
                 ->when($invoice, function($query, $invoice){
                    return $query->where("orders.invoice_id", "=", $invoice);
                 })
                 ->groupBy("orders.invoice_id")
                 ->get();

        $context = array(
            "data" => $order,
            "tglawal" => $tglawal,
            "tglakhir" => $tglakhir,
            "invoice" => $invoice,
        );

        return view("olahdata.order")->with($context);
    }

    public function detailorder(Request $request)
    {
        $id = $request->segment(3);

        $order = DB::table("orders")
                ->where("orders.invoice_id", $id)
                ->get();

        $orderdetail = DB::table("orders")
                       ->select("product.*", "order_detail.*")
                       ->join("order_detail", "orders.id", "=", "order_detail.order_id")
                       ->join("product", "product.id", "=", "order_detail.product_id")
                       ->join("product_category", "product_category.id", "=", "product.category")
                       ->where("orders.invoice_id", $id)
                       ->get();

        $context = array(
            "order" => $order,
            "detail" => $orderdetail
        );

        return view("olahdata.order_detail")->with($context);
    }
}
