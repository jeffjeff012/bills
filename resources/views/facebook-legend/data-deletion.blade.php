<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Deletion Instructions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- or your existing CSS method --}}
</head>
<body class="bg-white text-gray-900">

    {{-- Reuse the same header from welcome page --}}
    @include('partials.header')

    <div class="max-w-2xl mx-auto py-12 px-4">
        <h1 class="text-2xl font-semibold mb-4">Data Deletion Instructions</h1>

        <p class="mb-4">
            If you have signed in using Facebook and wish to delete your account and all related data from our application, follow these steps:
        </p>

        <ol class="list-decimal list-inside mb-4">
            <li>Log in to your account on our website.</li>
            <li>Go to <strong>Account Settings</strong>.</li>
            <li>Scroll down to the <strong>Delete Account</strong> section.</li>
            <li>Click the <strong>Delete Account</strong> button and confirm with your password.</li>
        </ol>

        <p>
            Once confirmed, all your data will be permanently deleted from our system.
        </p>

        <p class="mt-6">
            If you no longer have access to your account, please contact us at 
            <a href="mailto:support@yourdomain.com" class="text-blue-600 underline">support@yourdomain.com</a>.
        </p>
    </div>

    <footer class="text-center text-gray-600 text-sm py-4">
        <a href="{{ route('privacy.policy') }}" class="hover:underline">Privacy Policy</a> |
        <a href="{{ route('data.deletion') }}" class="hover:underline">Data Deletion Request</a>
    </footer>

</body>
</html>
