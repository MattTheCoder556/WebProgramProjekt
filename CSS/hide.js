if (fl !== null) {
    fl.addEventListener('click', function (e) {
        let forgetForm = document.querySelector('#forgetForm');

        if (forgetForm.style.display !== "block") {
            forgetForm.style.display = "block";
            this.textContent = 'Hide form.';
        } else {
            forgetForm.style.display = "none";
            this.textContent = 'Have you forgotten your password?';
        }

        e.preventDefault();
    });
}