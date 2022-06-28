if (window.matchMedia("(orientation: portrait)").matches) {
    alert('Voor een betere ervaring, kantel je device 90 graden.')
}
function del(x) {
    document.getElementById('orders').deleteRow(x.parentElement.parentElement.ariaRowIndex)
}