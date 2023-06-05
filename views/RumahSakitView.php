<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$RumahSakitView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frumah_sakitview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frumah_sakitview = currentForm = new ew.Form("frumah_sakitview", "view");
    loadjs.done("frumah_sakitview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.rumah_sakit) ew.vars.tables.rumah_sakit = <?= JsonEncode(GetClientVar("tables", "rumah_sakit")) ?>;
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
<form name="frumah_sakitview" id="frumah_sakitview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rumah_sakit">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rumah_sakit_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_rumah_sakit_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rumah_sakit_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama" <?= $Page->nama->cellAttributes() ?>>
<span id="el_rumah_sakit_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <tr id="r_alamat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rumah_sakit_alamat"><?= $Page->alamat->caption() ?></span></td>
        <td data-name="alamat" <?= $Page->alamat->cellAttributes() ?>>
<span id="el_rumah_sakit_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->daerah_id->Visible) { // daerah_id ?>
    <tr id="r_daerah_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rumah_sakit_daerah_id"><?= $Page->daerah_id->caption() ?></span></td>
        <td data-name="daerah_id" <?= $Page->daerah_id->cellAttributes() ?>>
<span id="el_rumah_sakit_daerah_id">
<span<?= $Page->daerah_id->viewAttributes() ?>>
<?= $Page->daerah_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->foto_rumah_sakit->Visible) { // foto_rumah_sakit ?>
    <tr id="r_foto_rumah_sakit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rumah_sakit_foto_rumah_sakit"><?= $Page->foto_rumah_sakit->caption() ?></span></td>
        <td data-name="foto_rumah_sakit" <?= $Page->foto_rumah_sakit->cellAttributes() ?>>
<span id="el_rumah_sakit_foto_rumah_sakit">
<span<?= $Page->foto_rumah_sakit->viewAttributes() ?>>
<?php if (!EmptyString($Page->foto_rumah_sakit->getViewValue()) && $Page->foto_rumah_sakit->linkAttributes() != "") { ?>
<a<?= $Page->foto_rumah_sakit->linkAttributes() ?>><?= $Page->foto_rumah_sakit->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->foto_rumah_sakit->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jam_buka->Visible) { // jam_buka ?>
    <tr id="r_jam_buka">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rumah_sakit_jam_buka"><?= $Page->jam_buka->caption() ?></span></td>
        <td data-name="jam_buka" <?= $Page->jam_buka->cellAttributes() ?>>
<span id="el_rumah_sakit_jam_buka">
<span<?= $Page->jam_buka->viewAttributes() ?>>
<?= $Page->jam_buka->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("fasilitas_rumah_sakit", explode(",", $Page->getCurrentDetailTable())) && $fasilitas_rumah_sakit->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("fasilitas_rumah_sakit", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "FasilitasRumahSakitGrid.php" ?>
<?php } ?>
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
