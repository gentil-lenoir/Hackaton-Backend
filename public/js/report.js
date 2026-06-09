document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('report-form');
    const locationButton = document.getElementById('use-current-location');
    const locationInput = document.getElementById('location');
    const locationMetadataInput = document.getElementById('location_metadata');
    const latitudeInput = document.getElementById('current_latitude');
    const longitudeInput = document.getElementById('current_longitude');
    const locationStatus = document.getElementById('location-status');
    const categoryInput = document.getElementById('category');
    const categoryChips = document.querySelectorAll('.cir-category-chip');
    const imageInput = document.getElementById('image');
    const uploadZone = document.getElementById('upload-zone');
    const uploadPreview = document.getElementById('upload-preview');
    const uploadRemove = document.getElementById('upload-remove');
    const submitButton = document.getElementById('submit-report');

    const setLocationStatus = (message, state = '') => {
        locationStatus.textContent = message;
        locationStatus.className = 'cir-location__status';
        if (state) {
            locationStatus.classList.add(state);
        }
    };

    categoryChips.forEach((chip) => {
        chip.addEventListener('click', () => {
            const value = chip.dataset.category;
            categoryInput.value = value;

            categoryChips.forEach((item) => item.classList.remove('is-active'));
            chip.classList.add('is-active');
        });
    });

    if (categoryInput?.value) {
        categoryChips.forEach((chip) => {
            if (chip.dataset.category === categoryInput.value) {
                chip.classList.add('is-active');
            }
        });
    }

    const clearImagePreview = () => {
        imageInput.value = '';
        uploadPreview.src = '';
        uploadZone.classList.remove('has-preview');
    };

    const showImagePreview = (file) => {
        if (!file || !file.type.startsWith('image/')) {
            return;
        }

        const reader = new FileReader();
        reader.onload = (event) => {
            uploadPreview.src = event.target.result;
            uploadZone.classList.add('has-preview');
        };
        reader.readAsDataURL(file);
    };

    uploadZone?.addEventListener('click', () => imageInput.click());

    uploadZone?.addEventListener('dragover', (event) => {
        event.preventDefault();
        uploadZone.classList.add('is-dragover');
    });

    uploadZone?.addEventListener('dragleave', () => {
        uploadZone.classList.remove('is-dragover');
    });

    uploadZone?.addEventListener('drop', (event) => {
        event.preventDefault();
        uploadZone.classList.remove('is-dragover');

        const file = event.dataTransfer.files?.[0];
        if (!file) {
            return;
        }

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        imageInput.files = dataTransfer.files;
        showImagePreview(file);
    });

    imageInput?.addEventListener('change', () => {
        const file = imageInput.files?.[0];
        if (file) {
            showImagePreview(file);
        } else {
            clearImagePreview();
        }
    });

    uploadRemove?.addEventListener('click', (event) => {
        event.stopPropagation();
        clearImagePreview();
    });

    locationButton?.addEventListener('click', () => {
        if (!navigator.geolocation) {
            setLocationStatus('Geolocation is not supported by this browser.', 'is-error');
            return;
        }

        setLocationStatus('Detecting your current location...', 'is-loading');
        locationButton.disabled = true;

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const { latitude, longitude, accuracy } = position.coords;

                latitudeInput.value = latitude;
                longitudeInput.value = longitude;
                locationMetadataInput.value = JSON.stringify({
                    source: 'browser_geolocation',
                    latitude,
                    longitude,
                    accuracy,
                });

                if (!locationInput.value.trim()) {
                    locationInput.value = `${latitude}, ${longitude}`;
                }

                setLocationStatus(
                    `Location captured (~${Math.round(accuracy)} m accuracy). You can still edit the address manually.`,
                    'is-success'
                );
                locationButton.disabled = false;
            },
            (error) => {
                const messages = {
                    1: 'Location access was denied. You can still type the place manually.',
                    2: 'Location could not be detected right now. Try again or type the place manually.',
                    3: 'Location request timed out. Try again or type the place manually.',
                };

                setLocationStatus(messages[error.code] ?? 'An unexpected geolocation error occurred.', 'is-error');
                locationButton.disabled = false;
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0,
            }
        );
    });

    form?.addEventListener('submit', () => {
        submitButton.disabled = true;
        submitButton.textContent = 'Submitting...';
    });
});
