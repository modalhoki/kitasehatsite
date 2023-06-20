<?php

namespace PHPMaker2021\Kitasehat;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // antrean_bpjs
    $app->any('/antreanbpjslist[/{id}]', AntreanBpjsController::class . ':list')->add(PermissionMiddleware::class)->setName('antreanbpjslist-antrean_bpjs-list'); // list
    $app->any('/antreanbpjsview[/{id}]', AntreanBpjsController::class . ':view')->add(PermissionMiddleware::class)->setName('antreanbpjsview-antrean_bpjs-view'); // view
    $app->any('/antreanbpjsedit[/{id}]', AntreanBpjsController::class . ':edit')->add(PermissionMiddleware::class)->setName('antreanbpjsedit-antrean_bpjs-edit'); // edit
    $app->any('/antreanbpjssearch', AntreanBpjsController::class . ':search')->add(PermissionMiddleware::class)->setName('antreanbpjssearch-antrean_bpjs-search'); // search
    $app->group(
        '/antrean_bpjs',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AntreanBpjsController::class . ':list')->add(PermissionMiddleware::class)->setName('antrean_bpjs/list-antrean_bpjs-list-2'); // list
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AntreanBpjsController::class . ':view')->add(PermissionMiddleware::class)->setName('antrean_bpjs/view-antrean_bpjs-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AntreanBpjsController::class . ':edit')->add(PermissionMiddleware::class)->setName('antrean_bpjs/edit-antrean_bpjs-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', AntreanBpjsController::class . ':search')->add(PermissionMiddleware::class)->setName('antrean_bpjs/search-antrean_bpjs-search-2'); // search
        }
    );

    // antrean_umum
    $app->any('/antreanumumlist[/{id}]', AntreanUmumController::class . ':list')->add(PermissionMiddleware::class)->setName('antreanumumlist-antrean_umum-list'); // list
    $app->any('/antreanumumview[/{id}]', AntreanUmumController::class . ':view')->add(PermissionMiddleware::class)->setName('antreanumumview-antrean_umum-view'); // view
    $app->any('/antreanumumedit[/{id}]', AntreanUmumController::class . ':edit')->add(PermissionMiddleware::class)->setName('antreanumumedit-antrean_umum-edit'); // edit
    $app->any('/antreanumumsearch', AntreanUmumController::class . ':search')->add(PermissionMiddleware::class)->setName('antreanumumsearch-antrean_umum-search'); // search
    $app->group(
        '/antrean_umum',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AntreanUmumController::class . ':list')->add(PermissionMiddleware::class)->setName('antrean_umum/list-antrean_umum-list-2'); // list
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AntreanUmumController::class . ':view')->add(PermissionMiddleware::class)->setName('antrean_umum/view-antrean_umum-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AntreanUmumController::class . ':edit')->add(PermissionMiddleware::class)->setName('antrean_umum/edit-antrean_umum-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', AntreanUmumController::class . ':search')->add(PermissionMiddleware::class)->setName('antrean_umum/search-antrean_umum-search-2'); // search
        }
    );

    // daerah
    $app->any('/daerahlist[/{id}]', DaerahController::class . ':list')->add(PermissionMiddleware::class)->setName('daerahlist-daerah-list'); // list
    $app->any('/daerahadd[/{id}]', DaerahController::class . ':add')->add(PermissionMiddleware::class)->setName('daerahadd-daerah-add'); // add
    $app->any('/daerahedit[/{id}]', DaerahController::class . ':edit')->add(PermissionMiddleware::class)->setName('daerahedit-daerah-edit'); // edit
    $app->any('/daerahsearch', DaerahController::class . ':search')->add(PermissionMiddleware::class)->setName('daerahsearch-daerah-search'); // search
    $app->group(
        '/daerah',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DaerahController::class . ':list')->add(PermissionMiddleware::class)->setName('daerah/list-daerah-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DaerahController::class . ':add')->add(PermissionMiddleware::class)->setName('daerah/add-daerah-add-2'); // add
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', DaerahController::class . ':edit')->add(PermissionMiddleware::class)->setName('daerah/edit-daerah-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', DaerahController::class . ':search')->add(PermissionMiddleware::class)->setName('daerah/search-daerah-search-2'); // search
        }
    );

    // dokter
    $app->any('/dokterlist[/{id}]', DokterController::class . ':list')->add(PermissionMiddleware::class)->setName('dokterlist-dokter-list'); // list
    $app->any('/dokteradd[/{id}]', DokterController::class . ':add')->add(PermissionMiddleware::class)->setName('dokteradd-dokter-add'); // add
    $app->any('/dokteraddopt', DokterController::class . ':addopt')->add(PermissionMiddleware::class)->setName('dokteraddopt-dokter-addopt'); // addopt
    $app->any('/dokterview[/{id}]', DokterController::class . ':view')->add(PermissionMiddleware::class)->setName('dokterview-dokter-view'); // view
    $app->any('/dokteredit[/{id}]', DokterController::class . ':edit')->add(PermissionMiddleware::class)->setName('dokteredit-dokter-edit'); // edit
    $app->any('/dokterdelete[/{id}]', DokterController::class . ':delete')->add(PermissionMiddleware::class)->setName('dokterdelete-dokter-delete'); // delete
    $app->any('/doktersearch', DokterController::class . ':search')->add(PermissionMiddleware::class)->setName('doktersearch-dokter-search'); // search
    $app->group(
        '/dokter',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DokterController::class . ':list')->add(PermissionMiddleware::class)->setName('dokter/list-dokter-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DokterController::class . ':add')->add(PermissionMiddleware::class)->setName('dokter/add-dokter-add-2'); // add
            $group->any('/' . Config("ADDOPT_ACTION") . '', DokterController::class . ':addopt')->add(PermissionMiddleware::class)->setName('dokter/addopt-dokter-addopt-2'); // addopt
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', DokterController::class . ':view')->add(PermissionMiddleware::class)->setName('dokter/view-dokter-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', DokterController::class . ':edit')->add(PermissionMiddleware::class)->setName('dokter/edit-dokter-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', DokterController::class . ':delete')->add(PermissionMiddleware::class)->setName('dokter/delete-dokter-delete-2'); // delete
            $group->any('/' . Config("SEARCH_ACTION") . '', DokterController::class . ':search')->add(PermissionMiddleware::class)->setName('dokter/search-dokter-search-2'); // search
        }
    );

    // fasilitas
    $app->any('/fasilitaslist[/{id}]', FasilitasController::class . ':list')->add(PermissionMiddleware::class)->setName('fasilitaslist-fasilitas-list'); // list
    $app->any('/fasilitasadd[/{id}]', FasilitasController::class . ':add')->add(PermissionMiddleware::class)->setName('fasilitasadd-fasilitas-add'); // add
    $app->any('/fasilitasaddopt', FasilitasController::class . ':addopt')->add(PermissionMiddleware::class)->setName('fasilitasaddopt-fasilitas-addopt'); // addopt
    $app->any('/fasilitasedit[/{id}]', FasilitasController::class . ':edit')->add(PermissionMiddleware::class)->setName('fasilitasedit-fasilitas-edit'); // edit
    $app->any('/fasilitassearch', FasilitasController::class . ':search')->add(PermissionMiddleware::class)->setName('fasilitassearch-fasilitas-search'); // search
    $app->group(
        '/fasilitas',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', FasilitasController::class . ':list')->add(PermissionMiddleware::class)->setName('fasilitas/list-fasilitas-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', FasilitasController::class . ':add')->add(PermissionMiddleware::class)->setName('fasilitas/add-fasilitas-add-2'); // add
            $group->any('/' . Config("ADDOPT_ACTION") . '', FasilitasController::class . ':addopt')->add(PermissionMiddleware::class)->setName('fasilitas/addopt-fasilitas-addopt-2'); // addopt
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', FasilitasController::class . ':edit')->add(PermissionMiddleware::class)->setName('fasilitas/edit-fasilitas-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', FasilitasController::class . ':search')->add(PermissionMiddleware::class)->setName('fasilitas/search-fasilitas-search-2'); // search
        }
    );

    // fasilitas_rumah_sakit
    $app->any('/fasilitasrumahsakitlist[/{id}]', FasilitasRumahSakitController::class . ':list')->add(PermissionMiddleware::class)->setName('fasilitasrumahsakitlist-fasilitas_rumah_sakit-list'); // list
    $app->any('/fasilitasrumahsakitadd[/{id}]', FasilitasRumahSakitController::class . ':add')->add(PermissionMiddleware::class)->setName('fasilitasrumahsakitadd-fasilitas_rumah_sakit-add'); // add
    $app->any('/fasilitasrumahsakitaddopt', FasilitasRumahSakitController::class . ':addopt')->add(PermissionMiddleware::class)->setName('fasilitasrumahsakitaddopt-fasilitas_rumah_sakit-addopt'); // addopt
    $app->any('/fasilitasrumahsakitedit[/{id}]', FasilitasRumahSakitController::class . ':edit')->add(PermissionMiddleware::class)->setName('fasilitasrumahsakitedit-fasilitas_rumah_sakit-edit'); // edit
    $app->any('/fasilitasrumahsakitdelete[/{id}]', FasilitasRumahSakitController::class . ':delete')->add(PermissionMiddleware::class)->setName('fasilitasrumahsakitdelete-fasilitas_rumah_sakit-delete'); // delete
    $app->any('/fasilitasrumahsakitpreview', FasilitasRumahSakitController::class . ':preview')->add(PermissionMiddleware::class)->setName('fasilitasrumahsakitpreview-fasilitas_rumah_sakit-preview'); // preview
    $app->group(
        '/fasilitas_rumah_sakit',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', FasilitasRumahSakitController::class . ':list')->add(PermissionMiddleware::class)->setName('fasilitas_rumah_sakit/list-fasilitas_rumah_sakit-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', FasilitasRumahSakitController::class . ':add')->add(PermissionMiddleware::class)->setName('fasilitas_rumah_sakit/add-fasilitas_rumah_sakit-add-2'); // add
            $group->any('/' . Config("ADDOPT_ACTION") . '', FasilitasRumahSakitController::class . ':addopt')->add(PermissionMiddleware::class)->setName('fasilitas_rumah_sakit/addopt-fasilitas_rumah_sakit-addopt-2'); // addopt
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', FasilitasRumahSakitController::class . ':edit')->add(PermissionMiddleware::class)->setName('fasilitas_rumah_sakit/edit-fasilitas_rumah_sakit-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', FasilitasRumahSakitController::class . ':delete')->add(PermissionMiddleware::class)->setName('fasilitas_rumah_sakit/delete-fasilitas_rumah_sakit-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', FasilitasRumahSakitController::class . ':preview')->add(PermissionMiddleware::class)->setName('fasilitas_rumah_sakit/preview-fasilitas_rumah_sakit-preview-2'); // preview
        }
    );

    // pasien
    $app->any('/pasienlist[/{id}]', PasienController::class . ':list')->add(PermissionMiddleware::class)->setName('pasienlist-pasien-list'); // list
    $app->any('/pasienadd[/{id}]', PasienController::class . ':add')->add(PermissionMiddleware::class)->setName('pasienadd-pasien-add'); // add
    $app->any('/pasienview[/{id}]', PasienController::class . ':view')->add(PermissionMiddleware::class)->setName('pasienview-pasien-view'); // view
    $app->any('/pasienedit[/{id}]', PasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('pasienedit-pasien-edit'); // edit
    $app->any('/pasiendelete[/{id}]', PasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('pasiendelete-pasien-delete'); // delete
    $app->any('/pasiensearch', PasienController::class . ':search')->add(PermissionMiddleware::class)->setName('pasiensearch-pasien-search'); // search
    $app->group(
        '/pasien',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', PasienController::class . ':list')->add(PermissionMiddleware::class)->setName('pasien/list-pasien-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', PasienController::class . ':add')->add(PermissionMiddleware::class)->setName('pasien/add-pasien-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', PasienController::class . ':view')->add(PermissionMiddleware::class)->setName('pasien/view-pasien-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', PasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('pasien/edit-pasien-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', PasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('pasien/delete-pasien-delete-2'); // delete
            $group->any('/' . Config("SEARCH_ACTION") . '', PasienController::class . ':search')->add(PermissionMiddleware::class)->setName('pasien/search-pasien-search-2'); // search
        }
    );

    // rumah_sakit
    $app->any('/rumahsakitlist[/{id}]', RumahSakitController::class . ':list')->add(PermissionMiddleware::class)->setName('rumahsakitlist-rumah_sakit-list'); // list
    $app->any('/rumahsakitadd[/{id}]', RumahSakitController::class . ':add')->add(PermissionMiddleware::class)->setName('rumahsakitadd-rumah_sakit-add'); // add
    $app->any('/rumahsakitview[/{id}]', RumahSakitController::class . ':view')->add(PermissionMiddleware::class)->setName('rumahsakitview-rumah_sakit-view'); // view
    $app->any('/rumahsakitedit[/{id}]', RumahSakitController::class . ':edit')->add(PermissionMiddleware::class)->setName('rumahsakitedit-rumah_sakit-edit'); // edit
    $app->any('/rumahsakitdelete[/{id}]', RumahSakitController::class . ':delete')->add(PermissionMiddleware::class)->setName('rumahsakitdelete-rumah_sakit-delete'); // delete
    $app->any('/rumahsakitsearch', RumahSakitController::class . ':search')->add(PermissionMiddleware::class)->setName('rumahsakitsearch-rumah_sakit-search'); // search
    $app->group(
        '/rumah_sakit',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RumahSakitController::class . ':list')->add(PermissionMiddleware::class)->setName('rumah_sakit/list-rumah_sakit-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RumahSakitController::class . ':add')->add(PermissionMiddleware::class)->setName('rumah_sakit/add-rumah_sakit-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RumahSakitController::class . ':view')->add(PermissionMiddleware::class)->setName('rumah_sakit/view-rumah_sakit-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RumahSakitController::class . ':edit')->add(PermissionMiddleware::class)->setName('rumah_sakit/edit-rumah_sakit-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RumahSakitController::class . ':delete')->add(PermissionMiddleware::class)->setName('rumah_sakit/delete-rumah_sakit-delete-2'); // delete
            $group->any('/' . Config("SEARCH_ACTION") . '', RumahSakitController::class . ':search')->add(PermissionMiddleware::class)->setName('rumah_sakit/search-rumah_sakit-search-2'); // search
        }
    );

    // webusers
    $app->any('/webuserslist[/{id}]', WebusersController::class . ':list')->add(PermissionMiddleware::class)->setName('webuserslist-webusers-list'); // list
    $app->any('/webusersadd[/{id}]', WebusersController::class . ':add')->add(PermissionMiddleware::class)->setName('webusersadd-webusers-add'); // add
    $app->any('/webusersview[/{id}]', WebusersController::class . ':view')->add(PermissionMiddleware::class)->setName('webusersview-webusers-view'); // view
    $app->any('/webusersedit[/{id}]', WebusersController::class . ':edit')->add(PermissionMiddleware::class)->setName('webusersedit-webusers-edit'); // edit
    $app->any('/webusersdelete[/{id}]', WebusersController::class . ':delete')->add(PermissionMiddleware::class)->setName('webusersdelete-webusers-delete'); // delete
    $app->group(
        '/webusers',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', WebusersController::class . ':list')->add(PermissionMiddleware::class)->setName('webusers/list-webusers-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', WebusersController::class . ':add')->add(PermissionMiddleware::class)->setName('webusers/add-webusers-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', WebusersController::class . ':view')->add(PermissionMiddleware::class)->setName('webusers/view-webusers-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', WebusersController::class . ':edit')->add(PermissionMiddleware::class)->setName('webusers/edit-webusers-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', WebusersController::class . ':delete')->add(PermissionMiddleware::class)->setName('webusers/delete-webusers-delete-2'); // delete
        }
    );

    // kontak_darurat
    $app->any('/kontakdaruratlist[/{id}]', KontakDaruratController::class . ':list')->add(PermissionMiddleware::class)->setName('kontakdaruratlist-kontak_darurat-list'); // list
    $app->any('/kontakdaruratadd[/{id}]', KontakDaruratController::class . ':add')->add(PermissionMiddleware::class)->setName('kontakdaruratadd-kontak_darurat-add'); // add
    $app->any('/kontakdaruratview[/{id}]', KontakDaruratController::class . ':view')->add(PermissionMiddleware::class)->setName('kontakdaruratview-kontak_darurat-view'); // view
    $app->any('/kontakdaruratedit[/{id}]', KontakDaruratController::class . ':edit')->add(PermissionMiddleware::class)->setName('kontakdaruratedit-kontak_darurat-edit'); // edit
    $app->any('/kontakdaruratdelete[/{id}]', KontakDaruratController::class . ':delete')->add(PermissionMiddleware::class)->setName('kontakdaruratdelete-kontak_darurat-delete'); // delete
    $app->any('/kontakdaruratpreview', KontakDaruratController::class . ':preview')->add(PermissionMiddleware::class)->setName('kontakdaruratpreview-kontak_darurat-preview'); // preview
    $app->group(
        '/kontak_darurat',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', KontakDaruratController::class . ':list')->add(PermissionMiddleware::class)->setName('kontak_darurat/list-kontak_darurat-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', KontakDaruratController::class . ':add')->add(PermissionMiddleware::class)->setName('kontak_darurat/add-kontak_darurat-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', KontakDaruratController::class . ':view')->add(PermissionMiddleware::class)->setName('kontak_darurat/view-kontak_darurat-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', KontakDaruratController::class . ':edit')->add(PermissionMiddleware::class)->setName('kontak_darurat/edit-kontak_darurat-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', KontakDaruratController::class . ':delete')->add(PermissionMiddleware::class)->setName('kontak_darurat/delete-kontak_darurat-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', KontakDaruratController::class . ':preview')->add(PermissionMiddleware::class)->setName('kontak_darurat/preview-kontak_darurat-preview-2'); // preview
        }
    );

    // praktik_poli
    $app->any('/praktikpolilist[/{id}]', PraktikPoliController::class . ':list')->add(PermissionMiddleware::class)->setName('praktikpolilist-praktik_poli-list'); // list
    $app->any('/praktikpoliadd[/{id}]', PraktikPoliController::class . ':add')->add(PermissionMiddleware::class)->setName('praktikpoliadd-praktik_poli-add'); // add
    $app->any('/praktikpoliedit[/{id}]', PraktikPoliController::class . ':edit')->add(PermissionMiddleware::class)->setName('praktikpoliedit-praktik_poli-edit'); // edit
    $app->any('/praktikpolidelete[/{id}]', PraktikPoliController::class . ':delete')->add(PermissionMiddleware::class)->setName('praktikpolidelete-praktik_poli-delete'); // delete
    $app->any('/praktikpolipreview', PraktikPoliController::class . ':preview')->add(PermissionMiddleware::class)->setName('praktikpolipreview-praktik_poli-preview'); // preview
    $app->group(
        '/praktik_poli',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', PraktikPoliController::class . ':list')->add(PermissionMiddleware::class)->setName('praktik_poli/list-praktik_poli-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', PraktikPoliController::class . ':add')->add(PermissionMiddleware::class)->setName('praktik_poli/add-praktik_poli-add-2'); // add
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', PraktikPoliController::class . ':edit')->add(PermissionMiddleware::class)->setName('praktik_poli/edit-praktik_poli-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', PraktikPoliController::class . ':delete')->add(PermissionMiddleware::class)->setName('praktik_poli/delete-praktik_poli-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', PraktikPoliController::class . ':preview')->add(PermissionMiddleware::class)->setName('praktik_poli/preview-praktik_poli-preview-2'); // preview
        }
    );

    // audittrail
    $app->any('/audittraillist[/{id}]', AudittrailController::class . ':list')->add(PermissionMiddleware::class)->setName('audittraillist-audittrail-list'); // list
    $app->any('/audittrailadd[/{id}]', AudittrailController::class . ':add')->add(PermissionMiddleware::class)->setName('audittrailadd-audittrail-add'); // add
    $app->any('/audittrailview[/{id}]', AudittrailController::class . ':view')->add(PermissionMiddleware::class)->setName('audittrailview-audittrail-view'); // view
    $app->any('/audittrailedit[/{id}]', AudittrailController::class . ':edit')->add(PermissionMiddleware::class)->setName('audittrailedit-audittrail-edit'); // edit
    $app->any('/audittraildelete[/{id}]', AudittrailController::class . ':delete')->add(PermissionMiddleware::class)->setName('audittraildelete-audittrail-delete'); // delete
    $app->group(
        '/audittrail',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AudittrailController::class . ':list')->add(PermissionMiddleware::class)->setName('audittrail/list-audittrail-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', AudittrailController::class . ':add')->add(PermissionMiddleware::class)->setName('audittrail/add-audittrail-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AudittrailController::class . ':view')->add(PermissionMiddleware::class)->setName('audittrail/view-audittrail-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AudittrailController::class . ':edit')->add(PermissionMiddleware::class)->setName('audittrail/edit-audittrail-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', AudittrailController::class . ':delete')->add(PermissionMiddleware::class)->setName('audittrail/delete-audittrail-delete-2'); // delete
        }
    );

    // data_durasi
    $app->any('/datadurasilist[/{id}]', DataDurasiController::class . ':list')->add(PermissionMiddleware::class)->setName('datadurasilist-data_durasi-list'); // list
    $app->any('/datadurasiadd[/{id}]', DataDurasiController::class . ':add')->add(PermissionMiddleware::class)->setName('datadurasiadd-data_durasi-add'); // add
    $app->any('/datadurasiview[/{id}]', DataDurasiController::class . ':view')->add(PermissionMiddleware::class)->setName('datadurasiview-data_durasi-view'); // view
    $app->group(
        '/data_durasi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DataDurasiController::class . ':list')->add(PermissionMiddleware::class)->setName('data_durasi/list-data_durasi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DataDurasiController::class . ':add')->add(PermissionMiddleware::class)->setName('data_durasi/add-data_durasi-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', DataDurasiController::class . ':view')->add(PermissionMiddleware::class)->setName('data_durasi/view-data_durasi-view-2'); // view
        }
    );

    // userlevelpermissions
    $app->any('/userlevelpermissionslist[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissionslist-userlevelpermissions-list'); // list
    $app->any('/userlevelpermissionsadd[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissionsadd-userlevelpermissions-add'); // add
    $app->any('/userlevelpermissionsview[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissionsview-userlevelpermissions-view'); // view
    $app->any('/userlevelpermissionsedit[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissionsedit-userlevelpermissions-edit'); // edit
    $app->any('/userlevelpermissionsdelete[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissionsdelete-userlevelpermissions-delete'); // delete
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissions/add-userlevelpermissions-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissions/delete-userlevelpermissions-delete-2'); // delete
        }
    );

    // userlevels
    $app->any('/userlevelslist[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelslist-userlevels-list'); // list
    $app->any('/userlevelsadd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelsadd-userlevels-add'); // add
    $app->any('/userlevelsview[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelsview-userlevels-view'); // view
    $app->any('/userlevelsedit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelsedit-userlevels-edit'); // edit
    $app->any('/userlevelsdelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelsdelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

<<<<<<< HEAD
    // antrean_bpjs_rs
    $app->any('/antreanbpjsrslist[/{id}]', AntreanBpjsRsController::class . ':list')->add(PermissionMiddleware::class)->setName('antreanbpjsrslist-antrean_bpjs_rs-list'); // list
    $app->any('/antreanbpjsrsedit[/{id}]', AntreanBpjsRsController::class . ':edit')->add(PermissionMiddleware::class)->setName('antreanbpjsrsedit-antrean_bpjs_rs-edit'); // edit
    $app->any('/antreanbpjsrssearch', AntreanBpjsRsController::class . ':search')->add(PermissionMiddleware::class)->setName('antreanbpjsrssearch-antrean_bpjs_rs-search'); // search
    $app->group(
        '/antrean_bpjs_rs',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AntreanBpjsRsController::class . ':list')->add(PermissionMiddleware::class)->setName('antrean_bpjs_rs/list-antrean_bpjs_rs-list-2'); // list
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AntreanBpjsRsController::class . ':edit')->add(PermissionMiddleware::class)->setName('antrean_bpjs_rs/edit-antrean_bpjs_rs-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', AntreanBpjsRsController::class . ':search')->add(PermissionMiddleware::class)->setName('antrean_bpjs_rs/search-antrean_bpjs_rs-search-2'); // search
        }
    );

    // antrean_umum_rs
    $app->any('/antreanumumrslist[/{id}]', AntreanUmumRsController::class . ':list')->add(PermissionMiddleware::class)->setName('antreanumumrslist-antrean_umum_rs-list'); // list
    $app->any('/antreanumumrsedit[/{id}]', AntreanUmumRsController::class . ':edit')->add(PermissionMiddleware::class)->setName('antreanumumrsedit-antrean_umum_rs-edit'); // edit
    $app->any('/antreanumumrssearch', AntreanUmumRsController::class . ':search')->add(PermissionMiddleware::class)->setName('antreanumumrssearch-antrean_umum_rs-search'); // search
    $app->group(
        '/antrean_umum_rs',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AntreanUmumRsController::class . ':list')->add(PermissionMiddleware::class)->setName('antrean_umum_rs/list-antrean_umum_rs-list-2'); // list
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AntreanUmumRsController::class . ':edit')->add(PermissionMiddleware::class)->setName('antrean_umum_rs/edit-antrean_umum_rs-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', AntreanUmumRsController::class . ':search')->add(PermissionMiddleware::class)->setName('antrean_umum_rs/search-antrean_umum_rs-search-2'); // search
        }
    );

=======
>>>>>>> parent of 72b00b1 (rumah sakit views refinements)
    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->any('/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // change_password
    $app->any('/changepassword', OthersController::class . ':changepassword')->add(PermissionMiddleware::class)->setName('changepassword');

    // userpriv
    $app->any('/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->any('/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
