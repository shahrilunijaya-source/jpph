# PLAN — Portal JPPH 1-day Prototype

**Date:** 2026-05-05
**Reads with:** `SPEC.md`, `CONSTRAINTS.md`, `STATE.md`
**Output of:** Stage 4 — `claude-mem:make-plan`
**Stack:** Laravel 11 (PHP 8.2+) · Livewire 3 · Filament 3.3.x · Breeze (blade) · Tailwind 3 · Chart.js 4 · D3 + topojson-client · MySQL 8

Each phase is **independently testable**. Cut order from SPEC §11 still applies if behind schedule.

---

## Phase 0 — Documentation Reference (READ BEFORE BUILDING)

Concrete API references gathered via context7. Copy these patterns; do not invent variants.

### Laravel 11

- **Install:** `composer create-project laravel/laravel portal-jpph` then `cd portal-jpph && php artisan serve`. PHP 8.2+ required. (kernel.php is **gone** — middleware now in `bootstrap/app.php`.)
- **Migration column types:**
  ```php
  $table->id();
  $table->string('no_rujukan', 32)->unique();
  $table->enum('status', ['diterima','dalam_semakan','diluluskan','ditolak','menunggu_dokumen']);
  $table->decimal('nilai_hartanah_rm', total: 15, places: 2);
  $table->json('changes');
  $table->date('tarikh_terima');
  $table->foreignIdFor(User::class)->nullable();
  $table->timestamps();
  ```
- **Eloquent casts (canonical Laravel 11 form):**
  ```php
  protected $fillable = ['no_rujukan','pemohon_nama','status', /* ... */];
  protected function casts(): array {
      return ['tarikh_terima' => 'date', 'tarikh_kemaskini' => 'date'];
  }
  ```
- **Full-text search (chatbot):** `Faq::whereFullText(['question_bm','question_en'], $query)->limit(3)->get()` — MySQL only, requires FULLTEXT index.
- **Routing groups:**
  ```php
  Route::middleware(['auth','role:super_admin,pentadbir_kandungan'])
      ->prefix('admin')->name('admin.')->group(/* ... */);
  ```
- **Middleware in Laravel 11** (`bootstrap/app.php`):
  ```php
  ->withMiddleware(function (Middleware $middleware) {
      $middleware->alias(['role' => \App\Http\Middleware\EnsureUserHasRole::class]);
  })
  ```
- **Cache:** `Cache::remember('cms:home', 300, fn () => Page::where('slug','home')->first())` — 5-min TTL.
- **Pest:**
  ```php
  it('looks up case by reference', function () {
      CaseDutiSetem::factory()->create(['no_rujukan' => 'JPPH/DS/2026/00001']);
      $this->get('/microsite/status-duti-setem?ref=JPPH/DS/2026/00001')
           ->assertOk()->assertSee('diluluskan');
  });
  ```

### Breeze (blade)

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate
npm install && npm run dev
```
Scaffolds `routes/auth.php`, blade views in `resources/views/auth/*`, login at `/login`, `/dashboard`. Note: `/dashboard` will be **renamed** to `/dashboard-statistik` (public stats) since admin lives at `/admin`.

### Livewire 3

- Install: `composer require livewire/livewire`. Bundles Alpine.js — no separate install.
- Layout uses `@livewireStyles` (head) + `@livewireScripts` (body).
- Generate: `php artisan make:livewire Public/CaseLookup`.
- **v3 directive defaults flipped:**
  - `wire:model` is now **deferred by default** (was live in v2)
  - `wire:model.live` for live-as-you-type (replaces v2 default)
  - `wire:model.blur` (replaces `.lazy`)
  - `<form wire:submit>` (no `.prevent` — implicit)
- **Validation (modern attribute form):**
  ```php
  use Livewire\Attributes\Validate;
  #[Validate('required|regex:/^JPPH\/(DS|PP)\/\d{4}\/\d{5}$/')]
  public string $reference = '';
  public function lookup() { $this->validate(); /* ... */ }
  ```
- **Pagination:** `use Livewire\WithPagination` trait.
- **Chart.js inside Livewire (CRITICAL pattern — `wire:ignore`):**
  ```blade
  <div x-data="{ chart: null }"
       x-init="chart = new Chart($refs.canvas, cfg); $watch('data', () => { chart.destroy(); chart = new Chart($refs.canvas, cfg) })"
       wire:ignore>
    <canvas x-ref="canvas" style="height: 320px"></canvas>
  </div>
  ```
  Always destroy before re-init.

### Filament 3.3.x

- Install: `composer require filament/filament:"^3.3" -W` then `php artisan filament:install --panels`.
- Generates `app/Providers/Filament/AdminPanelProvider.php` + registers panel at `/admin`.
- **Disable registration** by omitting `->registration()` in panel provider; **keep** `->login()`.
- Generate resource: `php artisan make:filament-resource Page --view`.
- **Form schema components:**
  ```php
  use Filament\Forms\Components\{TextInput, Textarea, RichEditor, Toggle, FileUpload, Select, DateTimePicker};

  TextInput::make('title_bm')->required()->maxLength(255);
  TextInput::make('title_en')->required()->maxLength(255);
  RichEditor::make('body_bm')->columnSpanFull();
  RichEditor::make('body_en')->columnSpanFull();
  Toggle::make('published')->default(false);
  FileUpload::make('image_path')->image()->directory('announcements')->disk('public');
  DateTimePicker::make('expires_at')->nullable();
  ```
- **Read-only resource** (Cases): override `canCreate()`, `canEdit()`, `canDelete()` returning `false`; in `getPages()` only register `index` + `view` (omit `create`, `edit`).
- **Role-based authorization** on resources:
  ```php
  public static function canViewAny(): bool {
      return auth()->user()?->role === 'super_admin'
          || auth()->user()?->role === 'pentadbir_kandungan';
  }
  ```
- **Stats widget:**
  ```bash
  php artisan make:filament-widget CaseStats --stats-overview
  ```
  ```php
  return [
      Stat::make('Diluluskan', CaseDutiSetem::where('status','diluluskan')->count())->color('success'),
      Stat::make('Dalam Semakan', CaseDutiSetem::where('status','dalam_semakan')->count())->color('warning'),
      Stat::make('Jumlah', CaseDutiSetem::count()),
  ];
  ```
- **Audit log** via Eloquent observer (cleaner than Filament hook):
  ```php
  Page::saved(function (Page $p) {
      AuditLog::create([
          'user_id' => auth()->id(),
          'action' => $p->wasRecentlyCreated ? 'created' : 'updated',
          'model' => Page::class,
          'model_id' => $p->id,
          'changes' => $p->getChanges(),
          'ip' => request()->ip(),
      ]);
  });
  ```

### Tailwind 3

`tailwind.config.js`:
```js
export default {
  content: ['./resources/**/*.blade.php', './resources/**/*.js', './app/**/*.php'],
  darkMode: ['selector', '[data-mode="oku"]'],
  theme: {
    extend: {
      colors: {
        navy: { DEFAULT: '#0A2540', 900: '#0A2540' },
        gold: { DEFAULT: '#C9A227', 500: '#C9A227' },
      },
      fontFamily: {
        sans: ['Inter','system-ui','sans-serif'],
        display: ['"Plus Jakarta Sans"','Inter','sans-serif'],
      },
    },
  },
}
```
`resources/css/app.css`:
```css
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap');
@tailwind base; @tailwind components; @tailwind utilities;
```
Reduced motion: use `motion-safe:` and `motion-reduce:` variants directly. OKU mode: `<html data-mode="oku">` activates `dark:` variant.

### Chart.js 4

```bash
npm install chart.js
```
Bootstrap (in `app.js`):
```js
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);
Chart.defaults.color = '#0A2540';
Chart.defaults.borderColor = 'rgba(10,37,64,0.1)';
Chart.defaults.font.family = 'Inter, system-ui, sans-serif';
```
Always `responsive: true, maintainAspectRatio: false` and parent div with explicit height.

### D3 + topojson

```bash
npm install d3 topojson-client
```
TopoJSON source: <https://github.com/jnewbery/CartogramMalaysia/blob/master/public/data/malaysia-states.topojson>. Place file at `public/data/malaysia-states.topojson`. **Inspect `topo.objects` keys before assuming names.**

### Akta Setem 1949 First Schedule (verified)

Progressive (slab) brackets — NOT flat:
- First RM 100,000 → 1%
- RM 100,001 – 500,000 → 2%
- RM 500,001 – 1,000,000 → 3%
- Above RM 1,000,000 → 4%

### Anti-patterns to avoid

- ❌ `app/Http/Kernel.php` — removed in Laravel 11; use `bootstrap/app.php`
- ❌ `protected $listeners = []` — use `#[On('event')]` attribute
- ❌ `emit()` — use `dispatch()` (Livewire 3)
- ❌ `<form wire:submit.prevent>` — `.prevent` is implicit
- ❌ `wire:model.lazy` — use `wire:model.blur`
- ❌ `wire:model` in Livewire 3 if you want live (it's now deferred by default — use `.live`)
- ❌ Filament 2 `Card::make()` — replaced by `Section::make()`
- ❌ `Chart.js` without `Chart.register(...registerables)` — silent fail
- ❌ Tailwind 2 `purge: []` — use `content: []`
- ❌ Stamp duty flat-rate calc — must apply progressive slabs
- ❌ Re-running `new Chart()` without `.destroy()` first — ghost tooltips

---

## Phase 1 — Bootstrap (hr 0–1)

**Goal:** Laravel app live at `localhost:8000`, all tooling installed, MySQL connected.

### Tasks

1. Verify MySQL 8 running locally. Create DB:
   ```sql
   CREATE DATABASE portal_jpph CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
2. Scaffold Laravel:
   ```bash
   composer create-project laravel/laravel portal-jpph
   cd portal-jpph
   ```
3. Edit `.env`:
   ```
   APP_NAME="Portal JPPH"
   APP_LOCALE=ms
   APP_FALLBACK_LOCALE=en
   DB_DATABASE=portal_jpph
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Install Tailwind (Vite preset already exists in Laravel 11):
   ```bash
   npm install
   npm install -D tailwindcss@3 postcss autoprefixer
   npx tailwindcss init -p
   ```
   Replace `tailwind.config.js` with Phase 0 config. Replace `resources/css/app.css` with Phase 0 css.
5. Install Livewire 3:
   ```bash
   composer require livewire/livewire
   ```
6. Install Filament 3:
   ```bash
   composer require filament/filament:"^3.3" -W
   php artisan filament:install --panels
   ```
   Accept defaults. Note `/admin` route created.
7. Install Breeze (blade):
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install blade
   ```
8. Install Chart.js + D3 + topojson:
   ```bash
   npm install chart.js d3 topojson-client
   ```
9. `php artisan migrate` (Breeze migrations + Filament panel migrations).
10. `php artisan serve` + `npm run dev` in second terminal.

### Verification

- ✅ `curl http://localhost:8000` returns HTML 200
- ✅ `/login` displays Breeze login form
- ✅ `/admin/login` displays Filament login form
- ✅ `php artisan tinker` → `\DB::connection()->getPdo()` returns PDO instance (DB connected)
- ✅ Tailwind class `bg-navy` not yet defined but `bg-blue-500` works on a test page

### Anti-patterns guard

- Don't run `php artisan breeze:install` without specifying `blade` (interactive picker hangs in non-TTY)
- Don't skip `npm install` — Vite needs node modules

---

## Phase 2 — Database schema + seeders (hr 1–2)

**Goal:** All 8 tables migrated. Realistic seed data committed.

### Tasks

1. Create migrations (in this order — FK dependencies):
   ```bash
   php artisan make:migration create_cases_duti_setem_table
   php artisan make:migration create_cases_pinjaman_perumahan_table
   php artisan make:migration create_pages_table
   php artisan make:migration create_announcements_table
   php artisan make:migration create_faqs_table
   php artisan make:migration create_audit_log_table
   php artisan make:migration add_role_to_users_table
   ```
   `users` already exists from Breeze; just add `role` column.

2. Migration bodies — copy from SPEC §8 verbatim. Add FULLTEXT to `faqs`:
   ```php
   $table->fullText(['question_bm','question_en','answer_bm','answer_en']);
   ```

3. Models:
   ```bash
   php artisan make:model CaseDutiSetem -f --seed
   php artisan make:model CasePinjamanPerumahan -f --seed
   php artisan make:model Page -f --seed
   php artisan make:model Announcement -f --seed
   php artisan make:model Faq -f --seed
   php artisan make:model AuditLog -f
   ```
   Each model: set `$fillable`, `casts()` returning enum/date casts.

4. **Realistic Malaysian seed data** (CRITICAL for demo credibility):
   - 30× duti setem cases — names: Ahmad, Siti, Tan, Devi, Wong, Kumar mixed; branches: KL, Pulau Pinang, Johor Bahru, Shah Alam, Kuching, Kota Kinabalu; amounts: RM150k–RM2.5M
   - 25× pinjaman perumahan — banks: Maybank, CIMB, RHB, Bank Islam, Public Bank, Hong Leong, AmBank
   - 5× pages: `latar-belakang`, `visi-misi-objektif`, `hubungi-kami`, `dasar-privasi`, `dasar-keselamatan`
   - 5× announcements (1 expired)
   - 20× faqs covering: duti setem rates, valuation timeline, pinjaman steps, contact info, branches, services
   - 3× users: super@jpph.demo / Demo!2026 (super_admin), admin@jpph.demo / Demo!2026 (pentadbir_kandungan), staff@jpph.demo / Demo!2026 (staff)

5. Add seeder calls to `DatabaseSeeder::run()`. `php artisan migrate:fresh --seed`.

### Verification

```bash
php artisan tinker
>>> CaseDutiSetem::count()           # 30
>>> Faq::whereFullText(['question_bm','question_en'], 'duti')->count()  # >0
>>> User::where('role','super_admin')->first()->email  # super@jpph.demo
```

### Anti-patterns guard

- Don't forget FULLTEXT index — chatbot queries fail without it
- Don't store passwords plain — use `Hash::make()` or `bcrypt()` in seeders
- ENUM in MySQL preferred over string columns for fixed sets (matches SPEC §8)

---

## Phase 3 — Auth + role middleware + Filament admin (hr 2–4)

**Goal:** Login works. `/admin` Filament panel renders with 4 working resources, role-gated.

### Tasks

1. Create role middleware:
   ```bash
   php artisan make:middleware EnsureUserHasRole
   ```
   ```php
   public function handle(Request $request, Closure $next, ...$roles) {
       if (! in_array(auth()->user()?->role, $roles)) abort(403);
       return $next($request);
   }
   ```
   Register alias in `bootstrap/app.php`:
   ```php
   ->withMiddleware(function (Middleware $middleware) {
       $middleware->alias(['role' => \App\Http\Middleware\EnsureUserHasRole::class]);
   })
   ```

2. Configure `AdminPanelProvider`:
   ```php
   ->brandName('JPPH Admin')
   ->login()
   ->colors(['primary' => Color::hex('#0A2540')])
   ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
   ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
   ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
   ->authMiddleware([Authenticate::class, 'role:super_admin,pentadbir_kandungan,staff'])
   // Omit ->registration() — public registration disabled
   ```

3. Generate resources:
   ```bash
   php artisan make:filament-resource Page
   php artisan make:filament-resource Announcement
   php artisan make:filament-resource Faq
   php artisan make:filament-resource CaseDutiSetem --view
   php artisan make:filament-resource CasePinjamanPerumahan --view
   ```

4. Page/Announcement/Faq resource form schema — copy from Phase 0 reference. Both BM + EN fields.

5. Cases resources — read-only (override `canCreate/Edit/Delete` returning `false`; remove `create`/`edit` from `getPages()`).

6. Stats widget:
   ```bash
   php artisan make:filament-widget CaseStats --stats-overview
   ```
   Register in `AdminPanelProvider->widgets([...])`.

7. Audit log observer — register `Page::observe(PageObserver::class)` in `AppServiceProvider::boot()`. Same for `Announcement`, `Faq`.

8. Override Breeze redirect — after login, `super_admin` + `pentadbir_kandungan` redirect to `/admin`; `staff` to `/dashboard-statistik`.

### Verification

- ✅ Login as super@jpph.demo → lands on `/admin`
- ✅ Filament dashboard shows CaseStats widget with case counts
- ✅ Pages CRUD: create new page, save, see in list
- ✅ Announcement CRUD with image upload works
- ✅ Faq CRUD works
- ✅ Cases resource: list visible, "Create" button absent, click row shows view-only details
- ✅ Login as staff@jpph.demo → 403 on `/admin` (or redirected away)
- ✅ Edit a Page → `audit_log` table has new row with `changes` JSON populated

### Anti-patterns guard

- ❌ Don't use Filament 2 `Card::make()` — use `Section::make()`
- ❌ Don't put role check in resource `canViewAny()` AND middleware (double-gate causes confusion); pick middleware

---

## Phase 4 — Design tokens + base layout (hr 4–5)

**Goal:** Public-facing layout with nav + footer, JPPH branding visible. No content yet.

### Tasks

1. Confirm Tailwind config (Phase 0). Run `npm run dev` — verify hot reload.

2. Create `resources/views/layouts/portal.blade.php` (public layout):
   - `<html lang="ms" data-mode="">` (placeholder for OKU toggle)
   - `<head>`: title, meta description, `@vite([...])`, `@livewireStyles`
   - `<body class="font-sans bg-white text-navy">`
   - Skip-to-content link
   - Nav component (top bar) — sticky, white bg, navy text, gold accents
   - `<main>` slot
   - Footer component
   - `@livewireScripts`

3. Create blade components:
   ```bash
   php artisan make:component Nav
   php artisan make:component Footer
   php artisan make:component Button
   php artisan make:component Card
   ```

4. **Nav component:**
   - Left: JPPH logo (use `assets/jpph-logo-512.png` → `public/images/`) + "Portal Rasmi JPPH" text
   - Center: nav menu (Profil / Perkhidmatan / Microsites / Penerbitan / Hubungi)
   - Right: BM/EN toggle, OKU toggle, 4 PPPA links (Soalan Lazim, Hubungi Kami, Aduan, Peta Laman) — with uniform Heroicons icons

5. **Footer component:**
   - Top section: 4-column link grid (Profil, Perkhidmatan, Pautan Luar [MyGov + Data Terbuka MANDATORY], Hubungi)
   - Bottom strip: Jata Negara icon (`assets/jata-negara.png` → `public/images/`) + copyright + Dasar Privasi + Dasar Keselamatan + Penafian + Hak Cipta links
   - All links named per PPPA-Lampiran A3 examples

6. **Button component variants:** `primary` (navy bg, white text), `accent` (gold bg, navy text), `ghost` (transparent + navy border).

7. **Card component:** white bg, soft shadow, rounded-lg, padding-6, optional hover-lift.

### Verification

- ✅ Visit `/` (placeholder route returning layout) — renders nav + footer
- ✅ JPPH logo visible top-left
- ✅ 4 PPPA links visible top-right with icons
- ✅ Footer shows Jata Negara + MyGov + Data Terbuka links
- ✅ Inter + Plus Jakarta Sans fonts loaded (DevTools → Network)
- ✅ `bg-navy` and `bg-gold` Tailwind utilities work
- ✅ Responsive: nav collapses to hamburger below 768px (use Alpine `x-data="{ open: false }"`)

### Anti-patterns guard

- ❌ Don't hardcode PPPA links — use a `config('jpph.pppa_links')` array for reuse
- ❌ Don't use `<img>` without alt — every image needs `alt="..."`
- ❌ Don't forget `aria-current="page"` on active nav item

---

## Phase 5 — Homepage (hr 5–7)

**Goal:** Hero, audience switcher, announcements carousel, microsite tiles. Stripe-tier polish.

### Tasks

1. `php artisan make:livewire Public/Homepage` → `App\Livewire\Public\Homepage`.

2. Add route `Route::get('/', \App\Livewire\Public\Homepage::class)->name('home');` (replace welcome route).

3. **Hero section** (full-bleed):
   - Container: `class="relative bg-navy text-white overflow-hidden min-h-[600px]"`
   - Background: radial gradient mesh via inline SVG + faint noise overlay (data URI SVG)
   - Content grid (2-col):
     - Left: tagline kicker (gold uppercase, tracking-widest) → headline `class="font-display text-6xl md:text-7xl font-bold leading-tight tracking-tight"` "Perkhidmatan Bernilai, Komitmen Kami." → search bar (case ref or property)
     - Right: floating "live case stats" card (white bg, soft shadow, 3deg tilt-on-hover via Alpine)
   - Below hero: audience switcher (4 pills)
   - Motion: `motion-safe:animate-[fade-up_400ms_ease-out]` for staggered reveal

4. **Audience switcher Livewire component:**
   - Public prop `selectedAudience = 'rakyat'`
   - 4 buttons → `wire:click="setAudience('profesional')"`
   - Filters microsite tiles below per audience
   - URL state via `#[Url] public string $audience = 'rakyat'`

5. **Announcement carousel:**
   - Pull `Announcement::where('published_at', '<=', now())->whereNull('expires_at')->orWhere('expires_at','>',now())->limit(5)->get()`
   - Alpine carousel: `x-data="{ idx: 0 }"`, auto-rotate every 5s, prev/next buttons, dot indicators
   - Each slide: image + title + excerpt + date

6. **Microsite tiles grid** (4-6 cards):
   - Status Kes Duti Setem
   - Status Kes Pinjaman Perumahan
   - Pengiraan Duti Setem
   - Carian Cawangan (link only, not built)
   - Data Terbuka NAPIC (external)
   - Sembang JPPH (chatbot trigger)
   Each tile: icon + title + 1-line description + arrow CTA. Hover-lift.

7. **Tagline kicker** "Perkhidmatan Bernilai, Komitmen Kami" pulled from scrape (`reference/scrape/sitemap.json` title).

### Verification

- ✅ `/` renders w/ hero, switcher, carousel, tiles
- ✅ Hero loads under 2s (no jank)
- ✅ Audience switcher tabs change tile filter
- ✅ Carousel auto-rotates
- ✅ Hover on microsite tile lifts 4px with shadow grow
- ✅ Mobile: hero stacks vertical, switcher horizontal scroll
- ✅ Lighthouse contrast check: navy/white passes AAA, gold/navy passes AAA

### Anti-patterns guard

- ❌ Don't use `wire:model` on hero search — use plain Alpine for instant feel; trigger Livewire only on submit
- ❌ Don't lazy-load above-the-fold images
- ❌ Don't bind hero CSS to viewport units that break on iOS Safari (use min-h-screen or fixed px)

---

## Phase 6 — Public dashboard (hr 7–8)

**Goal:** `/dashboard-statistik` shows 4 KPIs + 2 charts + Malaysia choropleth. All animate smoothly.

### Tasks

1. `php artisan make:livewire Public/DashboardStatistik`.
2. Route: `Route::get('/dashboard-statistik', DashboardStatistik::class)->name('dashboard.statistik');` (rename Breeze default).
3. Component pulls aggregate data from DB:
   ```php
   $this->kpis = [
     ['label'=>'Jumlah Kes Bulan Ini', 'value'=>CaseDutiSetem::whereMonth('tarikh_terima', now()->month)->count(), 'delta'=>'+12%'],
     ['label'=>'Nilai Hartanah Dinilai', 'value'=>'RM '.number_format(CaseDutiSetem::sum('nilai_hartanah_rm'), 2), 'delta'=>'+8%'],
     // ...
   ];
   $this->monthlyData = CaseDutiSetem::selectRaw('MONTH(tarikh_terima) as m, COUNT(*) as c')->groupBy('m')->pluck('c','m');
   $this->stateData = CaseDutiSetem::selectRaw('cawangan, COUNT(*) as c')->groupBy('cawangan')->pluck('c','cawangan');
   ```
4. View: 4 `<x-property-stat-tile>` (RM number + delta + sparkline placeholder).
5. **Line chart** — monthly transactions (12 months). Mount Chart.js per Phase 0 pattern, `wire:ignore`.
6. **Bar chart** — top branches by case count.
7. **Malaysia choropleth** — D3 + topojson. Download Malaysia state TopoJSON to `public/data/malaysia-states.topojson`.
8. Theme: navy + gold + neutral-200, no other colors.
9. Animation: chart `animation: { duration: 800, easing: 'easeOutQuart' }`.

### Verification

- ✅ Navigate `/dashboard-statistik` — 4 KPIs visible with deltas
- ✅ Charts animate in, no console errors
- ✅ Choropleth renders Malaysia states; hover shows tooltip
- ✅ All values match DB query results
- ✅ Reduced-motion preference disables chart animation

### Anti-patterns guard

- ❌ Don't fetch chart data via JS `fetch()` — pass via `@json($monthlyData)` blade directive
- ❌ Don't init Chart.js without `Chart.register(...registerables)` — silent fail
- ❌ Don't use map projection without `.fitSize()` — distortion
- ❌ Don't omit `style="height: 320px"` on chart container — chart explodes

---

## Phase 7 — Status microsites (hr 8–9.5)

**Goal:** Status Kes Duti Setem + Status Kes Pinjaman Perumahan microsites — form → DB → result.

### Tasks

1. `php artisan make:livewire Public/StatusDutiSetem` + `Public/StatusPinjamanPerumahan`.
2. Routes:
   ```php
   Route::get('/microsite/status-duti-setem', StatusDutiSetem::class)->name('ms.duti-setem');
   Route::get('/microsite/status-pinjaman-perumahan', StatusPinjamanPerumahan::class)->name('ms.pinjaman-perumahan');
   ```
3. Each component:
   - Public prop `reference` w/ `#[Validate('required|regex:/^JPPH\/(DS|PP)\/\d{4}\/\d{5}$/i')]`
   - `lookup()` method: validate, query, set `$this->result`, set `$this->error` if not found
4. Shared blade component `<x-case-lookup-form :model="..." :prefix="..."/>` — accepts model class + ref prefix.
5. Result card slides in via `motion-safe:animate-fade-up` (custom keyframe in Tailwind config):
   - Status badge top-right (color-coded: success/warning/danger)
   - Timeline of status events (vertical, green check / amber dot / gray future)
   - Masked IC (`maskIc()` helper: `123456-XX-1234` → `123456-**-1234`)
6. Inline 404 result (not page 404) when no match.

### Verification

- ✅ Visit `/microsite/status-duti-setem`, paste `JPPH/DS/2026/00001` (seeded), see result
- ✅ Paste invalid format `ABC123` — see validation error
- ✅ Paste valid format but unknown ref — see "Tiada rekod dijumpai" inline
- ✅ IC displayed masked
- ✅ Status badge color matches status semantics
- ✅ Pinjaman microsite same pattern, hits its table

### Pest test

```php
it('looks up duti setem case by reference', function () {
    \App\Models\CaseDutiSetem::factory()->create([
        'no_rujukan' => 'JPPH/DS/2026/99999',
        'status' => 'diluluskan',
    ]);
    \Livewire\Livewire::test(\App\Livewire\Public\StatusDutiSetem::class)
        ->set('reference', 'JPPH/DS/2026/99999')
        ->call('lookup')
        ->assertSet('result.status', 'diluluskan');
});
```

### Anti-patterns guard

- ❌ Don't expose full IC — always mask
- ❌ Don't use `find()` (assumes id) — use `where('no_rujukan', $ref)->first()`
- ❌ Don't 404-route on miss — keep page state, show inline error

---

## Phase 8 — Pengiraan Duti Setem calculator (hr 9.5–10.5)

**Goal:** `/microsite/pengiraan-duti-setem` — live calculator using progressive Akta Setem 1949 brackets.

### Tasks

1. `php artisan make:livewire Public/PengiraanDutiSetem`.
2. Route: `Route::get('/microsite/pengiraan-duti-setem', PengiraanDutiSetem::class)->name('ms.calc-duti');`.
3. Public props:
   - `nilaiHartanah` (decimal, `wire:model.live.debounce.300ms`)
   - `jenis` (enum: jual_beli, hadiah, pewarisan)
   - Computed `dutiSetem` total + breakdown
4. Calculator logic (Eloquent NOT needed — pure math):
   ```php
   public function getDutiSetemProperty(): array {
       $v = (float) $this->nilaiHartanah;
       $brackets = [
           ['min'=>0,        'max'=>100_000,    'rate'=>0.01],
           ['min'=>100_000,  'max'=>500_000,    'rate'=>0.02],
           ['min'=>500_000,  'max'=>1_000_000,  'rate'=>0.03],
           ['min'=>1_000_000,'max'=>PHP_INT_MAX,'rate'=>0.04],
       ];
       $rows = []; $total = 0;
       foreach ($brackets as $b) {
           if ($v <= $b['min']) break;
           $taxable = min($v, $b['max']) - $b['min'];
           $tax = $taxable * $b['rate'];
           $rows[] = compact('b','taxable','tax') + ['rate_pct' => $b['rate']*100];
           $total += $tax;
       }
       return ['rows' => $rows, 'total' => $total];
   }
   ```
5. View: input field (RM amount, formatted), jenis select, result section showing breakdown table + total RM.
6. Live update via `wire:model.live.debounce.300ms`.
7. **Disclaimer at bottom:** "Pengiraan adalah anggaran. Sila rujuk LHDN untuk pengesahan rasmi."

### Verification

- ✅ Visit `/microsite/pengiraan-duti-setem`
- ✅ Type 750000 → see total RM 17,500 (1%×100k=1000 + 2%×400k=8000 + 3%×250k=7500)
- ✅ Type 50000 → see total RM 500
- ✅ Type 1500000 → see total RM 35,000 (1k+8k+15k+20k×0.04=20k? Let me recompute: 1%×100k=1000, 2%×400k=8000, 3%×500k=15000, 4%×500k=20000 = RM 44,000)
- ✅ Live update without page reload
- ✅ Negative input rejected

### Pest test

```php
it('calculates progressive stamp duty correctly', function () {
    $c = new \App\Livewire\Public\PengiraanDutiSetem();
    $c->nilaiHartanah = 750000;
    expect($c->dutiSetem['total'])->toBe(17500.0);
});
```

### Anti-patterns guard

- ❌ Don't multiply value × top bracket rate — must apply slabs
- ❌ Don't accept negatives or non-numeric — validate
- ❌ Don't use floats for currency in production — for prototype, OK; flag in SPEC §16

---

## Phase 9 — Chatbot widget (hr 10.5–11)

**Goal:** Floating FAB present on every page; opens panel; answers from `faqs` table via full-text search.

### Tasks

1. `php artisan make:livewire ChatbotFab`.
2. Mount in main layout `portal.blade.php` before `</body>`:
   ```blade
   <livewire:chatbot-fab />
   ```
3. Component state:
   - `open` (bool)
   - `messages` array of `['who'=>'user|bot', 'text'=>'...']`
   - `input` string
4. `send()` method:
   ```php
   public function send() {
       $msg = trim($this->input);
       if (! $msg) return;
       $this->messages[] = ['who'=>'user', 'text'=>$msg];
       $hit = Faq::whereFullText(['question_bm','question_en'], $msg)->first();
       $reply = $hit?->answer_bm
                ?? "Maaf, saya belum tahu jawapan. Sila hubungi cawangan terdekat: jpph.gov.my/v3/ms/peta-laman/";
       $this->messages[] = ['who'=>'bot', 'text'=>$reply];
       $this->input = '';
   }
   ```
5. View:
   - 56×56 FAB button bottom-right, `class="fixed bottom-6 right-6 z-40 bg-navy text-gold rounded-full ..."`
   - Open panel: 380×560 sliding from FAB, `wire:transition`
   - Header bar: "Sembang JPPH" + close X
   - Message list (scroll), navy bubble for user, gray-50 for bot, max-w-80%, rounded-xl
   - Input + send button
   - Typing indicator: 3 bouncing dots (Tailwind keyframe `@keyframes bounce-dot`) shown while `wire:loading`
6. Pre-seed FAQ topics for demo: "berapa duti setem rumah RM500k", "berapa lama pinjaman perumahan dinilai", "carian cawangan terdekat", "hubungi JPPH", "fungsi JPPH", "perkhidmatan teras", "sewaan", "tukar syarat tanah".

### Verification

- ✅ FAB visible on every public route
- ✅ Click FAB → panel opens with smooth slide-up
- ✅ Type "duti setem RM500k" → bot answers from FAQ
- ✅ Type "asdfgh" → friendly fallback
- ✅ Closing FAB resets `open` (panel hidden) but keeps message history (session-scoped via `#[Session]` if time permits, otherwise just component state)

### Anti-patterns guard

- ❌ Don't actually call any LLM — pure FAQ lookup. Out of 1-day scope.
- ❌ Don't scroll-jack — let user scroll messages naturally; auto-scroll to bottom on new message via Alpine `$nextTick(() => $el.scrollTop = $el.scrollHeight)`
- ❌ Don't store conversation in DB for prototype (no schema for it; out of scope)

---

## Phase 10 — Polish + responsive + OKU + i18n toggle (hr 11–12)

**Goal:** Mobile sweep, OKU mode toggle, BM/EN toggle, motion polish, final verification.

### Tasks

1. **Responsive sweep** on every screen at 375px / 768px / 1280px:
   - Hero: stacked vertical on mobile
   - Dashboard: 1-col KPIs on mobile, 2-col on tablet
   - Filament admin: works out of box, just verify
   - Microsites: forms full-width on mobile
   - Chatbot panel: full-screen overlay on mobile (`md:w-[380px] md:h-[560px] w-screen h-screen md:rounded-xl rounded-none`)

2. **OKU mode toggle:**
   - Top-bar button toggles `<html data-mode="oku">` via Alpine
   - When `[data-mode="oku"]`: invert palette (yellow text on black), `text-base` → `text-lg`, increase line-height
   - Tailwind `dark:` variants apply (because `darkMode: ['selector', '[data-mode="oku"]']`)
   - Persist choice in localStorage
   - All `dark:` color overrides use the high-contrast yellow/black palette, NOT a typical dark-mode purple/gray

3. **BM/EN toggle:**
   - Top-bar button toggles `app()->setLocale()` via session
   - Backend reads `Page::find(1)->title_{$locale}` — done at component level
   - For static UI strings: use `lang/ms.json` + `lang/en.json` + `__()` helper
   - All key UI strings translated

4. **Motion polish:**
   - Smooth scroll: `html { scroll-behavior: smooth; }`
   - Add `motion-safe:animate-[fade-up_400ms]` to hero, microsite tiles, dashboard KPIs (stagger via Alpine `x-intersect`)
   - All animation respects `prefers-reduced-motion`

5. **404 / 500 pages** — branded with nav + footer, "Surat Maklumat tidak dijumpai" + back link.

6. **Favicon** — convert `assets/jpph-logo-mobile.png` → `public/favicon.ico` (use Pillow if needed, or just use PNG favicon).

7. **Meta tags** — Open Graph image (use hero screenshot), description, theme-color (`#0A2540`).

8. **Final demo dry-run** — execute SPEC §12 demo flow end-to-end. Fix any rough edges.

### Verification (full demo script)

Run through SPEC §12 step-by-step:
1. ✅ `/` hero loads cleanly
2. ✅ Audience switcher filters tiles
3. ✅ Status Duti Setem lookup returns seeded result
4. ✅ Chatbot answers FAQ
5. ✅ Dashboard charts animate
6. ✅ Calculator math correct
7. ✅ Login → admin
8. ✅ Filament Page edit reflects on public site after refresh
9. ✅ BM ↔ EN toggle reflows site
10. ✅ OKU mode toggle changes palette + font size

### Anti-patterns guard

- ❌ Don't ship `npm run dev` build — switch to `npm run build` for production CSS
- ❌ Don't leave `APP_DEBUG=true` for screen-share demo — set to false; production-grade error pages
- ❌ Don't forget to set `APP_URL=http://localhost:8000` in `.env`

---

## Phase 11 — Verification (final)

### Automated tests (Pest)

```bash
php artisan test
```
Required passing:
- ✅ `it("looks up duti setem case by reference")`
- ✅ `it("looks up pinjaman perumahan case by reference")`
- ✅ `it("calculates progressive stamp duty correctly")` (multiple data points: 50k, 750k, 1.5M)
- ✅ `it("admin can edit page and audit_log row created")`
- ✅ `it("non-super-admin blocked from /admin/users")` — adapt route per role config

### Manual checks

- ✅ Demo script executable in <5 minutes screen-share
- ✅ Chrome + Edge + Firefox + Safari mobile (Edge dev tools simulate iOS Safari)
- ✅ Lighthouse run on `/`: Performance ≥80, Accessibility ≥90, Best Practices ≥90, SEO ≥90
- ✅ No JS console errors on any route
- ✅ No PHP `Throwable` in `storage/logs/laravel.log`
- ✅ All seeded users can log in successfully

### Anti-pattern grep checks

```bash
grep -r "wire:model.lazy" resources/        # → no matches (Livewire 3 anti-pattern)
grep -r "wire:submit.prevent" resources/    # → no matches
grep -r "Card::make" app/Filament/          # → no matches (Filament 2)
grep -r "->emit(" app/Livewire/             # → no matches (use ->dispatch())
grep -r "protected \$listeners" app/        # → no matches (use #[On] attribute)
```

### LAMPIRAN T compliance trace (final)

Cross-check SPEC §15 — each row mapped to working code/route. Note any not-yet-built rows (ones in §16 deferred list).

---

## Cut order (if behind schedule)

Apply in this order — drop tasks from latest phase first:

1. **Phase 10:** OKU toggle (ship without)
2. **Phase 6:** Choropleth → swap for second bar chart
3. **Phase 9:** Chatbot → static "Coming soon" panel
4. **Phase 7:** Pinjaman Perumahan → ship Duti Setem only
5. **Phase 8:** Calculator → form-only, math TBD
6. **Phase 3:** Filament admin → login screen only, no resources

### Floor (must-ship at hr 8 max)

- Phase 1 ✅ — Laravel + MySQL live
- Phase 2 ✅ — Schema + seeds
- Phase 3 (partial) — login works
- Phase 4 ✅ — JPPH-branded layout
- Phase 5 ✅ — Homepage hero
- Phase 6 (partial) — 1 chart
- Phase 7 (a only) — Status Duti Setem

---

## Appendix — File tree at end of build

```
portal-jpph/
├── app/
│   ├── Filament/
│   │   ├── Resources/
│   │   │   ├── PageResource.php
│   │   │   ├── AnnouncementResource.php
│   │   │   ├── FaqResource.php
│   │   │   ├── CaseDutiSetemResource.php
│   │   │   └── CasePinjamanPerumahanResource.php
│   │   └── Widgets/CaseStats.php
│   ├── Http/Middleware/EnsureUserHasRole.php
│   ├── Livewire/Public/
│   │   ├── Homepage.php
│   │   ├── DashboardStatistik.php
│   │   ├── StatusDutiSetem.php
│   │   ├── StatusPinjamanPerumahan.php
│   │   ├── PengiraanDutiSetem.php
│   │   └── ChatbotFab.php
│   ├── Models/
│   │   ├── User.php (Breeze + role)
│   │   ├── CaseDutiSetem.php
│   │   ├── CasePinjamanPerumahan.php
│   │   ├── Page.php
│   │   ├── Announcement.php
│   │   ├── Faq.php
│   │   └── AuditLog.php
│   ├── Observers/
│   │   ├── PageObserver.php
│   │   ├── AnnouncementObserver.php
│   │   └── FaqObserver.php
│   └── Providers/Filament/AdminPanelProvider.php
├── bootstrap/app.php  (middleware aliases)
├── database/
│   ├── migrations/   (8)
│   ├── factories/    (matching)
│   └── seeders/      (UserSeeder + 6 data seeders)
├── resources/
│   ├── css/app.css
│   ├── js/app.js   (Chart.register, D3 imports)
│   └── views/
│       ├── layouts/portal.blade.php
│       ├── components/
│       │   ├── nav.blade.php
│       │   ├── footer.blade.php
│       │   ├── button.blade.php
│       │   ├── card.blade.php
│       │   ├── audience-switcher.blade.php
│       │   ├── announcement-carousel.blade.php
│       │   ├── microsite-card.blade.php
│       │   ├── property-stat-tile.blade.php
│       │   ├── case-lookup-form.blade.php
│       │   └── result-card.blade.php
│       └── livewire/public/
│           ├── homepage.blade.php
│           ├── dashboard-statistik.blade.php
│           ├── status-duti-setem.blade.php
│           ├── status-pinjaman-perumahan.blade.php
│           ├── pengiraan-duti-setem.blade.php
│           └── chatbot-fab.blade.php
├── public/
│   ├── images/
│   │   ├── jpph-logo.png
│   │   ├── jata-negara.png
│   │   └── favicon.ico
│   └── data/
│       └── malaysia-states.topojson
├── routes/web.php
├── tailwind.config.js
└── tests/Feature/    (Pest tests)
```
