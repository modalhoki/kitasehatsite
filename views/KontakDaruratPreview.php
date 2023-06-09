<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$KontakDaruratPreview = &$Page;
?>
<script>
if (!ew.vars.tables.kontak_darurat) ew.vars.tables.kontak_darurat = <?= JsonEncode(GetClientVar("tables", "kontak_darurat")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid kontak_darurat"><!-- .card -->
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
<?php if ($Page->pasien_id->Visible) { // pasien_id ?>
    <?php if ($Page->SortUrl($Page->pasien_id) == "") { ?>
        <th class="<?= $Page->pasien_id->headerCellClass() ?>"><?= $Page->pasien_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->pasien_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->pasien_id->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->pasien_id->getNextSort() ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->pasien_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->pasien_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->pasien_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <?php if ($Page->SortUrl($Page->nama) == "") { ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><?= $Page->nama->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->nama->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->nama->getNextSort() ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
    <?php if ($Page->SortUrl($Page->no_hp) == "") { ?>
        <th class="<?= $Page->no_hp->headerCellClass() ?>"><?= $Page->no_hp->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->no_hp->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->no_hp->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->no_hp->getNextSort() ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->no_hp->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->no_hp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->no_hp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
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
<?php if ($Page->pasien_id->Visible) { // pasien_id ?>
        <!-- pasien_id -->
        <td<?= $Page->pasien_id->cellAttributes() ?>>
<span<?= $Page->pasien_id->viewAttributes() ?>>
<?= $Page->pasien_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <!-- nama -->
        <td<?= $Page->nama->cellAttributes() ?>>
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <!-- no_hp -->
        <td<?= $Page->no_hp->cellAttributes() ?>>
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
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
