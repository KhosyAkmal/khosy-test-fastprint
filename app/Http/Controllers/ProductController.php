<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Js;

class ProductController extends Controller
{
    public function getDataFromAPI() {
        try {
            $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';

            $postToApi = Http::asForm()->post($url, [
                'username' => 'tesprogrammer280623C09',
                'password' => 'c69aa638188e880e42042d86448996e8',
            ]);

            $response = $postToApi->json();

            $truncateProduk = Product::truncate();
            foreach($response['data'] as $item) {
                $produk = Product::create([
                    'id_produk' => $item['id_produk'],
                    'nama_produk' => $item['nama_produk'],
                    'kategori' => $item['kategori'],
                    'harga' => $item['harga'],
                    'status' => $item['status']
                ]);
            }

            // DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menambahkan data dari API'
            ],200);

        } catch (\Throwable $th) {
            // DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ],500);
        }

    }
}
