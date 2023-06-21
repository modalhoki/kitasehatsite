<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$AntreanUmumRsEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fantrean_umum_rsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fantrean_umum_rsedit = currentForm = new ew.Form("fantrean_umum_rsedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "antrean_umum_rs")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.antrean_umum_rs)
        ew.vars.tables.antrean_umum_rs = currentTable;
    fantrean_umum_rsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["nomor_antrean", [fields.nomor_antrean.visible && fields.nomor_antrean.required ? ew.Validators.required(fields.nomor_antrean.caption) : null], fields.nomor_antrean.isInvalid],
        ["waktu", [fields.waktu.visible && fields.waktu.required ? ew.Validators.required(fields.waktu.caption) : null], fields.waktu.isInvalid],
        ["pasien_id", [fields.pasien_id.visible && fields.pasien_id.required ? ew.Validators.required(fields.pasien_id.caption) : null], fields.pasien_id.isInvalid],
        ["fasilitas_id", [fields.fasilitas_id.visible && fields.fasilitas_id.required ? ew.Validators.required(fields.fasilitas_id.caption) : null], fields.fasilitas_id.isInvalid],
        ["rumah_sakit_id", [fields.rumah_sakit_id.visible && fields.rumah_sakit_id.required ? ew.Validators.required(fields.rumah_sakit_id.caption) : null], fields.rumah_sakit_id.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["keluhan_awal", [fields.keluhan_awal.visible && fields.keluhan_awal.required ? ew.Validators.required(fields.keluhan_awal.caption) : null], fields.keluhan_awal.isInvalid],
        ["webusers_id", [fields.webusers_id.visible && fields.webusers_id.required ? ew.Validators.required(fields.webusers_id.caption) : null], fields.webusers_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fantrean_umum_rsedit,
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
    fantrean_umum_rsedit.validate = function () {
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
    fantrean_umum_rsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fantrean_umum_rsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fantrean_umum_rsedit.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fantrean_umum_rsedit.lists.webusers_id = <?= $Page->webusers_id->toClientList($Page) ?>;
    loadjs.done("fantrean_umum_rsedit");
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
<form name="fantrean_umum_rsedit" id="fantrean_umum_rsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="antrean_umum_rs">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_antrean_umum_rs_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_antrean_umum_rs_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_umum_rs" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nomor_antrean->Visible) { // nomor_antrean ?>
    <div id="r_nomor_antrean" class="form-group row">
        <label id="elh_antrean_umum_rs_nomor_antrean" for="x_nomor_antrean" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nomor_antrean->caption() ?><?= $Page->nomor_antrean->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nomor_antrean->cellAttributes() ?>>
<span id="el_antrean_umum_rs_nomor_antrean">
<span<?= $Page->nomor_antrean->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->nomor_antrean->getDisplayValue($Page->nomor_antrean->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_umum_rs" data-field="x_nomor_antrean" data-hidden="1" name="x_nomor_antrean" id="x_nomor_antrean" value="<?= HtmlEncode($Page->nomor_antrean->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
    <div id="r_waktu" class="form-group row">
        <label id="elh_antrean_umum_rs_waktu" for="x_waktu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waktu->caption() ?><?= $Page->waktu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu->cellAttributes() ?>>
<span id="el_antrean_umum_rs_waktu">
<span<?= $Page->waktu->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->waktu->getDisplayValue($Page->waktu->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_umum_rs" data-field="x_waktu" data-hidden="1" name="x_waktu" id="x_waktu" value="<?= HtmlEncode($Page->waktu->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pasien_id->Visible) { // pasien_id ?>
    <div id="r_pasien_id" class="form-group row">
        <label id="elh_antrean_umum_rs_pasien_id" for="x_pasien_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pasien_id->caption() ?><?= $Page->pasien_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pasien_id->cellAttributes() ?>>
<span id="el_antrean_umum_rs_pasien_id">
<span<?= $Page->pasien_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->pasien_id->getDisplayValue($Page->pasien_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_umum_rs" data-field="x_pasien_id" data-hidden="1" name="x_pasien_id" id="x_pasien_id" value="<?= HtmlEncode($Page->pasien_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
    <div id="r_fasilitas_id" class="form-group row">
        <label id="elh_antrean_umum_rs_fasilitas_id" for="x_fasilitas_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fasilitas_id->caption() ?><?= $Page->fasilitas_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fasilitas_id->cellAttributes() ?>>
<span id="el_antrean_umum_rs_fasilitas_id">
<span<?= $Page->fasilitas_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->fasilitas_id->getDisplayValue($Page->fasilitas_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_umum_rs" data-field="x_fasilitas_id" data-hidden="1" name="x_fasilitas_id" id="x_fasilitas_id" value="<?= HtmlEncode($Page->fasilitas_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
    <div id="r_rumah_sakit_id" class="form-group row">
        <label id="elh_antrean_umum_rs_rumah_sakit_id" for="x_rumah_sakit_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rumah_sakit_id->caption() ?><?= $Page->rumah_sakit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rumah_sakit_id->cellAttributes() ?>>
<span id="el_antrean_umum_rs_rumah_sakit_id">
<span<?= $Page->rumah_sakit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->rumah_sakit_id->getDisplayValue($Page->rumah_sakit_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_umum_rs" data-field="x_rumah_sakit_id" data-hidden="1" name="x_rumah_sakit_id" id="x_rumah_sakit_id" value="<?= HtmlEncode($Page->rumah_sakit_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_antrean_umum_rs_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_antrean_umum_rs_status">
<template id="tp_x_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="antrean_umum_rs" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status"
    name="x_status"
    value="<?= HtmlEncode($Page->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status"
    data-target="dsl_x_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status->isInvalidClass() ?>"
    data-table="antrean_umum_rs"
    data-field="x_status"
    data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
    <?= $Page->status->editAttributes() ?>>
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keluhan_awal->Visible) { // keluhan_awal ?>
    <div id="r_keluhan_awal" class="form-group row">
        <label id="elh_antrean_umum_rs_keluhan_awal" for="x_keluhan_awal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keluhan_awal->caption() ?><?= $Page->keluhan_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keluhan_awal->cellAttributes() ?>>
<span id="el_antrean_umum_rs_keluhan_awal">
<span<?= $Page->keluhan_awal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->keluhan_awal->getDisplayValue($Page->keluhan_awal->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_umum_rs" data-field="x_keluhan_awal" data-hidden="1" name="x_keluhan_awal" id="x_keluhan_awal" value="<?= HtmlEncode($Page->keluhan_awal->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->webusers_id->Visible) { // webusers_id ?>
    <div id="r_webusers_id" class="form-group row">
        <label id="elh_antrean_umum_rs_webusers_id" for="x_webusers_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->webusers_id->caption() ?><?= $Page->webusers_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->webusers_id->cellAttributes() ?>>
<span id="el_antrean_umum_rs_webusers_id">
    <select
        id="x_webusers_id"
        name="x_webusers_id"
        class="form-control ew-select<?= $Page->webusers_id->isInvalidClass() ?>"
        data-select2-id="antrean_umum_rs_x_webusers_id"
        data-table="antrean_umum_rs"
        data-field="x_webusers_id"
        data-value-separator="<?= $Page->webusers_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->webusers_id->getPlaceHolder()) ?>"
        <?= $Page->webusers_id->editAttributes() ?>>
        <?= $Page->webusers_id->selectOptionListHtml("x_webusers_id") ?>
    </select>
    <?= $Page->webusers_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->webusers_id->getErrorMessage() ?></div>
<?= $Page->webusers_id->Lookup->getParamTag($Page, "p_x_webusers_id") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='antrean_umum_rs_x_webusers_id']"),
        options = { name: "x_webusers_id", selectId: "antrean_umum_rs_x_webusers_id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.antrean_umum_rs.fields.webusers_id.selectOptions);
    ew.createSelect(options);
});
</script>
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
    ew.addEventHandlers("antrean_umum_rs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
