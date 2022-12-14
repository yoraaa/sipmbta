<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pmb', 'm_pmb');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->render('index/index', $data);
    }

    public function pendaftarprodi1()
    {
        $data['title'] = 'Grafik Berdasarkan Prodi 1';
        $result = null;
        $sliced = null;
        $max = 0;
        $selected = null;
        $prodi = $this->m_pmb->listProdi();
        foreach ($prodi as $key => $p) {
            $prodi[$key]['jumlah'] = $this->m_pmb->jumlahPendaftarProdi1($p['id_prodi']);           
        }


        foreach ($prodi as $p => $prod) {          
            $result[$p] = [
                "name"  => $prod['nama_prodi'],
                "jumlah" => $prod['jumlah'],
                "y"     => intval($prod['jumlah']),
            ];
        }

        $data['pendaftar'] = $prodi;
        $data['grafik1'] = json_encode($result);
        $this->render('index/grafik_satu', $data);
    }

    public function pendaftarprodi2()
    {
        $data['title'] = 'Grafik Berdasarkan Prodi 2';
        $prodi = $this->m_pmb->listProdi();
        foreach ($prodi as $key => $p) {
            $prodi[$key]['jumlah'] = $this->m_pmb->jumlahPendaftarProdi1($p['id_prodi']);
            $prodi[$key]['jumlah2'] = $this->m_pmb->jumlahPendaftarProdi2($p['id_prodi']);
            
        }

        $hasil = null;
        foreach ($prodi as $p => $prod) {
            $hasil[$p] = [
                "name"  => $prod['nama_prodi'],
                "jumlah" => $prod['jumlah2'],
                "y"     => intval($prod['jumlah']),
            ];
        }

        $data['pendaftar'] = $prodi;
        $data['grafik2'] = json_encode($hasil);
        $this->render('index/grafik_dua', $data);
    }

    public function pendaftarPrestasi()
    {
        $data['title'] = 'Grafik Berdasarkan Tingkat Prestasi Pendaftar';
        $jalur = $this->m_pmb->listPrestasi();
       
        $hasil = null;
        foreach ($jalur as $p => $jal) {
            $hasil[$p] = [
                "name"  => $jal['tingkat'],
                "jumlah" => $jal['jumlah'],
                "y"     => intval($jal['jumlah']),
            ];
        }

        $data['pendaftar'] = $jalur;
        $data['grafik4'] = json_encode($hasil);
        $this->render('index/grafik_empat', $data);

    }

    public function pendaftarJalur()
    {
        $data['title'] = 'Grafik Berdasarkan Jalur Pendaftaran';
        $jalur = $this->m_pmb->listJalur();
        foreach ($jalur as $key => $p) {
            $jalur[$key]['jumlah'] = $this->m_pmb->jumlahPendaftarBerdasarkanJalur($p['id_jalur']);
        }

        $hasil = null;
        foreach ($jalur as $p => $jal) {
            $hasil[$p] = [
                "name"  => $jal['nama_jalur'],
                "jumlah" => $jal['jumlah'],
                "y"     => intval($jal['jumlah']),
            ];
        }

        $data['pendaftar'] = $jalur;
        $data['grafik4'] = json_encode($hasil);
        $this->render('index/grafik_empat', $data);

    }

    public function grafikpendapatan()
    {
        $data['title'] = 'Grafik Berdasarkan Total Pendapatan Per Bank';
        $jalur = $this->m_pmb->pendapatanPerBank();
       
        $hasil = null;
        foreach ($jalur as $p => $jal) {
            $hasil[$p] = [
                "name"  => $jal['nama_bank'],
                "y"  => intval($jal['total']),
            ];
        }

        $totalP = null;
        foreach ($jalur as $p => $jal) {
            $totalP += intval($jal['total']);
        }

        
        $data['grafik5'] = json_encode($hasil);
        $data['total_pendapatan'] = json_encode($totalP);
        $this->render('index/grafik_lima', $data);

    }

    public function perbandinganPendaftarBank()
    {
        $data['title'] = 'Grafik Berdasarkan Total Pendaftar Berdasarkan Bank dan Status Pembayaran';
        $bank = $this->m_pmb->pendapatanPerBank();
        $status = $this->m_pmb->statusPembayaran();
       
        $namaBank = [];
        foreach ($bank as $p => $bank) {
            array_push($namaBank, $bank['nama_bank']);
        }

        $statusBayar = [];
        $statusBelum=[];
        $totalPendaftar=null;
        foreach ($status as $p => $sts) {

            if($sts['status_pembayaran'] == '1'){
                array_push($statusBayar, intval($sts['jumlah']));
            }else{
                array_push($statusBelum,intval($sts['jumlah']));
            }

            $totalPendaftar += $sts['jumlah'];
            
        }

        $hasil[] =[
            "name" => "Sudah Bayar",
            "data" => $statusBayar
        ];

        $hasil[] =[
            "name" => "Belum Bayar",
            "data" => $statusBelum
        ];
               
        $data['status'] = json_encode($hasil);
        $data['bank'] = json_encode($namaBank);
        $data['pendaftar'] = json_encode($totalPendaftar);
        $this->render('index/grafik_enam', $data);
    }

    
}
