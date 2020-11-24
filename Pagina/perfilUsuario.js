const actualBtn = document.getElementById('inpFile');

const fileChosen = document.getElementById('file-chosen');

const previewContainer = document.getElementById('imagePreview');
const previewImage = previewContainer.querySelector(".image-preview__image");
const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

inpFile.addEventListener("change", function(){
  const file = this.files[0];
  if(file){
    const reader = new FileReader();

    previewDefaultText.style.display = "none";

    reader.addEventListener("load", function(){
      previewImage.setAttribute("src", this.result);
    });

    reader.readAsDataURL(file);
  } else{
    previewDefaultText.style.display = null;
    previewImage.style.display = null;
    previewImage.setAttribute("src", "");
  }
});

actualBtn.addEventListener('change', function(){
  fileChosen.textContent = this.files[0].name;
});