// Function to preview selected image
  function previewImage(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" class="image-preview">`;
        };

        reader.readAsDataURL(input.files[0]);
    }
}
    // Sell product form validation
    function validateForm() {
        const address = document.getElementById('address').value.trim();
        const quantity = document.getElementById('quantity').value.trim();
        const scrapname = document.getElementById('scrapname').value.trim();
        const productDescription = document.getElementById('product-description').value.trim();
        const imageUploadInput = document.getElementById('image-upload-input-1');

        let isValid = true;

        const addressErrorMessage = document.getElementById('address-error-message');
        const scrapnameErrorMessage = document.getElementById('scrap-name-error-message');
        const quantityErrorMessage = document.getElementById('quantity-error-message');
        const productDescriptionErrorMessage = document.getElementById('product-description-error-message');
        const imageUploadErrorMessage = document.getElementById('image-upload-error-message');

        addressErrorMessage.textContent = '';
        scrapnameErrorMessage.textContent = '';
        quantityErrorMessage.textContent = '';
        productDescriptionErrorMessage.textContent = '';
        imageUploadErrorMessage.textContent = '';

        if (address === '') {
            addressErrorMessage.textContent = 'Pick up location is required';
            isValid = false;
        }

        if (scrapname === '') {
            scrapnameErrorMessage.textContent = 'Please select a scrap item';
            isValid = false;
        }

        if (isNaN(quantity) || Number(quantity) <= 0) {
            quantityErrorMessage.textContent = 'Please enter a valid quantity';
            isValid = false;
        }

        if (productDescription === '') {
            productDescriptionErrorMessage.textContent = 'Product description is required';
            isValid = false;
        }

        if (imageUploadInput.files.length === 0) {
            imageUploadErrorMessage.textContent = 'Please select an image';
            isValid = false;
        }

        return isValid;
    }


      function updatescrapRate() {
    const selectedScrapItem = document.getElementById('scrapname').value;
    const selectedScrapRate = document.querySelector(`option[value="${selectedScrapItem}"]`).getAttribute('data-rate');
    document.getElementById('scraprate').value = selectedScrapRate
      }
