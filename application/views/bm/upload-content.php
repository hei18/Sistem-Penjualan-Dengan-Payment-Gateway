<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <h1><?= $tittle; ?></h1>
                </div>

                <div class="col d-flex justify-content-end">


                </div>
                <!-- /.info-box -->
            </div>


        </div>
    </section>
    <!-- /.container-fluid -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary">
                <?= $this->session->flashdata('message'); ?>
                <div class="card-header bg-warning">
                    <h3 class="card-title">Baca <a class="btn btn-info" href="<?= base_url('bm/channel/rules'); ?>">Aturan Ini</a> Sebelum Upload</h3>

                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="<?= base_url('bm/channel/uploadcontent'); ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Judul</label>
                                    <input autocomplete="off" id="title" name="title" type="text" class="form-control">
                                    <?= form_error('title', '<small class=" text-danger">', '</small>'); ?>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Versi Lengkap</label>
                                    <br>
                                    <small>File Harus mp3 atau wav (Ukuran Max 100MB)</small>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="full_version" name="full_version" type="file" class="custom-file-input" accept=".mp3, .wav">
                                            <label autocomplete="off" class="custom-file-label" for="exampleInputFile">mp3/wav</label>
                                        </div>
                                    </div>
                                    <small class=" text-danger" id="file-result1"> </small>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Versi Demo</label>
                                    <br>
                                    <small>File Harus mp3 atau wav (Ukuran Max 100MB)</small>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="demo_version" name="demo_version" type="file" class="custom-file-input" accept=".mp3, .wav">
                                            <label autocomplete="off" class="custom-file-label" for="exampleInputFile">mp3/wav</label>
                                        </div>
                                    </div>
                                    <small class=" text-danger" id="file-result2"> </small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Gambar</label>
                                    <br>
                                    <small>Gambar harus jpg\png\jpeg (Ukuran Max 2MB)</small>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="thumbnail" name="thumbnail" type="file" class="custom-file-input" accept=".jpeg, .jpg, .png">
                                            <label autocomplete="off" class="custom-file-label" for="exampleInputFile">jpeg/jpg/png</label>
                                        </div>
                                    </div>
                                    <small class=" text-danger" id="file-result3"> </small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="disabledSelect">Jenis Musik</label>
                                    <select id="genre" name="genre" class="form-control">
                                        <option value="">Pilih Jenis Musik</option>
                                        <option value="Classical">Classical</option>
                                        <option value="Dubstep">Dubstep</option>
                                        <option value="EDM">EDM</option>
                                        <option value="Heavy Metal">Heavy Metal</option>
                                        <option value="Hip Hop">Hip Hop</option>
                                        <option value="House">House</option>
                                        <option value="Old School">Old School</option>
                                        <option value="Pop">Pop</option>
                                        <option value="Rock">Rock</option>
                                        <option value="Trap">Trap</option>
                                    </select>

                                    <?= form_error('genre', '<small class=" text-danger">', '</small>'); ?>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi</label>
                                    <textarea class="form-control" name="description" id="description" rows="2" placeholder="Jelaskan tentang instrumen Anda seperti DAW apa yang Anda gunakan, berapa bpm, jelaskan suasananya, akor dimulai dari apa dan apa pun yang terkait dengan instrumen Anda"></textarea>
                                    <?= form_error('description', '<small class=" text-danger">', '</small>'); ?>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga</label>
                                    <input autocomplete="off" id="price" name="price" type="text" class="form-control money numberOnly">
                                    <?= form_error('price', '<small class=" text-danger">', '</small>'); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a type="button" href="<?= base_url('bm/channel/content'); ?>" class="btn btn-warning">Kembali</a>

                        <input name="submit" class="btn btn-info" type="submit" value="submit" disabled="true" />
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->