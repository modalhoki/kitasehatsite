<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$RumahSakitSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var frumah_sakitsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    frumah_sakitsearch = currentAdvancedSearchForm = new ew.Form("frumah_sakitsearch", "search");
    <?php } else { ?>
    frumah_sakitsearch = currentForm = new ew.Form("frumah_sakitsearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "rumah_sakit")) ?>,
        fields = currentTable.fields;
    frumah_sakitsearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["nama", [], fields.nama.isInvalid],
        ["alamat", [], fields.alamat.isInvalid],
        ["daerah_id", [], fields.daerah_id.isInvalid],
        ["foto_rumah_sakit", [], fields.foto_rumah_sakit.isInvalid],
        ["jam_buka", [], fields.jam_buka.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        frumah_sakitsearch.setInvalid();
    });

    // Validate form
    frumah_sakitsearch.validate = function () {
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
    frumah_sakitsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frumah_sakitsearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    frumah_sakitsearch.lists.daerah_id = <?= $Page->daerah_id->toClientList($Page) ?>;
    loadjs.done("frumah_sakitsearch");
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
<form name="frumah_sakitsearch" id="frumah_sakitsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rumah_sakit">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_rumah_sakit_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
            <span id="el_rumah_sakit_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="rumah_sakit" data-field="x_id" name="x_id" id="x_id" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama" class="form-group row">
        <label for="x_nama" class="<?= $Page->LeftColumnClass ?>"><span id="elh_rumah_sakit_nama"><?= $Page->nama->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama" id="z_nama" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama->cellAttributes() ?>>
            <span id="el_rumah_sakit_nama" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->nama->getInputTextType() ?>" data-table="rumah_sakit" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>" value="<?= $Page->nama->EditValue ?>"<?= $Page->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <div id="r_alamat" class="form-group row">
        <label for="x_alamat" class="<?= $Page->LeftColumnClass ?>"><span id="elh_rumah_sakit_alamat"><?= $Page->alamat->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_alamat" id="z_alamat" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alamat->cellAttributes() ?>>
            <span id="el_rumah_sakit_alamat" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->alamat->getInputTextType() ?>" data-table="rumah_sakit" data-field="x_alamat" name="x_alamat" id="x_alamat" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->alamat->getPlaceHolder()) ?>" value="<?= $Page->alamat->EditValue ?>"<?= $Page->alamat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->alamat->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->daerah_id->Visible) { // daerah_id ?>
    <div id="r_daerah_id" class="form-group row">
        <label for="x_daerah_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_rumah_sakit_daerah_id"><?= $Page->daerah_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_daerah_id" id="z_daerah_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->daerah_id->cellAttributes() ?>>
            <span id="el_rumah_sakit_daerah_id" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_daerah_id"><?= EmptyValue(strval($Page->daerah_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->daerah_id->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->daerah_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->daerah_id->ReadOnly || $Page->daerah_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_daerah_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->daerah_id->getErrorMessage(false) ?></div>
<?= $Page->daerah_id->Lookup->getParamTag($Page, "p_x_daerah_id") ?>
<input type="hidden" is="selection-list" data-table="rumah_sakit" data-field="x_daerah_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->daerah_id->displayValueSeparatorAttribute() ?>" name="x_daerah_id" id="x_daerah_id" value="<?= $Page->daerah_id->AdvancedSearch->SearchValue ?>"<?= $Page->daerah_id->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->foto_rumah_sakit->Visible) { // foto_rumah_sakit ?>
    <div id="r_foto_rumah_sakit" class="form-group row">
        <label for="x_foto_rumah_sakit" class="<?= $Page->LeftColumnClass ?>"><span id="elh_rumah_sakit_foto_rumah_sakit"><?= $Page->foto_rumah_sakit->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_foto_rumah_sakit" id="z_foto_rumah_sakit" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->foto_rumah_sakit->cellAttributes() ?>>
            <span id="el_rumah_sakit_foto_rumah_sakit" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->foto_rumah_sakit->getInputTextType() ?>" data-table="rumah_sakit" data-field="x_foto_rumah_sakit" name="x_foto_rumah_sakit" id="x_foto_rumah_sakit" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->foto_rumah_sakit->getPlaceHolder()) ?>" value="<?= $Page->foto_rumah_sakit->EditValue ?>"<?= $Page->foto_rumah_sakit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->foto_rumah_sakit->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->jam_buka->Visible) { // jam_buka ?>
    <div id="r_jam_buka" class="form-group row">
        <label for="x_jam_buka" class="<?= $Page->LeftColumnClass ?>"><span id="elh_rumah_sakit_jam_buka"><?= $Page->jam_buka->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_jam_buka" id="z_jam_buka" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jam_buka->cellAttributes() ?>>
            <span id="el_rumah_sakit_jam_buka" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->jam_buka->getInputTextType() ?>" data-table="rumah_sakit" data-field="x_jam_buka" name="x_jam_buka" id="x_jam_buka" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->jam_buka->getPlaceHolder()) ?>" value="<?= $Page->jam_buka->EditValue ?>"<?= $Page->jam_buka->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->jam_buka->getErrorMessage(false) ?></div>
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
    ew.addEventHandlers("rumah_sakit");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
