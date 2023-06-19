<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$PraktikPoliDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpraktik_polidelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpraktik_polidelete = currentForm = new ew.Form("fpraktik_polidelete", "delete");
    loadjs.done("fpraktik_polidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.praktik_poli) ew.vars.tables.praktik_poli = <?= JsonEncode(GetClientVar("tables", "praktik_poli")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpraktik_polidelete" id="fpraktik_polidelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="praktik_poli">
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
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
        <th class="<?= $Page->dokter_id->headerCellClass() ?>"><span id="elh_praktik_poli_dokter_id" class="praktik_poli_dokter_id"><?= $Page->dokter_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hari_praktik->Visible) { // hari_praktik ?>
        <th class="<?= $Page->hari_praktik->headerCellClass() ?>"><span id="elh_praktik_poli_hari_praktik" class="praktik_poli_hari_praktik"><?= $Page->hari_praktik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jam_praktik->Visible) { // jam_praktik ?>
        <th class="<?= $Page->jam_praktik->headerCellClass() ?>"><span id="elh_praktik_poli_jam_praktik" class="praktik_poli_jam_praktik"><?= $Page->jam_praktik->caption() ?></span></th>
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
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
        <td <?= $Page->dokter_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_praktik_poli_dokter_id" class="praktik_poli_dokter_id">
<span<?= $Page->dokter_id->viewAttributes() ?>>
<?= $Page->dokter_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hari_praktik->Visible) { // hari_praktik ?>
        <td <?= $Page->hari_praktik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_praktik_poli_hari_praktik" class="praktik_poli_hari_praktik">
<span<?= $Page->hari_praktik->viewAttributes() ?>>
<?= $Page->hari_praktik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jam_praktik->Visible) { // jam_praktik ?>
        <td <?= $Page->jam_praktik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_praktik_poli_jam_praktik" class="praktik_poli_jam_praktik">
<span<?= $Page->jam_praktik->viewAttributes() ?>>
<?= $Page->jam_praktik->getViewValue() ?></span>
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
