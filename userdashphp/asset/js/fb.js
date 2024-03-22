function validateForm() {
  var errorMessage = document.getElementById('error-message');
  var messageInput = document.getElementsByName('message')[0];

  if (messageInput.value.length < 5) {
      errorMessage.innerText = 'Message must contain at least 5 characters.';
      errorMessage.style.color = 'red';
      messageInput.classList.add('error-indicator');
      return false;
  } else {
      errorMessage.innerText = '';
      messageInput.classList.remove('error-indicator');
      return true;
  }
}