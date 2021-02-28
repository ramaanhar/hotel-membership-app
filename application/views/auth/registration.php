<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

                <div class="col-lg">
                    <div class="p-5">
                        <a href="<?= base_url("auth") ?>" style="text-decoration: none;">
                            <div class="row justify-content-start">
                                <div class="col-inline">
                                    <i class="fas fa-fw fa-arrow-left"></i>
                                </div>
                                <div class="col-inline ml-3">
                                    <span>BACK TO LOGIN</span>
                                </div>
                            </div>
                        </a>
                        <div class="text-center">
                            <br />
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration') ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full name" value="<?= set_value('name') ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nik" name="nik" placeholder="Citizen ID card number (NIK in KTP)" value="<?= set_value('nik') ?>">
                                <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control form-control-user" id="address" name="address" placeholder="Home address"><?= set_value('address') ?></textarea>
                                <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="gender">Gender :</label>
                                </div>
                                <div class="col-sm-4 ml-4">
                                    <input type="radio" class="form-check-input" id="gender1" name="gender" value="Male" <?= set_radio('gender', 'Male') ?>>
                                    <label class="form-check-label" for="gender1"> Male </label>
                                </div>
                                <div class="col-sm-4 ml-4">
                                    <input type="radio" class="form-check-input" id="gender2" name="gender" value="Female" <?= set_radio('gender', 'Female') ?>>
                                    <label class="form-check-label" for="gender2"> Female </label>
                                </div>
                                <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="phone" name="phone" placeholder="Phone number" value="<?= set_value('phone') ?>">
                                <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email address" value="<?= set_value('email') ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username') ?>">
                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>


                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>