<?php

namespace PHPMaker2021\Kitasehat;

// Table
$dokter = Container("dokter");
?>
<?php if ($dokter->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_doktermaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($dokter->nama_dokter->Visible) { // nama_dokter ?>
        <tr id="r_nama_dokter">
            <td class="<?= $dokter->TableLeftColumnClass ?>"><?= $dokter->nama_dokter->caption() ?></td>
            <td <?= $dokter->nama_dokter->cellAttributes() ?>>
<span id="el_dokter_nama_dokter">
<span<?= $dokter->nama_dokter->viewAttributes() ?>>
<?= $dokter->nama_dokter->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($dokter->webusers_id->Visible) { // webusers_id ?>
        <tr id="r_webusers_id">
            <td class="<?= $dokter->TableLeftColumnClass ?>"><?= $dokter->webusers_id->caption() ?></td>
            <td <?= $dokter->webusers_id->cellAttributes() ?>>
<span id="el_dokter_webusers_id">
<span<?= $dokter->webusers_id->viewAttributes() ?>>
<?= $dokter->webusers_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
