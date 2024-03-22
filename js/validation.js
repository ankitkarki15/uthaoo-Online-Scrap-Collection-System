// Function to validate the form
function validateForm() {
  let isValid = true;

  // Reset error messages
  document.querySelectorAll('.error').forEach((element) => element.textContent = '');

  // Get form elements
  const addressInput = document.getElementById('address');
  const scrapnameInput = document.getElementById('scrapname');
  const scraprateInput = document.getElementById('scraprate');
  const quantityInput = document.getElementById('quantity');
  const descriptionInput = document.getElementById('product-description');
  const imagesInput1 = document.getElementById('image-upload-input-1');
//   const imagesInput2 = document.getElementById('image-upload-input-2');

  // Perform validation for each input
  if (addressInput.value.trim() === '') {
      document.getElementById('address-message').textContent = 'Please enter the pick-up location.';
      isValid = false;
  }

  if (scrapnameInput.value === '') {
      document.getElementById('scrapname-message').textContent = 'Please select a scrap item.';
      isValid = false;
  }

  if (scraprateInput.value.trim() === '' || isNaN(scraprateInput.value)) {
      document.getElementById('scraprate-message').textContent = 'Please enter a valid scrap rate.';
      isValid = false;
  }

  if (quantityInput.value.trim() === '' || isNaN(quantityInput.value)) {
      document.getElementById('quantity-message').textContent = 'Please enter a valid quantity.';
      isValid = false;
  }

  if (descriptionInput.value.trim() === '') {
      document.getElementById('product-description-message').textContent = 'Please describe the condition of the scrap.';
      isValid = false;
  }

  if (imagesInput1.files.length === 0 && imagesInput2.files.length === 0) {
      document.getElementById('image-message').textContent = 'Please upload at least one image.';
      isValid = false;
  }

  // Check email format using regular expression
  const emailInput = document.getElementById('email');
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailInput.value)) {
      document.getElementById('email-message').textContent = 'Please enter a valid email address.';
      isValid = false;
  }

  return isValid;
}

// Event listener for form submission
document.querySelector('form').addEventListener('submit', (event) => {
  if (!validateForm()) {
      event.preventDefault();
  }
});

// Function to update the scrap rate based on selected scrap item
function updatescrapRate() {
  const scrapnameInput = document.getElementById('scrapname');
  const scraprateInput = document.getElementById('scraprate');

  switch (scrapnameInput.value) {
      case 'Plastic':
          scraprateInput.value = 15;
          break;
      case 'water Bottles':
          scraprateInput.value = 10;
          break;
      // Add other cases for different scrap items and rates
      // ...
      default:
          scraprateInput.value = ''; // Set to empty for unknown items
  }
}

// Function to preview images
function previewImages(event, previewElementId) {
  const previewElement = document.getElementById(previewElementId);
  previewElement.innerHTML = '';

  const files = event.target.files;
  for (const file of files) {
      const image = document.createElement('img');
      image.src = URL.createObjectURL(file);
      image.className = 'image-preview';
      previewElement.appendChild(image);
  }
}