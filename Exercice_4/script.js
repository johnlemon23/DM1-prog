const form = document.querySelector('form');
const identifiantInput = document.getElementById('identifiant');
const passwordInput = document.getElementById('password');
const emailInput = document.getElementById('email');
const emailConfirmInput = document.getElementById('email-confirm');

form.addEventListener('submit', function (event) {
    if (!validateIdentifiant() || !validatePassword() || !validateEmail()) {
        event.preventDefault();
    }
});

function validateIdentifiant() {
  const identifiantValue = identifiantInput.value.trim();
  const identifiantError = document.getElementById('identifiant-error');

  if (identifiantValue === '') {
    identifiantError.textContent = 'L\'identifiant est obligatoire.';
    return false;
} else {
    identifiantError.textContent = '';
}

return true;
}

function validatePassword() {
  const passwordValue = passwordInput.value.trim();
  const passwordError = document.getElementById('password-error');

  if (passwordValue.length < 6) {
    passwordError.textContent = 'Le mot de passe doit comporter au moins 6 caractères.';
    return false;
  } else {
    passwordError.textContent = '';
}

return true;
}

function validateEmail() {
  const emailValue = emailInput.value.trim();
  const emailConfirmValue = emailConfirmInput.value.trim();
  const emailError = document.getElementById('email-error');

  if (emailValue === '' || emailConfirmValue === '') {
    emailError.textContent = 'Les adresses e-mails sont obligatoires.';
    return false;
  } else if (emailValue !== emailConfirmValue) {
    emailError.textContent = 'Les adresses e-mails ne correspondent pas.';
    return false;
  } else {
    emailError.textContent = '';
  }

  return true;
}
  