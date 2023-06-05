<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DokterPoliView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdokter_poliview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fdokter_poliview = currentForm = new ew.Form("fdokter_poliview", "view");
    loadjs.done("fdokter_poliview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.dokter_poli) ew.vars.tables.dokter_poli = <?= JsonEncode(GetClientVar("tables", "dokter_poli")) ?>;
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
<form name="fdokter_poliview" id="fdokter_poliview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="dokter_poli">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_dokter_poli_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_dokter_poli_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
    <tr id="r_dokter_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_dokter_poli_dokter_id"><?= $Page->dokter_id->caption() ?></span></td>
        <td data-name="dokter_id" <?= $Page->dokter_id->cellAttributes() ?>>
<span id="el_dokter_poli_dokter_id">
<span<?= $Page->dokter_id->viewAttributes() ?>>
<?= $Page->dokter_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fasilitas_rs_id->Visible) { // fasilitas_rs_id ?>
    <tr id="r_fasilitas_rs_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_dokter_poli_fasilitas_rs_id"><?= $Page->fasilitas_rs_id->caption() ?></span></td>
        <td data-name="fasilitas_rs_id" <?= $Page->fasilitas_rs_id->cellAttributes() ?>>
<span id="el_dokter_poli_fasilitas_rs_id">
<span<?= $Page->fasilitas_rs_id->viewAttributes() ?>>
<?= $Page->fasilitas_rs_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jam_praktik->Visible) { // jam_praktik ?>
    <tr id="r_jam_praktik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_dokter_poli_jam_praktik"><?= $Page->jam_praktik->caption() ?></span></td>
        <td data-name="jam_praktik" <?= $Page->jam_praktik->cellAttributes() ?>>
<span id="el_dokter_poli_jam_praktik">
<span<?= $Page->jam_praktik->viewAttributes() ?>>
<?= $Page->jam_praktik->getViewValue() ?></span>
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
