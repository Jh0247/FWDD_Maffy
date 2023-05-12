const realFileBtn = document.getElementById("real-file");
const customBtn = document.getElementById("custom-button");
const customTxt = document.getElementById("custom-text");

customBtn.addEventListener("click", function() {
realFileBtn.click();
});

realFileBtn.addEventListener("change", function() {
if (realFileBtn.value) {
    customTxt.innerHTML = realFileBtn.value.match(
    /[\/\\]([\w\d\s\.\-\(\)]+)$/
    )[1];
} else {
    customTxt.innerHTML = "No file chosen, yet.";
}
});

function previewImage(event){
    var reader = new FileReader();//to get the file data

    reader.onload = function(){
        var output = document.getElementById('image');
        output.src = reader.result;//change the source to result
    }
    reader.readAsDataURL(event.target.files[0]);//preview the image
}
