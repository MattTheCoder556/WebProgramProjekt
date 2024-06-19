function checkPassword() {
    var password = document.getElementById("passw").value;
    var passwLength = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;
    var passwReqElem = document.getElementById("passwReq");

    if (password.match(passwLength)) {
        passwReqElem.innerHTML = "Password meets requirements";
        passwReqElem.className = "valid"; // Apply 'valid' class for green color
    } else {
        passwReqElem.innerHTML = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one special symbol, and one number.";
        passwReqElem.className = "invalid"; // Apply 'invalid' class for red color
    }
}