 // Get the radio buttons
    const radioButtons = document.querySelectorAll('input[type=radio][name="menu-item"]');

    // Add event listener to radio buttons
    radioButtons.forEach((radioButton) => {
    radioButton.addEventListener('change', () => {
        // Get the selected radio value
        const selectedRadio = document.querySelector('input[type=radio][name="menu-item"]:checked').value;

        // Send the selected radio value to the server
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'search.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = () => {
            if (xhr.status === 200) {
                // Display the results on the web page
                document.getElementById('result').innerHTML = xhr.responseText;
            } else {
                console.log('Request failed. Returned status of ' + xhr.status);
            }
        };
        xhr.send('radio=' + selectedRadio);
    });
});

