<?php

namespace PHPMaker2021\Kitasehat;

// Table
$fasilitas_rumah_sakit = Container("fasilitas_rumah_sakit");
?>
<?php if ($fasilitas_rumah_sakit->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_fasilitas_rumah_sakitmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($fasilitas_rumah_sakit->fasilitas_id->Visible) { // fasilitas_id ?>
        <tr id="r_fasilitas_id">
            <td class="<?= $fasilitas_rumah_sakit->TableLeftColumnClass ?>"><?= $fasilitas_rumah_sakit->fasilitas_id->caption() ?></td>
            <td <?= $fasilitas_rumah_sakit->fasilitas_id->cellAttributes() ?>>
<span id="el_fasilitas_rumah_sakit_fasilitas_id">
<span<?= $fasilitas_rumah_sakit->fasilitas_id->viewAttributes() ?>>
<?= $fasilitas_rumah_sakit->fasilitas_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($fasilitas_rumah_sakit->hari_buka->Visible) { // hari_buka ?>
        <tr id="r_hari_buka">
            <td class="<?= $fasilitas_rumah_sakit->TableLeftColumnClass ?>"><?= $fasilitas_rumah_sakit->hari_buka->caption() ?></td>
            <td <?= $fasilitas_rumah_sakit->hari_buka->cellAttributes() ?>>
<span id="el_fasilitas_rumah_sakit_hari_buka">
<span<?= $fasilitas_rumah_sakit->hari_buka->viewAttributes() ?>>
<?= $fasilitas_rumah_sakit->hari_buka->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($fasilitas_rumah_sakit->jam_buka->Visible) { // jam_buka ?>
        <tr id="r_jam_buka">
            <td class="<?= $fasilitas_rumah_sakit->TableLeftColumnClass ?>"><?= $fasilitas_rumah_sakit->jam_buka->caption() ?></td>
            <td <?= $fasilitas_rumah_sakit->jam_buka->cellAttributes() ?>>
<span id="el_fasilitas_rumah_sakit_jam_buka">
<span<?= $fasilitas_rumah_sakit->jam_buka->viewAttributes() ?>>
<?= $fasilitas_rumah_sakit->jam_buka->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
