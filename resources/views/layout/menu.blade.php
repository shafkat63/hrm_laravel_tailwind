<!-- Include Alpine.js in your layout head -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<aside id="sidebar"
    class="bg-gray-800 text-gray-100 w-64 min-h-screen flex flex-col transition-transform duration-300 transform xl:translate-x-0 -translate-x-full"
    x-data="{ open: false }">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-4 border-b border-gray-700">
        <a href="/Home" class="text-xl font-bold">HRM</a>
        <button class="xl:hidden text-gray-300 focus:outline-none" @click="open = !open">
            <i class="bx bx-chevron-left bx-sm"></i>
        </button>
    </div>

    <!-- Sidebar Menu -->
    <div :class="{'translate-x-0': open, '-translate-x-full': !open}"
        class="flex-1 overflow-y-auto transition-transform duration-300 xl:translate-x-0">
        <ul class="space-y-1 px-2">
            @foreach($formattedMenu as $menuItem)
            @php
            $currentUrl = request()->path();
            $hasSubmenu = isset($menuItem['submenu']) && count($menuItem['submenu']) > 0;
            $isActive = request()->is(ltrim($menuItem['url'], '/')) ||
            request()->is(ltrim($menuItem['url'], '/') . '/*') ||
            ($hasSubmenu && collect($menuItem['submenu'])->contains(fn($sub) => request()->is(ltrim($sub['url'], '/'))
            || request()->is(ltrim($sub['url'], '/') . '/*')));
            @endphp

            <li x-data="{ submenuOpen: {{ $isActive && $hasSubmenu ? 'true' : 'false' }} }">
                <a href="{{ $hasSubmenu ? '#' : url($menuItem['url']) }}" @if($hasSubmenu)
                    @click.prevent="submenuOpen = !submenuOpen" @endif
                    class="flex items-center justify-between p-2 rounded-md hover:bg-gray-700 {{ $isActive ? 'bg-gray-900 font-semibold' : '' }}">
                    <div class="flex items-center space-x-2">
                        <i class="{{ $menuItem['icon'] }}"></i>
                        <span>{{ $menuItem['title'] }}</span>
                    </div>
                    @if($hasSubmenu)
                    <i :class="submenuOpen ? 'rotate-180' : ''" class="bi bi-chevron-down transition-transform"></i>
                    @endif
                </a>

                <!-- Submenu -->
                @if($hasSubmenu)
                <ul x-show="submenuOpen" x-transition class="ml-6 mt-1 space-y-1" x-cloak>
                    @foreach($menuItem['submenu'] as $submenuItem)
                    @php
                    $submenuUrl = url($submenuItem['url']);
                    $isSubActive = request()->fullUrlIs($submenuUrl) || request()->is(ltrim($submenuItem['url'], '/'));
                    @endphp
                    <li>
                        <a href="{{ url($submenuItem['url']) }}"
                            class="flex items-center space-x-2 p-2 rounded-md hover:bg-gray-700 {{ $isSubActive ? 'bg-gray-900 font-semibold' : '' }}">
                            <i class="bi bi-circle text-xs"></i>
                            <span>{{ $submenuItem['title'] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</aside>