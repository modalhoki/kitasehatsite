<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$WebusersRsSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var fwebusers_rssearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    fwebusers_rssearch = currentAdvancedSearchForm = new ew.Form("fwebusers_rssearch", "search");
    <?php } else { ?>
    fwebusers_rssearch = currentForm = new ew.Form("fwebusers_rssearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "webusers_rs")) ?>,
        fields = currentTable.fields;
    fwebusers_rssearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["_username", [], fields._username.isInvalid],
        ["_password", [], fields._password.isInvalid],
        ["role", [], fields.role.isInvalid],
        ["rumah_sakit_id", [], fields.rumah_sakit_id.isInvalid],
        ["administrator_rumah_sakit", [], fields.administrator_rumah_sakit.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fwebusers_rssearch.setInvalid();
    });

    // Validate form
    fwebusers_rssearch.validate = function () {
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
    fwebusers_rssearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fwebusers_rssearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fwebusers_rssearch.lists.rumah_sakit_id = <?= $Page->rumah_sakit_id->toClientList($Page) ?>;
    fwebusers_rssearch.lists.administrator_rumah_sakit = <?= $Page->administrator_rumah_sakit->toClientList($Page) ?>;
    loadjs.done("fwebusers_rssearch");
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
<form name="fwebusers_rssearch" id="fwebusers_rssearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="webusers_rs">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_webusers_rs_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
            <span id="el_webusers_rs_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="webusers_rs" data-field="x_id" name="x_id" id="x_id" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username" class="form-group row">
        <label for="x__username" class="<?= $Page->LeftColumnClass ?>"><span id="elh_webusers_rs__username"><?= $Page->_username->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z__username" id="z__username" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_username->cellAttributes() ?>>
            <span id="el_webusers_rs__username" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->_username->getInputTextType() ?>" data-table="webusers_rs" data-field="x__username" name="x__username" id="x__username" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>" value="<?= $Page->_username->EditValue ?>"<?= $Page->_username->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password" class="form-group row">
        <label for="x__password" class="<?= $Page->LeftColumnClass ?>"><span id="elh_webusers_rs__password"><?= $Page->_password->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z__password" id="z__password" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_password->cellAttributes() ?>>
            <span id="el_webusers_rs__password" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->_password->getInputTextType() ?>" data-table="webusers_rs" data-field="x__password" name="x__password" id="x__password" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>" value="<?= $Page->_password->EditValue ?>"<?= $Page->_password->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->role->Visible) { // role ?>
    <div id="r_role" class="form-group row">
        <label for="x_role" class="<?= $Page->LeftColumnClass ?>"><span id="elh_webusers_rs_role"><?= $Page->role->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_role" id="z_role" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->role->cellAttributes() ?>>
            <span id="el_webusers_rs_role" class="ew-search-field ew-search-field-single">
    <select
        id="x_role"
        name="x_role"
        class="form-control ew-select<?= $Page->role->isInvalidClass() ?>"
        data-select2-id="webusers_rs_x_role"
        data-table="webusers_rs"
        data-field="x_role"
        data-value-separator="<?= $Page->role->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->role->getPlaceHolder()) ?>"
        <?= $Page->role->editAttributes() ?>>
        <?= $Page->role->selectOptionListHtml("x_role") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->role->getErrorMessage(false) ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='webusers_rs_x_role']"),
        options = { name: "x_role", selectId: "webusers_rs_x_role", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.webusers_rs.fields.role.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
    <div id="r_rumah_sakit_id" class="form-group row">
        <label for="x_rumah_sakit_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_webusers_rs_rumah_sakit_id"><?= $Page->rumah_sakit_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_rumah_sakit_id" id="z_rumah_sakit_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rumah_sakit_id->cellAttributes() ?>>
            <span id="el_webusers_rs_rumah_sakit_id" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_rumah_sakit_id"><?= EmptyValue(strval($Page->rumah_sakit_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->rumah_sakit_id->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->rumah_sakit_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->rumah_sakit_id->ReadOnly || $Page->rumah_sakit_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_rumah_sakit_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->rumah_sakit_id->getErrorMessage(false) ?></div>
<?= $Page->rumah_sakit_id->Lookup->getParamTag($Page, "p_x_rumah_sakit_id") ?>
<input type="hidden" is="selection-list" data-table="webusers_rs" data-field="x_rumah_sakit_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->rumah_sakit_id->displayValueSeparatorAttribute() ?>" name="x_rumah_sakit_id" id="x_rumah_sakit_id" value="<?= $Page->rumah_sakit_id->AdvancedSearch->SearchValue ?>"<?= $Page->rumah_sakit_id->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->administrator_rumah_sakit->Visible) { // administrator_rumah_sakit ?>
    <div id="r_administrator_rumah_sakit" class="form-group row">
        <label for="x_administrator_rumah_sakit" class="<?= $Page->LeftColumnClass ?>"><span id="elh_webusers_rs_administrator_rumah_sakit"><?= $Page->administrator_rumah_sakit->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_administrator_rumah_sakit" id="z_administrator_rumah_sakit" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->administrator_rumah_sakit->cellAttributes() ?>>
            <span id="el_webusers_rs_administrator_rumah_sakit" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_administrator_rumah_sakit"><?= EmptyValue(strval($Page->administrator_rumah_sakit->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->administrator_rumah_sakit->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->administrator_rumah_sakit->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->administrator_rumah_sakit->ReadOnly || $Page->administrator_rumah_sakit->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_administrator_rumah_sakit',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->administrator_rumah_sakit->getErrorMessage(false) ?></div>
<?= $Page->administrator_rumah_sakit->Lookup->getParamTag($Page, "p_x_administrator_rumah_sakit") ?>
<input type="hidden" is="selection-list" data-table="webusers_rs" data-field="x_administrator_rumah_sakit" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->administrator_rumah_sakit->displayValueSeparatorAttribute() ?>" name="x_administrator_rumah_sakit" id="x_administrator_rumah_sakit" value="<?= $Page->administrator_rumah_sakit->AdvancedSearch->SearchValue ?>"<?= $Page->administrator_rumah_sakit->editAttributes() ?>>
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
    ew.addEventHandlers("webusers_rs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
