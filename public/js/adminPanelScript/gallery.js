function addGallery() {
    const form = new FormData(document.querySelector("#formGallery"));
    const url = "/admin/plus-gallery";
    const alert = document.getElementById("alert__box");
    const alertMessage = document.getElementById("alert__message");

    $.ajax({
        type: "POST",
        url: url,
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if (data == "Upload successfully") {
                alertMessage.innerHTML = data;
                alert.classList.add('alert-success')
                alert.classList.remove('d-none')
                alert.classList.remove("alert-danger");
                getAllGallery();
            } else {
                alertMessage.innerHTML = data;
                alert.classList.add("alert-danger");
                alert.classList.remove("alert-success");
                alert.classList.remove("d-none");
            }
        },
        error: function(data) {
            console.log("error");
            console.log(data);
        }
    });
}

function getAllGallery() {
    const url = "/admin/get-gallery";

    $.ajax({
        type: "GET",
        url: url,
        success: function (data) {
            var galleryCard = document.getElementById("galleryBox");
            galleryCard.innerHTML = data;
            console.log(data);
        },
        error: function(data) {
            console.log("error");
            console.log(data);
        }
    });
}

getAllGallery()
