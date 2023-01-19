<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case '':
        case 'home':
            file_exists('pages/home.php') ? include 'pages/home.php' : include "pages/404.php";
            break;
        case'lokasiread':
            file_exists('pages/admin/lokasiread.php') ? include 'pages/admin/lokasiread.php' : include "pages/404.php";
            break;
        case'lokasicreate':
            file_exists('pages/admin/lokasicreate.php') ? include 'pages/admin/lokasicreate.php' : include "pages/404.php";
            break;
        case'lokasiupdate':
            file_exists('pages/admin/lokasiupdate.php') ? include 'pages/admin/lokasiupdate.php' : include "pages/404.php";
            break;
        case'lokasidelete':
            file_exists('pages/admin/lokasidelete.php') ? include 'pages/admin/lokasidelete.php' : include "pages/404.php";
            break;
        case'jabatanread':
            file_exists('pages/jabatan/jabatanread.php') ? include 'pages/jabatan/jabatanread.php' : include "pages/404.php";
            break;
        case'jabatancreate':
            file_exists('pages/jabatan/jabatancreate.php') ? include 'pages/jabatan/jabatancreate.php' : include "pages/404.php";
            break;
        case'jabatanupdate':
            file_exists('pages/jabatan/jabatanupdate.php') ? include 'pages/jabatan/jabatanupdate.php' : include "pages/404.php";
            break;
        case'jabatandelete':
            file_exists('pages/jabatan/jabatandelete.php') ? include 'pages/jabatan/jabatandelete.php' : include "pages/404.php";
            break;
        case'bagianread':
            file_exists('pages/bagian/bagianread.php') ? include 'pages/bagian/bagianread.php' : include "pages/404.php";
            break;
        case'bagiancreate':
            file_exists('pages/bagian/bagiancreate.php') ? include 'pages/bagian/bagiancreate.php' : include "pages/404.php";
            break;
        case'bagianupdate':
            file_exists('pages/bagian/bagianupdate.php') ? include 'pages/bagian/bagianupdate.php' : include "pages/404.php";
            break;
        case'bagiandelete':
            file_exists('pages/bagian/bagiandelete.php') ? include 'pages/bagian/bagiandelete.php' : include "pages/404.php";
            break;
            case 'karyawanread':
                file_exists('pages/karyawan/karyawanread.php') ? include 'pages/karyawan/karyawanread.php' : include "pages/404.php";
                break;
            case 'karyawancreate':
                file_exists('pages/admin/karyawancreate.php') ? include 'pages/admin/karyawancreate.php' : include "pages/404.php";
                break;
            case 'karyawanbagian':
                file_exists('pages/karyawan/karyawanbagian.php') ? include 'pages/karyawan/karyawanbagian.php' : include "pages/404.php";
                break;
            case 'karyawanjabatan':
                file_exists('pages/karyawan/karyawanjabatan.php') ? include 'pages/karyawan/karyawanjabatan.php' : include "pages/404.php";
                break;
            case 'karyawanupdate':
                file_exists('pages/karyawan/karyawanupdate.php') ? include 'pages/karyawan/karyawanupdate.php' : include "pages/404.php";
                break;
            case 'karyawandelete':
                file_exists('pages/karyawan/karyawandelete.php') ? include 'pages/karyawan/karyawandelete.php' : include "pages/404.php";
                break;
        default:
            include "pages/404.php";
    }
} else {
    include "pages/home.php";
}