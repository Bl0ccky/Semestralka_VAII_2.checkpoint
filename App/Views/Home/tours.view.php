<?php /** @var Array $data */ ?>

<title>Zájazdy</title>
<div class="container">
    <div class="tourGuyNadpis">Naše Zájazdy</div>
    <div class="row text-center mb-5">
        <?php if ($data['message'] != "") { ?>
            <h5><?= $data['message'] ?></h5>
        <?php } ?>
        <?php foreach ($data['tours'] as $tour) { ?>
            <div class="profil tour col-12 col-md-6 col-lg-3">
                <div class="row flex-column justify-content-center h-100">
                    <div>
                        <div class="nadpis_profil"><?= $tour->getName() ?></div>
                        <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $tour->getImage() ?>"
                             class="img-fluid img_country" alt="country-flag"><br>
                        Cena: <?= $tour->getPrice() ?>€<br>
                        Termín: <?= $tour->getDate() ?><br>
                        Popis: <?= $tour->getInfo() ?><br>
                    </div>
                    <div>
                        <div class="mt-3 bottom_of_tour">
                            <form method="post" action="?c=home&a=specificTourForm">
                                <button type="submit" class="but_objednat_zaj p-1 p-sm-2 p-md-3">Zistiť viac</button>
                                <input name="id_tour" type="hidden" value="<?= $tour->getId(); ?>">
                            </form>
                            <div class="text-end" style="<?= $tour->isFull() ? "font-weight: bold" : "" ?>">
                                Kapacita <?= $tour->getNumberOfOrders() ?> / <?= $tour->getCapacity() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div id="slideshow" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="public/images/georgia.jpg" class="d-block w-100" alt="georgia-pic">
        </div>
        <div class="carousel-item">
            <img src="public/images/italia.jpg" class="d-block w-100" alt="italy-pic">
        </div>
        <div class="carousel-item">
            <img src="public/images/belgium.jpg" class="d-block w-100 obj_position_top" alt="belgium-pic">
        </div>
        <div class="carousel-item">
            <img src="public/images/iran.jpg" class="d-block w-100" alt="iran-pic">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
