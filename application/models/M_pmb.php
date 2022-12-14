<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pmb extends CI_Model
{
    public function listPendaftar()
    {
        return $this->db->get('pendaftar')->result_array();
    }

    public function listProdi()
    {
        return $this->db->get('prodi')->result_array();
    }

    public function listJalur()
    {
        return $this->db->get('jalur_pendaftaran')->result_array();
    }


    public function jumlahPendaftarProdi1($idProdi)
    {
        $result = 0;
        $this->db->where('id_prodi1', $idProdi);
        $data = $this->db->get('pendaftar')->result_array();
        if (!empty($data)) {
            $result = count($data);
        }
        return $result;
    }

    public function jumlahPendaftarProdi2($idProdi)
    {
        $result = 0;
        $this->db->where('id_prodi2', $idProdi);
        $data = $this->db->get('pendaftar')->result_array();
        if (!empty($data)) {
            $result = count($data);
        }
        return $result;
    }

    public function listPrestasi()
    {
        $this->db->select( 'COUNT(syaratprestasi.id_pendaftar) as jumlah, syaratprestasi.tingkat_prestasi as tingkat');
        $this->db->from('syaratprestasi');
        $this->db->group_by('syaratprestasi.tingkat_prestasi');
        return $this->db->get()->result_array();
    }

    public function jumlahPendaftarBerdasarkanJalur($idJalur)
    {
        $result = 0;
        $this->db->where('id_jalur', $idJalur);
        $data = $this->db->get('pendaftar')->result_array();
        if (!empty($data)) {
            $result = count($data);
        }
        return $result;
    }

    public function pendapatanPerBank()
    {
        $this->db->select( 'SUM(pembayaran.jumlah_bayar) as total, bank.nama_bank');
        $this->db->from('pembayaran');
        $this->db->join('bank','pembayaran.id_bank= bank.id_bank');
        $this->db->where('pembayaran.status_pembayaran = 1');
        $this->db->group_by('pembayaran.id_bank');
        return $this->db->get()->result_array();
    }

    public function statusPembayaran(){
        $this->db->select('COUNT(pembayaran.id_pendaftar) as jumlah, pembayaran.status_pembayaran, bank.nama_bank ');
        $this->db->from('pembayaran');
        $this->db->join('bank','pembayaran.id_bank= bank.id_bank');
        $this->db->group_by('bank.nama_bank, pembayaran.status_pembayaran');
        return $this->db->get()->result_array();
    }



   
}
