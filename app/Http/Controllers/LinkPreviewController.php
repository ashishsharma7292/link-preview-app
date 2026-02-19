<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LinkPreviewController extends Controller
{
    public function preview(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $url = $request->url;

        // Security: Block internal IPs (basic SSRF protection)
        if ($this->isInternalUrl($url)) {
            return response()->json([
                'error' => 'Invalid URL'
            ], 422);
        }

        try {

            $response = Http::timeout(10)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0'
                ])
                ->get($url);

            if (!$response->successful()) {
                return response()->json([
                    'error' => 'Unable to fetch URL'
                ], 400);
            }

            $html = $response->body();

            $meta = $this->extractMetaData($html, $url);

            return response()->json($meta);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong'
            ], 500);
        }
    }

    private function extractMetaData($html, $url)
    {
        $doc = new \DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($doc);

        $meta = [
            'title' => null,
            'description' => null,
            'image' => null,
            'url' => $url,
        ];

        // Open Graph
        $tags = [
            'og:title' => 'title',
            'og:description' => 'description',
            'og:image' => 'image',
            'og:url' => 'url',
        ];

        foreach ($tags as $property => $key) {
            $nodes = $xpath->query("//meta[@property='$property']");
            if ($nodes->length > 0) {
                $meta[$key] = $nodes->item(0)->getAttribute('content');
            }
        }

        // Fallback title
        if (!$meta['title']) {
            $titleNodes = $doc->getElementsByTagName('title');
            if ($titleNodes->length > 0) {
                $meta['title'] = $titleNodes->item(0)->nodeValue;
            }
        }

        // Fallback description
        if (!$meta['description']) {
            $descNodes = $xpath->query("//meta[@name='description']");
            if ($descNodes->length > 0) {
                $meta['description'] = $descNodes->item(0)->getAttribute('content');
            }
        }

        return $meta;
    }

    private function isInternalUrl($url)
    {
        $host = parse_url($url, PHP_URL_HOST);

        $ip = gethostbyname($host);

        return filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        ) === false;
    }
}