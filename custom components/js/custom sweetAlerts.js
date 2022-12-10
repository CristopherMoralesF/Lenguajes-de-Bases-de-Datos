function errroMessageStatus(messageText) {

    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: messageText,
        confirmButtonText: 'Ok!'
    }).then((result) => {

        if (result.isConfirmed) {
            window.location.reload(true);
        }
    })

}

function successMessageStatus(messageText) {
    Swal.fire({
        title: 'Updated!',
        text: messageText,
        icon: 'success',
        confirmButtonText: 'Ok!'
    }).then((result) => {
        if (result.isConfirmed) {
          window.location.reload(true)
        }
      })

}