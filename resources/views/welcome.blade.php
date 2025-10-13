@extends('layout.app')

@section('title', 'Home')

@section('mainContent')


<section class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-20">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
            Simplify Your <span class="text-blue-600">Employee Management</span>
        </h2>
        <p class="text-lg text-gray-600 mb-8">
            A modern HRM solution that helps you manage payroll, attendance, leave, and performance — all in one
            place.
        </p>
        <div class="flex justify-center gap-4">
            <a href="#features"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                Get Started
            </a>
            <a href="#about"
                class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-blue-600 hover:text-white transition">
                Learn More
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20">
    <div class="container mx-auto px-6 text-center">
        <h3 class="text-3xl font-semibold text-gray-800 mb-12">Powerful HRM Features</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-md transition">
                <img src="https://cdn-icons-png.flaticon.com/512/942/942751.png" class="w-16 mx-auto mb-4"
                    alt="Attendance">
                <h4 class="text-xl font-semibold mb-2">Attendance Tracking</h4>
                <p class="text-gray-600">Monitor employee attendance and working hours with real-time data and
                    reports.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-md transition">
                <img src="https://cdn-icons-png.flaticon.com/512/4205/4205999.png" class="w-16 mx-auto mb-4"
                    alt="Payroll">
                <h4 class="text-xl font-semibold mb-2">Payroll Management</h4>
                <p class="text-gray-600">Generate salaries automatically with deductions, bonuses, and tax
                    calculations.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-md transition">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="w-16 mx-auto mb-4"
                    alt="Performance">
                <h4 class="text-xl font-semibold mb-2">Performance Review</h4>
                <p class="text-gray-600">Evaluate employee performance with goals, KPIs, and detailed feedback
                    reports.</p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="bg-blue-50 py-20">
    <div class="container mx-auto px-6 text-center">
        <h3 class="text-3xl font-semibold text-gray-800 mb-6">About Our HRM</h3>
        <p class="max-w-2xl mx-auto text-gray-600">
            Our HRM system is designed to streamline your human resource processes and improve workforce
            productivity.
            Whether you're a small startup or a large organization, our platform scales with your needs.
        </p>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-20">
    <div class="container mx-auto px-6 text-center">
        <h3 class="text-3xl font-semibold text-gray-800 mb-12">Simple Pricing</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow hover:shadow-md transition">
                <h4 class="text-2xl font-semibold mb-2">Basic</h4>
                <p class="text-gray-600 mb-4">Perfect for small teams</p>
                <h2 class="text-4xl font-bold text-blue-600 mb-6">$29<span class="text-lg text-gray-600">/mo</span>
                </h2>
                <ul class="text-gray-600 space-y-2 mb-6">
                    <li>✔ Attendance</li>
                    <li>✔ Payroll</li>
                    <li>❌ Performance Review</li>
                </ul>
                <a href="#" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Choose
                    Plan</a>
            </div>
            <div class="bg-blue-600 text-white p-8 rounded-2xl shadow-lg transform scale-105">
                <h4 class="text-2xl font-semibold mb-2">Pro</h4>
                <p class="text-blue-100 mb-4">Best for growing companies</p>
                <h2 class="text-4xl font-bold mb-6">$59<span class="text-lg text-blue-200">/mo</span></h2>
                <ul class="space-y-2 mb-6">
                    <li>✔ Attendance</li>
                    <li>✔ Payroll</li>
                    <li>✔ Performance Review</li>
                </ul>
                <a href="#" class="bg-white text-blue-600 px-6 py-2 rounded-lg hover:bg-blue-100 transition">Choose
                    Plan</a>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow hover:shadow-md transition">
                <h4 class="text-2xl font-semibold mb-2">Enterprise</h4>
                <p class="text-gray-600 mb-4">For large organizations</p>
                <h2 class="text-4xl font-bold text-blue-600 mb-6">$99<span class="text-lg text-gray-600">/mo</span>
                </h2>
                <ul class="text-gray-600 space-y-2 mb-6">
                    <li>✔ All Features</li>
                    <li>✔ Dedicated Support</li>
                    <li>✔ Custom Integrations</li>
                </ul>
                <a href="#" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Choose
                    Plan</a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="bg-gray-100 py-20">
    <div class="container mx-auto px-6 text-center">
        <h3 class="text-3xl font-semibold text-gray-800 mb-6">Contact Us</h3>
        <p class="text-gray-600 mb-8">Have questions? Get in touch with our HRM team today.</p>
        <a href="mailto:info@hrmsystem.com"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
            info@hrmsystem.com
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 py-6">
    <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
        <p>&copy; {{ date('Y') }} HRM System. All rights reserved.</p>
        <div class="flex space-x-4 mt-4 md:mt-0">
            <a href="#" class="hover:text-white">Privacy</a>
            <a href="#" class="hover:text-white">Terms</a>
            <a href="#" class="hover:text-white">Support</a>
        </div>
    </div>
</footer>


@endsection
@section('scripts')
@endsection