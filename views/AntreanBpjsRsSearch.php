<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$AntreanBpjsRsSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var fantrean_bpjs_rssearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    fantrean_bpjs_rssearch = currentAdvancedSearchForm = new ew.Form("fantrean_bpjs_rssearch", "search");
    <?php } else { ?>
    fantrean_bpjs_rssearch = currentForm = new ew.Form("fantrean_bpjs_rssearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "antrean_bpjs_rs")) ?>,
        fields = currentTable.fields;
    fantrean_bpjs_rssearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["nomor_antrean", [ew.Validators.integer], fields.nomor_antrean.isInvalid],
        ["waktu", [ew.Validators.datetime(1)], fields.waktu.isInvalid],
        ["pasien_id", [], fields.pasien_id.isInvalid],
        ["fasilitas_id", [ew.Validators.integer], fields.fasilitas_id.isInvalid],
        ["rumah_sakit_id", [], fields.rumah_sakit_id.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["keluhan_awal", [], fields.keluhan_awal.isInvalid],
        ["webusers_id", [], fields.webusers_id.isInvalid],
        ["Petugas", [], fields.Petugas.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fantrean_bpjs_rssearch.setInvalid();
    });

    // Validate form
    fantrean_bpjs_rssearch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fantrean_bpjs_rssearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fantrean_bpjs_rssearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fantrean_bpjs_rssearch.lists.pasien_id = <?= $Page->pasien_id->toClientList($Page) ?>;
    fantrean_bpjs_rssearch.lists.fasilitas_id = <?= $Page->fasilitas_id->toClientList($Page) ?>;
    fantrean_bpjs_rssearch.lists.rumah_sakit_id = <?= $Page->rumah_sakit_id->toClientList($Page) ?>;
    fantrean_bpjs_rssearch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fantrean_bpjs_rssearch.lists.webusers_id = <?= $Page->webusers_id->toClientList($Page) ?>;
    loadjs.done("fantrean_bpjs_rssearch");
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
<form name="fantrean_bpjs_rssearch" id="fantrean_bpjs_rssearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="antrean_bpjs_rs">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rs_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="antrean_bpjs_rs" data-field="x_id" name="x_id" id="x_id" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->nomor_antrean->Visible) { // nomor_antrean ?>
    <div id="r_nomor_antrean" class="form-group row">
        <label for="x_nomor_antrean" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_nomor_antrean"><?= $Page->nomor_antrean->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_nomor_antrean" id="z_nomor_antrean" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nomor_antrean->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rs_nomor_antrean" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->nomor_antrean->getInputTextType() ?>" data-table="antrean_bpjs_rs" data-field="x_nomor_antrean" name="x_nomor_antrean" id="x_nomor_antrean" size="30" placeholder="<?= HtmlEncode($Page->nomor_antrean->getPlaceHolder()) ?>" value="<?= $Page->nomor_antrean->EditValue ?>"<?= $Page->nomor_antrean->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nomor_antrean->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
    <div id="r_waktu" class="form-group row">
        <label for="x_waktu" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_waktu"><?= $Page->waktu->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_waktu" id="z_waktu" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rs_waktu" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->waktu->getInputTextType() ?>" data-table="antrean_bpjs_rs" data-field="x_waktu" data-format="1" name="x_waktu" id="x_waktu" placeholder="<?= HtmlEncode($Page->waktu->getPlaceHolder()) ?>" value="<?= $Page->waktu->EditValue ?>"<?= $Page->waktu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->waktu->getErrorMessage(false) ?></div>
<?php if (!$Page->waktu->ReadOnly && !$Page->waktu->Disabled && !isset($Page->waktu->EditAttrs["readonly"]) && !isset($Page->waktu->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fantrean_bpjs_rssearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fantrean_bpjs_rssearch", "x_waktu", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->pasien_id->Visible) { // pasien_id ?>
    <div id="r_pasien_id" class="form-group row">
        <label for="x_pasien_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_pasien_id"><?= $Page->pasien_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_pasien_id" id="z_pasien_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pasien_id->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rs_pasien_id" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pasien_id"><?= EmptyValue(strval($Page->pasien_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->pasien_id->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->pasien_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->pasien_id->ReadOnly || $Page->pasien_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pasien_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->pasien_id->getErrorMessage(false) ?></div>
<?= $Page->pasien_id->Lookup->getParamTag($Page, "p_x_pasien_id") ?>
<input type="hidden" is="selection-list" data-table="antrean_bpjs_rs" data-field="x_pasien_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->pasien_id->displayValueSeparatorAttribute() ?>" name="x_pasien_id" id="x_pasien_id" value="<?= $Page->pasien_id->AdvancedSearch->SearchValue ?>"<?= $Page->pasien_id->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
    <div id="r_fasilitas_id" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_fasilitas_id"><?= $Page->fasilitas_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_fasilitas_id" id="z_fasilitas_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fasilitas_id->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rs_fasilitas_id" class="ew-search-field ew-search-field-single">
<?php
$onchange = $Page->fasilitas_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->fasilitas_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_fasilitas_id" class="ew-auto-suggest">
    <div class="input-group flex-nowrap">
        <input type="<?= $Page->fasilitas_id->getInputTextType() ?>" class="form-control" name="sv_x_fasilitas_id" id="sv_x_fasilitas_id" value="<?= RemoveHtml($Page->fasilitas_id->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->fasilitas_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->fasilitas_id->getPlaceHolder()) ?>"<?= $Page->fasilitas_id->editAttributes() ?>>
        <div class="input-group-append">
            <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->fasilitas_id->caption()), $Language->phrase("LookupLink", true))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_fasilitas_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?= ($Page->fasilitas_id->ReadOnly || $Page->fasilitas_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
        </div>
    </div>
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="antrean_bpjs_rs" data-field="x_fasilitas_id" data-input="sv_x_fasilitas_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->fasilitas_id->displayValueSeparatorAttribute() ?>" name="x_fasilitas_id" id="x_fasilitas_id" value="<?= HtmlEncode($Page->fasilitas_id->AdvancedSearch->SearchValue) ?>"<?= $onchange ?>>
<div class="invalid-feedback"><?= $Page->fasilitas_id->getErrorMessage(false) ?></div>
<script>
loadjs.ready(["fantrean_bpjs_rssearch"], function() {
    fantrean_bpjs_rssearch.createAutoSuggest(Object.assign({"id":"x_fasilitas_id","forceSelect":false}, ew.vars.tables.antrean_bpjs_rs.fields.fasilitas_id.autoSuggestOptions));
});
</script>
<?= $Page->fasilitas_id->Lookup->getParamTag($Page, "p_x_fasilitas_id") ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
    <div id="r_rumah_sakit_id" class="form-group row">
        <label for="x_rumah_sakit_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_rumah_sakit_id"><?= $Page->rumah_sakit_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_rumah_sakit_id" id="z_rumah_sakit_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rumah_sakit_id->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rs_rumah_sakit_id" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_rumah_sakit_id"><?= EmptyValue(strval($Page->rumah_sakit_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->rumah_sakit_id->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->rumah_sakit_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->rumah_sakit_id->ReadOnly || $Page->rumah_sakit_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_rumah_sakit_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->rumah_sakit_id->getErrorMessage(false) ?></div>
<?= $Page->rumah_sakit_id->Lookup->getParamTag($Page, "p_x_rumah_sakit_id") ?>
<input type="hidden" is="selection-list" data-table="antrean_bpjs_rs" data-field="x_rumah_sakit_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->rumah_sakit_id->displayValueSeparatorAttribute() ?>" name="x_rumah_sakit_id" id="x_rumah_sakit_id" value="<?= $Page->rumah_sakit_id->AdvancedSearch->SearchValue ?>"<?= $Page->rumah_sakit_id->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_status"><?= $Page->status->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_status" id="z_status" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rs_status" class="ew-search-field ew-search-field-single">
<template id="tp_x_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="antrean_bpjs_rs" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status"
    name="x_status"
    value="<?= HtmlEncode($Page->status->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_status"
    data-target="dsl_x_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status->isInvalidClass() ?>"
    data-table="antrean_bpjs_rs"
    data-field="x_status"
    data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
    <?= $Page->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->keluhan_awal->Visible) { // keluhan_awal ?>
    <div id="r_keluhan_awal" class="form-group row">
        <label for="x_keluhan_awal" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_keluhan_awal"><?= $Page->keluhan_awal->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_keluhan_awal" id="z_keluhan_awal" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keluhan_awal->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rs_keluhan_awal" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->keluhan_awal->getInputTextType() ?>" data-table="antrean_bpjs_rs" data-field="x_keluhan_awal" name="x_keluhan_awal" id="x_keluhan_awal" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keluhan_awal->getPlaceHolder()) ?>" value="<?= $Page->keluhan_awal->EditValue ?>"<?= $Page->keluhan_awal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->keluhan_awal->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->webusers_id->Visible) { // webusers_id ?>
    <div id="r_webusers_id" class="form-group row">
        <label for="x_webusers_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_webusers_id"><?= $Page->webusers_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_webusers_id" id="z_webusers_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->webusers_id->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rs_webusers_id" class="ew-search-field ew-search-field-single">
    <select
        id="x_webusers_id"
        name="x_webusers_id"
        class="form-control ew-select<?= $Page->webusers_id->isInvalidClass() ?>"
        data-select2-id="antrean_bpjs_rs_x_webusers_id"
        data-table="antrean_bpjs_rs"
        data-field="x_webusers_id"
        data-value-separator="<?= $Page->webusers_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->webusers_id->getPlaceHolder()) ?>"
        <?= $Page->webusers_id->editAttributes() ?>>
        <?= $Page->webusers_id->selectOptionListHtml("x_webusers_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->webusers_id->getErrorMessage(false) ?></div>
<?= $Page->webusers_id->Lookup->getParamTag($Page, "p_x_webusers_id") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='antrean_bpjs_rs_x_webusers_id']"),
        options = { name: "x_webusers_id", selectId: "antrean_bpjs_rs_x_webusers_id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.antrean_bpjs_rs.fields.webusers_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->Petugas->Visible) { // Petugas ?>
    <div id="r_Petugas" class="form-group row">
        <label for="x_Petugas" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rs_Petugas"><?= $Page->Petugas->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Petugas" id="z_Petugas" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Petugas->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rs_Petugas" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->Petugas->getInputTextType() ?>" data-table="antrean_bpjs_rs" data-field="x_Petugas" name="x_Petugas" id="x_Petugas" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Petugas->getPlaceHolder()) ?>" value="<?= $Page->Petugas->EditValue ?>"<?= $Page->Petugas->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->Petugas->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("Search") ?></button>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="location.reload();"><?= $Language->phrase("Reset") ?></button>
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
    ew.addEventHandlers("antrean_bpjs_rs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
