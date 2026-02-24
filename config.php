<?php
declare(strict_types=1);
session_start();

/**
 * Defaults
 */
$default_lang = 'en';
$default_page = 'home';

/**
 * Feature flags (toggle sections + their assets)
 */
$features = [
  'staff_join_section' => false,   // show Join section on staff page
  // future examples:
  // 'newsletter_banner' => false,
  // 'jobs_page' => false,
];

$featureEnabled = function(string $key) use ($features): bool {
  return !empty($features[$key]);
};

/**
 * Allowed routes
 */
$validLanguages = ['nl', 'en', 'es'];
$validPages = ['home', 'services', 'staff', 'contact', 'contact-success', 'privacy', 'womens-health'];
/**
 * Page titles
 */
$titles = [
  'home' => [
    'en' => 'HENG REN TANG Acupuncture Clinic | Balance Method & Wellness',
    'nl' => 'HENG REN TANG Acupunctuur Kliniek | Balans Methode & Welzijn',
    'es' => 'Clínica de Acupuntura HENG REN TANG | Método Balance y Bienestar'
  ],
  'services' => [
    'en' => 'Treatment Specialties | HENG REN TANG Acupuncture Clinic',
    'nl' => 'Behandelingsspecialisaties | HENG REN TANG Acupunctuur Kliniek',
    'es' => 'Especialidades de tratamiento | Clínica de Acupuntura HENG REN TANG'
  ],
  'staff' => [
    'en' => 'Meet Our Experts | HENG REN TANG Acupuncture Clinic',
    'nl' => 'Ontmoet Onze Experts | HENG REN TANG Acupunctuur Kliniek',
    'es' => 'Conoce a nuestro equipo | Clínica de Acupuntura HENG REN TANG'
  ],
  'contact' => [
    'en' => 'Contact Us | HENG REN TANG Acupuncture Clinic',
    'nl' => 'Contacteer Ons | HENG REN TANG Acupunctuur Kliniek',
    'es' => 'Contacto | Clínica de Acupuntura HENG REN TANG'
  ],
  'contact-success' => [
    'en' => 'Message sent | HENG REN TANG',
    'nl' => 'Bericht verzonden | HENG REN TANG',
    'es' => 'Mensaje enviado | HENG REN TANG'
  ],
  'privacy' => [
    'en' => 'Privacy Policy | HENG REN TANG Acupuncture Clinic',
    'nl' => 'Privacybeleid | HENG REN TANG Acupunctuur Kliniek',
    'es' => 'Política de privacidad | Clínica de Acupuntura HENG REN TANG'
  ],
  'womens-health' => [
    'en' => "Women’s Health | HENG REN TANG Acupuncture Clinic",
    'nl' => "Vrouwengezondheid | HENG REN TANG Acupunctuur Kliniek",
    'es' => "Salud de la mujer | Clínica de Acupuntura HENG REN TANG"
  ]
];


/**
 * Determine base URL (useful for redirects & nav)
 */
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
$base_url = $scheme . '://' . $host . ($scriptDir ? $scriptDir : '');

/**
 * Read incoming params (sanitize)
 */
$lang = isset($_GET['lang']) ? preg_replace('/[^a-z\-]/i', '', (string)$_GET['lang']) : $default_lang;
$page = isset($_GET['page']) ? preg_replace('/[^a-z\-]/i', '', (string)$_GET['page']) : $default_page;

/**
 * Session language
 */
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = $default_lang;
} else if (isset($_GET['lang']) && in_array($lang, $validLanguages, true) && $_SESSION['lang'] !== $lang) {
  $_SESSION['lang'] = $lang;
}
$lang = $_SESSION['lang'];

/**
 * Session page
 */
if (!isset($_SESSION['selectedPage'])) {
  $_SESSION['selectedPage'] = $default_page;
} else if (isset($_GET['page']) && in_array($page, $validPages, true) && $_SESSION['selectedPage'] !== $page) {
  $_SESSION['selectedPage'] = $page;
}
$page = $_SESSION['selectedPage'];

/**
 * Redirect empty query string → canonical URL
 */
if (($_SERVER['QUERY_STRING'] ?? '') === '') {
  header("Location: {$base_url}/?lang={$lang}&page={$page}");
  exit();
}

/**
 * Ensure params are valid (fallback safely)
 */
if (!in_array($lang, $validLanguages, true)) $lang = $default_lang;
if (!in_array($page, $validPages, true)) $page = $default_page;

/**
 * Page title fallback
 */
$page_title = $titles[$page][$lang] ?? ($titles[$page][$default_lang] ?? 'HENG REN TANG');
