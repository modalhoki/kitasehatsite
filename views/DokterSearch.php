<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$DokterSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdoktersearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    fdoktersearch = currentAdvancedSearchForm = new ew.Form("fdoktersearch", "search");
    <?php } else { ?>
    fdoktersearch = currentForm = new ew.Form("fdoktersearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "dokter")) ?>,
        fields = currentTable.fields;
    fdoktersearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["nama_dokter", [], fields.nama_dokter.isInvalid],
        ["webusers_id", [], fields.webusers_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fdoktersearch.setInvalid();
    });

    // Validate form
    fdoktersearch.validate = function () {
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
    fdoktersearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdoktersearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdoktersearch.lists.webusers_id = <?= $Page->webusers_id->toClientList($Page) ?>;
    loadjs.done("fdoktersearch");
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
<form name="fdoktersearch" id="fdoktersearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="dokter">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_dokter_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
            <span id="el_dokter_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="dokter" data-field="x_id" name="x_id" id="x_id" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_dokter->Visible) { // nama_dokter ?>
    <div id="r_nama_dokter" class="form-group row">
        <label for="x_nama_dokter" class="<?= $Page->LeftColumnClass ?>"><span id="elh_dokter_nama_dokter"><?= $Page->nama_dokter->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama_dokter" id="z_nama_dokter" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_dokter->cellAttributes() ?>>
            <span id="el_dokter_nama_dokter" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->nama_dokter->getInputTextType() ?>" data-table="dokter" data-field="x_nama_dokter" name="x_nama_dokter" id="x_nama_dokter" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama_dokter->getPlaceHolder()) ?>" value="<?= $Page->nama_dokter->EditValue ?>"<?= $Page->nama_dokter->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nama_dokter->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->webusers_id->Visible) { // webusers_id ?>
    <div id="r_webusers_id" class="form-group row">
        <label for="x_webusers_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_dokter_webusers_id"><?= $Page->webusers_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_webusers_id" id="z_webusers_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->webusers_id->cellAttributes() ?>>
            <span id="el_dokter_webusers_id" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_webusers_id"><?= EmptyValue(strval($Page->webusers_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->webusers_id->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->webusers_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->webusers_id->ReadOnly || $Page->webusers_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_webusers_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->webusers_id->getErrorMessage(false) ?></div>
<?= $Page->webusers_id->Lookup->getParamTag($Page, "p_x_webusers_id") ?>
<input type="hidden" is="selection-list" data-table="dokter" data-field="x_webusers_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->webusers_id->displayValueSeparatorAttribute() ?>" name="x_webusers_id" id="x_webusers_id" value="<?= $Page->webusers_id->AdvancedSearch->SearchValue ?>"<?= $Page->webusers_id->editAttributes() ?>>
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
    ew.addEventHandlers("dokter");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
