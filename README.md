 Link Preview API Documentation

🔗 Link Preview API
===================

Generate metadata (title, description, image) from any public website URL.

📌 Endpoint
-----------

POST http://127.0.0.1:8000/api/link-preview

📤 Request Body (JSON)
----------------------

{
    "url": "https://example.com"
}

💻 cURL Example
---------------

curl -X POST http://127.0.0.1:8000/api/link-preview \\
-H "Content-Type: application/json" \\
-d '{"url":"https://example.com"}'

✅ Success Response Example
--------------------------

{
    "title": "Example Domain",
    "description": "This domain is for use in illustrative examples in documents.",
    "image": "https://example.com/image.jpg",
    "url": "https://example.com"
}

❌ Error Response Example
------------------------

{
    "error": "Invalid URL"
}

📖 Notes
--------

*   URL must be publicly accessible.
*   OpenGraph metadata is prioritized.
*   Fallback to normal title and meta description if OG tags are missing.
*   Internal/private IP addresses are blocked for security.

Built with ❤️ By Ashish.