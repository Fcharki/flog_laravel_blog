<footer class="flog-footer">
    <div class="container">
        <div class="footer-inner mx-3">

            <a class="footer-brand" href="/">
                Flog
            </a>

            <nav class="footer-links">
                <a href="{{ route('aboutUs') }}" class="me-3">About Us</a>
                <a href="{{ route('help') }}">Help</a>
            </nav>

            <p class="footer-text">
                &copy; {{ date('Y') }} Flog Blog. All rights reserved.
            </p>

        </div>
    </div>
</footer>
