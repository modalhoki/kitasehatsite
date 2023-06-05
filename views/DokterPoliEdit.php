<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DokterPoliEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdokter_poliedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fdokter_poliedit = currentForm = new ew.Form("fdokter_poliedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "dokter_poli")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.dokter_poli)
        ew.vars.tables.dokter_poli = currentTable;
    fdokter_poliedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["dokter_id", [fields.dokter_id.visible && fields.dokter_id.required ? ew.Validators.required(fields.dokter_id.caption) : null], fields.dokter_id.isInvalid],
        ["fasilitas_rs_id", [fields.fasilitas_rs_id.visible && fields.fasilitas_rs_id.required ? ew.Validators.required(fields.fasilitas_rs_id.caption) : null], fields.fasilitas_rs_id.isInvalid],
        ["jam_praktik", [fields.jam_praktik.visible && fields.jam_praktik.required ? ew.Validators.required(fields.jam_praktik.caption) : null], fields.jam_praktik.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdokter_poliedit,
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
    fdokter_poliedit.validate = function () {
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
    fdokter_poliedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdokter_poliedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdokter_poliedit.lists.dokter_id = <?= $Page->dokter_id->toClientList($Page) ?>;
    fdokter_poliedit.lists.fasilitas_rs_id = <?= $Page->fasilitas_rs_id->toClientList($Page) ?>;
    loadjs.done("fdokter_poliedit");
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
<form name="fdokter_poliedit" id="fdokter_poliedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="dokter_poli">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_dokter_poli_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_dokter_poli_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="dokter_poli" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
    <div id="r_dokter_id" class="form-group row">
        <label id="elh_dokter_poli_dokter_id" for="x_dokter_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dokter_id->caption() ?><?= $Page->dokter_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dokter_id->cellAttributes() ?>>
<span id="el_dokter_poli_dokter_id">
<div class="input-group ew-lookup-list" aria-describedby="x_dokter_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_dokter_id"><?= EmptyValue(strval($Page->dokter_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->dokter_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->dokter_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->dokter_id->ReadOnly || $Page->dokter_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_dokter_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->dokter_id->getErrorMessage() ?></div>
<?= $Page->dokter_id->getCustomMessage() ?>
<?= $Page->dokter_id->Lookup->getParamTag($Page, "p_x_dokter_id") ?>
<input type="hidden" is="selection-list" data-table="dokter_poli" data-field="x_dokter_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->dokter_id->displayValueSeparatorAttribute() ?>" name="x_dokter_id" id="x_dokter_id" value="<?= $Page->dokter_id->CurrentValue ?>"<?= $Page->dokter_id->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fasilitas_rs_id->Visible) { // fasilitas_rs_id ?>
    <div id="r_fasilitas_rs_id" class="form-group row">
        <label id="elh_dokter_poli_fasilitas_rs_id" for="x_fasilitas_rs_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fasilitas_rs_id->caption() ?><?= $Page->fasilitas_rs_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fasilitas_rs_id->cellAttributes() ?>>
<span id="el_dokter_poli_fasilitas_rs_id">
<div class="input-group ew-lookup-list" aria-describedby="x_fasilitas_rs_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_fasilitas_rs_id"><?= EmptyValue(strval($Page->fasilitas_rs_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->fasilitas_rs_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->fasilitas_rs_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->fasilitas_rs_id->ReadOnly || $Page->fasilitas_rs_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_fasilitas_rs_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->fasilitas_rs_id->getErrorMessage() ?></div>
<?= $Page->fasilitas_rs_id->getCustomMessage() ?>
<?= $Page->fasilitas_rs_id->Lookup->getParamTag($Page, "p_x_fasilitas_rs_id") ?>
<input type="hidden" is="selection-list" data-table="dokter_poli" data-field="x_fasilitas_rs_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->fasilitas_rs_id->displayValueSeparatorAttribute() ?>" name="x_fasilitas_rs_id" id="x_fasilitas_rs_id" value="<?= $Page->fasilitas_rs_id->CurrentValue ?>"<?= $Page->fasilitas_rs_id->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jam_praktik->Visible) { // jam_praktik ?>
    <div id="r_jam_praktik" class="form-group row">
        <label id="elh_dokter_poli_jam_praktik" for="x_jam_praktik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jam_praktik->caption() ?><?= $Page->jam_praktik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jam_praktik->cellAttributes() ?>>
<span id="el_dokter_poli_jam_praktik">
<input type="<?= $Page->jam_praktik->getInputTextType() ?>" data-table="dokter_poli" data-field="x_jam_praktik" name="x_jam_praktik" id="x_jam_praktik" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->jam_praktik->getPlaceHolder()) ?>" value="<?= $Page->jam_praktik->EditValue ?>"<?= $Page->jam_praktik->editAttributes() ?> aria-describedby="x_jam_praktik_help">
<?= $Page->jam_praktik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jam_praktik->getErrorMessage() ?></div>
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
    ew.addEventHandlers("dokter_poli");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
