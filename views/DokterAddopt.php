<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DokterAddopt = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdokteraddopt;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "addopt";
    fdokteraddopt = currentForm = new ew.Form("fdokteraddopt", "addopt");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "dokter")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.dokter)
        ew.vars.tables.dokter = currentTable;
    fdokteraddopt.addFields([
        ["nama_dokter", [fields.nama_dokter.visible && fields.nama_dokter.required ? ew.Validators.required(fields.nama_dokter.caption) : null], fields.nama_dokter.isInvalid],
        ["webusers_id", [fields.webusers_id.visible && fields.webusers_id.required ? ew.Validators.required(fields.webusers_id.caption) : null], fields.webusers_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdokteraddopt,
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
    fdokteraddopt.validate = function () {
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
        return true;
    }

    // Form_CustomValidate
    fdokteraddopt.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdokteraddopt.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdokteraddopt.lists.webusers_id = <?= $Page->webusers_id->toClientList($Page) ?>;
    loadjs.done("fdokteraddopt");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<form name="fdokteraddopt" id="fdokteraddopt" class="ew-form ew-horizontal" action="<?= HtmlEncode(GetUrl(Config("API_URL"))) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="<?= Config("API_ACTION_NAME") ?>" id="<?= Config("API_ACTION_NAME") ?>" value="<?= Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?= Config("API_OBJECT_NAME") ?>" id="<?= Config("API_OBJECT_NAME") ?>" value="dokter">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($Page->nama_dokter->Visible) { // nama_dokter ?>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label ew-label" for="x_nama_dokter"><?= $Page->nama_dokter->caption() ?><?= $Page->nama_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10">
<input type="<?= $Page->nama_dokter->getInputTextType() ?>" data-table="dokter" data-field="x_nama_dokter" name="x_nama_dokter" id="x_nama_dokter" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama_dokter->getPlaceHolder()) ?>" value="<?= $Page->nama_dokter->EditValue ?>"<?= $Page->nama_dokter->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nama_dokter->getErrorMessage() ?></div>
</div>
    </div>
<?php } ?>
<?php if ($Page->webusers_id->Visible) { // webusers_id ?>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label ew-label" for="x_webusers_id"><?= $Page->webusers_id->caption() ?><?= $Page->webusers_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_webusers_id"><?= EmptyValue(strval($Page->webusers_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->webusers_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->webusers_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->webusers_id->ReadOnly || $Page->webusers_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_webusers_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->webusers_id->getErrorMessage() ?></div>
<?= $Page->webusers_id->Lookup->getParamTag($Page, "p_x_webusers_id") ?>
<input type="hidden" is="selection-list" data-table="dokter" data-field="x_webusers_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->webusers_id->displayValueSeparatorAttribute() ?>" name="x_webusers_id" id="x_webusers_id" value="<?= $Page->webusers_id->CurrentValue ?>"<?= $Page->webusers_id->editAttributes() ?>>
</div>
    </div>
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
