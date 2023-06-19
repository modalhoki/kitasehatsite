<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DokterView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdokterview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fdokterview = currentForm = new ew.Form("fdokterview", "view");
    loadjs.done("fdokterview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.dokter) ew.vars.tables.dokter = <?= JsonEncode(GetClientVar("tables", "dokter")) ?>;
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
<form name="fdokterview" id="fdokterview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="dokter">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_dokter_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_dokter_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_dokter->Visible) { // nama_dokter ?>
    <tr id="r_nama_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_dokter_nama_dokter"><?= $Page->nama_dokter->caption() ?></span></td>
        <td data-name="nama_dokter" <?= $Page->nama_dokter->cellAttributes() ?>>
<span id="el_dokter_nama_dokter">
<span<?= $Page->nama_dokter->viewAttributes() ?>>
<?= $Page->nama_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->webusers_id->Visible) { // webusers_id ?>
    <tr id="r_webusers_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_dokter_webusers_id"><?= $Page->webusers_id->caption() ?></span></td>
        <td data-name="webusers_id" <?= $Page->webusers_id->cellAttributes() ?>>
<span id="el_dokter_webusers_id">
<span<?= $Page->webusers_id->viewAttributes() ?>>
<?= $Page->webusers_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("praktik_poli", explode(",", $Page->getCurrentDetailTable())) && $praktik_poli->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("praktik_poli", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PraktikPoliGrid.php" ?>
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
