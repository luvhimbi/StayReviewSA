@extends('layouts.app')

@section('title', 'Terms of Service')

@section('content')

    <div class="max-w-4xl mx-auto mt-12 px-6">
        <nav class="text-gray-500 text-sm mb-6" aria-label="Breadcrumb">
            <ol class="list-reset flex">
                <li>
                    <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">Back</a>
                </li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-700">Privacy Policy</li>
            </ol>
        </nav>
        <h1 class="text-3xl font-semibold mb-6">Terms of Service</h1>

        <p class="text-gray-700 mb-4">
            Welcome to MyApp! By accessing or using our platform, you agree to comply with these Terms of Service.
            Please read them carefully before using our services.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">1. Acceptance of Terms</h2>
        <p class="text-gray-700 mb-4">
            By using our platform, you acknowledge that you have read, understood, and agree to be bound by these terms.
            If you do not agree, please do not use our services.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">2. User Accounts</h2>
        <p class="text-gray-700 mb-4">
            To access certain features, you may need to create an account. You are responsible for maintaining
            the confidentiality of your account credentials and for all activity under your account.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">3. Prohibited Conduct</h2>
        <p class="text-gray-700 mb-4">
            Users must not use the platform for unlawful purposes or engage in any activity that may harm,
            disrupt, or interfere with other users or the platform’s services. This includes, but is not limited to:
        </p>
        <ul class="list-disc list-inside text-gray-700 mb-4">
            <li>Harassment or abuse of other users.</li>
            <li>Uploading malicious software or viruses.</li>
            <li>Attempting to access unauthorized areas of the platform.</li>
            <li>Spamming or phishing attempts.</li>
        </ul>

        <h2 class="text-2xl font-semibold mt-6 mb-2">4. Content Ownership</h2>
        <p class="text-gray-700 mb-4">
            All content you provide remains your property. However, by using the platform, you grant MyApp
            a non-exclusive, worldwide, royalty-free license to display, distribute, and use the content
            as necessary to provide the services.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">5. Privacy and Data</h2>
        <p class="text-gray-700 mb-4">
            We collect and process personal information in accordance with our Privacy Policy and the POPI Act.
            By using our platform, you consent to our handling of your data as described in the Privacy Policy.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">6. Limitation of Liability</h2>
        <p class="text-gray-700 mb-4">
            MyApp is provided “as is” without warranties of any kind. We are not liable for any damages,
            losses, or other issues arising from your use of the platform.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">7. Termination</h2>
        <p class="text-gray-700 mb-4">
            We reserve the right to suspend or terminate your account at our discretion, especially in cases
            of violation of these Terms of Service.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">8. Changes to Terms</h2>
        <p class="text-gray-700 mb-4">
            We may update these Terms of Service from time to time. Users will be notified of significant
            changes. Continued use of the platform constitutes acceptance of the updated terms.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">9. Contact Us</h2>
        <p class="text-gray-700 mb-4">
            If you have any questions or concerns about these Terms of Service, please contact us at
            <a href="mailto:support@myapp.com" class="text-blue-600 hover:underline">support@myapp.com</a>.
        </p>
    </div>
@endsection

