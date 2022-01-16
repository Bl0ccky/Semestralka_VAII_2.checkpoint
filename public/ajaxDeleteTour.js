class Tours {
    getAllTours() {
        fetch('?c=admin&a=getAllTours')
            .then(response => response.json())
            .then(tourData => {
                let html = "";
                if (tourData !== 'ArrayIsEmpty')
                {
                    for (let tour of tourData) {
                        fetch('?c=admin&a=getNumOfOrders&id_tour=' + tour.id)
                            .then(response => response.json())
                            .then(numOfOrders => {
                                html += "<tr>"
                                    + "<th scope='row'>" + tour.id + "</th>"
                                    + "<td><img src=\"public/tours_images/" + tour.image + "\" class='img-fluid img_country' alt='country-flag'></td>"
                                    + "<td>" + tour.name + "</td>"
                                    + "<td>" + tour.date + "</td>"
                                    + "<td>" + numOfOrders + " / " + tour.capacity + "</td>"
                                    + "<td>"
                                    + "<form method = 'post' action = '?c=admin&a=specificTourEditForm'>"
                                    + "<button type = 'submit' class = 'btn p-0' style = 'color: white; font-size: 20px;'>"
                                    + "<i class = 'fas fa-edit'></i>"
                                    + "</button>"
                                    + "<input name='edited_tour' type='hidden' value='" + tour.id + "'>"
                                    + "</form>"
                                    + "</td>"
                                    + "<td>"
                                    + "<button id='" + tour.id + "' class ='btn p-0' style = 'color: white; font-size: 20px;' onClick ='removeTour(this.id)'>"
                                    + "<i class = 'far fa-trash-alt'></i>"
                                    + "</button>"
                                    + "</td>"
                                    + "</tr>"
                                document.getElementById("tours").innerHTML = html;
                            })
                    }
                }
                else
                {
                    document.getElementById("tours").innerHTML = html;
                }
            });
    }
}

window.onload = function ()
{
    var ajaxDeleteTour = new Tours()
    ajaxDeleteTour.getAllTours();
}

function removeTour(id_tour) {
    fetch('?c=admin&a=deleteTour&deleted_tour=' + id_tour)
        .then(response => response.json())
        .then(tourData => {
            let html = "";
            if (tourData !== 'ArrayIsEmpty')
            {

                for (let tour of tourData) {
                    fetch('?c=admin&a=getNumOfOrders&id_tour=' + tour.id)
                        .then(response => response.json())
                        .then(numOfOrders => {
                            html += "<tr>"
                                + "<th scope='row'>" + tour.id + "</th>"
                                + "<td><img src=\"public/tours_images/" + tour.image + "\" class='img-fluid img_country' alt='country-flag'></td>"
                                + "<td>" + tour.name + "</td>"
                                + "<td>" + tour.date + "</td>"
                                + "<td>" + numOfOrders + " / " + tour.capacity + "</td>"
                                + "<td>"
                                + "<form method = 'post' action = '?c=admin&a=specificTourEditForm'>"
                                + "<button type = 'submit' class = 'btn p-0' style = 'color: white; font-size: 20px;'>"
                                + "<i class = 'fas fa-edit'></i>"
                                + "</button>"
                                + "<input name='edited_tour' type='hidden' value='" + tour.id + "'>"
                                + "</form>"
                                + "</td>"
                                + "<td>"
                                + "<button id='" + tour.id + "' class ='btn p-0' style = 'color: white; font-size: 20px;' onClick ='removeTour(this.id)'>"
                                + "<i class = 'far fa-trash-alt'></i>"
                                + "</button>"
                                + "</td>"
                                + "</tr>"
                            document.getElementById("tours").innerHTML = html;
                        })
                }
            }
            else
            {
                document.getElementById("tours").innerHTML = html;
            }
        });

}