    <? if ($this->session->flashdata('error')) : ?>
    <div class="attention error">
        <?=$this->session->flashdata('error');?>
    </div>
    <? endif; ?>