<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Privacy Policy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{-- Optional: Tailwind or app CSS --}}
</head>
<body class="bg-white text-gray-900">
    @include('partials.header')
    <div class="max-w-2xl mx-auto py-12 px-4">
        <h1 class="text-2xl font-semibold mb-4">Privacy Policy</h1>

        <p class="mb-4">
            This Privacy Policy explains how we collect, use, and protect your information when you use our application.
        </p>

        <h2 class="text-xl font-semibold mt-6 mb-2">1. Information We Collect</h2>
        <p class="mb-4">
            When you sign in using Facebook, we may collect the following information:
        </p>
        <ul class="list-disc list-inside mb-4">
            <li>Your name</li>
            <li>Email address</li>
            <li>Facebook ID</li>
            <li>Profile picture (if permission is granted)</li>
        </ul>

        <h2 class="text-xl font-semibold mt-6 mb-2">2. How We Use Your Information</h2>
        <p class="mb-4">
            We use your data to:
        </p>
        <ul class="list-disc list-inside mb-4">
            <li>Authenticate and identify you</li>
            <li>Provide personalized experiences within the app</li>
            <li>Ensure the security of your account</li>
        </ul>

        <h2 class="text-xl font-semibold mt-6 mb-2">3. Data Storage</h2>
        <p class="mb-4">
            Your data is stored securely and is not shared with third parties unless required by law.
        </p>

        <h2 class="text-xl font-semibold mt-6 mb-2">4. Data Deletion</h2>
        <p class="mb-4">
            You may request to delete your data at any time. 
        </p>

        <h2 class="text-xl font-semibold mt-6 mb-2">5. Contact</h2>
        <p class="mb-4">
            For questions or concerns about this policy, please contact us at 
            <a href="mailto:support@yourdomain.com" class="text-blue-600 underline">support@yourdomain.com</a>.
        </p>

        <footer class="text-center text-gray-600 text-sm py-4">
            <a href="{{ route('privacy.policy') }}" class="hover:underline">Privacy Policy</a> |
            <a href="{{ route('data.deletion') }}" class="hover:underline">Data Deletion Request</a>
        </footer>
    </div>
</body>
</html>
