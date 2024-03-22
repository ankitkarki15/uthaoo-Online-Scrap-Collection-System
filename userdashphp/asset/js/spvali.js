function validateForm() {
    var addressInput = document.getElementById("address");
    var quantityInput = document.getElementById("quantity");
    var quantityValue = parseFloat(quantityInput.value);

    if (addressInput.value.trim() === "") {
      alert("Please enter your pick up location.");
      addressInput.focus();
      return false;
    }

    if (isNaN(quantityValue) || quantityValue <= 0) {
      alert("Please enter a valid quantity value.");
      quantityInput.focus();
      return false;
    }

    var imageInput1 = document.getElementById("image-upload-input-1");
    var imageInput2 = document.getElementById("image-upload-input-2");

    if (imageInput1.files.length === 0 && imageInput2.files.length === 0) {
      alert("Please upload at least one image.");
      return false;
    }

    return true;
  }