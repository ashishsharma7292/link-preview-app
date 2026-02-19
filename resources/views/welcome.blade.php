<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Link Preview API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="max-w-5xl mx-auto px-6 py-12">

        <!-- Header -->
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-bold text-blue-600 mb-4">
                🔗 Link Preview API
            </h1>
            <p class="text-lg text-gray-600">
                Generate metadata (title, description, image) from any public website URL.
            </p>
        </div>

        <!-- Endpoint Section -->
        <div class="bg-white shadow-lg rounded-2xl p-8 mb-10">
            <h2 class="text-2xl font-semibold mb-4">📌 Endpoint</h2>

            <div class="bg-gray-100 p-4 rounded-lg text-sm font-mono">
                POST http://127.0.0.1:8000/api/link-preview
            </div>
        </div>

        <!-- Request Section -->
        <div class="bg-white shadow-lg rounded-2xl p-8 mb-10">
            <h2 class="text-2xl font-semibold mb-4">📤 Request Body (JSON)</h2>

            <div class="bg-gray-900 text-green-400 p-6 rounded-lg text-sm font-mono overflow-x-auto">
                <pre>{
    "url": "https://example.com"
}</pre>
            </div>
        </div>

        <!-- cURL Example -->
        <div class="bg-white shadow-lg rounded-2xl p-8 mb-10">
            <h2 class="text-2xl font-semibold mb-4">💻 cURL Example</h2>

            <div class="bg-gray-900 text-green-400 p-6 rounded-lg text-sm font-mono overflow-x-auto">
                <pre>curl -X POST http://127.0.0.1:8000/api/link-preview \
-H "Content-Type: application/json" \
-d '{"url":"https://example.com"}'</pre>
            </div>
        </div>

        <!-- Success Response -->
        <div class="bg-white shadow-lg rounded-2xl p-8 mb-10">
            <h2 class="text-2xl font-semibold mb-4">✅ Success Response Example</h2>

            <div class="bg-gray-900 text-green-400 p-6 rounded-lg text-sm font-mono overflow-x-auto">
                <pre>{
    "title": "Example Domain",
    "description": "This domain is for use in illustrative examples in documents.",
    "image": "https://example.com/image.jpg",
    "url": "https://example.com"
}</pre>
            </div>
        </div>

        <!-- Error Response -->
        <div class="bg-white shadow-lg rounded-2xl p-8 mb-10">
            <h2 class="text-2xl font-semibold mb-4">❌ Error Response Example</h2>

            <div class="bg-gray-900 text-red-400 p-6 rounded-lg text-sm font-mono overflow-x-auto">
                <pre>{
    "error": "Invalid URL"
}</pre>
            </div>
        </div>

        <!-- Notes -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
            <h2 class="text-xl font-semibold mb-2">📖 Notes</h2>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                <li>URL must be publicly accessible.</li>
                <li>OpenGraph metadata is prioritized.</li>
                <li>Fallback to normal title and meta description if OG tags are missing.</li>
                <li>Internal/private IP addresses are blocked for security.</li>
            </ul>
        </div>

        <!-- Footer -->
        <div class="text-center mt-12 text-gray-500 text-sm">
            © {{ date('Y') }} Link Preview API | Built with ❤️ By <span class="font-bold text-blue-600">Ashish</span>.
        </div>

    </div>

</body>

</html>
