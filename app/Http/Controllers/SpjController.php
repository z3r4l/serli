<?php

namespace App\Http\Controllers;

use App\Models\Spj_staff;
use App\Models\KepalaDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;

class SpjController extends Controller
{
    public function index()
    {
        if(Auth::user()->status != 'admin'){
            $index = Spj_staff::where('id_user',Auth::user()->id)->get();
        }else{
            $index = Spj_staff::all();
        }

        return view('halaman_admin.entry_spj.index', compact('index'));
    }

    public function cetak()
    {

        if(Auth::user()->status != 'admin'){
            if(isset($_GET['jenis_perjalanan'])){
                $jenis = $_GET['jenis_perjalanan'];

                if($_GET['jenis_perjalanan'] == ''){
                    $index = DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->where('id_user', Auth::user()->id)->select('spj_staff.id as id_spj', 'spj_staff.*', 'program_kerja.jenis_perjalanan')->get();
                }else{
                    $index =  DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->where('jenis_perjalanan', $jenis)->where('id_user', Auth::user()->id)->select('spj_staff.id as id_spj', 'spj_staff.*', 'program_kerja.jenis_perjalanan')->get();
                }
            }else{
                $index = DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->where('id_user', Auth::user()->id)->select('spj_staff.id as id_spj', 'spj_staff.*', 'program_kerja.jenis_perjalanan')->get();
            }
        }else{
            if(isset($_GET['jenis_perjalanan'])){
                $jenis = $_GET['jenis_perjalanan'];

                if($_GET['jenis_perjalanan'] == ''){
                    $index = DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->select('spj_staff.id as id_spj', 'spj_staff.*', 'program_kerja.jenis_perjalanan')->get();
                }else{
                    $index =  DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->where('jenis_perjalanan', $jenis)->select('spj_staff.id as id_spj', 'spj_staff.*', 'program_kerja.jenis_perjalanan')->get();
                }
            }else{
                $index = DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->select('spj_staff.id as id_spj', 'spj_staff.*', 'program_kerja.jenis_perjalanan')->get();
            }
        }



        return view('halaman_admin.cetak_spj.index', compact('index'));
    }

    public function export($jenis = NULL)
    {
        if(Auth::user()->status != 'admin'){
            if($jenis != ''){
                $cetak =  DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->join('detail_surat', 'spj_staff.no_sppd', '=', 'detail_surat.no_sppd')->join('surat_tugas', 'detail_surat.surat_tugas_id', '=', 'surat_tugas.id')->where('jenis_perjalanan', $jenis)->where('id_user', Auth::user()->id)->get();
            }else{
                $cetak =  DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->join('detail_surat', 'spj_staff.no_sppd', '=', 'detail_surat.no_sppd')->join('surat_tugas', 'detail_surat.surat_tugas_id', '=', 'surat_tugas.id')->where('id_user', Auth::user()->id)->get();
            }
        }else{
            if($jenis != ''){
                $cetak =  DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->join('detail_surat', 'spj_staff.no_sppd', '=', 'detail_surat.no_sppd')->join('surat_tugas', 'detail_surat.surat_tugas_id', '=', 'surat_tugas.id')->where('jenis_perjalanan', $jenis)->get();
            }else{
                $cetak =  DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->join('detail_surat', 'spj_staff.no_sppd', '=', 'detail_surat.no_sppd')->join('surat_tugas', 'detail_surat.surat_tugas_id', '=', 'surat_tugas.id')->get();
            }

        }


        return view('halaman_admin.cetak_spj.export', compact('cetak'));
    }

    public function cetak2($id)
    {
        if(Auth::user()->status != 'admin'){
            $cetak = DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->where('id_user', Auth::user()->id)->first();
            $kepala = KepalaDinas::first();
            $tipe = DB::table('spj_staff')->JOIN('users', 'spj_staff.id_user', '=','users.id' )->JOIN('tipe_user', 'users.id_tipe', '=', 'tipe_user.id_tipe')->where('users.id', Auth::user()->id)->first();
    
        }else{
            $cetak = DB::table('spj_staff')->join('program_kerja', 'spj_staff.kode_kegiatan', '=', 'program_kerja.kode_kegiatan')->first();
            $kepala = KepalaDinas::first();
            $tipe = DB::table('spj_staff')->JOIN('users', 'spj_staff.id_user', '=','users.id' )->JOIN('tipe_user', 'users.id_tipe', '=', 'tipe_user.id_tipe')->first();
            
           
        }

        return view('halaman_admin.cetak_spj.cetak', [
            "cetak" => $cetak,
            "tipe" => $tipe,
            "kepala" => $kepala
        ]);
    }

    public function get_spj_staff()
    {
        $id = $_GET['id'];
        $index = Spj_staff::find($id);
        return response()->json($index);
    }

    public function create()
    {
        return view('halaman_admin.entry_spj.tambah');
    }

    public function store(Request $request)
    {

        $request->validate([
            'sisa_nilai_kegiatan' => 'required',
        ]);

        $tambah =  new Spj_staff;

        $tambah->tanggal = date('Y-m-d');
        $tambah->no_sppd = $request->no_sppd;
        $tambah->nama_lengkap = $request->nama_lengkap;
        $tambah->nip = $request->nip;
        $tambah->jabatan = $request->jabatan;
        $tambah->pangkat = $request->pangkat;
        $tambah->golongan = $request->golongan;
        $tambah->unit = $request->unit;
        $tambah->tingkat_biaya = $request->tingkat_biaya;
        $tambah->tanggal_berangkat = $request->tanggal_berangkat;
        $tambah->tanggal_kembali = $request->tanggal_kembali;
        $tambah->selama = $request->selama;
        $tambah->tinggal_to_bandara_terminal = $request->tinggal_to_bandara_terminal;
        $tambah->bandara_terminal_to_tujuan = $request->bandara_terminal_to_tujuan;
        $tambah->tujuan_bandara_terminal = $request->tujuan_bandara_terminal;
        $tambah->bandara_terminal_tinggal = $request->bandara_terminal_tinggal;
        $tambah->biaya_hotel = $request->biaya_hotel;
        $tambah->belanja_bbm = $request->belanja_bbm;
        $tambah->transport_pp = $request->transport_pp;
        $tambah->medical_checkup = $request->medical_checkup;
        $tambah->total_riil = $request->total_riil;
        $tambah->uang_harian = $request->uang_harian;
        $tambah->biaya_transportasi_darat = $request->biaya_transportasi_darat;
        $tambah->biaya_tiket_pesawat = $request->biaya_tiket_pesawat;
        $tambah->biaya_bahan_bakar = $request->biaya_bahan_bakar;
        $tambah->biaya_penginapan = $request->biaya_penginapan;
        $tambah->biaya_representase = $request->biaya_representase;
        $tambah->daftar_pernyataan = $request->daftar_pernyataan;
        $tambah->total_perjalanan_dinas = $request->total_perjalanan_dinas;
        $tambah->kode_kegiatan = $request->kode_kegiatan;
        $tambah->nilai_kegiatan = $request->nilai_kegiatan;
        $tambah->sisa_nilai_kegiatan = $request->sisa_nilai_kegiatan;
        $tambah->kode_rekening = $request->kode_rekening;
        $tambah->keperluan = $request->keperluan;
        $tambah->daerah_tujuan = $request->daerah_tujuan;
        $tambah->instansi_tujuan = $request->instansi_tujuan;
        $tambah->keberangkatan_nama_pesawat_ka_bus_kapal_lainnya = $request->keberangkatan_nama_pesawat_ka_bus_kapal_lainnya;
        $tambah->keberangkatan_kode_booking = $request->keberangkatan_kode_booking;
        $tambah->keberangkatan_nomor_tiket = $request->keberangkatan_nomor_tiket;
        $tambah->keberangkatan_nomor_seat = $request->keberangkatan_nomor_seat;
        $tambah->keberangkatan_nomor_flight = $request->keberangkatan_nomor_flight;
        $tambah->kedatangan_nama_pesawat_ka_bus_kapal_lainnya = $request->kedatangan_nama_pesawat_ka_bus_kapal_lainnya;
        $tambah->kedatangan_kode_booking = $request->kedatangan_kode_booking;
        $tambah->kedatangan_nomor_tiket = $request->kedatangan_nomor_tiket;
        $tambah->kedatangan_nomor_seat = $request->kedatangan_nomor_seat;
        $tambah->kedatangan_nomor_flight = $request->kedatangan_nomor_flight;
        $tambah->nama_hotel = $request->nama_hotel;
        $tambah->nomor_kamar = $request->nomor_kamar;
        $tambah->tgl_checkin = $request->tgl_checkin;
        $tambah->tgl_checkout = $request->tgl_checkout;
        $tambah->email = $request->email;
        $tambah->telp_hotel = $request->telp_hotel;
        $tambah->alamat_hotel = $request->alamat_hotel;
        if ($request->dokumen_pendukung) {
            $file = $request->file('dokumen_pendukung');
            $file_nama = time() . $file->getClientOriginalName();
            $file->move('gambar', $file_nama);
            $tambah->dokumen_pendukung = $file_nama;
        }
        $tambah->jumlah_total = $request->total_riil + $request->total_perjalanan_dinas;
        $tambah->id_user = Auth::user()->id;

        $tambah->save();

        DB::table('program_kerja')->where('kode_kegiatan', $request->kode_kegiatan)->update(['nilai' => $request->sisa_nilai_kegiatan]);

        Alert::success('Data Berhasil', 'Data Berhasil ditambahkan');
        return redirect()->route('kelola_spj');
    }

    public function edit($id)
    {
        $edit = Spj_staff::find($id);
        return view('halaman_admin.entry_spj.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $update = Spj_staff::find($id);

        if ($request->dokumen_pendukung) {

            $update->no_sppd = $request->no_sppd;
            $update->nama_lengkap = $request->nama_lengkap;
            $update->nip = $request->nip;
            $update->jabatan = $request->jabatan;
            $update->pangkat = $request->pangkat;
            $update->golongan = $request->golongan;
            $update->unit = $request->unit;
            $update->tingkat_biaya = $request->tingkat_biaya;
            $update->tanggal_berangkat = $request->tanggal_berangkat;
            $update->tanggal_kembali = $request->tanggal_kembali;
            $update->selama = $request->selama;
            $update->tinggal_to_bandara_terminal = $request->tinggal_to_bandara_terminal;
            $update->bandara_terminal_to_tujuan = $request->bandara_terminal_to_tujuan;
            $update->tujuan_bandara_terminal = $request->tujuan_bandara_terminal;
            $update->bandara_terminal_tinggal = $request->bandara_terminal_tinggal;
            $update->biaya_hotel = $request->biaya_hotel;
            $update->belanja_bbm = $request->belanja_bbm;
            $update->transport_pp = $request->transport_pp;
            $update->medical_checkup = $request->medical_checkup;
            $update->total_riil = $request->total_riil;
            $update->uang_harian = $request->uang_harian;
            $update->biaya_transportasi_darat = $request->biaya_transportasi_darat;
            $update->biaya_tiket_pesawat = $request->biaya_tiket_pesawat;
            $update->biaya_bahan_bakar = $request->biaya_bahan_bakar;
            $update->biaya_penginapan = $request->biaya_penginapan;
            $update->biaya_representase = $request->biaya_representase;
            $update->daftar_pernyataan = $request->daftar_pernyataan;
            $update->total_perjalanan_dinas = $request->total_perjalanan_dinas;
            $update->kode_kegiatan = $request->kode_kegiatan;
            $update->nilai_kegiatan = $request->nilai_kegiatan;
            $update->sisa_nilai_kegiatan = $request->sisa_nilai_kegiatan;
            $update->keperluan = $request->keperluan;
            $update->daerah_tujuan = $request->daerah_tujuan;
            $update->instansi_tujuan = $request->instansi_tujuan;
            $update->keberangkatan_nama_pesawat_ka_bus_kapal_lainnya = $request->keberangkatan_nama_pesawat_ka_bus_kapal_lainnya;
            $update->keberangkatan_kode_booking = $request->keberangkatan_kode_booking;
            $update->keberangkatan_nomor_tiket = $request->keberangkatan_nomor_tiket;
            $update->keberangkatan_nomor_seat = $request->keberangkatan_nomor_seat;
            $update->keberangkatan_nomor_flight = $request->keberangkatan_nomor_flight;
            $update->kedatangan_nama_pesawat_ka_bus_kapal_lainnya = $request->kedatangan_nama_pesawat_ka_bus_kapal_lainnya;
            $update->kedatangan_kode_booking = $request->kedatangan_kode_booking;
            $update->kedatangan_nomor_tiket = $request->kedatangan_nomor_tiket;
            $update->kedatangan_nomor_seat = $request->kedatangan_nomor_seat;
            $update->kedatangan_nomor_flight = $request->kedatangan_nomor_flight;
            $update->nama_hotel = $request->nama_hotel;
            $update->nomor_kamar = $request->nomor_kamar;
            $update->tgl_checkin = $request->tgl_checkin;
            $update->tgl_checkout = $request->tgl_checkout;
            $update->email = $request->email;
            $update->telp_hotel = $request->telp_hotel;
            $update->alamat_hotel = $request->alamat_hotel;

            $file = $request->file('dokumen_pendukung');
            $file_nama = time() . $file->getClientOriginalName();
            $file->move('gambar', $file_nama);
            File::delete('gambar', $update->dokumen_pendukung);
            $update->dokumen_pendukung = $file_nama;

            $update->jumlah_total = $request->total_riil + $request->total_perjalanan_dinas;

            $update->save();
        } else {
            $update->no_sppd = $request->no_sppd;
            $update->nama_lengkap = $request->nama_lengkap;
            $update->nip = $request->nip;
            $update->jabatan = $request->jabatan;
            $update->pangkat = $request->pangkat;
            $update->golongan = $request->golongan;
            $update->unit = $request->unit;
            $update->tingkat_biaya = $request->tingkat_biaya;
            $update->tanggal_berangkat = $request->tanggal_berangkat;
            $update->tanggal_kembali = $request->tanggal_kembali;
            $update->selama = $request->selama;
            $update->tinggal_to_bandara_terminal = $request->tinggal_to_bandara_terminal;
            $update->bandara_terminal_to_tujuan = $request->bandara_terminal_to_tujuan;
            $update->tujuan_bandara_terminal = $request->tujuan_bandara_terminal;
            $update->bandara_terminal_tinggal = $request->bandara_terminal_tinggal;
            $update->biaya_hotel = $request->biaya_hotel;
            $update->belanja_bbm = $request->belanja_bbm;
            $update->transport_pp = $request->transport_pp;
            $update->medical_checkup = $request->medical_checkup;
            $update->total_riil = $request->total_riil;
            $update->uang_harian = $request->uang_harian;
            $update->biaya_transportasi_darat = $request->biaya_transportasi_darat;
            $update->biaya_tiket_pesawat = $request->biaya_tiket_pesawat;
            $update->biaya_bahan_bakar = $request->biaya_bahan_bakar;
            $update->biaya_penginapan = $request->biaya_penginapan;
            $update->biaya_representase = $request->biaya_representase;
            $update->daftar_pernyataan = $request->daftar_pernyataan;
            $update->total_perjalanan_dinas = $request->total_perjalanan_dinas;
            $update->kode_kegiatan = $request->kode_kegiatan;
            $update->nilai_kegiatan = $request->nilai_kegiatan;
            $update->sisa_nilai_kegiatan = $request->sisa_nilai_kegiatan;
            $update->keperluan = $request->keperluan;
            $update->daerah_tujuan = $request->daerah_tujuan;
            $update->instansi_tujuan = $request->instansi_tujuan;
            $update->keberangkatan_nama_pesawat_ka_bus_kapal_lainnya = $request->keberangkatan_nama_pesawat_ka_bus_kapal_lainnya;
            $update->keberangkatan_kode_booking = $request->keberangkatan_kode_booking;
            $update->keberangkatan_nomor_tiket = $request->keberangkatan_nomor_tiket;
            $update->keberangkatan_nomor_seat = $request->keberangkatan_nomor_seat;
            $update->keberangkatan_nomor_flight = $request->keberangkatan_nomor_flight;
            $update->kedatangan_nama_pesawat_ka_bus_kapal_lainnya = $request->kedatangan_nama_pesawat_ka_bus_kapal_lainnya;
            $update->kedatangan_kode_booking = $request->kedatangan_kode_booking;
            $update->kedatangan_nomor_tiket = $request->kedatangan_nomor_tiket;
            $update->kedatangan_nomor_seat = $request->kedatangan_nomor_seat;
            $update->kedatangan_nomor_flight = $request->kedatangan_nomor_flight;
            $update->nama_hotel = $request->nama_hotel;
            $update->nomor_kamar = $request->nomor_kamar;
            $update->tgl_checkin = $request->tgl_checkin;
            $update->tgl_checkout = $request->tgl_checkout;
            $update->email = $request->email;
            $update->telp_hotel = $request->telp_hotel;
            $update->alamat_hotel = $request->alamat_hotel;
            $update->jumlah_total = $request->total_riil * $request->total_perjalanan_dinas;
            $update->save();
        }

        Alert::success('Data Berhasil', 'Data Berhasil ditambahkan');
        return redirect()->route('kelola_spj');
    }

    public function delete($id)
    {
        $delete = Spj_staff::find($id);
        $delete->delete();

        Alert::error('Data Berhasil', 'Data Berhasil ditambahkan');
        return redirect()->route('kelola_spj');
    }

    public function cek_sppd()
    {
        $no_sppd = $_POST['no_sppd'];

        $isi = DB::table('detail_surat')
            ->JOIN('pegawai', 'pegawai.nip', '=', 'detail_surat.nip')
            ->JOIN('surat_tugas', 'surat_tugas.id', '=', 'detail_surat.surat_tugas_id')
            ->WHERE('detail_surat.no_sppd', $no_sppd)
            ->SELECT('detail_surat.*', 'pegawai.*', 'surat_tugas.tanggal_berangkat', 'surat_tugas.tanggal_kembali', 'surat_tugas.selama', 'surat_tugas.uraian', 'surat_tugas.tempat_tujuan')
            ->FIRST();

        return response()->json($isi);
    }

    public function get_biaya()
    {
        $kategori = $_POST['kategori'];

        $biayahotel = DB::table('biaya_hotel')->where('kategori', $kategori)->get();

        return response()->json($biayahotel);
    }


    public function get_kegiatan()
    {
        $kode = $_POST['kode'];

        $kegiatan = DB::table('program_kerja')->where('kode_kegiatan', $kode)->first();

        return response()->json($kegiatan);
    }

    public function get_representase()
    {
        $jabatan = $_POST['jabatan'];

        $biayarepresentase = DB::table('biaya_representasi')->where('jabatan', $jabatan)->get();

        return response()->json($biayarepresentase);
    }
}
