const modalWrap = document.getElementsByClassName('modal-wrap')[0];
const modalContent = document.getElementsByClassName("modal-content");
const modalButton = document.getElementsByClassName("modal-button");

console.log(modalWrap.classList.contains('display-none'));

modalButton.onclick = function () {
    console.log(modalWrap.classList.contains('display-none'));
    if(modalWrap.classList.contains('display-none')){
        modalWrap.classList.remove('display-none');
    }
}
