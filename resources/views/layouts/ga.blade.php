@php
    $gaId = config('services.ga4.measurement_id') ?? env('GA_MEASUREMENT_ID');
    // Skip tracking for local + optionally for admins
    $shouldTrack =
        app()->environment('production') && !empty($gaId) && !(auth()->check() && (auth()->user()->is_admin ?? false));
@endphp

@if ($shouldTrack)
    <!-- Google tag (GA4) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ $gaId }}', {
            anonymize_ip: true
        });
    </script>
@endif
