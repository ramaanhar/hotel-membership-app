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
    <div class="row">
        <div class="col-lg-8 ml-3">

            <?= form_open_multipart('user/editprofile'); ?>
            <div class="form-group row">
                <div class="col-sm-4 mx-auto" data-toggle="modal" data-target="#ChangePPModal">
                    <img class="img-fluid rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="profilepicture">
                </div>
            </div>
            <div class="form-group row">
                <span class="text-grey mx-auto"> Tap picture above to change picture profile</span>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="name">Full name</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-user" id="name" name="name" value="<?= $user['name']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="nik">Citizen ID card number</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-user" id="nik" name="nik" value="<?= $user['nik_ktp']; ?>" readonly>

                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="address">Address</label>
                </div>
                <div class="col-sm-9">
                    <textarea class="form-control form-control-user" id="address" name="address"><?= $user['address']; ?></textarea>
                    <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="gender">Gender</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-user" id="gender" name="gender" value="<?= $user['gender']; ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="phone">Phone number</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-user" id="phone" name="phone" value="<?= $user['phone']; ?>">
                    <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="email">Email</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                </div>
                <!-- <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?> -->
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block col-lg-6 mx-auto">
                Finish Edit
            </button>
            <!-- Syntax modal -->
            <div class="modal fade" id="ChangePPModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Upload new profile picture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <img class="img-fluid rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                                    </div>
                                    <div class="col-md-8 col-sm-8 mt-auto mb-auto">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label for="image" class="custom-file-label text-left">Choose image file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            </form>
        </div>
    </div>
</div>



<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->