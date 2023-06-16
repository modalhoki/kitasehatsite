<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DataDurasiAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdata_durasiadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fdata_durasiadd = currentForm = new ew.Form("fdata_durasiadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "data_durasi")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.data_durasi)
        ew.vars.tables.data_durasi = currentTable;
    fdata_durasiadd.addFields([
        ["waktu_daftar", [fields.waktu_daftar.visible && fields.waktu_daftar.required ? ew.Validators.required(fields.waktu_daftar.caption) : null, ew.Validators.datetime(0)], fields.waktu_daftar.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdata_durasiadd,
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
    fdata_durasiadd.validate = function () {
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
    fdata_durasiadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdata_durasiadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fdata_durasiadd");
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
<form name="fdata_durasiadd" id="fdata_durasiadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="data_durasi">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->waktu_daftar->Visible) { // waktu_daftar ?>
    <div id="r_waktu_daftar" class="form-group row">
        <label id="elh_data_durasi_waktu_daftar" for="x_waktu_daftar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waktu_daftar->caption() ?><?= $Page->waktu_daftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu_daftar->cellAttributes() ?>>
<span id="el_data_durasi_waktu_daftar">
<input type="<?= $Page->waktu_daftar->getInputTextType() ?>" data-table="data_durasi" data-field="x_waktu_daftar" name="x_waktu_daftar" id="x_waktu_daftar" maxlength="19" placeholder="<?= HtmlEncode($Page->waktu_daftar->getPlaceHolder()) ?>" value="<?= $Page->waktu_daftar->EditValue ?>"<?= $Page->waktu_daftar->editAttributes() ?> aria-describedby="x_waktu_daftar_help">
<?= $Page->waktu_daftar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->waktu_daftar->getErrorMessage() ?></div>
<?php if (!$Page->waktu_daftar->ReadOnly && !$Page->waktu_daftar->Disabled && !isset($Page->waktu_daftar->EditAttrs["readonly"]) && !isset($Page->waktu_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdata_durasiadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fdata_durasiadd", "x_waktu_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
