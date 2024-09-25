// Generate a random captcha code
function generateCaptcha() {
  var captcha = Math.random().toString(36).substring(2, 8).toUpperCase();
  return captcha;
}

// Update the captcha text and generate new captcha
function refreshCaptcha() {
  var captchaText = document.getElementById('captchaText');
  var captchaInput = document.getElementById('captcha');
  var captcha = generateCaptcha();
  captchaText.textContent = captcha;
  captchaInput.value = '';
}

document.getElementById('refreshCaptcha').addEventListener('click', refreshCaptcha);

document.getElementById('cancelForm').addEventListener('submit', function(event) {
  event.preventDefault();

  var pnr = document.getElementById('pnr').value;
  var ticketNumber = document.getElementById('ticketNumber').value;
  var captchaInput = document.getElementById('captcha').value;
  var captchaText = document.getElementById('captchaText').textContent;
  var agreement = document.getElementById('agreement').checked;

  // Validate the agreement checkbox
  if (!agreement) {
    alert('Please agree to the terms and conditions.');
    return;
  }

  // Validate the captcha code
  if (captchaInput.toUpperCase() !== captchaText) {
    alert('Invalid captcha code. Please try again.');
    return;
  }

  // Here, you can implement the cancellation logic and handle the form submission as per your requirements

  // Display cancellation message
  alert('Ticket cancellation successful!');

  // Clear form fields
  document.getElementById('pnr').value = '';
  document.getElementById('ticketNumber').value = '';
  document.getElementById('captcha').value = '';
  document.getElementById('agreement').checked = false;
  refreshCaptcha();
});

// Initial captcha generation on page load
refreshCaptcha();