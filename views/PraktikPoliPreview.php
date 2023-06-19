<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$PraktikPoliPreview = &$Page;
?>
<script>
if (!ew.vars.tables.praktik_poli) ew.vars.tables.praktik_poli = <?= JsonEncode(GetClientVar("tables", "praktik_poli")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid praktik_poli"><!-- .card -->
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
    <thead><!-- Table header -->
        <tr class="ew-table-header">
<?php
// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
    <?php if ($Page->SortUrl($Page->dokter_id) == "") { ?>
        <th class="<?= $Page->dokter_id->headerCellClass() ?>"><?= $Page->dokter_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->dokter_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->dokter_id->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->dokter_id->getNextSort() ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->dokter_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->dokter_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->dokter_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->hari_praktik->Visible) { // hari_praktik ?>
    <?php if ($Page->SortUrl($Page->hari_praktik) == "") { ?>
        <th class="<?= $Page->hari_praktik->headerCellClass() ?>"><?= $Page->hari_praktik->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->hari_praktik->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->hari_praktik->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->hari_praktik->getNextSort() ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->hari_praktik->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->hari_praktik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->hari_praktik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jam_praktik->Visible) { // jam_praktik ?>
    <?php if ($Page->SortUrl($Page->jam_praktik) == "") { ?>
        <th class="<?= $Page->jam_praktik->headerCellClass() ?>"><?= $Page->jam_praktik->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jam_praktik->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->jam_praktik->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->jam_praktik->getNextSort() ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->jam_praktik->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->jam_praktik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->jam_praktik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
        </tr>
    </thead>
    <tbody><!-- Table body -->
<?php
$Page->RecCount = 0;
$Page->RowCount = 0;
while ($Page->Recordset && !$Page->Recordset->EOF) {
    // Init row class and style
    $Page->RecCount++;
    $Page->RowCount++;
    $Page->CssStyle = "";
    $Page->loadListRowValues($Page->Recordset);

    // Render row
    $Page->RowType = ROWTYPE_PREVIEW; // Preview record
    $Page->resetAttributes();
    $Page->renderListRow();

    // Render list options
    $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
        <!-- dokter_id -->
        <td<?= $Page->dokter_id->cellAttributes() ?>>
<span<?= $Page->dokter_id->viewAttributes() ?>>
<?= $Page->dokter_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->hari_praktik->Visible) { // hari_praktik ?>
        <!-- hari_praktik -->
        <td<?= $Page->hari_praktik->cellAttributes() ?>>
<span<?= $Page->hari_praktik->viewAttributes() ?>>
<?= $Page->hari_praktik->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jam_praktik->Visible) { // jam_praktik ?>
        <!-- jam_praktik -->
        <td<?= $Page->jam_praktik->cellAttributes() ?>>
<span<?= $Page->jam_praktik->viewAttributes() ?>>
<?= $Page->jam_praktik->getViewValue() ?></span>
</td>
<?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    $Page->Recordset->moveNext();
} // while
?>
    </tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?= $Page->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?= $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
    foreach ($Page->OtherOptions as $option)
        $option->render("body");
?>
</div>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
