<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$AntreanBpjsRsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fantrean_bpjs_rsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fantrean_bpjs_rsview = currentForm = new ew.Form("fantrean_bpjs_rsview", "view");
    loadjs.done("fantrean_bpjs_rsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.antrean_bpjs_rs) ew.vars.tables.antrean_bpjs_rs = <?= JsonEncode(GetClientVar("tables", "antrean_bpjs_rs")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fantrean_bpjs_rsview" id="fantrean_bpjs_rsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="antrean_bpjs_rs">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_antrean_bpjs_rs_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nomor_antrean->Visible) { // nomor_antrean ?>
    <tr id="r_nomor_antrean">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_nomor_antrean"><?= $Page->nomor_antrean->caption() ?></span></td>
        <td data-name="nomor_antrean" <?= $Page->nomor_antrean->cellAttributes() ?>>
<span id="el_antrean_bpjs_rs_nomor_antrean">
<span<?= $Page->nomor_antrean->viewAttributes() ?>>
<?= $Page->nomor_antrean->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
    <tr id="r_waktu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_waktu"><?= $Page->waktu->caption() ?></span></td>
        <td data-name="waktu" <?= $Page->waktu->cellAttributes() ?>>
<span id="el_antrean_bpjs_rs_waktu">
<span<?= $Page->waktu->viewAttributes() ?>>
<?= $Page->waktu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pasien_id->Visible) { // pasien_id ?>
    <tr id="r_pasien_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_pasien_id"><?= $Page->pasien_id->caption() ?></span></td>
        <td data-name="pasien_id" <?= $Page->pasien_id->cellAttributes() ?>>
<span id="el_antrean_bpjs_rs_pasien_id">
<span<?= $Page->pasien_id->viewAttributes() ?>>
<?= $Page->pasien_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
    <tr id="r_fasilitas_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_fasilitas_id"><?= $Page->fasilitas_id->caption() ?></span></td>
        <td data-name="fasilitas_id" <?= $Page->fasilitas_id->cellAttributes() ?>>
<span id="el_antrean_bpjs_rs_fasilitas_id">
<span<?= $Page->fasilitas_id->viewAttributes() ?>>
<?= $Page->fasilitas_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
    <tr id="r_rumah_sakit_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_rumah_sakit_id"><?= $Page->rumah_sakit_id->caption() ?></span></td>
        <td data-name="rumah_sakit_id" <?= $Page->rumah_sakit_id->cellAttributes() ?>>
<span id="el_antrean_bpjs_rs_rumah_sakit_id">
<span<?= $Page->rumah_sakit_id->viewAttributes() ?>>
<?= $Page->rumah_sakit_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el_antrean_bpjs_rs_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keluhan_awal->Visible) { // keluhan_awal ?>
    <tr id="r_keluhan_awal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_keluhan_awal"><?= $Page->keluhan_awal->caption() ?></span></td>
        <td data-name="keluhan_awal" <?= $Page->keluhan_awal->cellAttributes() ?>>
<span id="el_antrean_bpjs_rs_keluhan_awal">
<span<?= $Page->keluhan_awal->viewAttributes() ?>>
<?= $Page->keluhan_awal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Petugas->Visible) { // Petugas ?>
    <tr id="r_Petugas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_Petugas"><?= $Page->Petugas->caption() ?></span></td>
        <td data-name="Petugas" <?= $Page->Petugas->cellAttributes() ?>>
<span id="el_antrean_bpjs_rs_Petugas">
<span<?= $Page->Petugas->viewAttributes() ?>>
<?= $Page->Petugas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
