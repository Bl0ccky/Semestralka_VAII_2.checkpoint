<?php /** @var Array $data */
use App\Config\Configuration;?>

<div class="container">
    <?php if ($data['error'] != "") { ?>
        <div class="col-4 offset-4 align-middle alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?= $data['error'] ?>
        </div>
    <?php } ?>
</div>
<div class="container">

        <form id="edit_form" method="post" action="?c=auth&a=editProfile" enctype="multipart/form-data">
            <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= Configuration::PROFILE_IMAGE_DIR . \App\Models\User::getOne(\App\Auth::getId())->getImage() ?>" alt="Admin"
                                 class="rounded-circle" width="150">
                            <label for="formFile" class="form-label">Zmeniť profilovú fotku</label>
                            <input name="profile_image" class="form-control" type="file">
                            <div class="mt-3">
                                <h4><?= \App\Models\User::getOne(\App\Auth::getId())->getFullName() ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 align-items-center">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Meno</h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="name" name="name" type="text" class="form-control" value="<?= \App\Models\User::getOne(\App\Auth::getId())->getName() ?>" required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <small class="visually-hidden oNasText">Error message</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Priezvisko</h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="lastName" name="last_name" type="text" class="form-control" value="<?= \App\Models\User::getOne(\App\Auth::getId())->getLastName() ?>" required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <small class="visually-hidden oNasText">Error message</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Login</h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="login" name="login" type="text" class="form-control" value="<?= \App\Models\User::getOne(\App\Auth::getId())->getLogin() ?>" required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <small class="visually-hidden oNasText">Error message</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Heslo</h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="password" name="password" type="password" class="form-control" value="<?= \App\Models\User::getOne(\App\Auth::getId())->getPassword() ?>" required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <small class="visually-hidden oNasText">Error message</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="email" name="email" type="email" class="form-control" value="<?= \App\Models\User::getOne(\App\Auth::getId())->getEmail() ?>" required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <small class="visually-hidden oNasText">Error message</small>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Dátum narodenia</h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="date" name="date" type="date" class="form-control" value="<?= \App\Models\User::getOne(\App\Auth::getId())->getDate() ?>" required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <small class="visually-hidden oNasText">Error message</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <button type="submit" class="btn btn-warning px-4">Uložiť zmeny</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="public/form_validation.js"></script>
