<header>
    <nav class="navbar navbar-expand-lg navbar-light flog-navbar mx-3">
        <div class="container-fluid">

            <a class="navbar-brand" href="/">
                <img
                    src="{{ asset('../flog-logo.png') }}"
                    class="d-inline-block align-top"
                    alt="Flog logo"
                >
            </a>

            <button
                class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                    {{-- Categories dropdown --}}
                    @if($showNavbarCategories ?? true)
                    <li class="nav-item dropdown">
                        <a
                            class="navbar-category-trigger"
                            href="#"
                            id="navbarCategoriesTrigger"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="fas fa-th-large me-1"></i>
                            Categories
                            <i class="fas fa-chevron-down cat-chevron"></i>
                        </a>

                        <div class="dropdown-menu category-menu" aria-labelledby="navbarCategoriesTrigger" id="categoryMenu">
                            @if(isset($visibleCategories) && $visibleCategories->count())
                                <div id="visibleCategories">
                                @foreach($visibleCategories as $category)
                                    <a
                                        href="{{ route('category.posts', ['categoryId' => $category->id]) }}"
                                        class="dropdown-item category-link"
                                    >
                                        <span class="cat-dot" style="background:{{ $category->color ?? 'var(--flog-green)' }};"></span>
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                                </div>
                            @endif

                            @if(isset($hiddenCategories) && $hiddenCategories->count())
                                <div id="moreCategories" class="more-cat-wrap" style="display:none;">
                                    @foreach($hiddenCategories as $category)
                                        <a
                                            href="{{ route('category.posts', ['categoryId' => $category->id]) }}"
                                            class="dropdown-item category-link"
                                        >
                                            <span class="cat-dot" style="background:{{ $category->color ?? 'var(--flog-green)' }};"></span>
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <button
                                    class="more-cat-toggle"
                                    type="button"
                                    id="toggleMoreCategories"
                                    aria-expanded="false"
                                >
                                    More Categories
                                </button>
                            @endif
                        </div>
                    </li>
                    @endif

                    @auth
                        <li class="nav-item">
                            <a
                                class="nav-link dash rounded-3 me-lg-2 my-2 my-lg-0"
                                href="{{ url('/dashboard') }}"
                            >
                                <i class="fas fa-th-large me-1"></i>
                                Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a
                                class="nav-link login-btn"
                                href="{{ route('login') }}"
                            >
                                Log in
                            </a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a
                                    class="nav-link signup-btn rounded-3"
                                    href="{{ route('register') }}"
                                >
                                    Sign up
                                </a>
                            </li>
                        @endif
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
</header>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('toggleMoreCategories');
        const visibleCategories = document.getElementById('visibleCategories');
        const moreCategories = document.getElementById('moreCategories');
        const dropdownMenu = document.getElementById('categoryMenu');

        if (!toggleButton || !visibleCategories || !moreCategories || !dropdownMenu) {
            return;
        }

        const toggleCategories = function () {
            const isHidden = moreCategories.style.display === 'none' || moreCategories.style.display === '';

            if (isHidden) {
                visibleCategories.style.display = 'none';
                moreCategories.style.display = 'block';
                toggleButton.textContent = 'Less Categories';
            } else {
                visibleCategories.style.display = 'block';
                moreCategories.style.display = 'none';
                toggleButton.textContent = 'More Categories';
            }
        };

        toggleButton.addEventListener('click', function (event) {
            event.preventDefault();
            toggleCategories();
            event.stopPropagation();
        });

        dropdownMenu.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });
</script>
@endpush
