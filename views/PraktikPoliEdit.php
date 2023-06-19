<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$PraktikPoliEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpraktik_poliedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpraktik_poliedit = currentForm = new ew.Form("fpraktik_poliedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "praktik_poli")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.praktik_poli)
        ew.vars.tables.praktik_poli = currentTable;
    fpraktik_poliedit.addFields([
        ["dokter_id", [fields.dokter_id.visible && fields.dokter_id.required ? ew.Validators.required(fields.dokter_id.caption) : null], fields.dokter_id.isInvalid],
        ["fasilitas_rumah_sakit_id", [fields.fasilitas_rumah_sakit_id.visible && fields.fasilitas_rumah_sakit_id.required ? ew.Validators.required(fields.fasilitas_rumah_sakit_id.caption) : null], fields.fasilitas_rumah_sakit_id.isInvalid],
        ["jam_praktik", [fields.jam_praktik.visible && fields.jam_praktik.required ? ew.Validators.required(fields.jam_praktik.caption) : null], fields.jam_praktik.isInvalid],
        ["hari_praktik", [fields.hari_praktik.visible && fields.hari_praktik.required ? ew.Validators.required(fields.hari_praktik.caption) : null], fields.hari_praktik.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpraktik_poliedit,
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
    fpraktik_poliedit.validate = function () {
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
    fpraktik_poliedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpraktik_poliedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpraktik_poliedit.lists.dokter_id = <?= $Page->dokter_id->toClientList($Page) ?>;
    fpraktik_poliedit.lists.fasilitas_rumah_sakit_id = <?= $Page->fasilitas_rumah_sakit_id->toClientList($Page) ?>;
    loadjs.done("fpraktik_poliedit");
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
<form name="fpraktik_poliedit" id="fpraktik_poliedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="praktik_poli">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "fasilitas_rumah_sakit") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="fasilitas_rumah_sakit">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->fasilitas_rumah_sakit_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "dokter") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="dokter">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->dokter_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
    <div id="r_dokter_id" class="form-group row">
        <label id="elh_praktik_poli_dokter_id" for="x_dokter_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dokter_id->caption() ?><?= $Page->dokter_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dokter_id->cellAttributes() ?>>
<?php if ($Page->dokter_id->getSessionValue() != "") { ?>
<span id="el_praktik_poli_dokter_id">
<span<?= $Page->dokter_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->dokter_id->getDisplayValue($Page->dokter_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_dokter_id" name="x_dokter_id" value="<?= HtmlEncode($Page->dokter_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_praktik_poli_dokter_id">
<div class="input-group ew-lookup-list" aria-describedby="x_dokter_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_dokter_id"><?= EmptyValue(strval($Page->dokter_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->dokter_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->dokter_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->dokter_id->ReadOnly || $Page->dokter_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_dokter_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->dokter_id->getErrorMessage() ?></div>
<?= $Page->dokter_id->getCustomMessage() ?>
<?= $Page->dokter_id->Lookup->getParamTag($Page, "p_x_dokter_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_dokter_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->dokter_id->displayValueSeparatorAttribute() ?>" name="x_dokter_id" id="x_dokter_id" value="<?= $Page->dokter_id->CurrentValue ?>"<?= $Page->dokter_id->editAttributes() ?>>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fasilitas_rumah_sakit_id->Visible) { // fasilitas_rumah_sakit_id ?>
    <div id="r_fasilitas_rumah_sakit_id" class="form-group row">
        <label id="elh_praktik_poli_fasilitas_rumah_sakit_id" for="x_fasilitas_rumah_sakit_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fasilitas_rumah_sakit_id->caption() ?><?= $Page->fasilitas_rumah_sakit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fasilitas_rumah_sakit_id->cellAttributes() ?>>
<?php if ($Page->fasilitas_rumah_sakit_id->getSessionValue() != "") { ?>
<span id="el_praktik_poli_fasilitas_rumah_sakit_id">
<span<?= $Page->fasilitas_rumah_sakit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->fasilitas_rumah_sakit_id->getDisplayValue($Page->fasilitas_rumah_sakit_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_fasilitas_rumah_sakit_id" name="x_fasilitas_rumah_sakit_id" value="<?= HtmlEncode($Page->fasilitas_rumah_sakit_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_praktik_poli_fasilitas_rumah_sakit_id">
<div class="input-group ew-lookup-list" aria-describedby="x_fasilitas_rumah_sakit_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_fasilitas_rumah_sakit_id"><?= EmptyValue(strval($Page->fasilitas_rumah_sakit_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->fasilitas_rumah_sakit_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->fasilitas_rumah_sakit_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->fasilitas_rumah_sakit_id->ReadOnly || $Page->fasilitas_rumah_sakit_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_fasilitas_rumah_sakit_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "fasilitas_rumah_sakit") && !$Page->fasilitas_rumah_sakit_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_fasilitas_rumah_sakit_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->fasilitas_rumah_sakit_id->caption() ?>" data-title="<?= $Page->fasilitas_rumah_sakit_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_fasilitas_rumah_sakit_id',url:'<?= GetUrl("fasilitasrumahsakitaddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->fasilitas_rumah_sakit_id->getErrorMessage() ?></div>
<?= $Page->fasilitas_rumah_sakit_id->getCustomMessage() ?>
<?= $Page->fasilitas_rumah_sakit_id->Lookup->getParamTag($Page, "p_x_fasilitas_rumah_sakit_id") ?>
<input type="hidden" is="selection-list" data-table="praktik_poli" data-field="x_fasilitas_rumah_sakit_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->fasilitas_rumah_sakit_id->displayValueSeparatorAttribute() ?>" name="x_fasilitas_rumah_sakit_id" id="x_fasilitas_rumah_sakit_id" value="<?= $Page->fasilitas_rumah_sakit_id->CurrentValue ?>"<?= $Page->fasilitas_rumah_sakit_id->editAttributes() ?>>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jam_praktik->Visible) { // jam_praktik ?>
    <div id="r_jam_praktik" class="form-group row">
        <label id="elh_praktik_poli_jam_praktik" for="x_jam_praktik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jam_praktik->caption() ?><?= $Page->jam_praktik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jam_praktik->cellAttributes() ?>>
<span id="el_praktik_poli_jam_praktik">
<input type="<?= $Page->jam_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_jam_praktik" name="x_jam_praktik" id="x_jam_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->jam_praktik->getPlaceHolder()) ?>" value="<?= $Page->jam_praktik->EditValue ?>"<?= $Page->jam_praktik->editAttributes() ?> aria-describedby="x_jam_praktik_help">
<?= $Page->jam_praktik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jam_praktik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hari_praktik->Visible) { // hari_praktik ?>
    <div id="r_hari_praktik" class="form-group row">
        <label id="elh_praktik_poli_hari_praktik" for="x_hari_praktik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hari_praktik->caption() ?><?= $Page->hari_praktik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hari_praktik->cellAttributes() ?>>
<span id="el_praktik_poli_hari_praktik">
<input type="<?= $Page->hari_praktik->getInputTextType() ?>" data-table="praktik_poli" data-field="x_hari_praktik" name="x_hari_praktik" id="x_hari_praktik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->hari_praktik->getPlaceHolder()) ?>" value="<?= $Page->hari_praktik->EditValue ?>"<?= $Page->hari_praktik->editAttributes() ?> aria-describedby="x_hari_praktik_help">
<?= $Page->hari_praktik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hari_praktik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="praktik_poli" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("praktik_poli");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
