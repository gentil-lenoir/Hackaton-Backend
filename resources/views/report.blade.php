<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Citizen Issue Reporting</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/report.css', 'resources/js/report.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/report.css') }}">
        <script src="{{ asset('js/report.js') }}" defer></script>
    @endif
</head>
<body class="cir-page">
    <div class="cir-page__decor" aria-hidden="true">
        <svg data-corner="tl" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 110 A100 100 0 0 1 110 10" stroke="#555" stroke-width="3" fill="none"/>
            <path d="M25 110 A85 85 0 0 1 110 25" stroke="#555" stroke-width="2" fill="none"/>
            <path d="M40 110 A70 70 0 0 1 110 40" stroke="#555" stroke-width="1.5" fill="none"/>
        </svg>
        <svg data-corner="tr" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 20 Q30 0 60 20 T120 20" stroke="#666" stroke-width="1.2" fill="none"/>
            <path d="M0 40 Q35 20 70 40 T120 40" stroke="#666" stroke-width="1.2" fill="none"/>
            <path d="M0 60 Q40 40 80 60 T120 60" stroke="#666" stroke-width="1.2" fill="none"/>
            <path d="M0 80 Q45 60 90 80 T120 80" stroke="#666" stroke-width="1.2" fill="none"/>
        </svg>
        <svg data-corner="bl" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 40 Q40 60 80 40 T120 40" stroke="#666" stroke-width="1.2" fill="none"/>
            <path d="M0 60 Q35 80 70 60 T120 60" stroke="#666" stroke-width="1.2" fill="none"/>
            <path d="M0 80 Q30 100 60 80 T120 80" stroke="#666" stroke-width="1.2" fill="none"/>
        </svg>
        <svg data-corner="br" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 10 A100 100 0 0 0 110 110" stroke="#555" stroke-width="3" fill="none"/>
            <path d="M25 25 A85 85 0 0 0 110 110" stroke="#555" stroke-width="2" fill="none"/>
        </svg>
    </div>

    <main class="cir-shell">
        <header class="cir-header">
            <div class="cir-brand">
                <div class="cir-brand__mark" aria-hidden="true">
                    <span></span><span></span><span></span><span></span>
                </div>
                <span class="cir-brand__name">{{ config('app.name', 'CIR') }}</span>
            </div>

            <p class="cir-hero__eyebrow">How it works — Step 2</p>
            <h1 class="cir-hero__title">Submit a Report</h1>
            <p class="cir-hero__subtitle">
                AI-powered communication between citizens and public institutions.
                Share a photo, description, and location so authorities can respond faster.
            </p>
        </header>

        <section class="cir-steps" aria-label="Reporting steps">
            <article class="cir-step">
                <span class="cir-step__num">01</span>
                <p class="cir-step__text">Take a clear photo and add a brief description for authorities.</p>
            </article>
            <article class="cir-step">
                <span class="cir-step__num">02</span>
                <p class="cir-step__text">Share your location to pinpoint where the issue is occurring.</p>
            </article>
            <article class="cir-step">
                <span class="cir-step__num">03</span>
                <p class="cir-step__text">Submit your report instantly with a single tap.</p>
            </article>
        </section>

        @if (session('success'))
            <div class="cir-alert cir-alert--success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="cir-alert cir-alert--error" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="cir-card">
            <form id="report-form" class="cir-form" action="/report" method="post" enctype="multipart/form-data">
                @csrf

                <div class="cir-field">
                    <label class="cir-field__label" for="title">Title</label>
                    <input
                        class="cir-input"
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Brief summary of the issue"
                        required
                    >
                </div>

                <div class="cir-field">
                    <label class="cir-field__label" for="description">Description</label>
                    <p class="cir-field__hint">Provide context so authorities can assess urgency and priority.</p>
                    <textarea
                        class="cir-textarea"
                        id="description"
                        name="description"
                        placeholder="Describe what you observed, when it happened, and any safety concerns..."
                        required
                        rows="5"
                    >{{ old('description') }}</textarea>
                </div>

                <div class="cir-field">
                    <label class="cir-field__label" for="category">Category</label>
                    <p class="cir-field__hint">Select a common issue type or enter your own.</p>
                    <input
                        class="cir-input"
                        type="text"
                        id="category"
                        name="category"
                        value="{{ old('category') }}"
                        placeholder="e.g. Road damage & potholes"
                    >
                    <div class="cir-categories">
                        @foreach ([
                            'Road damage & potholes',
                            'Broken streetlights',
                            'Water leaks & flooding',
                            'Illegal dumping & waste',
                            'Public safety concerns',
                            'Environmental issues',
                        ] as $category)
                            <button
                                type="button"
                                class="cir-category-chip"
                                data-category="{{ $category }}"
                            >
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="cir-field">
                    <label class="cir-field__label" for="location">Location</label>
                    <div class="cir-location">
                        <div class="cir-location__head">
                            <p class="cir-field__hint">Use your current coordinates or type a place manually.</p>
                            <button
                                type="button"
                                class="cir-btn cir-btn--secondary"
                                id="use-current-location"
                            >
                                <svg class="cir-btn__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <circle cx="12" cy="12" r="3"/>
                                    <path d="M12 2v3M12 19v3M2 12h3M19 12h3"/>
                                </svg>
                                Use my location
                            </button>
                        </div>

                        <input
                            class="cir-input"
                            type="text"
                            id="location"
                            name="location"
                            value="{{ old('location') }}"
                            placeholder="Example: Goma, DR Congo or Avenue de la Paix"
                        >

                        <input type="hidden" id="location_metadata" name="location_metadata" value="{{ old('location_metadata') }}">
                        <input type="hidden" id="current_latitude" name="current_latitude" value="{{ old('current_latitude') }}">
                        <input type="hidden" id="current_longitude" name="current_longitude" value="{{ old('current_longitude') }}">

                        <p id="location-status" class="cir-location__status">
                            Manual location is enabled by default.
                        </p>
                    </div>
                </div>

                <div class="cir-field">
                    <label class="cir-field__label" for="image">Photo evidence</label>
                    <div class="cir-upload">
                        <div class="cir-upload__zone" id="upload-zone">
                            <div class="cir-upload__placeholder">
                                <svg class="cir-upload__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <circle cx="8.5" cy="10.5" r="1.5"/>
                                    <path d="M21 16l-5-5-4 4-2-2-5 5"/>
                                </svg>
                                <p class="cir-upload__title">Upload a clear photo of the issue</p>
                                <p class="cir-upload__hint">Drag & drop or click to browse · JPG, PNG up to 2 MB</p>
                            </div>
                            <img class="cir-upload__preview" id="upload-preview" alt="Selected issue photo preview">
                        </div>
                        <button type="button" class="cir-upload__remove" id="upload-remove">Remove</button>
                        <input
                            class="cir-upload__input"
                            type="file"
                            id="image"
                            name="image"
                            accept="image/*"
                        >
                    </div>
                </div>

                <button type="submit" class="cir-btn cir-btn--primary" id="submit-report">
                    Submit Report
                </button>
            </form>
        </div>

        <footer class="cir-footer">
            Citizen Issue Reporting · Smarter, more responsive communities
        </footer>
    </main>
</body>
</html>
