<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DataDurasiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdata_durasilist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fdata_durasilist = currentForm = new ew.Form("fdata_durasilist", "list");
    fdata_durasilist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fdata_durasilist");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> data_durasi">
<form name="fdata_durasilist" id="fdata_durasilist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="data_durasi">
<div id="gmp_data_durasi" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_data_durasilist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_data_durasi_id" class="data_durasi_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->waktu_daftar->Visible) { // waktu_daftar ?>
        <th data-name="waktu_daftar" class="<?= $Page->waktu_daftar->headerCellClass() ?>"><div id="elh_data_durasi_waktu_daftar" class="data_durasi_waktu_daftar"><?= $Page->renderSort($Page->waktu_daftar) ?></div></th>
<?php } ?>
<?php if ($Page->waktu_edit->Visible) { // waktu_edit ?>
        <th data-name="waktu_edit" class="<?= $Page->waktu_edit->headerCellClass() ?>"><div id="elh_data_durasi_waktu_edit" class="data_durasi_waktu_edit"><?= $Page->renderSort($Page->waktu_edit) ?></div></th>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
        <th data-name="durasi" class="<?= $Page->durasi->headerCellClass() ?>"><div id="elh_data_durasi_durasi" class="data_durasi_durasi"><?= $Page->renderSort($Page->durasi) ?></div></th>
<?php } ?>
<?php if ($Page->jalur->Visible) { // jalur ?>
        <th data-name="jalur" class="<?= $Page->jalur->headerCellClass() ?>"><div id="elh_data_durasi_jalur" class="data_durasi_jalur"><?= $Page->renderSort($Page->jalur) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_data_durasi", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_durasi_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->waktu_daftar->Visible) { // waktu_daftar ?>
        <td data-name="waktu_daftar" <?= $Page->waktu_daftar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_durasi_waktu_daftar">
<span<?= $Page->waktu_daftar->viewAttributes() ?>>
<?= $Page->waktu_daftar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->waktu_edit->Visible) { // waktu_edit ?>
        <td data-name="waktu_edit" <?= $Page->waktu_edit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_durasi_waktu_edit">
<span<?= $Page->waktu_edit->viewAttributes() ?>>
<?= $Page->waktu_edit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->durasi->Visible) { // durasi ?>
        <td data-name="durasi" <?= $Page->durasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_durasi_durasi">
<span<?= $Page->durasi->viewAttributes() ?>>
<?= $Page->durasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jalur->Visible) { // jalur ?>
        <td data-name="jalur" <?= $Page->jalur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_durasi_jalur">
<span<?= $Page->jalur->viewAttributes() ?>>
<?= $Page->jalur->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("data_durasi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
