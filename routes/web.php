<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// ==========================================
// 1. RUTE LOGIN & LOGOUT
// ==========================================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', function (Request $request) {
    $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    $user = DB::table('users')->where('username', $request->username)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        session([
            'user_id' => $user->id, 
            'username' => $user->username, 
            'nama' => $user->nama,
            'email' => $user->email,
            'role' => $user->role
        ]);
        
       // INI BAGIAN YANG DIUBAH
        if ($user->role === 'peserta') {
            return redirect('/dashboard-peserta');
        }
        return redirect('/dashboard');
        // SELESAI
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ]);
})->name('login');

Route::get('/logout', function () {
    session()->flush();
    return redirect('/login');
});

// ==========================================
// 2. RUTE REGISTER (DAFTAR PESERTA)
// ==========================================
Route::get('/register', function () {
    return view('register');
});

Route::post('/register', function (Request $request) {
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'username' => 'required|unique:users,username',
        'password' => 'required|min:6',
    ]);

    DB::table('users')->insert([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'nama' => $request->nama,
        'email' => $request->email,
        'role' => 'peserta',
    ]);

    DB::table('peserta')->insert([
        'id' => 'p' . time(),
        'nama' => $request->nama,
        'email' => $request->email,
    ]);

    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
});

// ==========================================
// 3. RUTE DASHBOARD
// ==========================================
Route::get('/dashboard', function () {
    return view('dashboard');
});

// ==========================================
// 4. RUTE DATA PESERTA (ADMIN)
// ==========================================
Route::get('/peserta', function () {
    $data_peserta = DB::table('sertifikat')
        ->join('peserta', 'sertifikat.peserta_id', '=', 'peserta.id')
        ->join('events', 'sertifikat.event_id', '=', 'events.id')
        ->select('sertifikat.*', 'peserta.nama', 'peserta.email', 'events.nama_event as event', 'events.tanggal')
        ->get();

    return view('peserta', ['data_peserta' => $data_peserta]);
});

// ==========================================
// 5. RUTE DAFTAR SERTIFIKAT (ADMIN)
// ==========================================
Route::get('/sertifikat', function () {
    $data_sertifikat = DB::table('sertifikat')
        ->join('peserta', 'sertifikat.peserta_id', '=', 'peserta.id')
        ->join('events', 'sertifikat.event_id', '=', 'events.id')
        ->select('sertifikat.*', 'peserta.nama', 'events.nama_event as event', 'events.tanggal')
        ->where('sertifikat.status', 'terverifikasi')
        ->get();

    return view('sertifikat', ['data_sertifikat' => $data_sertifikat]);
});

// ==========================================
// 6. RUTE SERTIFIKAT SAYA (PESERTA)
// ==========================================
Route::get('/sertifikat-saya', function () {
    $data_sertifikat = DB::table('sertifikat')
        ->join('peserta', 'sertifikat.peserta_id', '=', 'peserta.id')
        ->join('events', 'sertifikat.event_id', '=', 'events.id')
        ->select('sertifikat.*', 'peserta.nama', 'events.nama_event as event', 'events.tanggal')
        ->where('peserta.email', session('email'))
        ->where('sertifikat.status', 'terverifikasi')
        ->get();

    return view('sertifikat-saya', ['data_sertifikat' => $data_sertifikat]);
});

// ==========================================
// 7. RUTE TENTANG APLIKASI
// ==========================================
Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/dashboard-peserta', function () {
    return view('dashboard-peserta');
});

Route::get('/edit/{id}', function ($id) {
    // Ambil data sertifikat yang mau diedit
    $data = DB::table('sertifikat')
        ->join('peserta', 'sertifikat.peserta_id', '=', 'peserta.id')
        ->join('events', 'sertifikat.event_id', '=', 'events.id')
        ->select('sertifikat.*', 'peserta.nama', 'peserta.email', 'events.id as event_id', 'events.nama_event', 'events.tanggal')
        ->where('sertifikat.id', $id)
        ->first();

    // Ambil semua daftar event untuk dropdown
    $events = DB::table('events')->get();

    return view('edit', ['data' => $data, 'events' => $events]);
});

// ==========================================
// 8. RUTE EDIT PESERTA (ADMIN)
// ==========================================
Route::get('/edit/{id}', function ($id) {
    // Ambil data sertifikat yang mau diedit
    $data = DB::table('sertifikat')
        ->join('peserta', 'sertifikat.peserta_id', '=', 'peserta.id')
        ->join('events', 'sertifikat.event_id', '=', 'events.id')
        ->select('sertifikat.*', 'peserta.nama', 'peserta.email', 'events.id as event_id', 'events.nama_event', 'events.tanggal')
        ->where('sertifikat.id', $id)
        ->first();

    // Ambil semua daftar event untuk dropdown
    $events = DB::table('events')->get();

    return view('edit', ['data' => $data, 'events' => $events]);
});

Route::post('/edit', function (Request $request) {
    // Update data peserta
    DB::table('peserta')
        ->where('id', $request->peserta_id)
        ->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

    // Update event di tabel sertifikat
    DB::table('sertifikat')
        ->where('id', $request->sertifikat_id)
        ->update([
            'event_id' => $request->event_id,
        ]);

    return redirect('/peserta')->with('success', 'Data berhasil diperbarui!');
});

Route::post('/hapus/{id}', function ($id) {
    // Hapus data sertifikat dulu, lalu data pesertanya
    DB::table('sertifikat')->where('id', $id)->delete();
    return redirect('/peserta')->with('success', 'Data berhasil dihapus!');
});

Route::post('/terbitkan/{id}', function ($id) {
    // Ubah status sertifikat menjadi terverifikasi
    DB::table('sertifikat')->where('id', $id)->update([
        'status' => 'terverifikasi'
    ]);

    return redirect('/peserta')->with('success', 'Sertifikat berhasil diterbitkan!');
});

// Tampilkan halaman form tambah
Route::get('/tambah', function () {
    // Ambil data event buat dropdown
    $events = DB::table('events')->get();
    return view('tambah', ['events' => $events]);
});

// Proses simpan data peserta baru
Route::post('/tambah', function (Request $request) {
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'event_id' => 'required',
        'tanggal' => 'required',
    ]);

    // 1. Cek atau buat data peserta baru
    $peserta_id = 'p' . time();
    DB::table('peserta')->insert([
        'id' => $peserta_id,
        'nama' => $request->nama,
        'email' => $request->email,
    ]);

    // 2. Buat nomor sertifikat otomatis
    $tahun = date('Y');
    $last_sertifikat = DB::table('sertifikat')->orderBy('no_sertifikat', 'desc')->first();
    $next_number = $last_sertifikat ? ((int)substr($last_sertifikat->no_sertifikat, -4)) + 1 : 1;
    $no_sertifikat = 'EC-' . $tahun . '-' . str_pad($next_number, 4, '0', STR_PAD_LEFT);

    // 3. Simpan ke tabel sertifikat (status awal: menunggu)
    DB::table('sertifikat')->insert([
        'peserta_id' => $peserta_id,
        'event_id' => $request->event_id,
        'no_sertifikat' => $no_sertifikat,
        'status' => 'menunggu',
    ]);

    return redirect('/peserta')->with('success', 'Peserta berhasil ditambahkan!');
});