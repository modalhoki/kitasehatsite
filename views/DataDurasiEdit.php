<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DataDurasiEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdata_durasiedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fdata_durasiedit = currentForm = new ew.Form("fdata_durasiedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "data_durasi")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.data_durasi)
        ew.vars.tables.data_durasi = currentTable;
    fdata_durasiedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["waktu_daftar", [fields.waktu_daftar.visible && fields.waktu_daftar.required ? ew.Validators.required(fields.waktu_daftar.caption) : null, ew.Validators.datetime(1)], fields.waktu_daftar.isInvalid],
        ["waktu_edit", [fields.waktu_edit.visible && fields.waktu_edit.required ? ew.Validators.required(fields.waktu_edit.caption) : null, ew.Validators.datetime(1)], fields.waktu_edit.isInvalid],
        ["durasi", [fields.durasi.visible && fields.durasi.required ? ew.Validators.required(fields.durasi.caption) : null, ew.Validators.integer], fields.durasi.isInvalid],
        ["jalur", [fields.jalur.visible && fields.jalur.required ? ew.Validators.required(fields.jalur.caption) : null], fields.jalur.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdata_durasiedit,
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
    fdata_durasiedit.validate = function () {
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
    fdata_durasiedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdata_durasiedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdata_durasiedit.lists.jalur = <?= $Page->jalur->toClientList($Page) ?>;
    loadjs.done("fdata_durasiedit");
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
<form name="fdata_durasiedit" id="fdata_durasiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="data_durasi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_data_durasi_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_data_durasi_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="data_durasi" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu_daftar->Visible) { // waktu_daftar ?>
    <div id="r_waktu_daftar" class="form-group row">
        <label id="elh_data_durasi_waktu_daftar" for="x_waktu_daftar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waktu_daftar->caption() ?><?= $Page->waktu_daftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu_daftar->cellAttributes() ?>>
<span id="el_data_durasi_waktu_daftar">
<input type="<?= $Page->waktu_daftar->getInputTextType() ?>" data-table="data_durasi" data-field="x_waktu_daftar" data-format="1" name="x_waktu_daftar" id="x_waktu_daftar" maxlength="19" placeholder="<?= HtmlEncode($Page->waktu_daftar->getPlaceHolder()) ?>" value="<?= $Page->waktu_daftar->EditValue ?>"<?= $Page->waktu_daftar->editAttributes() ?> aria-describedby="x_waktu_daftar_help">
<?= $Page->waktu_daftar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->waktu_daftar->getErrorMessage() ?></div>
<?php if (!$Page->waktu_daftar->ReadOnly && !$Page->waktu_daftar->Disabled && !isset($Page->waktu_daftar->EditAttrs["readonly"]) && !isset($Page->waktu_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdata_durasiedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fdata_durasiedit", "x_waktu_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu_edit->Visible) { // waktu_edit ?>
    <div id="r_waktu_edit" class="form-group row">
        <label id="elh_data_durasi_waktu_edit" for="x_waktu_edit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waktu_edit->caption() ?><?= $Page->waktu_edit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu_edit->cellAttributes() ?>>
<span id="el_data_durasi_waktu_edit">
<input type="<?= $Page->waktu_edit->getInputTextType() ?>" data-table="data_durasi" data-field="x_waktu_edit" data-format="1" name="x_waktu_edit" id="x_waktu_edit" maxlength="19" placeholder="<?= HtmlEncode($Page->waktu_edit->getPlaceHolder()) ?>" value="<?= $Page->waktu_edit->EditValue ?>"<?= $Page->waktu_edit->editAttributes() ?> aria-describedby="x_waktu_edit_help">
<?= $Page->waktu_edit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->waktu_edit->getErrorMessage() ?></div>
<?php if (!$Page->waktu_edit->ReadOnly && !$Page->waktu_edit->Disabled && !isset($Page->waktu_edit->EditAttrs["readonly"]) && !isset($Page->waktu_edit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdata_durasiedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fdata_durasiedit", "x_waktu_edit", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
    <div id="r_durasi" class="form-group row">
        <label id="elh_data_durasi_durasi" for="x_durasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->durasi->caption() ?><?= $Page->durasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->durasi->cellAttributes() ?>>
<span id="el_data_durasi_durasi">
<input type="<?= $Page->durasi->getInputTextType() ?>" data-table="data_durasi" data-field="x_durasi" name="x_durasi" id="x_durasi" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->durasi->getPlaceHolder()) ?>" value="<?= $Page->durasi->EditValue ?>"<?= $Page->durasi->editAttributes() ?> aria-describedby="x_durasi_help">
<?= $Page->durasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->durasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jalur->Visible) { // jalur ?>
    <div id="r_jalur" class="form-group row">
        <label id="elh_data_durasi_jalur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jalur->caption() ?><?= $Page->jalur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jalur->cellAttributes() ?>>
<span id="el_data_durasi_jalur">
<template id="tp_x_jalur">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="data_durasi" data-field="x_jalur" name="x_jalur" id="x_jalur"<?= $Page->jalur->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_jalur" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_jalur"
    name="x_jalur"
    value="<?= HtmlEncode($Page->jalur->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jalur"
    data-target="dsl_x_jalur"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jalur->isInvalidClass() ?>"
    data-table="data_durasi"
    data-field="x_jalur"
    data-value-separator="<?= $Page->jalur->displayValueSeparatorAttribute() ?>"
    <?= $Page->jalur->editAttributes() ?>>
<?= $Page->jalur->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jalur->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
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
    ew.addEventHandlers("data_durasi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
