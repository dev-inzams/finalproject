function showToast(message, type) {
    const toastContainer = document.getElementById('toast-container');

    const toast = document.createElement('div');
    toast.className = `tost ${type}`;
    toast.innerText = message;

    toastContainer.appendChild(toast);

    // Triggering reflow to animate the entrance
    void toast.offsetWidth;

    toast.style.opacity = '1';

    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3000);
}

function successToast(message) {
    showToast(message, 'success');
}

function errorToast(message) {
    showToast(message, 'error');
}
