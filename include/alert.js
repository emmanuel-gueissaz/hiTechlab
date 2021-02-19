function alert_info(info, logo) {


    Swal.fire({

        title: info,
        icon: logo


    });
}

function alert_info_redirect(info, logo, location) {


    Swal.fire({

        title: info,
        icon: logo,
        timer: 1500,
        timerProgressBar: true


    }).then((result) => {
        document.location.href = location;
    });
}

function alert_info_confirms(info, logo, location) {



    Swal.fire({

        title: info,
        icon: logo,
        showCancelButton: true,
        showDenyButton: true,

        confirmButtonText: 'Faites estimer votre appareil !',
        cancelButtonText: 'Nous contacter',
        reverseButtons: true,
        showCloseButton: true,

    })
            .then((result) => {

                if (result.isConfirmed) {
                    document.location.href = location;
                }

                if (result.dismiss === Swal.DismissReason.cancel) {
                    window.open('https://hi-tech-lab.fr/contact');
                }
                if (result.dismiss === Swal.DismissReason.close) {

                }

            });
}



  