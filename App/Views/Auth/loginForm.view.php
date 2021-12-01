<?php /** @var Array $data */ ?>
<title>Login</title>
<div class="container">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <?php if ($data['error'] != "") { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= $data['error'] ?>
                </div>
            <?php } else if($data['message'] != "") { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <h5><?= $data['message'] ?></h5>
                    <p><?= $data['message2'] ?></p>
                </div>
            <?php } ?>
            <form method="post" action="?c=auth&a=login">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label oNasText">Email</label>
                    <input type="email" class="form-control" name="login" id="exampleFormControlInput1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label oNasText">Heslo</label>
                    <input type="password" class="form-control" name="password" id="exampleFormControlInput2" required>
                </div>
                <div class="row mb-3">
                    <div class="col-6 text-center">
                        <button type="submit" class="btn btn-warning">Prihlásiť</button>
                    </div>
                    <div class="col-6 text-center">
                        <a type="button" href="?c=auth&a=registrationForm" class="btn btn-warning">Nemám konto</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
