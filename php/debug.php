<?php
declare(strict_types=1);

/**
 * Debug output is disabled by default in production. To enable it temporarily,
 * set the HRT_DEBUG environment variable to 1 in Plesk and add ?debug=1.
 */
function debug_enabled(): bool {
  return getenv('HRT_DEBUG') === '1'
    && isset($_GET['debug'])
    && hash_equals('1', (string)$_GET['debug']);
}

function dbg(string $label, $value = null): void {
  if (!debug_enabled()) return;

  echo '<div class="dbg-row">';
  echo '<div class="dbg-label">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</div>';

  if ($value !== null) {
    $out = print_r($value, true);
    echo '<pre class="dbg-pre">' . htmlspecialchars($out, ENT_QUOTES, 'UTF-8') . '</pre>';
  }

  echo '</div>';
}

function dbg_log(string $label, $value = null): void {
  if (!debug_enabled()) return;
  $msg = $label . ' :: ' . ($value === null ? '' : print_r($value, true));
  error_log('[HRT DEBUG] ' . $msg);
}

function dbg_panel_start(string $title = 'Debug'): void {
  if (!debug_enabled()) return;
  echo '<style>
    .dbg-panel{position:fixed;right:14px;bottom:14px;z-index:9999;width:min(520px,calc(100vw - 28px));
      max-height:70vh;overflow:auto;background:rgba(255,255,255,.92);border:1px solid rgba(0,0,0,.12);
      border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,.12);padding:12px;font:12px/1.4 ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;}
    .dbg-title{font-weight:700;margin:0 0 8px;}
    .dbg-row{border-top:1px solid rgba(0,0,0,.08);padding-top:8px;margin-top:8px;}
    .dbg-label{color:#111827;margin-bottom:6px;}
    .dbg-pre{white-space:pre-wrap;word-break:break-word;margin:0;color:#111827;}
  </style>';
  echo '<div class="dbg-panel" role="region" aria-label="Debug Panel">';
  echo '<div class="dbg-title">' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</div>';
}

function dbg_panel_end(): void {
  if (!debug_enabled()) return;
  echo '</div>';
}
