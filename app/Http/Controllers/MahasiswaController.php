<?php

namespace App\Http\Controllers;

use App\Models\mahasiswas;
use Illuminate\Http\Request;
use Session;


//controller MahasiswaController memiliki satu action yaitu index(). Method index() akan dipanggil ketika pengguna meminta halaman utama dari aplikasi web. Logika untuk halaman utama dapat ditempatkan di dalam method index().

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $keyword = $request->keyword;
        // $keyword = $request->keyword; digunakan untuk mengambil nilai input keyword yang dikirimkan dari form pencarian pada halaman daftar mahasiswa. Nilai ini akan digunakan untuk mencari data mahasiswa berdasarkan keyword pencarian.

        $jumlahBaris = 5;
        // $jumlahBaris = 5; digunakan untuk menentukan jumlah baris data yang ditampilkan pada halaman daftar mahasiswa. Pada contoh ini, jumlah baris yang ditampilkan adalah 5.
        if(strlen($keyword)) {
            // if(strlen($keyword)) { ... } else { ... } digunakan untuk memeriksa apakah nilai input keyword memiliki panjang karakter yang lebih besar dari 0 atau tidak. Jika nilai keyword tidak kosong, maka kode pada blok if akan dieksekusi untuk mencari data mahasiswa berdasarkan keyword pencarian. Jika nilai keyword kosong, maka kode pada blok else akan dieksekusi untuk menampilkan seluruh data mahasiswa.
            $data = mahasiswas::where('nim', 'like', "%$keyword%")
                ->orwhere('nama', 'like', "%$keyword%")
                ->orwhere('jurusan', 'like', "%$keyword%")
                ->paginate($jumlahBaris);
                //Pada blok if, $data = mahasiswas::where('nim', 'like', "%$keyword%")->orwhere('nama', 'like', "%$keyword%")->orwhere('jurusan', 'like', "%$keyword%")->paginate($jumlahBaris); digunakan untuk mencari data mahasiswa berdasarkan keyword pencarian. Pencarian dilakukan berdasarkan kolom nim, nama, dan jurusan dengan menggunakan metode like pada query builder. Hasil pencarian akan diatur untuk ditampilkan dengan pagination.
        } else {
            $data = mahasiswas::orderBy('nim', 'desc')->paginate($jumlahBaris);
            //Pada blok else, $data = mahasiswas::orderBy('nim', 'desc')->paginate($jumlahBaris); digunakan untuk menampilkan seluruh data mahasiswa dengan urutan terbaru terlebih dahulu (berdasarkan kolom nim) dan ditampilkan dengan pagination.
        }
        return view('mahasiswa.index')->with('dataMhs', $data);
        //return view('mahasiswa.index')->with('dataMhs', $data); digunakan untuk mengembalikan tampilan (view) mahasiswa.index ke browser dengan data mahasiswa yang telah diambil dari database. Data mahasiswa tersebut disimpan pada variabel dataMhs yang akan digunakan pada tampilan untuk menampilkan daftar mahasiswa dengan menggunakan pagination.
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('mahasiswa.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nim',$request->nim);
        Session::flash('nama',$request->nama);
        Session::flash('jurusan',$request->jurusan);
        //Session::flash('nim',$request->nim);, Session::flash('nama',$request->nama);, dan Session::flash('jurusan',$request->jurusan); digunakan untuk menyimpan data sementara pada session.

        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'nama' => 'required',
            'jurusan' => 'required',

            // $request->validate([...]) digunakan untuk memvalidasi inputan yang dimasukkan oleh user.
        ],
        [
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM wajib numeric',
            'nim.unique' => 'NIM sudah ada',
            'nama.required' => 'Nama wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
        ]);
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan

            // $data = ['nim' => $request->nim, 'nama' => $request->nama, 'jurusan' => $request->jurusan]; digunakan untuk mengisi data yang akan disimpan ke dalam database.
        ];
        mahasiswas::create($data);
        return redirect()->to('mahasiswa')->with('success', 'Berhasil menambahkan data');
        // mahasiswas::create($data); digunakan untuk menyimpan data ke dalam database
        // return redirect()->to('mahasiswa')->with('success', 'Berhasil menambahkan data'); digunakan untuk mengarahkan user ke halaman mahasiswa setelah berhasil menyimpan data.
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    // Fungsi show digunakan untuk menampilkan data mahasiswa berdasarkan nim yang diambil dari parameter fungsi tersebut. 
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    // fungsi edit digunakan untuk menampilkan form edit data mahasiswa berdasarkan nim yang diambil dari parameter fungsi tersebut.
    // 
    {
        $data = mahasiswas::where('nim', $id)->first();
        return view('mahasiswa.edit')->with('dataMhs', $data);
    }

    // Pada fungsi edit, terdapat kode $data = mahasiswas::where('nim', $id)->first();. Kode tersebut digunakan untuk mengambil data mahasiswa berdasarkan nim yang diambil dari parameter fungsi tersebut. Kemudian, data tersebut akan dikirim ke halaman view mahasiswa.edit dengan menggunakan perintah return view('mahasiswa.edit')->with('dataMhs', $data);.

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
        ],
        // Fungsi ini bernama "update" dan menerima dua parameter, yaitu $request dan $id. Parameter $request berisi data yang dikirim oleh pengguna dari halaman web, sementara $id berisi identitas dari data yang akan diupdate.
        [
            'nama.required' => 'Nama wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
        ]);
        $data = [
            'nama' => $request->nama,
            'jurusan' => $request->jurusan
        ];
        // fungsi memvalidasi data yang dikirim oleh pengguna untuk memastikan bahwa data yang dibutuhkan untuk melakukan update telah diisi dengan benar. Fungsi validate() memeriksa apakah parameter 'nama' dan 'jurusan' telah diisi oleh pengguna. Jika tidak, maka fungsi akan mengembalikan pesan error yang sesuai dengan aturan yang telah didefinisikan.
        mahasiswas::where('nim', $id)->update($data);
        return redirect()->to('mahasiswa')->with('success', 'Berhasil update data');
        //  fungsi memanggil metode where() pada model mahasiswas dengan menggunakan parameter $id untuk menentukan data mana yang akan diupdate pada tabel database. Setelah data yang diinginkan sudah ditentukan, fungsi memanggil metode update() pada model tersebut dan menggunakan variabel $data sebagai parameter untuk melakukan update pada data tersebut.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        mahasiswas::where('nim', $id)->delete();
        return redirect()->to(',')->with('success', 'Berhasil melakukan delete data');
        // Fungsi "destroy" menerima satu parameter, yaitu $id, yang berisi nim dari mahasiswa yang akan dihapus.
        // ungsi menggunakan metode "where" pada model "mahasiswas" untuk mencari data mahasiswa yang memiliki nim yang sama dengan $id.
        // fungsi menggunakan metode "delete" pada model "mahasiswas" untuk menghapus data mahasiswa yang telah ditemukan pada baris sebelumnya.
    }
}
