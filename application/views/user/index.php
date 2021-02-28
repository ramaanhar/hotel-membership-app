<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row ml-2" style="max-width: 540px;">
        <?= $this->session->flashdata('message'); ?>

    </div>
    <h1 class="h3 mb-4 text-gray-800">Welcome User <?= $user['name']; ?></h1>
    <!-- Card -->
    <div class="card mb-3" style="max-width: 540px;" data-toggle="modal" data-target="#MemberModal">
        <div class="row no-gutters">

            <!-- syntax card -->
            <div class="card text-white">

                <img src="<?= base_url('assets/img/card/'); ?>card-<?= $card['levelname']; ?>.png" class="rounded card-img">

                <div class="card-img-overlay d-flex flex-column align-content-end flex-wrap">
                    <div class="mt-auto align-self-left mx-3">
                        <?php
                        $splitted = chunk_split($user['iduser'], 4, ' ');
                        $kapital = strtoupper($user['name']);
                        ?>
                        <h3 class=teks-kartu><?= $splitted; ?></h3>
                        <p class=teks-kartu><?= $kapital; ?></p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <img src="<?= base_url('assets/img/barcode/') . $member['barcode']; ?>">
                        <img src="<?= base_url('assets/img/qr/') . $member['qrcode']; ?>" width=15% height=auto class="float-right mx-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-2" style="max-width: 540px;">
            <span class="text-gray large"> Tap to member detail</span>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Syntax modal -->
<div class="modal fade" id="MemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Member detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-4 mx-auto">
                            <img class="img-fluid rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mx-auto">
                            Full name : <?= $user['name'] ?> <br />
                            Member code : <?= $user['iduser'] ?> <br />
                            Member since: <?= date('j F Y', strtotime($user['datecreated'])) ?> <br />
                            Valid until : <?= date('j F Y', strtotime($user['datecreated'] . "+ 1 year")) ?> <br />
                        </div>
                    </div>
                    <div class="row row-no-gutters justify-content-md-center align-items-end">
                        <div class="col-md-6 align-items-end">
                            <img src="<?= base_url('assets/img/barcode/') . $member['barcode']; ?>" class="img-fluid">
                        </div>
                        <div class="col-md-3 col-sm-5 col-5 mx-auto">
                            <img src="<?= base_url('assets/img/qr/') . $member['qrcode']; ?>" class="img-fluid">
                        </div>
                    </div>
                    <br />
                    <div class="row justify-content-center">
                        <a href="<?= base_url('assets/img/qr/') . $member['qrcode']; ?>">
                            <button type="button" class="btn btn-primary">View QR Code larger</button>
                        </a>
                    </div>
                    <br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>


<!-- End of Main Content -->