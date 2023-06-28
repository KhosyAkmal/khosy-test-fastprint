<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function getDataFromAPI() {
        try {
            $data = $this->getUsernamePassword();

            $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';
            $postToApi = Http::asForm()->post($url, [
                'username' => $data['username'],
                'password' => $data['password'],
            ]);

            $response = $postToApi->json();
            $truncate = Product::truncate();
            foreach($response['data'] as $item) {
                $produk = Product::create([
                    'id_produk' => $item['id_produk'],
                    'nama_produk' => $item['nama_produk'],
                    'kategori' => $item['kategori'],
                    'harga' => $item['harga'],
                    'status' => $item['status']
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menambahkan data dari API'
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ],500);
        }
    }

    public function getUsernamePassword(){
        $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';
        $postToApi = Http::asForm()->post($url, [
            'username' => 'tesprogrammer280623C09',
            'password' => 'c69aa638188e880e42042d86448996e8',
        ]);

        $usernameHeader = $postToApi->header('X-Credentials-Username');
        $username = explode(' (username', $usernameHeader);
        $username = $username[0];


        $data = [
            'username' => $username,
            'password' => md5('bisacoding-'.date_format(now(),"d-m-y"))
        ];

        return $data;
    }

    public function showProducts() {

        $produk = Product::where('status', 'bisa dijual')->get();

        if (request()->ajax()) {
            return DataTables::of($produk)
            ->editColumn('harga', function($item){
                return 'Rp. '.number_format( $item->harga ,0,",",".");
            })
            ->addColumn('action', function($item){
                $render =
                '
                    <div class="d-flex">
                        <button class="btn btn-warning btn-sm m-2 btn-action"
                        data-action="update"
                        data-id="'. $item->id_produk.'"
                        data-nama="'.$item->nama_produk.'"
                        data-kategori="'.$item->kategori.'"
                        data-harga="'.$item->harga.'"
                        >Edit</button>
                        <button class="btn btn-danger btn-action btn-sm m-2 btn-delete" data-id="'. $item->id_produk .'" >Hapus</button>
                    </div>
                ';

                return $render;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('product');
    }

    public function storeProduct(Request $request) {
        try {
            $rules = [
                'nama_produk' => 'required',
                'kategori' => 'required',
                'harga' => 'numeric'
            ];

            $message = [
                'nama_produk.required' => 'Nama produk harus di isi',
                'kategori.required' => 'Kategori harus di isi',
                'harga.numeric' => 'Harap isikan harga dengan Angka'
            ];

            $validators = Validator::make($request->all(), $rules, $message);
            if ( $validators->fails() ) {
                return response()->json([
                    'status' => 500,
                    'message' => $validators->errors()->first()
                ],500);
            }

            $produk = Product::create([
                'nama_produk' => $request->nama_produk,
                'kategori' => $request->kategori,
                'harga' => Str::remove('.', $request->harga),
                'status' => $request->status ?? 'bisa dijual'
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menambahkan produk'
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ],500);
        }
    }

    public function updateProduct($id, Request $request) {
        try {

            if( !$id ) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Data tidak ditemukan'
                ]);
            }

            $rules = [
                'nama_produk' => 'required',
                'kategori' => 'required',
                'harga' => 'numeric'
            ];

            $message = [
                'nama_produk.required' => 'Nama produk harus di isi',
                'kategori.required' => 'Kategori harus di isi',
                'harga.numeric' => 'Harap isikan harga dengan Angka'
            ];

            $validators = Validator::make($request->all(), $rules, $message);
            if ( $validators->fails() ) {
                return response()->json([
                    'status' => 500,
                    'message' => $validators->errors()->first()
                ],500);
            }

            $produk = Product::firstwhere('id_produk',$id);

            if( !$produk ) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Data tidak sinkron'
                ]);
            }

            $update = Product::where('id_produk', $id)->update([
                'nama_produk'   => $request->nama_produk,
                'kategori'      => $request->kategori,
                'harga'         => Str::remove('.', $request->harga),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil edit produk'
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ],500);
        }
    }

    public function destroyProduct(Request $request){
        try {
            $id = $request->id;
            if( !$id ) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Data tidak ditemukan'
                ]);
            }

            $produk = Product::where('id_produk',$id)->delete();
            if( !$produk ) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Data tidak sinkron'
                ]);
            }

            // $produk->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Sukses hapus produk'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 200,
                'message' => 'Err : '.$th->getMessage()
            ],500);
        }
    }
}
