<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DataDurasiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdata_durasiview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fdata_durasiview = currentForm = new ew.Form("fdata_durasiview", "view");
    loadjs.done("fdata_durasiview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.data_durasi) ew.vars.tables.data_durasi = <?= JsonEncode(GetClientVar("tables", "data_durasi")) ?>;
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
<form name="fdata_durasiview" id="fdata_durasiview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="data_durasi">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_durasi_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_data_durasi_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->waktu_daftar->Visible) { // waktu_daftar ?>
    <tr id="r_waktu_daftar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_durasi_waktu_daftar"><?= $Page->waktu_daftar->caption() ?></span></td>
        <td data-name="waktu_daftar" <?= $Page->waktu_daftar->cellAttributes() ?>>
<span id="el_data_durasi_waktu_daftar">
<span<?= $Page->waktu_daftar->viewAttributes() ?>>
<?= $Page->waktu_daftar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->waktu_edit->Visible) { // waktu_edit ?>
    <tr id="r_waktu_edit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_durasi_waktu_edit"><?= $Page->waktu_edit->caption() ?></span></td>
        <td data-name="waktu_edit" <?= $Page->waktu_edit->cellAttributes() ?>>
<span id="el_data_durasi_waktu_edit">
<span<?= $Page->waktu_edit->viewAttributes() ?>>
<?= $Page->waktu_edit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
    <tr id="r_durasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_durasi_durasi"><?= $Page->durasi->caption() ?></span></td>
        <td data-name="durasi" <?= $Page->durasi->cellAttributes() ?>>
<span id="el_data_durasi_durasi">
<span<?= $Page->durasi->viewAttributes() ?>>
<?= $Page->durasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jalur->Visible) { // jalur ?>
    <tr id="r_jalur">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_durasi_jalur"><?= $Page->jalur->caption() ?></span></td>
        <td data-name="jalur" <?= $Page->jalur->cellAttributes() ?>>
<span id="el_data_durasi_jalur">
<span<?= $Page->jalur->viewAttributes() ?>>
<?= $Page->jalur->getViewValue() ?></span>
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
