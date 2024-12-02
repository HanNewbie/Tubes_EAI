<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Car;
use App\Models\bayar;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function index(){
        
        $cars = Car::latest()->get();
        return view('frontend.homepage', compact('cars'));
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function contactStore(Request $request){
       $data = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'pesan' => 'required'  
       ]);

       Message::create($data);

       return redirect()->back()->with([
        'message' => 'Pesan anda berhasil dikirim',
        'alert-type' => 'Sukses'
       ]);
    }

    public function detail(Car $car){

        return view('frontend.detail', compact('car'));
    }

    public function bayar(Car $car){

        return view('frontend.bayar', compact('car'));
    }

    public function bayarStore(Request $request, $slug){
        $car = Car::where('slug', $request->input('mobil'))->first();
    
        // Validasi data lainnya
        $validatedData = $request->validate([
            'mobil' => 'required', // Validasi dasar untuk mobil
            'harga' => 'required',
            'nama' => 'required',
            'nomor' => 'required',
            'hari' => 'required',
            'status' => 'Unpaid',

        ]);

        // Hitung total harga berdasarkan jumlah hari
        $harga = $validatedData['harga'] * $validatedData['hari'];

        // Tambahkan total_harga ke dalam data yang akan disimpan
        $validatedData['harga_total'] = $harga;

        $validatedData['orders_id'] = uniqid();

        // Membuat tabel bayar berdasarkan data @validateData kedalam databse
        $bayars = Bayar::create($validatedData);

        //  Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    
        // Buat parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $bayars->orders_id, // Gunakan ID dari record yang baru dibuat
                'gross_amount' => $bayars->harga_total,
            ],
            'customer_details' => [
                'first_name' => $bayars->nama, // Pastikan sesuai dengan format Midtrans
                'phone' => $bayars->nomor, // Pastikan sesuai dengan format Midtrans
            ],
        ];
    
        // Dapatkan Snap Token dari Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($params);
       
        // Mengembalikan ke view sewa
        return view('frontend.sewa', compact ('snapToken', 'bayars'));
    }

    // callback
    public function callback(Request $request){
        $serverKey = config('midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement'){
                $bayars = Bayar::find($request->order_id);
                $bayars->update(['status' => 'Paid']);
            }
        }
    }

    
    public function invoice($orders_id){
        $bayars = Bayar::find($orders_id);
        return view('frontend.invoice', compact('bayars'));
     }

}