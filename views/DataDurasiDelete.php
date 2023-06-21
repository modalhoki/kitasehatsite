<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DataDurasiDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdata_durasidelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fdata_durasidelete = currentForm = new ew.Form("fdata_durasidelete", "delete");
    loadjs.done("fdata_durasidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.data_durasi) ew.vars.tables.data_durasi = <?= JsonEncode(GetClientVar("tables", "data_durasi")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fdata_durasidelete" id="fdata_durasidelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="data_durasi">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->waktu_daftar->Visible) { // waktu_daftar ?>
        <th class="<?= $Page->waktu_daftar->headerCellClass() ?>"><span id="elh_data_durasi_waktu_daftar" class="data_durasi_waktu_daftar"><?= $Page->waktu_daftar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->waktu_edit->Visible) { // waktu_edit ?>
        <th class="<?= $Page->waktu_edit->headerCellClass() ?>"><span id="elh_data_durasi_waktu_edit" class="data_durasi_waktu_edit"><?= $Page->waktu_edit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
        <th class="<?= $Page->durasi->headerCellClass() ?>"><span id="elh_data_durasi_durasi" class="data_durasi_durasi"><?= $Page->durasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jalur->Visible) { // jalur ?>
        <th class="<?= $Page->jalur->headerCellClass() ?>"><span id="elh_data_durasi_jalur" class="data_durasi_jalur"><?= $Page->jalur->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->waktu_daftar->Visible) { // waktu_daftar ?>
        <td <?= $Page->waktu_daftar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_durasi_waktu_daftar" class="data_durasi_waktu_daftar">
<span<?= $Page->waktu_daftar->viewAttributes() ?>>
<?= $Page->waktu_daftar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->waktu_edit->Visible) { // waktu_edit ?>
        <td <?= $Page->waktu_edit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_durasi_waktu_edit" class="data_durasi_waktu_edit">
<span<?= $Page->waktu_edit->viewAttributes() ?>>
<?= $Page->waktu_edit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
        <td <?= $Page->durasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_durasi_durasi" class="data_durasi_durasi">
<span<?= $Page->durasi->viewAttributes() ?>>
<?= $Page->durasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jalur->Visible) { // jalur ?>
        <td <?= $Page->jalur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_durasi_jalur" class="data_durasi_jalur">
<span<?= $Page->jalur->viewAttributes() ?>>
<?= $Page->jalur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
