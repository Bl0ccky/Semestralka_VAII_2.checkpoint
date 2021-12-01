<title>Pridať zájazd</title>
<div class="container">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <form id="addTour_form" method="post" action="?c=admin&a=addTour" enctype="multipart/form-data">
                <div class="mb-3 form_input">
                    <label for="name" class="form-label oNasText">Názov zájazdu</label>
                    <input id="name" type="text" class="form-control" name="tour_name" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <small class="visually-hidden oNasText">Error message</small>
                </div>
                <div class="mb-3 form_input">
                    <label for="tour_image" class="form-label oNasText">Obrázok</label>
                    <input id="tour_image" type="file" class="form-control" name="tour_image" required>
                </div>
                <div class="mb-3 form_input">
                    <label for="price" class="form-label oNasText">Cena</label>
                    <input id="price" type="number" class="form-control" name="tour_price" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <small class="visually-hidden oNasText">Error message</small>
                </div>
                <div class="mb-3 form_input">
                    <label for="date" class="form-label oNasText">Termín</label>
                    <input id="date" type="date" class="form-control" name="tour_date" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <small class="visually-hidden oNasText">Error message</small>
                </div>
                <div class="mb-3 form_input">
                    <label for="capacity" class="form-label oNasText">Kapacita</label>
                    <input id="capacity" type="number" class="form-control" name="tour_capacity" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <small class="visually-hidden oNasText">Error message</small>
                </div>
                <div class="mb-3 form_input">
                    <label for="tour_info" class="form-label oNasText">Popis</label>
                    <textarea id="tour_info" class="form-control" name="tour_info" form="addTour_form" required></textarea>
                </div>
                <div class="mb-3 w-100">
                    <button type="submit" class="btn btn-warning">Pridať</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="public/form_validation.js"></script>