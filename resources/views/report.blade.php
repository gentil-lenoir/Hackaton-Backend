<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report an Issue</title>
</head>
<body>
    <div>
        <div>
            <p>Citizen Issue Reporting</p>
            <h1>Report an issue</h1>
            <p>
                You can either use your current location or type the place manually.
            </p>
        </div>

        @if (session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/report" method="post" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title">Title</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    required
                >
            </div>

            <div>
                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    required
                    rows="5"
                >{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="category">Category</label>
                <input
                    type="text"
                    id="category"
                    name="category"
                    value="{{ old('category') }}"
                >
            </div>

            <div>
                <div>
                    <div>
                        <label for="location">Location</label>
                        <p>Use your current coordinates or type a place manually.</p>
                    </div>
                    <button
                        type="button"
                        id="use-current-location"
                    >
                        Use my current location
                    </button>
                </div>

                <div>
                    <input
                        type="text"
                        id="location"
                        name="location"
                        value="{{ old('location') }}"
                        placeholder="Example: Goma, DR Congo or Avenue de la Paix"
                    >
                </div>

                <input type="hidden" id="location_metadata" name="location_metadata" value="{{ old('location_metadata') }}">
                <input type="hidden" id="current_latitude" name="current_latitude" value="{{ old('current_latitude') }}">
                <input type="hidden" id="current_longitude" name="current_longitude" value="{{ old('current_longitude') }}">

                <p id="location-status">
                    Manual location is enabled by default.
                </p>
            </div>

            <div>
                <label for="image">Image</label>
                <input
                    type="file"
                    id="image"
                    name="image"
                >
            </div>

            <button
                type="submit"
            >
                Submit Report
            </button>
        </form>
    </div>

    <script>
        const locationButton = document.getElementById('use-current-location');
        const locationInput = document.getElementById('location');
        const locationMetadataInput = document.getElementById('location_metadata');
        const latitudeInput = document.getElementById('current_latitude');
        const longitudeInput = document.getElementById('current_longitude');
        const locationStatus = document.getElementById('location-status');

        locationButton.addEventListener('click', () => {
            if (!navigator.geolocation) {
                locationStatus.textContent = 'Geolocation is not supported by this browser.';
                return;
            }

            locationStatus.textContent = 'Detecting your current location...';

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    const accuracy = position.coords.accuracy;

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

                    locationStatus.textContent = `Current location captured with an accuracy of about ${Math.round(accuracy)} meters. You can still edit the location field manually.`;
                },
                (error) => {
                    const messages = {
                        1: 'Location access was denied. You can still type the place manually.',
                        2: 'Location could not be detected right now. Try again or type the place manually.',
                        3: 'Location request timed out. Try again or type the place manually.',
                    };

                    locationStatus.textContent = messages[error.code] ?? 'An unexpected geolocation error occurred.';
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0,
                }
            );
        });
    </script>
</body>
</html>
