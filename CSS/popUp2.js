// Function to show the popup
function showPopup(popupId) {
    var popup = document.getElementById(popupId);
    if (popup) {
        popup.classList.add('show');
    }
}

// Function to hide the popup
function hidePopup(popupId) {
    var popup = document.getElementById(popupId);
    if (popup) {
        popup.classList.remove('show');
    }
}

// Event listeners for dynamically generated popup buttons
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('[id^=openPopUp]').forEach(button => {
        button.addEventListener("click", function () {
            const popupId = button.getAttribute('data-popup-id');
            showPopup(popupId);
        });
    });

    document.querySelectorAll('[id^=closePopUp]').forEach(button => {
        button.addEventListener("click", function () {
            const popupId = button.getAttribute('data-popup-id');
            hidePopup(popupId);
        });
    });

    window.addEventListener("click", function (event) {
        document.querySelectorAll('.popup').forEach(popup => {
            if (event.target === popup) {
                hidePopup(popup.id);
            }
        });
    });
});
