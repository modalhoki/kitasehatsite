<?php

namespace PHPMaker2021\Kitasehat;

// Set up and run Grid object
$Grid = Container("FasilitasRumahSakitGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ffasilitas_rumah_sakitgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    ffasilitas_rumah_sakitgrid = new ew.Form("ffasilitas_rumah_sakitgrid", "grid");
    ffasilitas_rumah_sakitgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "fasilitas_rumah_sakit")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.fasilitas_rumah_sakit)
        ew.vars.tables.fasilitas_rumah_sakit = currentTable;
    ffasilitas_rumah_sakitgrid.addFields([
        ["fasilitas_id", [fields.fasilitas_id.visible && fields.fasilitas_id.required ? ew.Validators.required(fields.fasilitas_id.caption) : null], fields.fasilitas_id.isInvalid],
        ["hari_buka", [fields.hari_buka.visible && fields.hari_buka.required ? ew.Validators.required(fields.hari_buka.caption) : null], fields.hari_buka.isInvalid],
        ["jam_buka", [fields.jam_buka.visible && fields.jam_buka.required ? ew.Validators.required(fields.jam_buka.caption) : null], fields.jam_buka.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ffasilitas_rumah_sakitgrid,
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
    ffasilitas_rumah_sakitgrid.validate = function () {
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
    ffasilitas_rumah_sakitgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "fasilitas_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "hari_buka", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "jam_buka", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    ffasilitas_rumah_sakitgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffasilitas_rumah_sakitgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    ffasilitas_rumah_sakitgrid.lists.fasilitas_id = <?= $Grid->fasilitas_id->toClientList($Grid) ?>;
    loadjs.done("ffasilitas_rumah_sakitgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> fasilitas_rumah_sakit">
<div id="ffasilitas_rumah_sakitgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_fasilitas_rumah_sakit" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_fasilitas_rumah_sakitgrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->fasilitas_id->Visible) { // fasilitas_id ?>
        <th data-name="fasilitas_id" class="<?= $Grid->fasilitas_id->headerCellClass() ?>"><div id="elh_fasilitas_rumah_sakit_fasilitas_id" class="fasilitas_rumah_sakit_fasilitas_id"><?= $Grid->renderSort($Grid->fasilitas_id) ?></div></th>
<?php } ?>
<?php if ($Grid->hari_buka->Visible) { // hari_buka ?>
        <th data-name="hari_buka" class="<?= $Grid->hari_buka->headerCellClass() ?>"><div id="elh_fasilitas_rumah_sakit_hari_buka" class="fasilitas_rumah_sakit_hari_buka"><?= $Grid->renderSort($Grid->hari_buka) ?></div></th>
<?php } ?>
<?php if ($Grid->jam_buka->Visible) { // jam_buka ?>
        <th data-name="jam_buka" class="<?= $Grid->jam_buka->headerCellClass() ?>"><div id="elh_fasilitas_rumah_sakit_jam_buka" class="fasilitas_rumah_sakit_jam_buka"><?= $Grid->renderSort($Grid->jam_buka) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_fasilitas_rumah_sakit", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->fasilitas_id->Visible) { // fasilitas_id ?>
        <td data-name="fasilitas_id" <?= $Grid->fasilitas_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_fasilitas_rumah_sakit_fasilitas_id" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_fasilitas_id"><?= EmptyValue(strval($Grid->fasilitas_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->fasilitas_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->fasilitas_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->fasilitas_id->ReadOnly || $Grid->fasilitas_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "fasilitas") && !$Grid->fasilitas_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_fasilitas_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->fasilitas_id->caption() ?>" data-title="<?= $Grid->fasilitas_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_id',url:'<?= GetUrl("fasilitasaddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->fasilitas_id->getErrorMessage() ?></div>
<?= $Grid->fasilitas_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fasilitas_id") ?>
<input type="hidden" is="selection-list" data-table="fasilitas_rumah_sakit" data-field="x_fasilitas_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->fasilitas_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_fasilitas_id" id="x<?= $Grid->RowIndex ?>_fasilitas_id" value="<?= $Grid->fasilitas_id->CurrentValue ?>"<?= $Grid->fasilitas_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_fasilitas_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fasilitas_id" id="o<?= $Grid->RowIndex ?>_fasilitas_id" value="<?= HtmlEncode($Grid->fasilitas_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_fasilitas_rumah_sakit_fasilitas_id" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_fasilitas_id"><?= EmptyValue(strval($Grid->fasilitas_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->fasilitas_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->fasilitas_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->fasilitas_id->ReadOnly || $Grid->fasilitas_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "fasilitas") && !$Grid->fasilitas_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_fasilitas_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->fasilitas_id->caption() ?>" data-title="<?= $Grid->fasilitas_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_id',url:'<?= GetUrl("fasilitasaddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->fasilitas_id->getErrorMessage() ?></div>
<?= $Grid->fasilitas_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fasilitas_id") ?>
<input type="hidden" is="selection-list" data-table="fasilitas_rumah_sakit" data-field="x_fasilitas_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->fasilitas_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_fasilitas_id" id="x<?= $Grid->RowIndex ?>_fasilitas_id" value="<?= $Grid->fasilitas_id->CurrentValue ?>"<?= $Grid->fasilitas_id->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_fasilitas_rumah_sakit_fasilitas_id">
<span<?= $Grid->fasilitas_id->viewAttributes() ?>>
<?= $Grid->fasilitas_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_fasilitas_id" data-hidden="1" name="ffasilitas_rumah_sakitgrid$x<?= $Grid->RowIndex ?>_fasilitas_id" id="ffasilitas_rumah_sakitgrid$x<?= $Grid->RowIndex ?>_fasilitas_id" value="<?= HtmlEncode($Grid->fasilitas_id->FormValue) ?>">
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_fasilitas_id" data-hidden="1" name="ffasilitas_rumah_sakitgrid$o<?= $Grid->RowIndex ?>_fasilitas_id" id="ffasilitas_rumah_sakitgrid$o<?= $Grid->RowIndex ?>_fasilitas_id" value="<?= HtmlEncode($Grid->fasilitas_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->hari_buka->Visible) { // hari_buka ?>
        <td data-name="hari_buka" <?= $Grid->hari_buka->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_fasilitas_rumah_sakit_hari_buka" class="form-group">
<input type="<?= $Grid->hari_buka->getInputTextType() ?>" data-table="fasilitas_rumah_sakit" data-field="x_hari_buka" name="x<?= $Grid->RowIndex ?>_hari_buka" id="x<?= $Grid->RowIndex ?>_hari_buka" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->hari_buka->getPlaceHolder()) ?>" value="<?= $Grid->hari_buka->EditValue ?>"<?= $Grid->hari_buka->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hari_buka->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_hari_buka" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hari_buka" id="o<?= $Grid->RowIndex ?>_hari_buka" value="<?= HtmlEncode($Grid->hari_buka->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_fasilitas_rumah_sakit_hari_buka" class="form-group">
<input type="<?= $Grid->hari_buka->getInputTextType() ?>" data-table="fasilitas_rumah_sakit" data-field="x_hari_buka" name="x<?= $Grid->RowIndex ?>_hari_buka" id="x<?= $Grid->RowIndex ?>_hari_buka" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->hari_buka->getPlaceHolder()) ?>" value="<?= $Grid->hari_buka->EditValue ?>"<?= $Grid->hari_buka->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hari_buka->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_fasilitas_rumah_sakit_hari_buka">
<span<?= $Grid->hari_buka->viewAttributes() ?>>
<?= $Grid->hari_buka->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_hari_buka" data-hidden="1" name="ffasilitas_rumah_sakitgrid$x<?= $Grid->RowIndex ?>_hari_buka" id="ffasilitas_rumah_sakitgrid$x<?= $Grid->RowIndex ?>_hari_buka" value="<?= HtmlEncode($Grid->hari_buka->FormValue) ?>">
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_hari_buka" data-hidden="1" name="ffasilitas_rumah_sakitgrid$o<?= $Grid->RowIndex ?>_hari_buka" id="ffasilitas_rumah_sakitgrid$o<?= $Grid->RowIndex ?>_hari_buka" value="<?= HtmlEncode($Grid->hari_buka->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jam_buka->Visible) { // jam_buka ?>
        <td data-name="jam_buka" <?= $Grid->jam_buka->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_fasilitas_rumah_sakit_jam_buka" class="form-group">
<input type="<?= $Grid->jam_buka->getInputTextType() ?>" data-table="fasilitas_rumah_sakit" data-field="x_jam_buka" name="x<?= $Grid->RowIndex ?>_jam_buka" id="x<?= $Grid->RowIndex ?>_jam_buka" size="30" maxlength="13" placeholder="<?= HtmlEncode($Grid->jam_buka->getPlaceHolder()) ?>" value="<?= $Grid->jam_buka->EditValue ?>"<?= $Grid->jam_buka->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jam_buka->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_jam_buka" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jam_buka" id="o<?= $Grid->RowIndex ?>_jam_buka" value="<?= HtmlEncode($Grid->jam_buka->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_fasilitas_rumah_sakit_jam_buka" class="form-group">
<input type="<?= $Grid->jam_buka->getInputTextType() ?>" data-table="fasilitas_rumah_sakit" data-field="x_jam_buka" name="x<?= $Grid->RowIndex ?>_jam_buka" id="x<?= $Grid->RowIndex ?>_jam_buka" size="30" maxlength="13" placeholder="<?= HtmlEncode($Grid->jam_buka->getPlaceHolder()) ?>" value="<?= $Grid->jam_buka->EditValue ?>"<?= $Grid->jam_buka->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jam_buka->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_fasilitas_rumah_sakit_jam_buka">
<span<?= $Grid->jam_buka->viewAttributes() ?>>
<?= $Grid->jam_buka->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_jam_buka" data-hidden="1" name="ffasilitas_rumah_sakitgrid$x<?= $Grid->RowIndex ?>_jam_buka" id="ffasilitas_rumah_sakitgrid$x<?= $Grid->RowIndex ?>_jam_buka" value="<?= HtmlEncode($Grid->jam_buka->FormValue) ?>">
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_jam_buka" data-hidden="1" name="ffasilitas_rumah_sakitgrid$o<?= $Grid->RowIndex ?>_jam_buka" id="ffasilitas_rumah_sakitgrid$o<?= $Grid->RowIndex ?>_jam_buka" value="<?= HtmlEncode($Grid->jam_buka->OldValue) ?>">
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
loadjs.ready(["ffasilitas_rumah_sakitgrid","load"], function () {
    ffasilitas_rumah_sakitgrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_fasilitas_rumah_sakit", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->fasilitas_id->Visible) { // fasilitas_id ?>
        <td data-name="fasilitas_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_fasilitas_rumah_sakit_fasilitas_id" class="form-group fasilitas_rumah_sakit_fasilitas_id">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_fasilitas_id"><?= EmptyValue(strval($Grid->fasilitas_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->fasilitas_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->fasilitas_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->fasilitas_id->ReadOnly || $Grid->fasilitas_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "fasilitas") && !$Grid->fasilitas_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_fasilitas_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->fasilitas_id->caption() ?>" data-title="<?= $Grid->fasilitas_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_fasilitas_id',url:'<?= GetUrl("fasilitasaddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->fasilitas_id->getErrorMessage() ?></div>
<?= $Grid->fasilitas_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fasilitas_id") ?>
<input type="hidden" is="selection-list" data-table="fasilitas_rumah_sakit" data-field="x_fasilitas_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->fasilitas_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_fasilitas_id" id="x<?= $Grid->RowIndex ?>_fasilitas_id" value="<?= $Grid->fasilitas_id->CurrentValue ?>"<?= $Grid->fasilitas_id->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_fasilitas_rumah_sakit_fasilitas_id" class="form-group fasilitas_rumah_sakit_fasilitas_id">
<span<?= $Grid->fasilitas_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->fasilitas_id->getDisplayValue($Grid->fasilitas_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_fasilitas_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_fasilitas_id" id="x<?= $Grid->RowIndex ?>_fasilitas_id" value="<?= HtmlEncode($Grid->fasilitas_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_fasilitas_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fasilitas_id" id="o<?= $Grid->RowIndex ?>_fasilitas_id" value="<?= HtmlEncode($Grid->fasilitas_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->hari_buka->Visible) { // hari_buka ?>
        <td data-name="hari_buka">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_fasilitas_rumah_sakit_hari_buka" class="form-group fasilitas_rumah_sakit_hari_buka">
<input type="<?= $Grid->hari_buka->getInputTextType() ?>" data-table="fasilitas_rumah_sakit" data-field="x_hari_buka" name="x<?= $Grid->RowIndex ?>_hari_buka" id="x<?= $Grid->RowIndex ?>_hari_buka" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->hari_buka->getPlaceHolder()) ?>" value="<?= $Grid->hari_buka->EditValue ?>"<?= $Grid->hari_buka->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hari_buka->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_fasilitas_rumah_sakit_hari_buka" class="form-group fasilitas_rumah_sakit_hari_buka">
<span<?= $Grid->hari_buka->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->hari_buka->getDisplayValue($Grid->hari_buka->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_hari_buka" data-hidden="1" name="x<?= $Grid->RowIndex ?>_hari_buka" id="x<?= $Grid->RowIndex ?>_hari_buka" value="<?= HtmlEncode($Grid->hari_buka->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_hari_buka" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hari_buka" id="o<?= $Grid->RowIndex ?>_hari_buka" value="<?= HtmlEncode($Grid->hari_buka->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jam_buka->Visible) { // jam_buka ?>
        <td data-name="jam_buka">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_fasilitas_rumah_sakit_jam_buka" class="form-group fasilitas_rumah_sakit_jam_buka">
<input type="<?= $Grid->jam_buka->getInputTextType() ?>" data-table="fasilitas_rumah_sakit" data-field="x_jam_buka" name="x<?= $Grid->RowIndex ?>_jam_buka" id="x<?= $Grid->RowIndex ?>_jam_buka" size="30" maxlength="13" placeholder="<?= HtmlEncode($Grid->jam_buka->getPlaceHolder()) ?>" value="<?= $Grid->jam_buka->EditValue ?>"<?= $Grid->jam_buka->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jam_buka->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_fasilitas_rumah_sakit_jam_buka" class="form-group fasilitas_rumah_sakit_jam_buka">
<span<?= $Grid->jam_buka->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jam_buka->getDisplayValue($Grid->jam_buka->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_jam_buka" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jam_buka" id="x<?= $Grid->RowIndex ?>_jam_buka" value="<?= HtmlEncode($Grid->jam_buka->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_jam_buka" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jam_buka" id="o<?= $Grid->RowIndex ?>_jam_buka" value="<?= HtmlEncode($Grid->jam_buka->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["ffasilitas_rumah_sakitgrid","load"], function() {
    ffasilitas_rumah_sakitgrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="ffasilitas_rumah_sakitgrid">
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
    ew.addEventHandlers("fasilitas_rumah_sakit");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
