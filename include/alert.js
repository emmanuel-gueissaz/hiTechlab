       function alert_info(info, logo) {


                Swal.fire({

                    title: info,
                    icon: logo


                });
            }
            
             function alert_info_redirect(info, logo , location) {


            Swal.fire({

                title: info,
                icon: logo,
                timer: 1500,
                timerProgressBar: true


            }).then((result) => {
                document.location.href = location;
            });
        }
        
        
        
        