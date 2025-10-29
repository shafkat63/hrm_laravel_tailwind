<!-- Sidebar Wrapper -->
<div x-data="{ sidebarOpen: false, collapsed: false }" class="relative z-50">
    <!-- Sidebar -->
    <aside
        class="bg-gray-900 text-gray-100 h-screen fixed top-16 left-0 transition-all duration-300 ease-in-out
               flex flex-col border-r border-gray-800 shadow-xl overflow-y-auto"
        :class="{
            'w-64': !collapsed,
            'w-20': collapsed,
            'translate-x-0': sidebarOpen,
            '-translate-x-full md:translate-x-0': !sidebarOpen
        }"
    >
        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-700">
            <a href="{{ url('/dashboard') }}"
               class="font-extrabold tracking-wide text-indigo-400 hover:text-indigo-300 transition-all duration-200"
               :class="collapsed ? 'text-lg' : 'text-2xl'">
               HRM
            </a>
            <div class="flex items-center space-x-2">
                <!-- Collapse Toggle (Desktop) -->
                <button
                    class="hidden md:inline-flex text-gray-400 hover:text-indigo-300 focus:outline-none transition"
                    @click="collapsed = !collapsed"
                    title="Toggle sidebar"
                >
                    <i class="bi" :class="collapsed ? 'bi-chevron-double-right' : 'bi-chevron-double-left'"></i>
                </button>

                <!-- Close Button (Mobile) -->
                <button
                    class="md:hidden text-gray-400 hover:text-gray-200 focus:outline-none"
                    @click="sidebarOpen = false"
                >
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="px-3 py-5 space-y-1">
            @foreach($formattedMenu as $menuItem)
                @php
                    $hasSubmenu = isset($menuItem['submenu']) && count($menuItem['submenu']) > 0;
                    $isActive = request()->is(trim($menuItem['url'], '/')) ||
                                request()->is(trim($menuItem['url'], '/') . '/*');
                    if ($hasSubmenu) {
                        foreach ($menuItem['submenu'] as $sub) {
                            if (request()->is(trim($sub['url'], '/')) || request()->is(trim($sub['url'], '/') . '/*')) {
                                $isActive = true;
                                break;
                            }
                        }
                    }
                @endphp

                <li x-data="{ submenuOpen: {{ $isActive && $hasSubmenu ? 'true' : 'false' }} }" class="group">
                    <a href="{{ $hasSubmenu ? '#' : url($menuItem['url']) }}"
                       @if($hasSubmenu) @click.prevent="submenuOpen = !submenuOpen" @endif
                       class="flex items-center justify-between px-3 py-2 rounded-lg transition-all duration-200
                              {{ $isActive ? 'bg-indigo-700 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <div class="flex items-center space-x-3">
                            <i class="{{ $menuItem['icon'] }} text-lg
                                      {{ $isActive ? 'text-white' : 'text-gray-400 group-hover:text-indigo-300' }}"></i>
                            <span class="font-medium transition-all duration-200"
                                  x-show="!collapsed"
                                  x-transition.opacity>{{ $menuItem['title'] }}</span>
                        </div>
                        @if($hasSubmenu)
                            <i :class="submenuOpen ? 'rotate-180 text-indigo-300' : 'text-gray-400'"
                               x-show="!collapsed"
                               class="bi bi-chevron-down transition-transform duration-200"></i>
                        @endif
                    </a>

                    @if($hasSubmenu)
                        <ul x-show="submenuOpen && !collapsed" x-transition
                            class="ml-6 mt-1 space-y-1 border-l border-gray-700 pl-3" x-cloak>
                            @foreach($menuItem['submenu'] as $submenuItem)
                                @php
                                    $isSubActive = request()->is(trim($submenuItem['url'], '/')) ||
                                                   request()->is(trim($submenuItem['url'], '/') . '/*');
                                @endphp
                                <li>
                                    <a href="{{ url($submenuItem['url']) }}"
                                       class="flex items-center space-x-2 px-2 py-1.5 rounded-md transition-all duration-150
                                              {{ $isSubActive ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-gray-100' }}">
                                        <i class="{{ $isSubActive ? 'bi bi-circle-fill text-indigo-300 text-sm' : 'bi bi-circle text-gray-500 text-sm' }}"></i>
                                        <span class="text-sm font-medium">{{ $submenuItem['title'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </aside>

    <!-- Mobile Overlay -->
    <div
        class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        x-cloak>
    </div>
</div>
