<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/php/functions.php';
require_once __DIR__ . '/php/debug.php';

$S = load_shared_localization($lang);
$L = load_page_localization($lang, $page);

// allow page templates from root
$template = __DIR__ . '/' . $page . '.php';
if (!file_exists($template)) {
  http_response_code(404);
  $page = 'home';
  $template = __DIR__ . '/home.php';
  $L = load_page_localization($lang, $page);
}

dbg_panel_start('HRT Debug');
dbg('Lang / Page', ['lang'=>$lang, 'page'=>$page]);
dbg('Template file', $template);
dbg('Template exists?', file_exists($template) ? 'YES' : 'NO');

dbg('Shared.json loaded?', !empty($S) ? 'YES' : 'NO');
dbg('Home.json loaded?', !empty($L) ? 'YES' : 'NO');

dbg('Shared keys (top-level)', array_keys($S ?? []));
dbg('Page keys (top-level)', array_keys($L ?? []));

dbg('Hero title', $L['hero']['title'] ?? '(missing)');
dbg_log('Hero title', $L['hero']['title'] ?? '(missing)');
dbg_panel_end();

include __DIR__ . '/php/header.php';
include $template;
include __DIR__ . '/php/footer.php';
