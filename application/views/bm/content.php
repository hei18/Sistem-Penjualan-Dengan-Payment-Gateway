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

                    <a href="<?= base_url("bm/channel/uploadcontent"); ?>" class="btn btn-app d-none d-lg-block">
                        <i class="fa-solid fa-arrow-up-from-bracket fa-2x"></i>
                        <h5>Upload</h5>
                    </a>



                </div>
                <!-- /.info-box -->
            </div>


        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-info alert-dismissible fade show d-md-none" role="alert">
                <span class="alert-text">
                    You can upload your instrumental in website</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <?= $this->session->flashdata('message'); ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Better you read this <a class="btn btn-info" href="<?= base_url('bm/channel/rules'); ?>">RULES</a> before upload</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>

                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Full_version</th>
                                    <th>Demo_version</th>
                                    <th>Genre</th>
                                    <th>Status</th>

                                    <th>Info</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($displayBeat)) : ?>
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-info" role="alert">
                                                No Data
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php foreach ($displayBeat as $d) : ?>
                                    <tr class="bg-white">

                                        <td><img src="<?= base_url('files/thumbnail/') . $d['thumbnail']; ?>" alt="" style="max-width: 100px;"></td>
                                        <td><?= $d['title']; ?></td>
                                        <td><audio controls preload="auto" controlsList="nodownload noplaybackrate">
                                                <source src="<?= base_url('files/full/') . $d['full_version']; ?>" type="audio/mpeg">
                                            </audio>
                                        </td>
                                        <td><audio controls preload="auto" controlsList="nodownload noplaybackrate">
                                                <source src="<?= base_url('files/demo/') . $d['demo_version']; ?>" type="audio/mpeg">
                                            </audio>
                                        </td>
                                        <td>
                                            <?= $d['genre']; ?>

                                        </td>
                                        <td>
                                            <?php if ($d['status_product'] == 0) : ?>
                                                <span class="badge badge-warning">Review</span>
                                            <?php elseif ($d['status_product'] == 1) : ?>
                                                <span class="badge badge-success">Posted</span>
                                            <?php elseif ($d['status_product'] == 3) : ?>
                                                <span class="badge badge-danger">Canceled</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete <?= $d['title']; ?> ?')" href="<?= base_url('bm/channel/deletecontent/' . $d['id_product']); ?>"><i class="far fa-trash-alt"></i></a>
                                        </td>


                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
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