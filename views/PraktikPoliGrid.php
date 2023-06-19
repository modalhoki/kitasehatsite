<?php

namespace PHPMaker2021\Kitasehat;

// Set up and run Grid object
$Grid = Container("PraktikPoliGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpraktik_poligrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fpraktik_poligrid = new ew.Form("fpraktik_poligrid", "grid");
    fpraktik_poligrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "praktik_poli")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.praktik_poli)
        ew.vars.tables.praktik_poli = currentTable;
    fpraktik_poligrid.addFields([
        ["dokter_id", [fields.dokter_id.visible && fields.dokter_id.required ? ew.Validators.required(fields.dokter_id.caption) : null], fields.dokter_id.isInvalid],
        ["fasilitas_rumah_sakit_id", [fields.fasilitas_rumah_sakit_id.visible && fields.fasilitas_rumah_sakit_id.required ? ew.Validators.required(fields.fasilitas_rumah_sakit_id.caption) : null], fields.fasilitas_rumah_sakit_id.isInvalid],
        ["jam_praktik", [fields.jam_praktik.visible && fields.jam_praktik.required ? ew.Validators.required(fields.jam_praktik.caption) : null], fields.jam_praktik.isInvalid],
        ["hari_praktik", [fields.hari_praktik.visible && fields.hari_praktik.required ? ew.Validators.required(fields.hari_praktik.caption) : null], fields.hari_praktik.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpraktik_poligrid,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fpraktik_poligrid.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);
            var checkrow = (gridinsert) ? !this.emptyRow(rowIndex) : true;
            if (checkrow) {
                addcnt++;

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
            } // End Grid Add checking
        }
        return true;
    }

    // Check empty row
    fpraktik_poligrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "dokter_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "fasilitas_rumah_sakit_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "jam_praktik", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "hari_praktik", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpraktik_poligrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpraktik_poligrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpraktik_poligrid.lists.dokter_id = <?= $Grid->dokter_id->toClientList($Grid) ?>;
    fpraktik_poligrid.lists.fasilitas_rumah_sakit_id = <?= $Grid->fasilitas_rumah_sakit_id->toClientList($Grid) ?>;
    loadjs.done("fpraktik_poligrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> praktik_poli">
<div id="fpraktik_poligrid" class="ew-form ew-list-form form-inline">
<div id="gmp_praktik_poli" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_praktik_poligrid" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->dokter_id->Visible) { // dokter_id ?>
        <th data-name="dokter_id" class="<?= $Grid->dokter_id->headerCellClass() ?>"><div id="elh_praktik_poli_dokter_id" class="praktik_poli_dokter_id"><?= $Grid->renderSort($Grid->dokter_id) ?></div></th>
<?php } ?>
<?php if ($Grid->fasilitas_rumah_sakit_id->Visible) { // fasilitas_rumah_sakit_id ?>
        <th data-name="fasilitas_rumah_sakit_id" class="<?= $Grid->fasilitas_rumah_sakit_id->headerCellClass() ?>"><div id="elh_praktik_poli_fasilitas_rumah_sakit_id" class="praktik_poli_fasilitas_rumah_sakit_id"><?= $Grid->renderSort($Grid->fasilitas_rumah_sakit_id) ?></div></th>
<?php } ?>
<?php if ($Grid->jam_praktik->Visible) { // jam_praktik ?>
        <th data-name="jam_praktik" class="<?= $Grid->jam_praktik->headerCellClass() ?>"><div id="elh_praktik_poli_jam_praktik" class="praktik_poli_jam_praktik"><?= $Grid->renderSort($Grid->jam_praktik) ?></div></th>
<?php } ?>
<?php if ($Grid->hari_praktik->Visible) { // hari_praktik ?>
        <th data-name="hari_praktik" class="<?= $Grid->hari_praktik->headerCellClass() ?>"><div id="elh_praktik_poli_hari_praktik" class="praktik_poli_hari_praktik"><?= $Grid->renderSort($Grid->hari_praktik) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif (!$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
if ($Grid->isGridAdd())
    $Grid->RowIndex = 0;
if ($Grid->isGridEdit())
    $Grid->RowIndex = 0;
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row id / data-rowindex
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_praktik_poli", "data-rowtype" => $Grid->RowType]);

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if ($Grid->RowAction != "delete" && $Grid->RowAction != "insertdelete" && !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow())) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->dokter_id->Visible) { // dokter_id ?>
        <td data-name="dokter_id" <?= $Grid->dokter_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->dokter_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_dokter_id" class="form-group">
<span<?= $Grid->dokter_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->dokter_id->getDisplayValue($Grid->dokter_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_dokter_id" name="x<?= $Grid->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Grid->dokter_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_dokter_id" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_dokter_id"><?= EmptyValue(strval($Grid->dokter_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->dokter_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->dokter_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->dokter_id->ReadOnly || $Grid->dokter_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_dokter_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->dokter_id->getErrorMessage() ?></div>
<?= $Grid->dokter_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_dokter_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_dokter_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->dokter_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_dokter_id" id="x<?= $Grid->RowIndex ?>_dokter_id" value="<?= $Grid->dokter_id->CurrentValue ?>"<?= $Grid->dokter_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="praktik_poli" data-field="x_dokter_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_dokter_id" id="o<?= $Grid->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Grid->dokter_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->dokter_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_dokter_id" class="form-group">
<span<?= $Grid->dokter_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->dokter_id->getDisplayValue($Grid->dokter_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_dokter_id" name="x<?= $Grid->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Grid->dokter_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_dokter_id" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_dokter_id"><?= EmptyValue(strval($Grid->dokter_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->dokter_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->dokter_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->dokter_id->ReadOnly || $Grid->dokter_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_dokter_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->dokter_id->getErrorMessage() ?></div>
<?= $Grid->dokter_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_dokter_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_dokter_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->dokter_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_dokter_id" id="x<?= $Grid->RowIndex ?>_dokter_id" value="<?= $Grid->dokter_id->CurrentValue ?>"<?= $Grid->dokter_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_dokter_id">
<span<?= $Grid->dokter_id->viewAttributes() ?>>
<?= $Grid->dokter_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="praktik_poli" data-field="x_dokter_id" data-hidden="1" name="fpraktik_poligrid$x<?= $Grid->RowIndex ?>_dokter_id" id="fpraktik_poligrid$x<?= $Grid->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Grid->dokter_id->FormValue) ?>">
<input type="hidden" data-table="praktik_poli" data-field="x_dokter_id" data-hidden="1" name="fpraktik_poligrid$o<?= $Grid->RowIndex ?>_dokter_id" id="fpraktik_poligrid$o<?= $Grid->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Grid->dokter_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->fasilitas_rumah_sakit_id->Visible) { // fasilitas_rumah_sakit_id ?>
        <td data-name="fasilitas_rumah_sakit_id" <?= $Grid->fasilitas_rumah_sakit_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->fasilitas_rumah_sakit_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_fasilitas_rumah_sakit_id" class="form-group">
<span<?= $Grid->fasilitas_rumah_sakit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->fasilitas_rumah_sakit_id->getDisplayValue($Grid->fasilitas_rumah_sakit_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" name="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= HtmlEncode($Grid->fasilitas_rumah_sakit_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_fasilitas_rumah_sakit_id" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id"><?= EmptyValue(strval($Grid->fasilitas_rumah_sakit_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->fasilitas_rumah_sakit_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->fasilitas_rumah_sakit_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->fasilitas_rumah_sakit_id->ReadOnly || $Grid->fasilitas_rumah_sakit_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "fasilitas_rumah_sakit") && !$Grid->fasilitas_rumah_sakit_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->fasilitas_rumah_sakit_id->caption() ?>" data-title="<?= $Grid->fasilitas_rumah_sakit_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id',url:'<?= GetUrl("fasilitasrumahsakitaddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->fasilitas_rumah_sakit_id->getErrorMessage() ?></div>
<?= $Grid->fasilitas_rumah_sakit_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fasilitas_rumah_sakit_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_fasilitas_rumah_sakit_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->fasilitas_rumah_sakit_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" id="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= $Grid->fasilitas_rumah_sakit_id->CurrentValue ?>"<?= $Grid->fasilitas_rumah_sakit_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="praktik_poli" data-field="x_fasilitas_rumah_sakit_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" id="o<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= HtmlEncode($Grid->fasilitas_rumah_sakit_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->fasilitas_rumah_sakit_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_fasilitas_rumah_sakit_id" class="form-group">
<span<?= $Grid->fasilitas_rumah_sakit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->fasilitas_rumah_sakit_id->getDisplayValue($Grid->fasilitas_rumah_sakit_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" name="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= HtmlEncode($Grid->fasilitas_rumah_sakit_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_fasilitas_rumah_sakit_id" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id"><?= EmptyValue(strval($Grid->fasilitas_rumah_sakit_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->fasilitas_rumah_sakit_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->fasilitas_rumah_sakit_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->fasilitas_rumah_sakit_id->ReadOnly || $Grid->fasilitas_rumah_sakit_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "fasilitas_rumah_sakit") && !$Grid->fasilitas_rumah_sakit_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->fasilitas_rumah_sakit_id->caption() ?>" data-title="<?= $Grid->fasilitas_rumah_sakit_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id',url:'<?= GetUrl("fasilitasrumahsakitaddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->fasilitas_rumah_sakit_id->getErrorMessage() ?></div>
<?= $Grid->fasilitas_rumah_sakit_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fasilitas_rumah_sakit_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_fasilitas_rumah_sakit_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->fasilitas_rumah_sakit_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" id="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= $Grid->fasilitas_rumah_sakit_id->CurrentValue ?>"<?= $Grid->fasilitas_rumah_sakit_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_fasilitas_rumah_sakit_id">
<span<?= $Grid->fasilitas_rumah_sakit_id->viewAttributes() ?>>
<?= $Grid->fasilitas_rumah_sakit_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="praktik_poli" data-field="x_fasilitas_rumah_sakit_id" data-hidden="1" name="fpraktik_poligrid$x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" id="fpraktik_poligrid$x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= HtmlEncode($Grid->fasilitas_rumah_sakit_id->FormValue) ?>">
<input type="hidden" data-table="praktik_poli" data-field="x_fasilitas_rumah_sakit_id" data-hidden="1" name="fpraktik_poligrid$o<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" id="fpraktik_poligrid$o<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= HtmlEncode($Grid->fasilitas_rumah_sakit_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jam_praktik->Visible) { // jam_praktik ?>
        <td data-name="jam_praktik" <?= $Grid->jam_praktik->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_jam_praktik" class="form-group">
<input type="<?= $Grid->jam_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_jam_praktik" name="x<?= $Grid->RowIndex ?>_jam_praktik" id="x<?= $Grid->RowIndex ?>_jam_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->jam_praktik->getPlaceHolder()) ?>" value="<?= $Grid->jam_praktik->EditValue ?>"<?= $Grid->jam_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jam_praktik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="praktik_poli" data-field="x_jam_praktik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jam_praktik" id="o<?= $Grid->RowIndex ?>_jam_praktik" value="<?= HtmlEncode($Grid->jam_praktik->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_jam_praktik" class="form-group">
<input type="<?= $Grid->jam_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_jam_praktik" name="x<?= $Grid->RowIndex ?>_jam_praktik" id="x<?= $Grid->RowIndex ?>_jam_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->jam_praktik->getPlaceHolder()) ?>" value="<?= $Grid->jam_praktik->EditValue ?>"<?= $Grid->jam_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jam_praktik->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_jam_praktik">
<span<?= $Grid->jam_praktik->viewAttributes() ?>>
<?= $Grid->jam_praktik->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="praktik_poli" data-field="x_jam_praktik" data-hidden="1" name="fpraktik_poligrid$x<?= $Grid->RowIndex ?>_jam_praktik" id="fpraktik_poligrid$x<?= $Grid->RowIndex ?>_jam_praktik" value="<?= HtmlEncode($Grid->jam_praktik->FormValue) ?>">
<input type="hidden" data-table="praktik_poli" data-field="x_jam_praktik" data-hidden="1" name="fpraktik_poligrid$o<?= $Grid->RowIndex ?>_jam_praktik" id="fpraktik_poligrid$o<?= $Grid->RowIndex ?>_jam_praktik" value="<?= HtmlEncode($Grid->jam_praktik->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->hari_praktik->Visible) { // hari_praktik ?>
        <td data-name="hari_praktik" <?= $Grid->hari_praktik->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_hari_praktik" class="form-group">
<input type="<?= $Grid->hari_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_hari_praktik" name="x<?= $Grid->RowIndex ?>_hari_praktik" id="x<?= $Grid->RowIndex ?>_hari_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->hari_praktik->getPlaceHolder()) ?>" value="<?= $Grid->hari_praktik->EditValue ?>"<?= $Grid->hari_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hari_praktik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="praktik_poli" data-field="x_hari_praktik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hari_praktik" id="o<?= $Grid->RowIndex ?>_hari_praktik" value="<?= HtmlEncode($Grid->hari_praktik->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_hari_praktik" class="form-group">
<input type="<?= $Grid->hari_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_hari_praktik" name="x<?= $Grid->RowIndex ?>_hari_praktik" id="x<?= $Grid->RowIndex ?>_hari_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->hari_praktik->getPlaceHolder()) ?>" value="<?= $Grid->hari_praktik->EditValue ?>"<?= $Grid->hari_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hari_praktik->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_praktik_poli_hari_praktik">
<span<?= $Grid->hari_praktik->viewAttributes() ?>>
<?= $Grid->hari_praktik->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="praktik_poli" data-field="x_hari_praktik" data-hidden="1" name="fpraktik_poligrid$x<?= $Grid->RowIndex ?>_hari_praktik" id="fpraktik_poligrid$x<?= $Grid->RowIndex ?>_hari_praktik" value="<?= HtmlEncode($Grid->hari_praktik->FormValue) ?>">
<input type="hidden" data-table="praktik_poli" data-field="x_hari_praktik" data-hidden="1" name="fpraktik_poligrid$o<?= $Grid->RowIndex ?>_hari_praktik" id="fpraktik_poligrid$o<?= $Grid->RowIndex ?>_hari_praktik" value="<?= HtmlEncode($Grid->hari_praktik->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpraktik_poligrid","load"], function () {
    fpraktik_poligrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
    if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
        $Grid->RowIndex = '$rowindex$';
        $Grid->loadRowValues();

        // Set row properties
        $Grid->resetAttributes();
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_praktik_poli", "data-rowtype" => ROWTYPE_ADD]);
        $Grid->RowAttrs->appendClass("ew-template");
        $Grid->RowType = ROWTYPE_ADD;

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();
        $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->dokter_id->Visible) { // dokter_id ?>
        <td data-name="dokter_id">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->dokter_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_praktik_poli_dokter_id" class="form-group praktik_poli_dokter_id">
<span<?= $Grid->dokter_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->dokter_id->getDisplayValue($Grid->dokter_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_dokter_id" name="x<?= $Grid->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Grid->dokter_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_praktik_poli_dokter_id" class="form-group praktik_poli_dokter_id">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_dokter_id"><?= EmptyValue(strval($Grid->dokter_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->dokter_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->dokter_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->dokter_id->ReadOnly || $Grid->dokter_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_dokter_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->dokter_id->getErrorMessage() ?></div>
<?= $Grid->dokter_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_dokter_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_dokter_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->dokter_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_dokter_id" id="x<?= $Grid->RowIndex ?>_dokter_id" value="<?= $Grid->dokter_id->CurrentValue ?>"<?= $Grid->dokter_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_praktik_poli_dokter_id" class="form-group praktik_poli_dokter_id">
<span<?= $Grid->dokter_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->dokter_id->getDisplayValue($Grid->dokter_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="praktik_poli" data-field="x_dokter_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_dokter_id" id="x<?= $Grid->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Grid->dokter_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="praktik_poli" data-field="x_dokter_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_dokter_id" id="o<?= $Grid->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Grid->dokter_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->fasilitas_rumah_sakit_id->Visible) { // fasilitas_rumah_sakit_id ?>
        <td data-name="fasilitas_rumah_sakit_id">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->fasilitas_rumah_sakit_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_praktik_poli_fasilitas_rumah_sakit_id" class="form-group praktik_poli_fasilitas_rumah_sakit_id">
<span<?= $Grid->fasilitas_rumah_sakit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->fasilitas_rumah_sakit_id->getDisplayValue($Grid->fasilitas_rumah_sakit_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" name="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= HtmlEncode($Grid->fasilitas_rumah_sakit_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_praktik_poli_fasilitas_rumah_sakit_id" class="form-group praktik_poli_fasilitas_rumah_sakit_id">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id"><?= EmptyValue(strval($Grid->fasilitas_rumah_sakit_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->fasilitas_rumah_sakit_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->fasilitas_rumah_sakit_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->fasilitas_rumah_sakit_id->ReadOnly || $Grid->fasilitas_rumah_sakit_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "fasilitas_rumah_sakit") && !$Grid->fasilitas_rumah_sakit_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->fasilitas_rumah_sakit_id->caption() ?>" data-title="<?= $Grid->fasilitas_rumah_sakit_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id',url:'<?= GetUrl("fasilitasrumahsakitaddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->fasilitas_rumah_sakit_id->getErrorMessage() ?></div>
<?= $Grid->fasilitas_rumah_sakit_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fasilitas_rumah_sakit_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_fasilitas_rumah_sakit_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->fasilitas_rumah_sakit_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" id="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= $Grid->fasilitas_rumah_sakit_id->CurrentValue ?>"<?= $Grid->fasilitas_rumah_sakit_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_praktik_poli_fasilitas_rumah_sakit_id" class="form-group praktik_poli_fasilitas_rumah_sakit_id">
<span<?= $Grid->fasilitas_rumah_sakit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->fasilitas_rumah_sakit_id->getDisplayValue($Grid->fasilitas_rumah_sakit_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="praktik_poli" data-field="x_fasilitas_rumah_sakit_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" id="x<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= HtmlEncode($Grid->fasilitas_rumah_sakit_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="praktik_poli" data-field="x_fasilitas_rumah_sakit_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" id="o<?= $Grid->RowIndex ?>_fasilitas_rumah_sakit_id" value="<?= HtmlEncode($Grid->fasilitas_rumah_sakit_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jam_praktik->Visible) { // jam_praktik ?>
        <td data-name="jam_praktik">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_praktik_poli_jam_praktik" class="form-group praktik_poli_jam_praktik">
<input type="<?= $Grid->jam_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_jam_praktik" name="x<?= $Grid->RowIndex ?>_jam_praktik" id="x<?= $Grid->RowIndex ?>_jam_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->jam_praktik->getPlaceHolder()) ?>" value="<?= $Grid->jam_praktik->EditValue ?>"<?= $Grid->jam_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jam_praktik->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_praktik_poli_jam_praktik" class="form-group praktik_poli_jam_praktik">
<span<?= $Grid->jam_praktik->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jam_praktik->getDisplayValue($Grid->jam_praktik->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="praktik_poli" data-field="x_jam_praktik" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jam_praktik" id="x<?= $Grid->RowIndex ?>_jam_praktik" value="<?= HtmlEncode($Grid->jam_praktik->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="praktik_poli" data-field="x_jam_praktik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jam_praktik" id="o<?= $Grid->RowIndex ?>_jam_praktik" value="<?= HtmlEncode($Grid->jam_praktik->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->hari_praktik->Visible) { // hari_praktik ?>
        <td data-name="hari_praktik">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_praktik_poli_hari_praktik" class="form-group praktik_poli_hari_praktik">
<input type="<?= $Grid->hari_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_hari_praktik" name="x<?= $Grid->RowIndex ?>_hari_praktik" id="x<?= $Grid->RowIndex ?>_hari_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->hari_praktik->getPlaceHolder()) ?>" value="<?= $Grid->hari_praktik->EditValue ?>"<?= $Grid->hari_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hari_praktik->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_praktik_poli_hari_praktik" class="form-group praktik_poli_hari_praktik">
<span<?= $Grid->hari_praktik->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->hari_praktik->getDisplayValue($Grid->hari_praktik->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="praktik_poli" data-field="x_hari_praktik" data-hidden="1" name="x<?= $Grid->RowIndex ?>_hari_praktik" id="x<?= $Grid->RowIndex ?>_hari_praktik" value="<?= HtmlEncode($Grid->hari_praktik->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="praktik_poli" data-field="x_hari_praktik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hari_praktik" id="o<?= $Grid->RowIndex ?>_hari_praktik" value="<?= HtmlEncode($Grid->hari_praktik->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fpraktik_poligrid","load"], function() {
    fpraktik_poligrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpraktik_poligrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Grid->TotalRecords == 0 && !$Grid->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("praktik_poli");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
