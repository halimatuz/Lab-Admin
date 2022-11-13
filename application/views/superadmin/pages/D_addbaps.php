<?php
date_default_timezone_set('Asia/Jakarta');
foreach($institution as $i) {
    $int = $i;
}

foreach(@$bpas as $b) {
    @$bp = $b;
}

?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data BAPS</h1>
    </div>

    <div class="section-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Add BAPS</h4>
                <a href="<?= base_url('D_superadmin/print_baps/') . $int->id_sk ?>" class="btn btn-primary ml-auto"><i class="fas fa-print"></i> Print</a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('D_superadmin/save_baps') ?>" method="POST">
                    <input type="hidden" name="id_sk" value="<?= $int->id_sk ?>">
                    <p>
                        Telah dilakukan pengambilan sampel udara oleh pihak PT Delta Indonesia Laboratory pada<br>
                        Perusahaan : <span class="font-weight-bold"><?= $int->name_int ?></span><br>
                        Alamat : <span class="font-weight-bold"><?= $int->int_address ?></span><br>
                        Telp : <span class="font-weight-bold"><?= $int->int_phone ?></span><br>
                        Pada hari : <?= date("l", strtotime($int->date_sample)) ?> tanggal <?= date("d F Y", strtotime($int->date_sample)) ?> pukul <?= date("H:i", strtotime($int->date_sample)) ?> dengan masing-masing:<br>
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Udara Ambien</td>
                                    <td>:</td>
                                    <td width="60px"><input type="number" name="air_ambient" class="form-control" value="<?= @$bp->air_ambient ?>"></td>
                                    <td>titik</td>
                                </tr>
                                <tr>
                                    <td>Emisi Cerobong&emsp;</td>
                                    <td>:&emsp;</td>
                                    <td width="60px"><input type="number" name="chimney_emission" class="form-control" value="<?= @$bp->chimney_emission ?>"></td>
                                    <td>titik</td>
                                </tr>
                                <tr>
                                    <td>Pencahayaan</td>
                                    <td>:</td>
                                    <td width="60px"><input type="number" name="lightning" class="form-control" value="<?= @$bp->lightning ?>"></td>
                                    <td>titik</td>
                                </tr>
                                <tr>
                                    <td>Heat Stress</td>
                                    <td>:</td>
                                    <td width="60px"><input type="number" name="heat_stress" class="form-control" value="<?= @$bp->heat_stress ?>"></td>
                                    <td>titik</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Udara Ruang Kerja</td>
                                    <td>:</td>
                                    <td width="60px"><input type="number" name="workspace_air" class="form-control" value="<?= @$bp->workspace_air ?>"></td>
                                    <td>titik</td>
                                </tr>
                                <tr>
                                    <td>Kebauan&emsp;</td>
                                    <td>:&emsp;</td>
                                    <td width="60px"><input type="number" name="smell" class="form-control" value="<?= @$bp->smell ?>"></td>
                                    <td>titik</td>
                                </tr>
                                <tr>
                                    <td>Kebisingan</td>
                                    <td>:</td>
                                    <td width="60px"><input type="number" name="noise" class="form-control" value="<?= @$bp->noise ?>"></td>
                                    <td>titik</td>
                                </tr>
                                <tr>
                                    <td>Air Limbah</td>
                                    <td>:</td>
                                    <td width="60px"><input type="number" name="wastewater" class="form-control" value="<?= @$bp->wastewater ?>"></td>
                                    <td>titik</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-bordered-dark table-no-padding">
                            <tr class="text-center">
                                <td>No.</td>
                                <td>Lokasi</td>
                                <td>Parameters</td>
                                <td>Regulasi</td>
                                <td>Jenis Sampel</td>
                                <td>Waktu Pengukuran (Jam)</td>
                            </tr>
                            <?php $no = 1; foreach(@$sampling_det as $row) : ?>
                                <tr>
                                    <input type="hidden" name="id_sampling[]" value="<?= $row->id_sampling ?>">
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->location ?></td>
                                    <td><?= $row->sample_desc ?></td>
                                    <td>
                                        <select name="id_regulation[]" id="" class="form-control">
                                            <?php if($row->id_regulation == NULL || $row->id_regulation == 0 ) { ?>
                                                <option value="">-- Select Regulation --</option>
                                            <?php } ?>
                                            <?php foreach($regulation as $reg) : ?>
                                                <option value="<?= $reg->id_regulation ?>" <?php if($reg->id_regulation == $row->id_regulation){echo"selected";} ?>><?= $reg->name_regulation ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><?= $row->alias_analysis ?></td>
                                    <td>
                                        <input type="text" name="measurement_time[]" class="form-control" value="<?= $row->measurement_time ?>">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                    <div class="form-group">
                        <label for="id_sampler">Sampler</label>
                        <select name="id_sampler" id="id_sampler" class="form-control">
                            <option value="">-- Select Sampler --</option>
                            <?php foreach($sampler as $row) : ?>
                            <option value="<?= $row->id_sampler ?>" <?php echo $row->id_sampler == @$bp->id_sampler ? 'selected' : '' ?>><?= $row->name_smp ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>

                </div>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>



<form class="modal-part" id="modal-login-part" method="POST" action="<?= base_url('D_superadmin/add_test_request_detail_action') ?>">
    <p>Insert test details below.</p>
    <div class="form-group">
        <label>Parameter Description Test Example</label>
        <input type="hidden" name="id_sk" value="<?= $int->id_sk ?>">
        <select name="params[]" id="" class="form-control selectric" multiple="">
            <option value="">-- Select Parameters --</option>
            <?php foreach($sample as $row) : ?>
                <option value="<?= $row->name_sample ?>"><?= $row->name_sample ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Regulation</label>
        <select name="regulation" id="" class="form-control">
            <option value="">-- Select Regulation --</option>
            <?php foreach($regulation as $row) : ?>
                <option value="<?= $row->id_regulation ?>"><?= $row->name_regulation ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Total Example</label>
        <div class="input-group">
            <input type="number" name="total_example" class="form-control">
        </div>
    </div>
</form>