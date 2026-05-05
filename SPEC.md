# SPEC — Portal JPPH (Tender Prototype)

**Date:** 2026-05-05
**Stage:** 1 — Scope (output of `superpowers:brainstorming`)
**Reads with:** `CONSTRAINTS.md`, `STATE.md`

---

## 1. Purpose

One-day working prototype of the rebuilt JPPH Portal for tender submission. Goal: visual flagship + 3 backend features wired to MySQL, used to win the bid for the full 12+12 month build defined in `LAMPIRAN T`.

---

## 2. Users & Wedge

All four personas are **first-class** (no single wedge — multi-audience by mandate of PPPA 3.3 audience segmentation).

| Persona | Primary tasks | Where they land |
|---------|---------------|-----------------|
| **Rakyat** (general public) | Check case status, calculate stamp duty, find branches, read announcements | Homepage → Status microsites + Calculator |
| **Profesional** (lawyer / bank valuer / agent) | NAPIC links, technical publications, valuer registry | Homepage (Profesional tab) → Perkhidmatan Teras |
| **Warga JPPH** (internal staff) | myJPPH login, internal tools, content authoring | `/login` → `/admin` (Filament) |
| **Penyelidik** (researcher / student) | Open data, publications, training | Homepage (Penyelidik tab) → Penerbitan |

Audience switcher on homepage re-filters cards per persona (PPPA 3.3.j).

---

## 3. Pain Killed (priority order)

1. **Visual obsolescence** (E) — top priority. Rebuild looks 2026, not 2018. MYDS skeleton + Stripe-tier polish on hero/dashboards/landings.
2. **Fragmented data** (B) — case-status microsites, NAPIC, Carian Cawangan currently scattered across `jpph-backend.jpph.gov.my` + `napic.jpph.gov.my`. Prototype demonstrates unified UX (single domain, single login spine).
3. **Stale CMS** (C) — Filament admin proves bahagian-level content authoring without dev intervention.
4. **Poor IA** (D) — 49 flat nav links → audience-segmented homepage tiles + faceted nav.

A (perf), F (a11y), G (security signal) treated as mandatory floors per PPPA, not differentiators — but still implemented (WCAG AA contrast, OKU mode, HTTPS-ready, audit log stub).

---

## 4. Scope: 1-day Prototype

### In scope

- 6 polished public screens + 1 admin (Filament) panel
- 3 backend features wired to MySQL:
  - **(a)** Status Kes Duti Setem — lookup form → DB query → result card
  - **(b)** Status Kes Pinjaman Perumahan — same pattern, different table
  - **(c)** Login + Filament CMS — Pages + Announcements + Faqs CRUD, role-gated
- 1 working calculator (Pengiraan Duti Setem) — Akta Setem 1949 First Schedule
- 1 chatbot widget — UI complete, answers from `faqs` table (no LLM call)
- BM/EN language toggle
- OKU accessibility mode toggle
- Localhost-only target (`php artisan serve`, screen-share for tender)

### Out of scope (explicit cut for 1 day)

- Multi-tenant SSO across subdomains
- Production deploy / CI / CD
- Real LLM-powered chatbot
- NAPIC live integration
- Mobile app
- Content migration from current portal (defer to Stage 7+)
- Penetration test / SPLaSK audit
- Email/SMS subscriptions
- IDN auth integration
- e-Penyertaan modules
- Currency/tax engine beyond Akta Setem First Schedule

---

## 5. Architecture

```
Browser
  ├─ Tailwind 3 + MYDS components + JPPH skin
  ├─ Livewire 3 islands (status forms, charts, chatbot widget)
  └─ Alpine.js for micro-interactions
        │ HTTP localhost:8000
        ▼
Laravel 11 (PHP 8.3)
  ├─ Routes: web.php (public + auth groups)
  ├─ Livewire components (interactive)
  ├─ Filament 3 panel @ /admin (CMS)
  ├─ Laravel Breeze blade auth
  └─ Eloquent models
        │ PDO
        ▼
MySQL 8 (local)
  Tables: users · cases_duti_setem · cases_pinjaman_perumahan
        · pages · announcements · faqs · audit_log
```

**Stack rationale:**

- **Laravel 11 + Livewire 3** — SSR + reactivity without React/Vue toolchain, fast for 1-day delivery.
- **Filament 3** — admin out of the box, sells the CMS claim with zero CSS effort.
- **Breeze** — simplest auth scaffold; can swap to Sanctum for production.
- **Tailwind 3 + Alpine** — utility-first matches MYDS philosophy; Alpine handles parallax/carousel without extra JS framework.

**Module boundaries:**

- `app/Livewire/Public/` — homepage, status, dashboard, calculator, chatbot
- `app/Filament/Resources/` — admin CMS resources
- `app/Models/` — `User`, `CaseDutiSetem`, `CasePinjamanPerumahan`, `Page`, `Announcement`, `Faq`, `AuditLog`
- `resources/views/components/` — MYDS-styled blade components
- `database/seeders/` — realistic Malaysian demo data

---

## 6. Screen map

| # | Route | Type | Purpose |
|---|-------|------|---------|
| 1 | `/` | Livewire | Homepage — hero, audience switcher, announcements carousel, microsite tiles, 4 PPPA links top-right, MyGov + Data Terbuka footer links |
| 2 | `/dashboard-statistik` | Livewire | Public dashboard — KPI tiles + 2 charts + Malaysia choropleth (fake data, real Chart.js + d3) |
| 3 | `/microsite/status-duti-setem` | Livewire | **Backend (a)** — case ref → DB lookup → status timeline result |
| 4 | `/microsite/status-pinjaman-perumahan` | Livewire | **Backend (b)** — same pattern, different table |
| 5 | `/microsite/pengiraan-duti-setem` | Livewire | Calculator — live `wire:model.live` compute, Akta Setem 1949 schedule |
| 6 | `/login` | Breeze | Standard login form |
| 7 | `/admin` | Filament | **Backend (c)** — CMS: Pages + Announcements + Faqs CRUD, Cases (read-only) |
| 8 | (FAB) `/sembang` | Livewire | Floating chatbot widget — answers from `faqs` |

---

## 7. Components

### MYDS-aligned base (`resources/views/components/`)

`button` (primary/secondary/ghost) · `card` · `hero` · `nav` · `audience-switcher` · `announcement-carousel` · `chart` · `chatbot-fab`

### Forms

`case-lookup-form` (shared between status-duti-setem + status-pinjaman, swappable model) · `result-card` (status badge + timeline)

### JPPH-specific

`property-stat-tile` (RM value + delta + sparkline) · `microsite-card` · `footer` (Jata Negara + Dasar + MyGov + Data Terbuka)

### Filament resources

- `PageResource` — full CRUD with TipTap rich-text editor
- `AnnouncementResource` — CRUD with image upload + expiry
- `FaqResource` — Q&A pairs (BM + EN)
- `CaseDutiSetemResource` — read-only viewer
- `CasePinjamanPerumahanResource` — read-only viewer
- Dashboard widget: case counts by status

---

## 8. Database schema

```sql
users (id, name, email, password, email_verified_at,
       role ENUM('super_admin','pentadbir_kandungan','staff'),
       timestamps)

cases_duti_setem (
  id, no_rujukan VARCHAR(32) UNIQUE,           -- JPPH/DS/YYYY/NNNNN
  pemohon_nama, pemohon_ic,                    -- IC masked on display
  jenis_pindahmilik ENUM('jual_beli','hadiah','pewarisan','lain'),
  nilai_hartanah_rm DECIMAL(15,2),
  status ENUM('diterima','dalam_semakan','diluluskan','ditolak','menunggu_dokumen'),
  tarikh_terima DATE, tarikh_kemaskini DATE,
  pegawai_penilai, cawangan, catatan, timestamps
)

cases_pinjaman_perumahan (
  id, no_rujukan VARCHAR(32) UNIQUE,           -- JPPH/PP/YYYY/NNNNN
  pemohon_nama, bank, alamat_hartanah,
  nilai_pasaran_rm DECIMAL(15,2) NULL,
  status ENUM('diterima','dalam_penilaian','siap_laporan','dihantar_bank'),
  tarikh_terima DATE, tarikh_siap DATE NULL,
  pegawai_penilai, timestamps
)

pages (id, slug, title_bm, title_en, body_bm LONGTEXT, body_en LONGTEXT,
       published BOOL, updated_by FK→users, timestamps)

announcements (id, title_bm, title_en, excerpt_bm, excerpt_en,
               image_path, published_at, expires_at NULL, timestamps)

faqs (id, question_bm, question_en, answer_bm, answer_en,
      category, sort_order, timestamps)

audit_log (id, user_id FK, action, model, model_id,
           changes JSON, ip, created_at)
```

### Seed data

- `UserSeeder` — 3 users (super_admin / pentadbir_kandungan / staff)
- `CaseDutiSetemSeeder` — 30 cases, mixed status, realistic Malaysian names + amounts
- `CasePinjamanPerumahanSeeder` — 25 cases, mixed banks (Maybank, CIMB, RHB, Bank Islam, Public Bank)
- `PageSeeder` — Visi/Misi, Latar Belakang, Hubungi Kami, Dasar Privasi (BM + EN)
- `AnnouncementSeeder` — 5 items, 1 expired (proves expiry filter)
- `FaqSeeder` — 20 Q&A pairs covering property/valuation/duti setem/pinjaman

---

## 9. Data flows

**Status lookup (a/b):**
```
Form submit (Livewire wire:submit)
  → validate no_rujukan format
  → CaseDutiSetem::where('no_rujukan', $ref)->first()
  → mask pemohon_ic (chars 1-6 + ****** + last 4)
  → render <result-card> partial with status badge + timeline
  → if not found, inline "Rujukan tidak dijumpai" w/o page reload
```

**Calculator:**
```
wire:model.live on input → compute() on every change
  Akta Setem 1949 First Schedule:
    First RM 100,000      → 1%
    Next  RM 400,000      → 2%
    Next  RM 500,000      → 3%
    Above RM 1,000,000    → 4%
  → display total + breakdown table, no DB write
```

**Chatbot:**
```
User types → wire:submit
  → Faq::whereFullText(['question_bm','question_en'], $msg)->limit(3)
  → if hit: top answer
  → if miss: scripted fallback "Sila hubungi cawangan terdekat" + Carian link
```

**CMS edit (Filament):**
```
Login (Breeze) → role middleware → /admin
  → PageResource form save → Eloquent update
  → audit_log row inserted on saved hook
  → public reads via cache (5 min TTL)
```

### Validation + error handling

- All forms use Laravel FormRequest / Livewire `rules()` validation
- Status lookup: 404 result inline (not HTTP 404), keeps page state
- Calculator: numeric input sanitized, rejects negatives + non-numeric
- CMS: Filament built-in + role middleware (super_admin can edit users; pentadbir_kandungan can edit pages/announcements/faqs only)
- DB errors: Laravel debugbar in local; production-mode generic 500 page

---

## 10. Visual system

### Tokens

**Colors (PPPA ≤3 mandate)**
| Role | Hex | Use |
|---|---|---|
| Primary — JPPH Navy | `#0A2540` | Header, hero, primary buttons, charts |
| Accent — Govt Gold | `#C9A227` | CTAs, status badges, highlights |
| Surface — White | `#FFFFFF` | Page background |
| Neutrals (system, not counted) | `#F5F7FA` `#E6EAF0` `#94A3B8` `#1E293B` | Borders, muted text, dividers |
| Semantic (system) | green `#16A34A` · amber `#D97706` · red `#DC2626` | Status badges only |

**Typography:** Inter (UI/body), Plus Jakarta Sans (hero headlines). Tailwind sizes 12/14/16/18/24/32/48/64. Letter-spacing -0.02em on headlines.

**Spacing:** 4/8/12/16/24/32/48/64/96 (Tailwind scale).

**Radius:** 8 (cards) / 12 (panels) / 999 (pills).

**Shadow:** `0 1px 2px rgba(10,37,64,.06)` baseline; `0 12px 40px -12px rgba(10,37,64,.18)` for elevated.

**Motion:** ease `cubic-bezier(.2,.8,.2,1)`. Hover 150ms. Section reveal 400ms fade+rise via Alpine `x-intersect`. Hero parallax 0.3× scroll. Charts 800ms native ease. All disabled under `prefers-reduced-motion`.

### Hero design (homepage)

- Full-bleed navy `#0A2540` with radial mesh gradient + faint SVG noise overlay
- Plus Jakarta Sans 64px bold tagline: "Perkhidmatan Bernilai, Komitmen Kami."
- Floating "live case stats" card (depth shadow + 3deg tilt-on-hover via Alpine) — Stripe-style
- Search bar routes to either microsite based on detected ref pattern (`/^JPPH\/(DS|PP)\//`)
- Audience switcher pills below

### Dashboard polish

- 4 KPI tiles (RM value + ↑/↓ delta + 30-day sparkline)
- Line chart: monthly transactions
- Bar chart: regional split
- Choropleth: Malaysia state heat (D3 + topojson)
- Navy + gold palette throughout

### Microsite landing polish

- 200px compact hero (navy + breadcrumbs)
- Form card centered, max-w-2xl, soft elevation
- Result slides in (200ms fade+rise) with status badge
- Status timeline: vertical, green check / amber dot / gray future

### Chatbot widget

- 56×56 FAB, navy bg, gold AI sparkle, bottom-right 24px
- Open: 380×560 panel, slides up from FAB
- Bubble in/out: navy (user) / gray-50 (bot), 12px radius
- Typing indicator: 3 bouncing dots

### Accessibility (PPPA-mandated)

- Contrast ratios verified: navy/white 14.7:1 (AAA), gold/navy 7.2:1 (AAA), gold/white 2.8:1 → **gold restricted to dark surfaces**
- OKU mode toggle: 1.25× base font + high-contrast yellow/black palette
- Keyboard focusable everything + 2px gold focus ring
- Skip-to-content link
- Alt text on every image (CMS field)
- `prefers-reduced-motion` disables parallax + reveal animations
- `<html lang>` swaps with BM/EN toggle

---

## 11. Build sequence (1-day cascade, prioritized)

| Hr | Task |
|---|---|
| 0–0.5 | `composer create-project laravel/laravel portal-jpph` + `.env` + MySQL DB create + `php artisan migrate` |
| 0.5–1 | Install Tailwind 3, Livewire 3, Filament 3, Breeze; publish + register |
| 1–2 | Migrations (8 tables) + Models + Seeders |
| 2–3 | Breeze auth + role middleware + admin redirect |
| 3–4 | Filament panel + 4 resources |
| 4–5 | Tailwind config tokens (navy/gold), fonts, base layout (nav + footer) |
| 5–7 | Homepage hero + audience switcher + announcement carousel + microsite tiles |
| 7–8 | Dashboard: 4 KPI tiles + 2 charts + map |
| 8–9 | Status Kes Duti Setem Livewire component |
| 9–9.5 | Status Kes Pinjaman Perumahan (clone of above) |
| 9.5–10.5 | Pengiraan Duti Setem calculator |
| 10.5–11 | Chatbot FAB + panel + Faq query |
| 11–12 | Polish: motion, hover states, mobile responsive sweep, OKU toggle |

### Cut order if behind schedule

1. OKU toggle
2. Choropleth map (swap for second bar chart)
3. Chatbot (static "Coming soon" panel)
4. Status Kes Pinjaman (ship Duti Setem only)
5. Calculator (form-only, math TBD)
6. Filament admin (login screen only)

### Floor (must-ship)

Homepage hero + Status Kes Duti Setem + login + MySQL live + 1 chart.

---

## 12. Demo flow (tender screen-share script)

1. Open `/` — hero loads with subtle motion. Tagline. "JPPH Portal v2026."
2. Click audience: Rakyat — homepage tiles re-filter. "PPPA 3.3 audience segmentation."
3. Open Status Duti Setem — paste `JPPH/DS/2026/00123`, submit. Result card slides in. "Real MySQL Eloquent query, sub-100ms."
4. Open chatbot — type "berapa duti setem rumah RM500k". Bot answers from FAQ. "Domain-trained, AI-LLM upgrade ready."
5. Open `/dashboard-statistik` — charts animate. "Real-time interactive dashboard, LAMPIRAN T row 26."
6. Open Pengiraan Duti Setem — type RM 750,000, jenis = jual_beli. Live result. "Akta Setem 1949."
7. Login `/login` — admin@jpph.demo / Demo!2026 → `/admin`.
8. Edit a Page in Filament — change a sentence, save, refresh public — change visible. "Self-service CMS."
9. Lang toggle BM↔EN — site reflows. "BM primary, LAMPIRAN T row 35."
10. OKU mode — top-bar toggle, font scales, contrast switches. "WCAG AA, OKU compliance."

---

## 13. Risks + mitigations

| Risk | Likelihood | Impact | Mitigation |
|---|---|---|---|
| Filament setup eats > 1 hr | Med | High | Follow Filament quick-start; pre-cache `composer install` |
| MySQL local not configured | Low | Critical | Verify XAMPP/WAMP/native MySQL up before hr 0 |
| Tailwind + Livewire asset pipeline fights | Low | Med | `npm run build` once; ship compiled CSS; no Vite dev mode in demo |
| Chart.js + Livewire SSR mismatch | Med | Low | Lazy-init in Alpine `x-init`; no SSR data injection |
| OKU mode breaks layout | Low | Low | Feature flag; demo only if working |
| Chatbot looks fake | Med | Med | Pre-seed 10 demo-ready Q&A; canned friendly fallback |
| 12-hr blow-out | High | Critical | Cut order above; floor scope ships by hr 8 |
| Demo data feels fake | Med | Med | Realistic Malaysian names + branches + bank names |
| Charts unstyled | Med | High | Theme Chart.js with navy + gold from tokens.js |

---

## 14. Testing (1-day light)

- Manual click-through of demo script before submit
- 1 Pest feature test per backend feature:
  - `it("looks up case by reference")` × 2 (DS + PP)
  - `it("computes duti setem correctly")`
  - `it("admin can edit page and audit_log row created")`
  - `it("non-super-admin blocked from /admin/users")`
- No frontend / e2e tests (cut)
- Browser verify: Chrome + Edge + Firefox + Safari mobile (Edge dev tools)

---

## 15. Compliance trace (LAMPIRAN T → SPEC)

| LAMPIRAN T row | Mandate | Where addressed |
|---|---|---|
| AM-1..7 | Open standards, source = govt IPR, info security | Architecture §5; audit_log; .env not committed |
| 23 | Responsive design | Tailwind responsive utilities; sweep in build hr 11 |
| 24 | Homepage structure | §6 screen 1; §10 hero design |
| 25 | 4 components: design + function + content + security | All 4 sections covered |
| 26 | Real-time interactive dashboard | §6 screen 2 |
| 27 | Chatbot | §6 screen 8 |
| 31 | SSO | Single Breeze login governs admin + (future) microsite auth |
| 32 | CMS w/ role-based admin | §7 Filament; §8 users.role |
| 33 | WAF + OWASP Top 10 | Production-only; CSRF (Laravel native) + input validation cover demo |
| 35 | BM primary + EN | §10 lang toggle |
| 36 | W3C accessibility | §10 OKU mode + contrast |
| 38 | CMS without code changes | §6 screen 7 |
| 39 | Multi-device + multi-browser | §14 browser verify |
| 41 | PPPA Bil.1/2025 compliance | §3 + §10 PPPA-mandated rules |
| 42 | VM in PDSA (deferred) | Out of scope for 1-day localhost; design supports |
| 43 | Open-source platform | Laravel + MySQL ✓ |

---

## 16. Open items (post-prototype)

- TenderAI (Yusra) loop for ePerolehan + Lampiran handling — Stage 7+
- Full content migration (49+ pages) — Stage 7+
- VM deployment + PDSA onboarding — post-tender-award
- Real LLM chatbot wiring (Claude/Gemini API or local Ollama)
- IDN auth integration
- SPLaSK pre-audit checklist
- Penetration test + Security Posture Assessment
- Email/SMS subscription (PPPA 3.3.l)
- e-Penyertaan e-Information / e-Consultation / e-Decision

---

## Sources

- `CONSTRAINTS.md`
- `STATE.md`
- `reference/PPPA-extracted.txt` (BAB 3, 4, 6 mandates)
- `reference/LAMPIRAN-T-extracted.txt` (75 compliance rows)
- `reference/scrape/sitemap.json` (49-link IA from current portal)
- `reference/scrape/announcements.json` (homepage carousel)
- `assets/jpph-logo-512.png`, `jata-negara.png`
