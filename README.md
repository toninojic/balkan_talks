# BalkanTalks WordPress tema

Moderna custom WordPress tema za BalkanTalks sa fokusom na sadržaj, korisničke profile i dinamičko učitavanje postova.

---

## Sadržaj
- [1. Šta je BalkanTalks tema?](#1-sta-je-balkantalks-tema)
- [2. Tehnologije i alati](#2-tehnologije-i-alati)
- [3. Arhitektura (MVC pristup)](#3-arhitektura-mvc-pristup)
- [4. Struktura projekta](#4-struktura-projekta)
- [5. Instalacija](#5-instalacija)
- [6. Razvojni workflow](#6-razvojni-workflow)
- [7. Shortcode-ovi](#7-shortcode-ovi)
- [8. AJAX “Load more”](#8-ajax-load-more)
- [9. Custom polja korisnika](#9-custom-polja-korisnika)
- [10. Build front-end asseta](#10-build-front-end-asseta)
- [11. Debug i troubleshooting](#11-debug-i-troubleshooting)
- [12. Predlozi za sledeći korak](#12-predlozi-za-sledeci-korak)

---

## 1. Sta je BalkanTalks tema?

BalkanTalks je custom WordPress tema koja:
- prikazuje klasičan blog sadržaj (postove po kategorijama i tagovima),
- ima shortcode sistem za post loop i profile autora/saradnika,
- podržava AJAX učitavanje dodatnih postova,
- dodaje custom user meta polja za prikaz korisnika u tim sekcijama.

Tema koristi kombinaciju WordPress template hijerarhije i modularnog PHP koda organizovanog oko MVC ideje.

---

## 2. Tehnologije i alati

- **WordPress (PHP)** – runtime i CMS
- **Composer** – PSR-4 autoload za `src/` klase
- **SCSS + Grunt** – kompilacija stilova
- **Vanilla JS + WordPress AJAX** – dinamičko učitavanje postova

---

## 3. Arhitektura (MVC pristup)

Iako WordPress nije striktno MVC framework, kod je refaktorisan da prati MVC princip gde je to praktično:

### Model (`src/Models`)
Model sloj je zadužen za pripremu i sanitizaciju podataka.

- `PostQueryModel`:
  - gradi `WP_Query` argumente,
  - sanitizuje filtere (`category`, `tag`, `offset`, `posts_per_page`),
  - validira dozvoljene layout opcije.
- `UserProfilesModel`:
  - vraća korisnike po user meta roli,
  - uklanja duplikate korisnika po ID-u.

### View (`src/Views` + template fajlovi)
View sloj renderuje HTML.

- `TemplateRenderer` obezbeđuje centralizovan način renderovanja:
  - WordPress template part-ova,
  - običnih PHP view fajlova (npr. admin user fields view).
- Fizički markup ostaje u:
  - `global-templates/*`
  - `loop-templates/*`
  - `src/Admin/views/*`

### Controller (`src/Controllers`, `src/Shortcodes`, `src/Modals`)
Controller sloj povezuje WordPress hook-ove sa modelima i view-evima.

- `LoadMore` – AJAX endpoint
- `ThemeSupportController` – registracija theme support opcija i sidebara
- `Enqueue` – registracija/enqueue CSS/JS fajlova
- `Redirections` – mesto za custom redirect logiku
- `PostsLoop` / `UserProfiles` – shortcode kontroleri
- `UserMetaFields` – admin profil polja

### Bootstrap (`functions.php`, `src/MainLoader.php`)
- `functions.php` učitava Composer autoload i startuje `MainLoader`.
- `MainLoader` registruje sve shortcode i controller instance.

---

## 4. Struktura projekta

```text
.
├── functions.php
├── src
│   ├── MainLoader.php
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   ├── Shortcodes/
│   ├── Modals/
│   └── Admin/views/
├── global-templates/
├── loop-templates/
├── assets/public/src/scss/
├── assets/public/dist/
├── style.css
├── composer.json
├── package.json
└── Gruntfile.js
```

---

## 5. Instalacija

### Preduslovi
- PHP 8.0+
- WordPress instalacija
- Composer
- Node.js + npm

### Koraci
1. Kloniraj repo u `wp-content/themes/balkan_talks`.
2. Instaliraj PHP zavisnosti:
   ```bash
   composer install
   ```
3. Instaliraj JS/SCSS zavisnosti:
   ```bash
   npm install
   ```
4. Build stilova:
   ```bash
   npm run grunt
   ```
5. Aktiviraj temu u WordPress admin panelu (`Appearance > Themes`).

---

## 6. Razvojni workflow

Tipičan tok rada:
1. Dodaj/izmeni logiku u `Model` klasi.
2. Pozovi model iz odgovarajućeg controller-a.
3. Renderuj postojeći template preko `TemplateRenderer`.
4. Po potrebi ažuriraj SCSS i pokreni build.
5. Testiraj shortcode/AJAX tok u browseru.

---

## 7. Shortcode-ovi

### `[custom_category_loop]`
Prikazuje listu postova filtriranu po kategoriji ili tagu.

**Parametri:**
- `category` (string)
- `tag` (string)
- `posts_per_page` (int, default `6`)
- `layout` (`default|swiper|featured|stacked`)

**Primer:**
```text
[custom_category_loop category="news" posts_per_page="6" layout="featured"]
```

### `[user_profiles]`
Prikazuje profile korisnika po custom user meta roli.

**Parametri:**
- `role` (default `staff`)

**Primer:**
```text
[user_profiles role="contributors"]
```

---

## 8. AJAX “Load more”

Endpoint: `wp_ajax_load_more_posts` i `wp_ajax_nopriv_load_more_posts`

Ulazni parametri:
- `offset`
- `category`
- `tag`
- `posts_per_page`

Logika:
1. Controller prima request.
2. `PostQueryModel` sanitizuje input i formira query args.
3. Rezultat se renderuje kroz template part.
4. Vraća se `wp_send_json_success($html)`.

---

## 9. Custom polja korisnika

U user profilu u adminu postoje polja:
- `user_profile_image`
- `user_role`

View za admin formu je u:
- `src/Admin/views/user-profile-fields.php`

Persistencija ide preko `update_user_meta` u `UserMetaFields` klasi.

---

## 10. Build front-end asseta

Tema trenutno koristi Grunt samo za SCSS kompilaciju.

```bash
npm run grunt
```

Ulaz:
- `assets/public/src/scss/style.scss`

Izlaz:
- `assets/public/dist/css/style.css`
- `assets/public/dist/css/style.css.map`

---

## 11. Debug i troubleshooting

- Ako klase nisu učitane, proveri `composer install` i autoload.
- Ako stilovi nisu ažurirani, pokreni `npm run grunt`.
- Ako AJAX ne radi, proveri:
  - da je `main-script` enqueue-ovan,
  - da je `data.ajax_url` dostupan u JS-u,
  - da endpoint akcije odgovaraju (`load_more_posts`).

---

## 12. Predlozi za sledeci korak

- Dodati nonce proveru za AJAX (`check_ajax_referer`).
- Uvesti dedicated `Service` sloj za složenije use-case-ove.
- Dodati unit/integration testove za model sanitizaciju.
- Preimenovati folder `Modals` u `Models/Admin` (ili `Admin`) radi konzistentnosti imenovanja.
- Dodati CI pipeline (lint + basic theme smoke test).

---

Ako želiš, sledeći korak može biti i **faza 2 refaktora**: potpuno razdvajanje shortcode kontrolera od WordPress API sloja kroz adapter pattern (što olakšava testiranje van WordPress-a).
