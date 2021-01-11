<?php
$this->load->database();
$last = $this->db->order_by('position', "desc")->limit(1)->get('promo')->row();
// print_r($last);
//berhasil
?>
<!-- Modal -->
<div class="modal fade" id="promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-inline">
                <h2 class="modal-title d-inline text-center font-weight-bold" id="exampleModalLongTitle">PROMO</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a target='_blank' href="https://api.whatsapp.com/send?phone=62<?= Globals::idContact()->wa ?>" class="text-white h2 mb-0"><img src="<?php echo base_url('asset/foto_promo/'.$last->gambar); ?>"></a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a target='_blank' href="https://api.whatsapp.com/send?phone=62<?= Globals::idContact()->wa ?>" type="button" class="btn btn-primary">ORDER</a>
            </div>
        </div>
    </div>
</div>