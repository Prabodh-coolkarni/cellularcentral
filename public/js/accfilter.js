document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.accessory-button');
    const hiddenInput = document.getElementById('selected-accessory');

    buttons.forEach(button => {
        // Single click to select
        button.addEventListener('click', function() {
            buttons.forEach(btn => btn.classList.remove('active')); // Remove active from all buttons
            this.classList.add('active'); // Add active class to the clicked button
            hiddenInput.value = this.getAttribute('data-accessory'); // Set the hidden input value
        });

        // Double-click to deselect
        button.addEventListener('dblclick', function() {
            this.classList.remove('active'); // Remove the active class from this button
            hiddenInput.value = ''; // Clear the hidden input value
        });
    });
});
