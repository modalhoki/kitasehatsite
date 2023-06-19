<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$PraktikPoliList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpraktik_polilist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpraktik_polilist = currentForm = new ew.Form("fpraktik_polilist", "list");
    fpraktik_polilist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "praktik_poli")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.praktik_poli)
        ew.vars.tables.praktik_poli = currentTable;
    fpraktik_polilist.addFields([
        ["dokter_id", [fields.dokter_id.visible && fields.dokter_id.required ? ew.Validators.required(fields.dokter_id.caption) : null], fields.dokter_id.isInvalid],
        ["hari_praktik", [fields.hari_praktik.visible && fields.hari_praktik.required ? ew.Validators.required(fields.hari_praktik.caption) : null], fields.hari_praktik.isInvalid],
        ["jam_praktik", [fields.jam_praktik.visible && fields.jam_praktik.required ? ew.Validators.required(fields.jam_praktik.caption) : null], fields.jam_praktik.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpraktik_polilist,
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
    fpraktik_polilist.validate = function () {
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
        if (gridinsert && addcnt == 0) { // No row added
            ew.alert(ew.language.phrase("NoAddRecord"));
            return false;
        }
        return true;
    }

    // Check empty row
    fpraktik_polilist.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "dokter_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "hari_praktik", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "jam_praktik", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpraktik_polilist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpraktik_polilist.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpraktik_polilist.lists.dokter_id = <?= $Page->dokter_id->toClientList($Page) ?>;
    loadjs.done("fpraktik_polilist");
});
var fpraktik_polilistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fpraktik_polilistsrch = currentSearchForm = new ew.Form("fpraktik_polilistsrch");

    // Dynamic selection lists

    // Filters
    fpraktik_polilistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpraktik_polilistsrch");
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
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "fasilitas_rumah_sakit") {
    if ($Page->MasterRecordExists) {
        include_once "views/FasilitasRumahSakitMaster.php";
    }
}
?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "dokter") {
    if ($Page->MasterRecordExists) {
        include_once "views/DokterMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fpraktik_polilistsrch" id="fpraktik_polilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpraktik_polilistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="praktik_poli">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> praktik_poli">
<form name="fpraktik_polilist" id="fpraktik_polilist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="praktik_poli">
<?php if ($Page->getCurrentMasterTable() == "fasilitas_rumah_sakit" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="fasilitas_rumah_sakit">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->fasilitas_rumah_sakit_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "dokter" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="dokter">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->dokter_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_praktik_poli" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_praktik_polilist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
        <th data-name="dokter_id" class="<?= $Page->dokter_id->headerCellClass() ?>"><div id="elh_praktik_poli_dokter_id" class="praktik_poli_dokter_id"><?= $Page->renderSort($Page->dokter_id) ?></div></th>
<?php } ?>
<?php if ($Page->hari_praktik->Visible) { // hari_praktik ?>
        <th data-name="hari_praktik" class="<?= $Page->hari_praktik->headerCellClass() ?>"><div id="elh_praktik_poli_hari_praktik" class="praktik_poli_hari_praktik"><?= $Page->renderSort($Page->hari_praktik) ?></div></th>
<?php } ?>
<?php if ($Page->jam_praktik->Visible) { // jam_praktik ?>
        <th data-name="jam_praktik" class="<?= $Page->jam_praktik->headerCellClass() ?>"><div id="elh_praktik_poli_jam_praktik" class="praktik_poli_jam_praktik"><?= $Page->renderSort($Page->jam_praktik) ?></div></th>
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

// Restore number of post back records
if ($CurrentForm && ($Page->isConfirm() || $Page->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Page->FormKeyCountName) && ($Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm())) {
        $Page->KeyCount = $CurrentForm->getValue($Page->FormKeyCountName);
        $Page->StopRecord = $Page->StartRecord + $Page->KeyCount - 1;
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
if ($Page->isGridAdd())
    $Page->RowIndex = 0;
if ($Page->isGridEdit())
    $Page->RowIndex = 0;
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;
        if ($Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm()) {
            $Page->RowIndex++;
            $CurrentForm->Index = $Page->RowIndex;
            if ($CurrentForm->hasValue($Page->FormActionName) && ($Page->isConfirm() || $Page->EventCancelled)) {
                $Page->RowAction = strval($CurrentForm->getValue($Page->FormActionName));
            } elseif ($Page->isGridAdd()) {
                $Page->RowAction = "insert";
            } else {
                $Page->RowAction = "";
            }
        }

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
        if ($Page->isGridAdd()) { // Grid add
            $Page->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Page->isGridAdd() && $Page->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Page->restoreCurrentRowFormValues($Page->RowIndex); // Restore form values
        }
        if ($Page->isGridEdit()) { // Grid edit
            if ($Page->EventCancelled) {
                $Page->restoreCurrentRowFormValues($Page->RowIndex); // Restore form values
            }
            if ($Page->RowAction == "insert") {
                $Page->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Page->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Page->isGridEdit() && ($Page->RowType == ROWTYPE_EDIT || $Page->RowType == ROWTYPE_ADD) && $Page->EventCancelled) { // Update failed
            $Page->restoreCurrentRowFormValues($Page->RowIndex); // Restore form values
        }
        if ($Page->RowType == ROWTYPE_EDIT) { // Edit row
            $Page->EditRowCount++;
        }

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_praktik_poli", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();

        // Skip delete row / empty row for confirm page
        if ($Page->RowAction != "delete" && $Page->RowAction != "insertdelete" && !($Page->RowAction == "insert" && $Page->isConfirm() && $Page->emptyRow())) {
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->dokter_id->Visible) { // dokter_id ?>
        <td data-name="dokter_id" <?= $Page->dokter_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Page->dokter_id->getSessionValue() != "") { ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_dokter_id" class="form-group">
<span<?= $Page->dokter_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->dokter_id->getDisplayValue($Page->dokter_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_dokter_id" name="x<?= $Page->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Page->dokter_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_dokter_id" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Page->RowIndex ?>_dokter_id"><?= EmptyValue(strval($Page->dokter_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->dokter_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->dokter_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->dokter_id->ReadOnly || $Page->dokter_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Page->RowIndex ?>_dokter_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "dokter") && !$Page->dokter_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Page->RowIndex ?>_dokter_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->dokter_id->caption() ?>" data-title="<?= $Page->dokter_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?= $Page->RowIndex ?>_dokter_id',url:'<?= GetUrl("dokteraddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->dokter_id->getErrorMessage() ?></div>
<?= $Page->dokter_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_dokter_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_dokter_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->dokter_id->displayValueSeparatorAttribute() ?>" name="x<?= $Page->RowIndex ?>_dokter_id" id="x<?= $Page->RowIndex ?>_dokter_id" value="<?= $Page->dokter_id->CurrentValue ?>"<?= $Page->dokter_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="praktik_poli" data-field="x_dokter_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_dokter_id" id="o<?= $Page->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Page->dokter_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Page->dokter_id->getSessionValue() != "") { ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_dokter_id" class="form-group">
<span<?= $Page->dokter_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->dokter_id->getDisplayValue($Page->dokter_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_dokter_id" name="x<?= $Page->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Page->dokter_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_dokter_id" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Page->RowIndex ?>_dokter_id"><?= EmptyValue(strval($Page->dokter_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->dokter_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->dokter_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->dokter_id->ReadOnly || $Page->dokter_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Page->RowIndex ?>_dokter_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "dokter") && !$Page->dokter_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Page->RowIndex ?>_dokter_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->dokter_id->caption() ?>" data-title="<?= $Page->dokter_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?= $Page->RowIndex ?>_dokter_id',url:'<?= GetUrl("dokteraddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->dokter_id->getErrorMessage() ?></div>
<?= $Page->dokter_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_dokter_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_dokter_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->dokter_id->displayValueSeparatorAttribute() ?>" name="x<?= $Page->RowIndex ?>_dokter_id" id="x<?= $Page->RowIndex ?>_dokter_id" value="<?= $Page->dokter_id->CurrentValue ?>"<?= $Page->dokter_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_dokter_id">
<span<?= $Page->dokter_id->viewAttributes() ?>>
<?= $Page->dokter_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->hari_praktik->Visible) { // hari_praktik ?>
        <td data-name="hari_praktik" <?= $Page->hari_praktik->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_hari_praktik" class="form-group">
<input type="<?= $Page->hari_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_hari_praktik" name="x<?= $Page->RowIndex ?>_hari_praktik" id="x<?= $Page->RowIndex ?>_hari_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->hari_praktik->getPlaceHolder()) ?>" value="<?= $Page->hari_praktik->EditValue ?>"<?= $Page->hari_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->hari_praktik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="praktik_poli" data-field="x_hari_praktik" data-hidden="1" name="o<?= $Page->RowIndex ?>_hari_praktik" id="o<?= $Page->RowIndex ?>_hari_praktik" value="<?= HtmlEncode($Page->hari_praktik->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_hari_praktik" class="form-group">
<input type="<?= $Page->hari_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_hari_praktik" name="x<?= $Page->RowIndex ?>_hari_praktik" id="x<?= $Page->RowIndex ?>_hari_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->hari_praktik->getPlaceHolder()) ?>" value="<?= $Page->hari_praktik->EditValue ?>"<?= $Page->hari_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->hari_praktik->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_hari_praktik">
<span<?= $Page->hari_praktik->viewAttributes() ?>>
<?= $Page->hari_praktik->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->jam_praktik->Visible) { // jam_praktik ?>
        <td data-name="jam_praktik" <?= $Page->jam_praktik->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_jam_praktik" class="form-group">
<input type="<?= $Page->jam_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_jam_praktik" name="x<?= $Page->RowIndex ?>_jam_praktik" id="x<?= $Page->RowIndex ?>_jam_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->jam_praktik->getPlaceHolder()) ?>" value="<?= $Page->jam_praktik->EditValue ?>"<?= $Page->jam_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->jam_praktik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="praktik_poli" data-field="x_jam_praktik" data-hidden="1" name="o<?= $Page->RowIndex ?>_jam_praktik" id="o<?= $Page->RowIndex ?>_jam_praktik" value="<?= HtmlEncode($Page->jam_praktik->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_jam_praktik" class="form-group">
<input type="<?= $Page->jam_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_jam_praktik" name="x<?= $Page->RowIndex ?>_jam_praktik" id="x<?= $Page->RowIndex ?>_jam_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->jam_praktik->getPlaceHolder()) ?>" value="<?= $Page->jam_praktik->EditValue ?>"<?= $Page->jam_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->jam_praktik->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_praktik_poli_jam_praktik">
<span<?= $Page->jam_praktik->viewAttributes() ?>>
<?= $Page->jam_praktik->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpraktik_polilist","load"], function () {
    fpraktik_polilist.updateLists(<?= $Page->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Page->isGridAdd())
        if (!$Page->Recordset->EOF) {
            $Page->Recordset->moveNext();
        }
}
?>
<?php
    if ($Page->isGridAdd() || $Page->isGridEdit()) {
        $Page->RowIndex = '$rowindex$';
        $Page->loadRowValues();

        // Set row properties
        $Page->resetAttributes();
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowIndex, "id" => "r0_praktik_poli", "data-rowtype" => ROWTYPE_ADD]);
        $Page->RowAttrs->appendClass("ew-template");
        $Page->RowType = ROWTYPE_ADD;

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
        $Page->StartRowCount = 0;
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowIndex);
?>
    <?php if ($Page->dokter_id->Visible) { // dokter_id ?>
        <td data-name="dokter_id">
<?php if ($Page->dokter_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_praktik_poli_dokter_id" class="form-group praktik_poli_dokter_id">
<span<?= $Page->dokter_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->dokter_id->getDisplayValue($Page->dokter_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_dokter_id" name="x<?= $Page->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Page->dokter_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_praktik_poli_dokter_id" class="form-group praktik_poli_dokter_id">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Page->RowIndex ?>_dokter_id"><?= EmptyValue(strval($Page->dokter_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->dokter_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->dokter_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->dokter_id->ReadOnly || $Page->dokter_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Page->RowIndex ?>_dokter_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "dokter") && !$Page->dokter_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Page->RowIndex ?>_dokter_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->dokter_id->caption() ?>" data-title="<?= $Page->dokter_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?= $Page->RowIndex ?>_dokter_id',url:'<?= GetUrl("dokteraddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->dokter_id->getErrorMessage() ?></div>
<?= $Page->dokter_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_dokter_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_dokter_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->dokter_id->displayValueSeparatorAttribute() ?>" name="x<?= $Page->RowIndex ?>_dokter_id" id="x<?= $Page->RowIndex ?>_dokter_id" value="<?= $Page->dokter_id->CurrentValue ?>"<?= $Page->dokter_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="praktik_poli" data-field="x_dokter_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_dokter_id" id="o<?= $Page->RowIndex ?>_dokter_id" value="<?= HtmlEncode($Page->dokter_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->hari_praktik->Visible) { // hari_praktik ?>
        <td data-name="hari_praktik">
<span id="el$rowindex$_praktik_poli_hari_praktik" class="form-group praktik_poli_hari_praktik">
<input type="<?= $Page->hari_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_hari_praktik" name="x<?= $Page->RowIndex ?>_hari_praktik" id="x<?= $Page->RowIndex ?>_hari_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->hari_praktik->getPlaceHolder()) ?>" value="<?= $Page->hari_praktik->EditValue ?>"<?= $Page->hari_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->hari_praktik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="praktik_poli" data-field="x_hari_praktik" data-hidden="1" name="o<?= $Page->RowIndex ?>_hari_praktik" id="o<?= $Page->RowIndex ?>_hari_praktik" value="<?= HtmlEncode($Page->hari_praktik->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->jam_praktik->Visible) { // jam_praktik ?>
        <td data-name="jam_praktik">
<span id="el$rowindex$_praktik_poli_jam_praktik" class="form-group praktik_poli_jam_praktik">
<input type="<?= $Page->jam_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_jam_praktik" name="x<?= $Page->RowIndex ?>_jam_praktik" id="x<?= $Page->RowIndex ?>_jam_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->jam_praktik->getPlaceHolder()) ?>" value="<?= $Page->jam_praktik->EditValue ?>"<?= $Page->jam_praktik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->jam_praktik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="praktik_poli" data-field="x_jam_praktik" data-hidden="1" name="o<?= $Page->RowIndex ?>_jam_praktik" id="o<?= $Page->RowIndex ?>_jam_praktik" value="<?= HtmlEncode($Page->jam_praktik->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowIndex);
?>
<script>
loadjs.ready(["fpraktik_polilist","load"], function() {
    fpraktik_polilist.updateLists(<?= $Page->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Page->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<?= $Page->MultiSelectKey ?>
<?php } ?>
<?php if ($Page->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<?= $Page->MultiSelectKey ?>
<?php } ?>
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
    ew.addEventHandlers("praktik_poli");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
