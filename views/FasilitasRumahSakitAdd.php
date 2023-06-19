<?php

namespace PHPMaker2021\Kitasehat;

// Page object
$FasilitasRumahSakitAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var ffasilitas_rumah_sakitadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    ffasilitas_rumah_sakitadd = currentForm = new ew.Form("ffasilitas_rumah_sakitadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "fasilitas_rumah_sakit")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.fasilitas_rumah_sakit)
        ew.vars.tables.fasilitas_rumah_sakit = currentTable;
    ffasilitas_rumah_sakitadd.addFields([
        ["fasilitas_id", [fields.fasilitas_id.visible && fields.fasilitas_id.required ? ew.Validators.required(fields.fasilitas_id.caption) : null], fields.fasilitas_id.isInvalid],
        ["hari_buka", [fields.hari_buka.visible && fields.hari_buka.required ? ew.Validators.required(fields.hari_buka.caption) : null], fields.hari_buka.isInvalid],
        ["jam_buka", [fields.jam_buka.visible && fields.jam_buka.required ? ew.Validators.required(fields.jam_buka.caption) : null], fields.jam_buka.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ffasilitas_rumah_sakitadd,
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
    ffasilitas_rumah_sakitadd.validate = function () {
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
    ffasilitas_rumah_sakitadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffasilitas_rumah_sakitadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    ffasilitas_rumah_sakitadd.lists.fasilitas_id = <?= $Page->fasilitas_id->toClientList($Page) ?>;
    loadjs.done("ffasilitas_rumah_sakitadd");
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
<form name="ffasilitas_rumah_sakitadd" id="ffasilitas_rumah_sakitadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="fasilitas_rumah_sakit">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "rumah_sakit") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="rumah_sakit">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->rumah_sakit_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
    <div id="r_fasilitas_id" class="form-group row">
        <label id="elh_fasilitas_rumah_sakit_fasilitas_id" for="x_fasilitas_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fasilitas_id->caption() ?><?= $Page->fasilitas_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fasilitas_id->cellAttributes() ?>>
<span id="el_fasilitas_rumah_sakit_fasilitas_id">
<div class="input-group ew-lookup-list" aria-describedby="x_fasilitas_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_fasilitas_id"><?= EmptyValue(strval($Page->fasilitas_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->fasilitas_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->fasilitas_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->fasilitas_id->ReadOnly || $Page->fasilitas_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_fasilitas_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <?php if (AllowAdd(CurrentProjectID() . "fasilitas") && !$Page->fasilitas_id->ReadOnly) { ?>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_fasilitas_id" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->fasilitas_id->caption() ?>" data-title="<?= $Page->fasilitas_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_fasilitas_id',url:'<?= GetUrl("fasilitasaddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
        <?php } ?>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->fasilitas_id->getErrorMessage() ?></div>
<?= $Page->fasilitas_id->getCustomMessage() ?>
<?= $Page->fasilitas_id->Lookup->getParamTag($Page, "p_x_fasilitas_id") ?>
<input type="hidden" is="selection-list" data-table="fasilitas_rumah_sakit" data-field="x_fasilitas_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->fasilitas_id->displayValueSeparatorAttribute() ?>" name="x_fasilitas_id" id="x_fasilitas_id" value="<?= $Page->fasilitas_id->CurrentValue ?>"<?= $Page->fasilitas_id->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
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
    <?php if (strval($Page->rumah_sakit_id->getSessionValue()) != "") { ?>
    <input type="hidden" name="x_rumah_sakit_id" id="x_rumah_sakit_id" value="<?= HtmlEncode(strval($Page->rumah_sakit_id->getSessionValue())) ?>">
    <?php } ?>
<?php
    if (in_array("praktik_poli", explode(",", $Page->getCurrentDetailTable())) && $praktik_poli->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("praktik_poli", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PraktikPoliGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("fasilitas_rumah_sakit");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
