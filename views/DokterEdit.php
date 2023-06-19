<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DokterEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdokteredit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fdokteredit = currentForm = new ew.Form("fdokteredit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "dokter")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.dokter)
        ew.vars.tables.dokter = currentTable;
    fdokteredit.addFields([
        ["nama_dokter", [fields.nama_dokter.visible && fields.nama_dokter.required ? ew.Validators.required(fields.nama_dokter.caption) : null], fields.nama_dokter.isInvalid],
        ["webusers_id", [fields.webusers_id.visible && fields.webusers_id.required ? ew.Validators.required(fields.webusers_id.caption) : null], fields.webusers_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdokteredit,
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
    fdokteredit.validate = function () {
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

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fdokteredit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdokteredit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdokteredit.lists.webusers_id = <?= $Page->webusers_id->toClientList($Page) ?>;
    loadjs.done("fdokteredit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fdokteredit" id="fdokteredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="dokter">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->nama_dokter->Visible) { // nama_dokter ?>
    <div id="r_nama_dokter" class="form-group row">
        <label id="elh_dokter_nama_dokter" for="x_nama_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_dokter->caption() ?><?= $Page->nama_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_dokter->cellAttributes() ?>>
<span id="el_dokter_nama_dokter">
<input type="<?= $Page->nama_dokter->getInputTextType() ?>" data-table="dokter" data-field="x_nama_dokter" name="x_nama_dokter" id="x_nama_dokter" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama_dokter->getPlaceHolder()) ?>" value="<?= $Page->nama_dokter->EditValue ?>"<?= $Page->nama_dokter->editAttributes() ?> aria-describedby="x_nama_dokter_help">
<?= $Page->nama_dokter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_dokter->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->webusers_id->Visible) { // webusers_id ?>
    <div id="r_webusers_id" class="form-group row">
        <label id="elh_dokter_webusers_id" for="x_webusers_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->webusers_id->caption() ?><?= $Page->webusers_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->webusers_id->cellAttributes() ?>>
<span id="el_dokter_webusers_id">
<div class="input-group ew-lookup-list" aria-describedby="x_webusers_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_webusers_id"><?= EmptyValue(strval($Page->webusers_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->webusers_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->webusers_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->webusers_id->ReadOnly || $Page->webusers_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_webusers_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->webusers_id->getErrorMessage() ?></div>
<?= $Page->webusers_id->getCustomMessage() ?>
<?= $Page->webusers_id->Lookup->getParamTag($Page, "p_x_webusers_id") ?>
<input type="hidden" is="selection-list" data-table="dokter" data-field="x_webusers_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->webusers_id->displayValueSeparatorAttribute() ?>" name="x_webusers_id" id="x_webusers_id" value="<?= $Page->webusers_id->CurrentValue ?>"<?= $Page->webusers_id->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="dokter" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php
    if (in_array("praktik_poli", explode(",", $Page->getCurrentDetailTable())) && $praktik_poli->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("praktik_poli", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PraktikPoliGrid.php" ?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("dokter");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
