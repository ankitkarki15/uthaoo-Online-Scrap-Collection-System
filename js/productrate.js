function updatescrapRate() {
  var scrapNameSelect = document.getElementById("scrapname"); // Updated ID
  var rateInput = document.getElementById("scraprate"); // Updated ID
  var selectedOption = scrapNameSelect.options[scrapNameSelect.selectedIndex];
  var scraprate = selectedOption.getAttribute("data-rate"); // Updated variable name
  rateInput.value = scraprate; // Updated variable name
  // calculateTotalAmount(); // updates total amount when rate changes
}

function calculateTotalAmount() {
  var scraprate = parseFloat(document.getElementById("scraprate").value); // Updated variable name
  var scrapquantity = parseFloat(document.getElementById("scrapquantity").value);
  var totalAmountInput = document.getElementById("total-amount");

  var totalAmount = scraprate * scrapquantity; // Updated variable name
  totalAmountInput.value = totalAmount.toFixed(2);
} 

// images
function previewImages(event, previewId) {
var input = event.target;
var imagePreview = document.getElementById(previewId);
imagePreview.innerHTML = ""; 

if (input.files) {
var files = Array.from(input.files);

files.forEach(function (file) {
var reader = new FileReader();

reader.onload = function (e) {
var img = document.createElement("img");
img.src = e.target.result;
img.style.width = "200px";
img.style.height = "200px";
img.style.objectFit = "cover";
imagePreview.appendChild(img);
};

reader.readAsDataURL(file);
});
}
}

