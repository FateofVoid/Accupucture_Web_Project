<?php
declare(strict_types=1);

function h(?string $s): string {
  return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}

function load_json_file(string $path): array {
  if (!file_exists($path)) return [];
  $raw = file_get_contents($path);
  $decoded = json_decode($raw ?: '[]', true);
  return is_array($decoded) ? $decoded : [];
}

/**
 * Load shared localization only (localization/shared.json)
 * Returns array for selected language.
 */
function load_shared_localization(string $lang): array {
  $root = __DIR__ . '/../localization';
  $path = $root . '/shared.json';

  // DEBUG (safe: only prints if ?debug=1)
  if (function_exists('dbg')) {
    dbg('Shared path', $path);
    dbg('Shared exists?', file_exists($path) ? 'YES' : 'NO');
    dbg('Shared readable?', is_readable($path) ? 'YES' : 'NO');
  }

  if (!file_exists($path) || !is_readable($path)) return [];

  $raw = file_get_contents($path);
  $decoded = json_decode($raw ?: '[]', true);

  if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
    if (function_exists('dbg')) {
      dbg('Shared JSON ERROR', json_last_error_msg());
    }
    return [];
  }

  if (isset($decoded[$lang]) && is_array($decoded[$lang])) return $decoded[$lang];
  if (isset($decoded['en']) && is_array($decoded['en'])) return $decoded['en'];
  return [];
}

/**
 * Load page localization only (localization/{page}.json)
 * Returns array for selected language.
 */
function load_page_localization(string $lang, string $page): array {
  $root = __DIR__ . '/../localization';
  $path = $root . '/' . $page . '.json';

  if (function_exists('dbg')) {
    dbg('Page JSON path', $path);
    dbg('Page JSON exists?', file_exists($path) ? 'YES' : 'NO');
    dbg('Page JSON readable?', is_readable($path) ? 'YES' : 'NO');
  }

  if (!file_exists($path) || !is_readable($path)) return [];

  $raw = file_get_contents($path);
  $decoded = json_decode($raw ?: '[]', true);

  if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
    if (function_exists('dbg')) {
      dbg('Page JSON ERROR', json_last_error_msg());
    }
    return [];
  }

  if (isset($decoded[$lang]) && is_array($decoded[$lang])) return $decoded[$lang];
  if (isset($decoded['en']) && is_array($decoded['en'])) return $decoded['en'];
  return [];
}

/**
 * Build site page URL
 */
function page_url(string $base_url, string $lang, string $page): string {
  return "{$base_url}/?lang=" . rawurlencode($lang) . "&page=" . rawurlencode($page);
}

/**
 * Build anchor URL on current page
 */
function anchor_url(string $base_url, string $lang, string $page, string $anchor): string {
  return page_url($base_url, $lang, $page) . '#' . rawurlencode($anchor);
}

function safe_html(string $html, string $allowed = '<br><a><strong><em><b><i>'): string {
  return strip_tags($html, $allowed);
}