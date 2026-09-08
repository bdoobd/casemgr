"use strict"

const chkReset = document.getElementById('reset');
const pwdField = document.getElementById('password');
const pwdConfirmField = document.getElementById('passwordConfirm');

// console.log(chkReset, pwdField, pwdConfirmField);
chkReset.addEventListener('change', (event) => {
    if (pwdField.hasAttribute('disabled') && pwdConfirmField.hasAttribute('disabled')) {
        pwdField.removeAttribute('disabled');
        pwdConfirmField.removeAttribute('disabled');
    } else {
        pwdField.setAttribute('disabled', '');
        pwdConfirmField.setAttribute('disabled', '');

    }
})