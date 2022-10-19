import useKeydown from "./use-keyevent";
const Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    iconColor: 'green',
    customClass: {
        popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true
});

let notify = (message,type="success") => {
   Toast.fire({
        icon: message.type ?? type,
        title: message.text ?? message,
    })
}
let notifyError = (message,type='error') => {
   Toast.fire({
        icon: message.type ?? type,
        title: message.text ?? message,
    })
}

export {notify,notifyError};
