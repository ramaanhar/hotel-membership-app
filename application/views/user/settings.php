<div class="container-fluid">

    <a href="<?= base_url("user") ?>" style="text-decoration: none;">
        <div class="row justify-content-start">
            <div class="col-inline">
                <i class="fas fa-fw fa-arrow-left"></i>
            </div>
            <div class="col-inline ml-3">
                <span>BACK TO HOME</span>
            </div>
        </div>
    </a>
    <br />
    <h1 class="h3 mb-4 ml-3 text-gray-800"><?= $title; ?></h1>
    <div class="card col-lg-8">
        <div class="card-body">
            <div class="row justify-content-start no-gutters">
                <div class="col-inline">
                    <i class="fas fa-fw fa-key"></i>
                </div>
                <div class="col-inline">
                    <h3 class="h5 mb-4 ml-3 text-gray-800">Edit Username & Password</h3>
                </div>
            </div>
            <hr style="margin-top: 0px;" />
            <?= $this->session->flashdata('message'); ?>
            <?= form_open_multipart('user/settings'); ?>
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="username">Username</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= $user['username']; ?>">
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="password1">Old Password</label>
                </div>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="passwordnew1">New Password</label>
                </div>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-user" id="passwordnew1" name="passwordnew1">
                    <?= form_error('passwordnew1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="passwordnew2">Re-type New Password</label>
                </div>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-user" id="passwordnew2" name="passwordnew2">
                    <?= form_error('passwordnew2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-user btn-block col-lg-6 mx-auto" data-toggle="modal" data-target="#editProfileModal">
                Save changes
            </button>
            <!-- Modal untuk konfirmasi perubahan profil ketika mengklik tombol Finish Edit-->
            <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Are you sure to make changes on your profile?</div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Yes</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            </form>
        </div>
    </div>






</div>



<!-- /.container-fluid -->

</div>