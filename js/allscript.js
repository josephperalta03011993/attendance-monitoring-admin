function logoutUser() {

    window.location.href = 'logout.php';
}

    function showConfirmation() {
        // Create a custom modal dialog
        const modal = document.createElement('div');
        modal.style.position = 'fixed';
        modal.style.left = '0';
        modal.style.top = '0';
        modal.style.width = '100vw';
        modal.style.height = '100vh';
        modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        modal.style.display = 'flex';
        modal.style.justifyContent = 'center';
        modal.style.alignItems = 'center';
        modal.style.zIndex = '9999';

        const modalContent = document.createElement('div');
        modalContent.style.backgroundColor = '#fff';
        modalContent.style.padding = '20px';
        modalContent.style.borderRadius = '8px';
        modalContent.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        modalContent.style.textAlign = 'center';
        modalContent.style.width = '300px';

        const message = document.createElement('p');
        message.textContent = 'Password updated successfully! You can now log in.';
        message.style.fontSize = '16px';
        message.style.color = '#333';

        const loginButton = document.createElement('a');
        loginButton.href = 'login.php';
        loginButton.textContent = 'Go to Login';
        loginButton.style.backgroundColor = '#007bff';
        loginButton.style.color = 'white';
        loginButton.style.padding = '10px 20px';
        loginButton.style.borderRadius = '5px';
        loginButton.style.textDecoration = 'none';
        loginButton.style.display = 'inline-block';
        loginButton.style.marginTop = '20px';

        modalContent.appendChild(message);
        modalContent.appendChild(loginButton);
        modal.appendChild(modalContent);
        document.body.appendChild(modal);

        // Remove modal when the login button is clicked
        loginButton.addEventListener('click', function() {
            document.body.removeChild(modal);
        });
    }

        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('capture-button');
        const capturedImageInput = document.getElementById('captured_image');

        // Access the webcam
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error('Error accessing webcam: ', err);
            });

        // Capture image from video
        captureButton.addEventListener('click', () => {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert the image to base64 and store it in the hidden input
            const imageData = canvas.toDataURL('image/png');
            capturedImageInput.value = imageData;

            // Optionally show a preview of the captured image
            canvas.style.display = 'block';
        });