<?php
/**
 * PHPMaker 2021 user level settings
 */
namespace PHPMaker2021\Kitasehat;

// User level info
$USER_LEVELS = [["-2","Anonymous"],
    ["0","Default"]];
// User level priv info
$USER_LEVEL_PRIVS = [["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_bpjs","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_bpjs","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_umum","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_umum","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}daerah","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}daerah","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}dokter","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}dokter","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}fasilitas","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}fasilitas","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}fasilitas_rumah_sakit","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}fasilitas_rumah_sakit","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}pasien","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}pasien","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}rumah_sakit","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}rumah_sakit","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}webusers","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}webusers","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}kontak_darurat","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}kontak_darurat","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}praktik_poli","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}praktik_poli","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}image_slider","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}image_slider","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}audittrail","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}audittrail","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}data_durasi","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}data_durasi","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}userlevelpermissions","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}userlevelpermissions","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}userlevels","-2","0"],
<<<<<<< HEAD
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}userlevels","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_bpjs_rs","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_bpjs_rs","0","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_umum_rs","-2","0"],
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_umum_rs","0","0"]];
=======
    ["{6882EE26-EB4F-42D3-AF9E-95D0FA907878}userlevels","0","0"]];
>>>>>>> parent of 72b00b1 (rumah sakit views refinements)
// User level table info
$USER_LEVEL_TABLES = [["antrean_bpjs","antrean_bpjs","Antrean BPJS",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","antreanbpjslist"],
    ["antrean_umum","antrean_umum","Antrean Umum",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","antreanumumlist"],
    ["daerah","daerah","Daerah",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","daerahlist"],
    ["dokter","dokter","Data Dokter",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","dokterlist"],
    ["fasilitas","fasilitas","Fasilitas/Layanan",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","fasilitaslist"],
    ["fasilitas_rumah_sakit","fasilitas_rumah_sakit","Layanan @Rumah Sakit",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","fasilitasrumahsakitlist"],
    ["pasien","pasien","Data Pasien",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","pasienlist"],
    ["rumah_sakit","rumah_sakit","Rumah Sakit",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","rumahsakitlist"],
    ["webusers","webusers","webusers",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","webuserslist"],
    ["kontak_darurat","kontak_darurat","Kontak Darurat Pasien",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","kontakdaruratlist"],
    ["praktik_poli","praktik_poli","Data Praktik Poli",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","praktikpolilist"],
    ["image_slider","image_slider","image slider",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}",""],
    ["audittrail","audittrail","audittrail",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","audittraillist"],
    ["data_durasi","data_durasi","data durasi",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","datadurasilist"],
    ["userlevelpermissions","userlevelpermissions","userlevelpermissions",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","userlevelpermissionslist"],
<<<<<<< HEAD
    ["userlevels","userlevels","userlevels",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","userlevelslist"],
    ["antrean_bpjs_rs","antrean_bpjs_rs","Antrean BPJS",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","antreanbpjsrslist"],
    ["antrean_umum_rs","antrean_umum_rs","Antrean Umum",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","antreanumumrslist"]];
=======
    ["userlevels","userlevels","userlevels",true,"{6882EE26-EB4F-42D3-AF9E-95D0FA907878}","userlevelslist"]];
>>>>>>> parent of 72b00b1 (rumah sakit views refinements)
