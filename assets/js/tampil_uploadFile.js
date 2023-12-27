const dropArea = document.getElementById("drop-area")
const inputFile = document.getElementById("foto")
const imageView = document.getElementById("img-view")

inputFile.addEventListener("change", uploadImage)

function uploadImage(){
    let imgLink = URL.createObjectURL(inputFile.files[0])
    imageView.style.backgroundImage = `url(${imgLink})`
    imageView.textContent =""
    imageView.style.border = 0
}