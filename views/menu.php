<?php

namespace PHPMaker2021\Kitasehat;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(60, "mi_antrean_bpjs_rs", $MenuLanguage->MenuPhrase("60", "MenuText"), $MenuRelativePath . "antreanbpjsrslist", -1, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_bpjs_rs'), false, false, "", "", false);
$sideMenu->addMenuItem(61, "mi_antrean_umum_rs", $MenuLanguage->MenuPhrase("61", "MenuText"), $MenuRelativePath . "antreanumumrslist", -1, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_umum_rs'), false, false, "", "", false);
$sideMenu->addMenuItem(62, "mi_webusers_rs", $MenuLanguage->MenuPhrase("62", "MenuText"), $MenuRelativePath . "webusersrslist", -1, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}webusers_rs'), false, false, "", "", false);
$sideMenu->addMenuItem(1, "mi_antrean_bpjs", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "antreanbpjslist", -1, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_bpjs'), false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_antrean_umum", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "antreanumumlist", -1, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}antrean_umum'), false, false, "", "", false);
$sideMenu->addMenuItem(10, "mci_Master", $MenuLanguage->MenuPhrase("10", "MenuText"), "", -1, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(3, "mi_daerah", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "daerahlist", 10, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}daerah'), false, false, "", "", false);
$sideMenu->addMenuItem(36, "mci_Data_Dokter", $MenuLanguage->MenuPhrase("36", "MenuText"), "", 10, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(4, "mi_dokter", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "dokterlist", 36, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}dokter'), false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_fasilitas", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "fasilitaslist", 10, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}fasilitas'), false, false, "", "", false);
$sideMenu->addMenuItem(22, "mci_Pasien", $MenuLanguage->MenuPhrase("22", "MenuText"), "", 10, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(7, "mi_pasien", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "pasienlist", 22, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}pasien'), false, false, "", "", false);
$sideMenu->addMenuItem(8, "mi_rumah_sakit", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "rumahsakitlist", 10, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}rumah_sakit'), false, false, "", "", false);
$sideMenu->addMenuItem(59, "mci_User", $MenuLanguage->MenuPhrase("59", "MenuText"), "", 10, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(9, "mi_webusers", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "webuserslist", 59, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}webusers'), false, false, "", "", false);
$sideMenu->addMenuItem(41, "mi_userlevels", $MenuLanguage->MenuPhrase("41", "MenuText"), $MenuRelativePath . "userlevelslist", 59, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}userlevels'), false, false, "", "", false);
$sideMenu->addMenuItem(38, "mi_audittrail", $MenuLanguage->MenuPhrase("38", "MenuText"), $MenuRelativePath . "audittraillist", 10, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}audittrail'), false, false, "", "", false);
$sideMenu->addMenuItem(39, "mi_data_durasi", $MenuLanguage->MenuPhrase("39", "MenuText"), $MenuRelativePath . "datadurasilist", 10, "", AllowListMenu('{6882EE26-EB4F-42D3-AF9E-95D0FA907878}data_durasi'), false, false, "", "", false);
echo $sideMenu->toScript();
