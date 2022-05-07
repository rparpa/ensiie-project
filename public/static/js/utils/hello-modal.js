const modalWrap = document.getElementsByClassName('modal-wrap')[0];
const modalContent = document.getElementsByClassName("modal-content");
const modalButton = document.getElementsByClassName("modal-button");


modalButton.onclick = function () {
    if(modalWrap.classList.contains('display-none')){
        modalWrap.classList.remove('display-none');
    }
}
