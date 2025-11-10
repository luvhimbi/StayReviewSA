@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    <div class="max-w-4xl mx-auto mt-12 px-6">


        <!-- Breadcrumb -->
        <nav class="text-gray-500 text-sm mb-6" aria-label="Breadcrumb">
            <ol class="list-reset flex">
                <li>
                    <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">Back</a>
                </li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-700">Privacy Policy</li>
            </ol>
        </nav>



        <h1 class="text-3xl font-semibold mb-6">Privacy Policy</h1>

        <p class="text-gray-700 mb-4">
            At MyApp, we are committed to protecting your privacy and personal information. This Privacy Policy explains how we collect, use, and safeguard your data when you use our platform.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">1. Information We Collect</h2>
        <p class="text-gray-700 mb-4">
            We may collect the following types of information from you:
        </p>
        <ul class="list-disc list-inside text-gray-700 mb-4">
            <li>Personal information such as name, email, and profile details.</li>
            <li>Usage data such as login times, pages visited, and session activity.</li>
            <li>Information you provide through messages, feedback, or support requests.</li>
        </ul>

        <h2 class="text-2xl font-semibold mt-6 mb-2">2. How We Use Your Information</h2>
        <p class="text-gray-700 mb-4">
            We use the information collected to:
        </p>
        <ul class="list-disc list-inside text-gray-700 mb-4">
            <li>Provide and improve our services.</li>
            <li>Send important updates and notifications.</li>
            <li>Ensure platform security and prevent abuse.</li>
            <li>Comply with legal obligations, including the POPI Act.</li>
        </ul>

        <h2 class="text-2xl font-semibold mt-6 mb-2">3. Sharing Your Information</h2>
        <p class="text-gray-700 mb-4">
            We do not sell or share your personal information with third parties without your consent,
            except in the following situations:
        </p>
        <ul class="list-disc list-inside text-gray-700 mb-4">
            <li>With service providers who help us operate the platform.</li>
            <li>When required by law or to protect rights and safety.</li>
        </ul>

        <h2 class="text-2xl font-semibold mt-6 mb-2">4. Cookies and Tracking</h2>
        <p class="text-gray-700 mb-4">
            We may use cookies and similar technologies to enhance user experience and analyze platform usage.
            You can manage your cookie preferences in your browser settings.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">5. Data Retention</h2>
        <p class="text-gray-700 mb-4">
            We retain your personal data only as long as necessary to provide services and comply with legal obligations.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">6. Your Rights</h2>
        <p class="text-gray-700 mb-4">
            You have the right to access, correct, or delete your personal data. You may also withdraw consent for data processing at any time.
            To exercise these rights, please contact us at
            <a href="mailto:support@myapp.com" class="text-blue-600 hover:underline">support@myapp.com</a>.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">7. Security</h2>
        <p class="text-gray-700 mb-4">
            We implement appropriate technical and organizational measures to protect your data from unauthorized access, disclosure, alteration, or destruction.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">8. Updates to this Policy</h2>
        <p class="text-gray-700 mb-4">
            We may update this Privacy Policy from time to time. Users will be notified of significant changes.
            Continued use of the platform constitutes acceptance of the updated policy.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">9. Contact Us</h2>
        <p class="text-gray-700 mb-4">
            If you have any questions or concerns about this Privacy Policy, please contact us at
            <a href="mailto:support@myapp.com" class="text-blue-600 hover:underline">support@myapp.com</a>.
        </p>
    </div>
@endsection
