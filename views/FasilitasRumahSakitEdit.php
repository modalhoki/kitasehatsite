<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$FasilitasRumahSakitEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var ffasilitas_rumah_sakitedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    ffasilitas_rumah_sakitedit = currentForm = new ew.Form("ffasilitas_rumah_sakitedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "fasilitas_rumah_sakit")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.fasilitas_rumah_sakit)
        ew.vars.tables.fasilitas_rumah_sakit = currentTable;
    ffasilitas_rumah_sakitedit.addFields([
        ["hari_buka", [fields.hari_buka.visible && fields.hari_buka.required ? ew.Validators.required(fields.hari_buka.caption) : null], fields.hari_buka.isInvalid],
        ["jam_buka", [fields.jam_buka.visible && fields.jam_buka.required ? ew.Validators.required(fields.jam_buka.caption) : null], fields.jam_buka.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ffasilitas_rumah_sakitedit,
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
    ffasilitas_rumah_sakitedit.validate = function () {
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
    ffasilitas_rumah_sakitedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffasilitas_rumah_sakitedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ffasilitas_rumah_sakitedit");
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
<form name="ffasilitas_rumah_sakitedit" id="ffasilitas_rumah_sakitedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="fasilitas_rumah_sakit">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "rumah_sakit") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="rumah_sakit">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->rumah_sakit_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->hari_buka->Visible) { // hari_buka ?>
    <div id="r_hari_buka" class="form-group row">
        <label id="elh_fasilitas_rumah_sakit_hari_buka" for="x_hari_buka" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hari_buka->caption() ?><?= $Page->hari_buka->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hari_buka->cellAttributes() ?>>
<span id="el_fasilitas_rumah_sakit_hari_buka">
<input type="<?= $Page->hari_buka->getInputTextType() ?>" data-table="fasilitas_rumah_sakit" data-field="x_hari_buka" name="x_hari_buka" id="x_hari_buka" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->hari_buka->getPlaceHolder()) ?>" value="<?= $Page->hari_buka->EditValue ?>"<?= $Page->hari_buka->editAttributes() ?> aria-describedby="x_hari_buka_help">
<?= $Page->hari_buka->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hari_buka->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jam_buka->Visible) { // jam_buka ?>
    <div id="r_jam_buka" class="form-group row">
        <label id="elh_fasilitas_rumah_sakit_jam_buka" for="x_jam_buka" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jam_buka->caption() ?><?= $Page->jam_buka->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jam_buka->cellAttributes() ?>>
<span id="el_fasilitas_rumah_sakit_jam_buka">
<input type="<?= $Page->jam_buka->getInputTextType() ?>" data-table="fasilitas_rumah_sakit" data-field="x_jam_buka" name="x_jam_buka" id="x_jam_buka" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->jam_buka->getPlaceHolder()) ?>" value="<?= $Page->jam_buka->EditValue ?>"<?= $Page->jam_buka->editAttributes() ?> aria-describedby="x_jam_buka_help">
<?= $Page->jam_buka->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jam_buka->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="fasilitas_rumah_sakit" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("fasilitas_rumah_sakit");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
