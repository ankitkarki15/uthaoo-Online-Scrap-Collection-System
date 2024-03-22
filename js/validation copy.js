// sell product form validation
  
function validateForm() {
    const address = document.getElementById('address').value;
    const scrapName = document.getElementById('scrapname').value;
    const quantity = document.getElementById('quantity').value;
    const productDescription = document.getElementById('product-description').value;
    const imageUploadInput = document.getElementById('image-upload-input-1');
    
    // Reset error messages
    document.getElementById('address-error-message').textContent = '';
    document.getElementById('quantity-error-message').textContent = '';
    document.getElementById('product-description-error-message').textContent = '';
    document.getElementById('image-upload-error-message').textContent = '';
    
    // Address validation
    if (address.trim() === '') {
        document.getElementById('address-error-message').textContent = 'Pick up location is required';
        return false;
    }
    
    // Quantity validation
    if (quantity.trim() === '' || isNaN(quantity) || Number(quantity) <= 0) {
        document.getElementById('quantity-error-message').textContent = 'Please enter a valid quantity';
        return false;
    }
    
    // Product description validation
    if (productDescription.trim() === '') {
        document.getElementById('product-description-error-message').textContent = 'Product description is required';
        return false;
    }
    
    // Image upload validation (at least one image should be selected)
    if (imageUploadInput.files.length === 0) {
        document.getElementById('image-upload-error-message').textContent = 'Please select an image*';
        return false;
    }
    
    // All validations passed, allow form submission
    return true;
}


