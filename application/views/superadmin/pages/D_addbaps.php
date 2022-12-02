<?php
date_default_timezone_set('Asia/Jakarta');
foreach($institution as $i) {
    $int = $i;
}

foreach(@$bpas as $b) {
    @$bp = $b;
}

foreach(@$sk_number as $s) {
    @$sk = $s;
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
                    <form action="<?= base_url('D_superadmin/save_baps') ?>" method="POST" id="form_baps">
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

                        <h6 class="text-primary">Customer Section</h6>
                        <hr>

                        <div class="form-group">
                            <label for="int_person_baps">Nama Pihak Perusahaan</label>
                            <input type="text" name="int_person_baps" id="int_person_baps" class="form-control" placeholder="Nama Pihak Perusahaan" value="<?= @$sk->int_person_baps ?>">
                        </div>

                        <?php if($sk->int_signature_baps == NULL) { ?>

                        <div class="boxarea">
                            <h6>Tanda Tangan Disini!</h6>
                            <div class="signature-pad" id="signature-pad">
                                <div class="m-signature-pad">
                                    <div class="m-signature-pad-body">
                                        <canvas></canvas>
                                    </div>
                                    <div class="m-signature-pad-footer">
                                        <button type="button" data-action="clear" class="btn btn-danger"><i class="fa fa-trash-o"></i> Bersihkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php } else { ?>
                        <div class="form-group">
                            <label for="">Company Side Signature</label><br>
                            <img src="<?= base_url() . $sk->int_signature_baps ?>" alt="" class="img-thumbnail">
                            <a href="<?= base_url('D_superadmin/delete_signature_baps/') . $sk->id_sk ?>" class="text-danger mb-2 tombol-hapus"><u>Delete Signature</u></a>
                        </div>
                        <?php } ?>
                        
                        <button data-action="save" class="btn btn-primary" id="save2">Save Changes</button>

                    </div>
                </form>
            </div>
            </div>
        </div>
      
    </div>
  </section>
</div>


<script>

    var wrapper = document.getElementById("signature-pad"),
    clearButton = wrapper.querySelector("[data-action=clear]"),
    saveButton = document.querySelector("[data-action=save]"),
    canvas = wrapper.querySelector("canvas"),
    signaturePad;


    function resizeCanvas() {

      var ratio =  window.devicePixelRatio || 1;
      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = canvas.offsetHeight * ratio;
      canvas.getContext("2d").scale(ratio, ratio);
    }

    signaturePad = new SignaturePad(canvas);

    clearButton.addEventListener("click", function (event) {
      signaturePad.clear();
    });

    saveButton.addEventListener("click", function (event) {
      
    if (signaturePad.isEmpty()) {
        $('#myModal').modal('show');
    }

      else {
       
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>D_superadmin/save_signature_baps",
          data: {
            'int_signature_baps': signaturePad.toDataURL(),
            'id_sk': <?= $int->id_sk ?>
          }
        });

      }
    }); 
</script>
<style type="text/css">
    canvas {
        border: 1px dashed #ccc;
        border-radius: 5px;
        color: #bbbabb;
    }

    .m-signature-pad-footer
    {
        margin-bottom: 100px;
        margin-top: 10px;
    }
</style>