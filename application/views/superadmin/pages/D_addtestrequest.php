<?php
foreach($institution as $i) {
    $int = $i;
}

foreach(@$test_req as $test) {
    @$test_r = $test;
}

foreach(@$sk_number as $s) {
    @$sk = $s;
}

?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Test Request</h1>
    </div>

    <div class="section-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Add Test Request</h4>
                <a href="<?= base_url('D_superadmin/print_test_request/') . $int->id_sk ?>" class="btn btn-primary ml-auto"><i class="fas fa-print"></i> Print</a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('D_superadmin/save_test_request') ?>" method="POST">
                <div class="row">
                    <p class="font-weight-bold">I. PERMINTAAN PENGUJIAN</p>
                    <input type="hidden" name="id_sk" value="<?= $int->id_sk ?>">
                    <table class="table table-bordered table-bordered-dark table-no-padding">
                        <tr>
                            <th colspan="4">KODE CONTOH UJI</th>
                        </tr>
                        <tr>
                            <td colspan="4">DIISI OLEH PELANGGAN (DENGAN HURUF KAPITAL)</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold" width="10">1)</td>
                            <td class="font-weight-bold">Nama Pelanggan</td>
                            <td class="font-weight-bold" width="10">:</td>
                            <td><?= $int->name_int ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold" width="10">2)</td>
                            <td class="font-weight-bold">Alamat Pelanggan</td>
                            <td class="font-weight-bold" width="10">:</td>
                            <td><?= $int->int_address ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold" width="10"></td>
                            <td class="font-weight-bold">No. Telp/HP.</td>
                            <td class="font-weight-bold" width="10">:</td>
                            <td><?= $int->int_phone ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold" width="10">3)</td>
                            <td class="font-weight-bold">Nama/Jenis Contoh</td>
                            <td class="font-weight-bold" width="10">:</td>
                            <td>
                                <?php if(@$test_r->sample_type == '') {?>
                                <select name="sample_type[]" id="" class="form-control selectric" multiple>
                                    <option value="">-- Select Sample --</option>
                                    <?php foreach($sample as $row) : ?>
                                        <option value="<?= $row->name_sample ?>"><?= $row->name_sample ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php } else { ?>
                                    <input type="hidden" name="sample_type" value="<?= @$test_r->sample_type ?>">
                                    <?= @$test_r->sample_type ?>&emsp;
                                    <a href="<?php echo base_url('D_superadmin/delete_sample_type_request/') . @$test_r->id_sk ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold" width="10">4)</td>
                            <td class="font-weight-bold">Tanggal Masuk Contoh Uji</td>
                            <td class="font-weight-bold" width="10">:</td>
                            <td>
                                <input type="date" name="entry_date" class="form-control" value="<?= @$test_r->entry_date ?>">
                                <span class="text-small text-danger">*Required</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold" width="10">5)</td>
                            <td class="font-weight-bold">Kegiatan/Paket Pekerjaan</td>
                            <td class="font-weight-bold" width="10">:</td>
                            <td>
                                <input type="text" name="work_package" placeholder="Insert activity / work package" class="form-control" value="<?= @$test_r->work_package ?>">
                                <span class="text-small text-danger">*Required</span>
                            </td>
                        </tr>
                    </table>

                    <div class="table-responsive">
                        <table class="table table-bordered table-bordered-dark table-no-padding">
                            <tr>
                                <th width="10">6)</th>
                                <th colspan="4">Rincian Pengujian</th>
                            </tr>
                            <tr class="text-center">
                                <td>No.</td>
                                <td>Uraian Parameter Contoh Uji</td>
                                <td>Regulasi</td>
                                <td>Jumlah Contoh</td>
                                <td>Action</td>
                            </tr>
                            <?php $no = 1; foreach(@$test_req_details as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->params ?></td>
                                    <td><?= $row->name_regulation ?></td>
                                    <td><?= $row->total_example ?></td>
                                    <td>
                                        <a href="<?php echo base_url('D_superadmin/delete_test_request_detail/') . $row->id_request_det . '/' . $row->id_sk ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                    <button class="btn btn-success" id="modal-5"><i class="fas fa-plus"></i> Add New</button>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-bordered-dark table-no-padding">
                            <tr>
                                <th width="10">No.</th>
                                <th>Uraian</th>
                                <th>Kondisi Contoh</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td>1)</td>
                                <td>Jumlah</td>
                                <td>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                        <input type="radio" name="amount" value="1" class="selectgroup-input" <?php if(@$test_r->amount == 1){echo"checked";} ?>>
                                        <span class="selectgroup-button">Cukup</span>
                                        </label>
                                        <label class="selectgroup-item">
                                        <input type="radio" name="amount" value="0" class="selectgroup-input" <?php if(@$test_r->amount == 0 && @$test_r->amount != NULL){echo"checked";} ?>>
                                        <span class="selectgroup-button">Tidak</span>
                                        </label>
                                    </div>
                                    <span class="text-small text-danger">*Required</span>
                                </td>
                                <td>
                                    <input type="text" name="amount_desc" class="form-control" placeholder="Insert description" value="<?= @$test_r->amount_desc ?>">
                                    <span class="text-small text-primary">*Optional</span>
                                </td>
                            </tr>
                            <tr>
                                <td>2)</td>
                                <td>Kondisi</td>
                                <td>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                        <input type="radio" name="condition" value="1" class="selectgroup-input" <?php if(@$test_r->condition == 1){echo"checked";} ?>>
                                        <span class="selectgroup-button">Baik</span>
                                        </label>
                                        <label class="selectgroup-item">
                                        <input type="radio" name="condition" value="0" class="selectgroup-input" <?php if(@$test_r->condition == 0 && @$test_r->condition != NULL){echo"checked";} ?>>
                                        <span class="selectgroup-button">Tidak</span>
                                        </label>
                                    </div>
                                    <span class="text-small text-danger">*Required</span>
                                </td>
                                <td>
                                    <input type="text" name="condition_desc" class="form-control" placeholder="Insert description" value="<?= @$test_r->condition_desc ?>">
                                    <span class="text-small text-primary">*Optional</span>
                                </td>
                            </tr>
                            <tr>
                                <td>3)</td>
                                <td>Tempat contoh uji / wadah</td>
                                <td>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                        <input type="radio" name="receptacle" value="1" class="selectgroup-input" <?php if(@$test_r->receptacle == 1){echo"checked";} ?>>
                                        <span class="selectgroup-button">Baik</span>
                                        </label>
                                        <label class="selectgroup-item">
                                        <input type="radio" name="receptacle" value="0" class="selectgroup-input" <?php if(@$test_r->receptacle == 0 && @$test_r->receptacle != NULL){echo"checked";} ?>>
                                        <span class="selectgroup-button">Tidak</span>
                                        </label>
                                    </div>
                                    <span class="text-small text-danger">*Required</span>
                                </td>
                                <td>
                                    <input type="text" name="receptacle_desc" class="form-control" placeholder="Insert description" value="<?= @$test_r->receptacle_desc ?>">
                                    <span class="text-small text-primary">*Optional</span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-bordered-dark table-no-padding">
                            <tr>
                                <td>4)</td>
                                <td>
                                    Catatan:
                                    <input type="text" name="note_sample" class="form-control" value="<?= @$test_r->note_sample ?>">
                                    <span class="text-small text-primary">*Optional</span>
                                </td>
                                <td>
                                    Penerima Contoh:
                                    <input type="text" name="sample_receiver" class="form-control" value="<?= @$test_r->sample_receiver ?>">
                                    <span class="text-small text-primary">*Optional</span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <p class="font-weight-bold">III. KAJI ULANG PERMINTAAN PENGUJIAN</p>

                    <div class="table-responsive">
                        <table class="table table-bordered table-bordered-dark table-no-padding">
                            <tr>
                                <td width="10">1)</td>
                                <td>Kemampuan SDM</td>
                                <td width="10">:</td>
                                <td>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                        <input type="radio" name="hr_capabilities" value="1" class="selectgroup-input" <?php if(@$test_r->hr_capabilities == 1){echo"checked";} ?>>
                                        <span class="selectgroup-button">Ya</span>
                                        </label>
                                        <label class="selectgroup-item">
                                        <input type="radio" name="hr_capabilities" value="0" class="selectgroup-input" <?php if(@$test_r->hr_capabilities == 0 && @$test_r->hr_capabilities != NULL ){echo"checked";} ?>>
                                        <span class="selectgroup-button">Tidak</span>
                                        </label>
                                    </div>
                                    <span class="text-small text-danger">*Required</span>
                                </td>
                            </tr>
                            <tr>
                                <td width="10">2)</td>
                                <td>Kesesuaian Metode</td>
                                <td width="10">:</td>
                                <td>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                        <input type="radio" name="method_suitability" value="1" class="selectgroup-input" <?php if(@$test_r->method_suitability == 1){echo"checked";} ?>>
                                        <span class="selectgroup-button">Ya</span>
                                        </label>
                                        <label class="selectgroup-item">
                                        <input type="radio" name="method_suitability" value="0" class="selectgroup-input" <?php if(@$test_r->method_suitability == 0 && @$test_r->method_suitability != NULL ){echo"checked";} ?>>
                                        <span class="selectgroup-button">Tidak</span>
                                        </label>
                                    </div>
                                    <span class="text-small text-danger">*Required</span>
                                </td>
                            </tr>
                            <tr>
                                <td width="10">3)</td>
                                <td>Kemampuan Peralatan</td>
                                <td width="10">:</td>
                                <td>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                        <input type="radio" name="equipment_capability" value="1" class="selectgroup-input" <?php if(@$test_r->equipment_capability == 1){echo"checked";} ?>>
                                        <span class="selectgroup-button">Ya</span>
                                        </label>
                                        <label class="selectgroup-item">
                                        <input type="radio" name="equipment_capability" value="0" class="selectgroup-input" <?php if(@$test_r->equipment_capability == 0 && @$test_r->equipment_capability != NULL ){echo"checked";} ?>>
                                        <span class="selectgroup-button">Tidak</span>
                                        </label>
                                    </div>
                                    <span class="text-small text-danger">*Required</span>
                                </td>
                            </tr>
                            <tr>
                                <td width="10">4)</td>
                                <td>Kesimpulan</td>
                                <td width="10">:</td>
                                <td>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                        <input type="radio" name="conclusion" value="1" class="selectgroup-input" <?php if(@$test_r->conclusion == 1){echo"checked";} ?>>
                                        <span class="selectgroup-button">Bisa</span>
                                        </label>
                                        <label class="selectgroup-item">
                                        <input type="radio" name="conclusion" value="0" class="selectgroup-input" <?php if(@$test_r->conclusion == 0 && @$test_r->conclusion != NULL ){echo"checked";} ?>>
                                        <span class="selectgroup-button">Tidak Bisa Dilaksanakan</span>
                                        </label>
                                    </div>
                                    <span class="text-small text-danger">*Required</span>
                                </td>
                            </tr>
                            <tr>
                                <td width="10"></td>
                                <td>Waktu pelaksanaan pengujian maksimum</td>
                                <td width="10">:</td>
                                <td>
                                    <div class="row">
                                    <input type="number" name="max_time" class="form-control inline-block" style="width: 80px;" value="<?= @$test_r->max_time ?>"> <p class="inline-block mt-2 ml-2">hari kerja *)</p>
                                    </div>
                                    <span class="text-small text-danger">*Required</span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-bordered-dark table-no-padding">
                            <tr>
                                <td>5)</td>
                                <td>
                                    Catatan:
                                    <input type="text" name="note_request" class="form-control" value="<?= @$test_r->note_request ?>">
                                    <span class="text-small text-primary">*Optional</span>
                                </td>
                                <td>
                                    Penanggung Jawab Teknis:
                                    <input type="text" name="technical_respon" class="form-control" value="<?= @$test_r->technical_respon ?>">
                                    <span class="text-small text-primary">*Optional</span>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
                <br>

                <h6 class="text-primary">Customer Section</h6>
                <hr>

                <div class="form-group">
                    <label for="int_person_testreq">Nama Pihak Perusahaan</label>
                    <input type="text" name="int_person_testreq" id="int_person_testreq" class="form-control" placeholder="Nama Pihak Perusahaan" value="<?= @$sk->int_person_testreq ?>">
                </div>

                <?php if($sk->int_signature_testreq == NULL) { ?>

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
                    <img src="<?= base_url() . $sk->int_signature_testreq ?>" alt="" class="img-thumbnail">
                    <a href="<?= base_url('D_superadmin/delete_signature_testreq/') . $sk->id_sk ?>" class="text-danger mb-2 tombol-hapus"><u>Delete Signature</u></a>
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
          url: "<?php echo base_url();?>D_superadmin/save_signature_testreq",
          data: {
            'int_signature_testreq': signaturePad.toDataURL(),
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