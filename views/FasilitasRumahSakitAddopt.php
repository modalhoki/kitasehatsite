<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$FasilitasRumahSakitAddopt = &$Page;
?>
<script>
var currentForm, currentPageID;
var ffasilitas_rumah_sakitaddopt;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "addopt";
    ffasilitas_rumah_sakitaddopt = currentForm = new ew.Form("ffasilitas_rumah_sakitaddopt", "addopt");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "fasilitas_rumah_sakit")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.fasilitas_rumah_sakit)
        ew.vars.tables.fasilitas_rumah_sakit = currentTable;
    ffasilitas_rumah_sakitaddopt.addFields([
        ["rumah_sakit_id", [fields.rumah_sakit_id.visible && fields.rumah_sakit_id.required ? ew.Validators.required(fields.rumah_sakit_id.caption) : null, ew.Validators.integer], fields.rumah_sakit_id.isInvalid],
        ["fasilitas_id", [fields.fasilitas_id.visible && fields.fasilitas_id.required ? ew.Validators.required(fields.fasilitas_id.caption) : null], fields.fasilitas_id.isInvalid],
        ["hari_buka", [fields.hari_buka.visible && fields.hari_buka.required ? ew.Validators.required(fields.hari_buka.caption) : null], fields.hari_buka.isInvalid],
        ["jam_buka", [fields.jam_buka.visible && fields.jam_buka.required ? ew.Validators.required(fields.jam_buka.caption) : null], fields.jam_buka.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ffasilitas_rumah_sakitaddopt,
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
    ffasilitas_rumah_sakitaddopt.validate = function () {
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
    ffasilitas_rumah_sakitaddopt.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffasilitas_rumah_sakitaddopt.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    ffasilitas_rumah_sakitaddopt.lists.rumah_sakit_id = <?= $Page->rumah_sakit_id->toClientList($Page) ?>;
    ffasilitas_rumah_sakitaddopt.lists.fasilitas_id = <?= $Page->fasilitas_id->toClientList($Page) ?>;
    loadjs.done("ffasilitas_rumah_sakitaddopt");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<form name="ffasilitas_rumah_sakitaddopt" id="ffasilitas_rumah_sakitaddopt" class="ew-form ew-horizontal" action="<?= HtmlEncode(GetUrl(Config("API_URL"))) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="<?= Config("API_ACTION_NAME") ?>" id="<?= Config("API_ACTION_NAME") ?>" value="<?= Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?= Config("API_OBJECT_NAME") ?>" id="<?= Config("API_OBJECT_NAME") ?>" value="fasilitas_rumah_sakit">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label ew-label"><?= $Page->rumah_sakit_id->caption() ?><?= $Page->rumah_sakit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10">
<?php
$onchange = $Page->rumah_sakit_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->rumah_sakit_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_rumah_sakit_id" class="ew-auto-suggest">
    <div class="input-group flex-nowrap">
        <input type="<?= $Page->rumah_sakit_id->getInputTextType() ?>" class="form-control" name="sv_x_rumah_sakit_id" id="sv_x_rumah_sakit_id" value="<?= RemoveHtml($Page->rumah_sakit_id->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->rumah_sakit_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->rumah_sakit_id->getPlaceHolder()) ?>"<?= $Page->rumah_sakit_id->editAttributes() ?>>
        <div class="input-group-append">
            <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->rumah_sakit_id->caption()), $Language->phrase("LookupLink", true))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_rumah_sakit_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?= ($Page->rumah_sakit_id->ReadOnly || $Page->rumah_sakit_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
        </div>
    </div>
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="fasilitas_rumah_sakit" data-field="x_rumah_sakit_id" data-input="sv_x_rumah_sakit_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->rumah_sakit_id->displayValueSeparatorAttribute() ?>" name="x_rumah_sakit_id" id="x_rumah_sakit_id" value="<?= HtmlEncode($Page->rumah_sakit_id->CurrentValue) ?>"<?= $onchange ?>>
<div class="invalid-feedback"><?= $Page->rumah_sakit_id->getErrorMessage() ?></div>
<script>
loadjs.ready(["ffasilitas_rumah_sakitaddopt"], function() {
    ffasilitas_rumah_sakitaddopt.createAutoSuggest(Object.assign({"id":"x_rumah_sakit_id","forceSelect":false}, ew.vars.tables.fasilitas_rumah_sakit.fields.rumah_sakit_id.autoSuggestOptions));
});
</script>
<?= $Page->rumah_sakit_id->Lookup->getParamTag($Page, "p_x_rumah_sakit_id") ?>
</div>
    </div>
<?php } ?>
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label ew-label" for="x_fasilitas_id"><?= $Page->fasilitas_id->caption() ?><?= $Page->fasilitas_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_fasilitas_id"><?= EmptyValue(strval($Page->fasilitas_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->fasilitas_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->fasilitas_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->fasilitas_id->ReadOnly || $Page->fasilitas_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_fasilitas_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "fasilitas") && !$Page->fasilitas_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_fasilitas_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->fasilitas_id->caption() ?>" data-title="<?= $Page->fasilitas_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_fasilitas_id',url:'<?= GetUrl("fasilitasaddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->fasilitas_id->getErrorMessage() ?></div>
<?= $Page->fasilitas_id->Lookup->getParamTag($Page, "p_x_fasilitas_id") ?>
<input type="hidden" is="selection-list" data-table="fasilitas_rumah_sakit" data-field="x_fasilitas_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->fasilitas_id->displayValueSeparatorAttribute() ?>" name="x_fasilitas_id" id="x_fasilitas_id" value="<?= $Page->fasilitas_id->CurrentValue ?>"<?= $Page->fasilitas_id->editAttributes() ?>>
</div>
    </div>
<?php } ?>
<?php if ($Page->hari_buka->Visible) { // hari_buka ?>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label ew-label" for="x_hari_buka"><?= $Page->hari_buka->caption() ?><?= $Page->hari_buka->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10">
<input type="<?= $Page->hari_buka->getInputTextType() ?>" data-table="fasilitas_rumah_sakit" data-field="x_hari_buka" name="x_hari_buka" id="x_hari_buka" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->hari_buka->getPlaceHolder()) ?>" value="<?= $Page->hari_buka->EditValue ?>"<?= $Page->hari_buka->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->hari_buka->getErrorMessage() ?></div>
</div>
    </div>
<?php } ?>
<?php if ($Page->jam_buka->Visible) { // jam_buka ?>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label ew-label" for="x_jam_buka"><?= $Page->jam_buka->caption() ?><?= $Page->jam_buka->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10">
<input type="<?= $Page->jam_buka->getInputTextType() ?>" data-table="fasilitas_rumah_sakit" data-field="x_jam_buka" name="x_jam_buka" id="x_jam_buka" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->jam_buka->getPlaceHolder()) ?>" value="<?= $Page->jam_buka->EditValue ?>"<?= $Page->jam_buka->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->jam_buka->getErrorMessage() ?></div>
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
    ew.addEventHandlers("fasilitas_rumah_sakit");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
