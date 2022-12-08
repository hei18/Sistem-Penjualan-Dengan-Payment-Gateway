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
                    <h3 class="card-title">Better you read this <a class="btn btn-info" href="<?= base_url('bm/channel/rules'); ?>">RULES</a> before upload</h3>

                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="<?= base_url('bm/channel/uploadcontent'); ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input id="title" name="title" type="text" class="form-control">
                                    <?= form_error('title', '<small class=" text-danger">', '</small>'); ?>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Full Version</label>
                                    <br>
                                    <small>The file upload is must be mp3 or wav</small>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="full_version" name="full_version" type="file" class="custom-file-input" accept=".mp3, .wav">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Demo Version</label>
                                    <br>
                                    <small>The file upload is must be mp3 or wav</small>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="demo_version" name="demo_version" type="file" class="custom-file-input" accept=".mp3, .wav">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thumbnail</label>
                                    <br>
                                    <small>The Thumbnail is must be jpg\png\jpeg</small>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="thumbnail" name="thumbnail" type="file" class="custom-file-input" accept=".jpeg, .jpg, .png">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="disabledSelect">Genre</label>
                                    <select id="genre" name="genre" class="form-control">
                                        <option value="">Select Your Genre</option>
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
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                                    <?= form_error('description', '<small class=" text-danger">', '</small>'); ?>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input id="price" name="price" type="text" class="form-control money numberOnly">
                                    <?= form_error('price', '<small class=" text-danger">', '</small>'); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a type="button" href="<?= base_url('bm/channel/content'); ?>" class="btn btn-warning">Back</a>

                        <button type="submit" class="btn btn-primary">Submit</button>
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