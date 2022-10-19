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
export default {
    data: () => ({
        data: '',
    }),
    methods: {
        notify(message,type="success") {
           Toast.fire({
                icon: message.type ?? type,
                title: message.text ?? message,
            })
        },
        notifyError(message,type='') {
            Toast.fire({
                icon: type??"error",
                title: message.text ?? message,
            })
        }
    }
}
