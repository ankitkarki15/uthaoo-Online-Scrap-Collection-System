const submit = document.querySelector('input[type="submit"]');

  const isEmpty = (str) => str.trim().length === 0;
  const checkLength = (str, min, max) => str.trim().length >= min && str.trim().length <= max;
  const isNumberOnly = (str) => /^[0-9]{10}$/.test(str);
  const isEmailValid = (str) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);

  submit.addEventListener("click", (e) => {
    // Extracting DOM objects
    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const phoneNo = document.getElementById("phone-no");
    const message = document.getElementById("message");

    // Error message containers
    const nameMessage = document.getElementById("name-message");
    const emailMessage = document.getElementById("email-message");
    const phoneMessage = document.getElementById("phone-message");
    const messageMessage = document.getElementById("message-message");

    if (isEmpty(name.value)) {
      e.preventDefault();
      nameMessage.innerText = "Please enter your full name!";
    } else {
      nameMessage.innerText = "";
    }

    if (isEmpty(email.value)) {
      e.preventDefault();
      emailMessage.innerText = "Please enter your email address!";
    } else if (!isEmailValid(email.value)) {
      e.preventDefault();
      emailMessage.innerText = "Please enter a valid email address!";
    } else {
      emailMessage.innerText = "";
    }

    if (isEmpty(phoneNo.value)) {
      e.preventDefault();
      phoneMessage.innerText = "Please enter your phone number!";
    } else if (!isNumberOnly(phoneNo.value)) {
      e.preventDefault();
      phoneMessage.innerText = "Phone number should contain only 10 digits";
    } else {
      phoneMessage.innerText = "";
    }

    if (isEmpty(message.value)) {
      e.preventDefault();
      messageMessage.innerText = "Please write something!";
    } else {
      messageMessage.innerText = "";
    }
  });
