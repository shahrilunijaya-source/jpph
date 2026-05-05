# STATE — Portal JPPH

**Updated:** 2026-05-05

## Current Stage

**Stage 0 — DONE.** Inputs read, constraints locked, logos pulled.

**Next: Stage 1 — Scope.**
Run `superpowers:brainstorming` to pin user/wedge/edge cases → write `SPEC.md`.

## Stage Log

| Stage | Status | Output |
|-------|--------|--------|
| 0 — Inputs & Constraints | ✅ done | `CONSTRAINTS.md`, `assets/` (4× logos) |
| 1 — Scope | ✅ done | `SPEC.md` (1-day prototype, MYDS+Stripe-tier, MySQL backend a+b+c) |
| 2 — Reference Design | ⏭ skipped (fast-track) | scrape sitemap covers IA reference |
| 3 — Design System | ⏭ skipped (fast-track) | folded into SPEC §10 |
| 4 — Plan | ✅ done | `PLAN.md` (12 phases, doc-discovered APIs, copy-ready) |
| 5 — Visual Variants | ⏭ skipped (fast-track) | variants happen during Phase 4-5 Tailwind tweaks |
| 6 — HTML Mockup | ⏭ skipped (fast-track) | merged with Phase 4-5 build |
| 7 — Build | ✅ done | Laravel 13 + Livewire 4 + Filament 5 + MySQL prototype shipped at `portal-jpph/` |
| 8 — QA | ✅ done | 9/9 PHPUnit tests pass; Playwright verify of all 6 routes + Filament admin |
| 8 — QA | pending | + PPPA compliance pass + CSO audit |
| 9 — Performance | pending | benchmark + health |
| 10 — Ship | pending | review + ship + deploy + canary |

## Stage 0 Notes

- PPPA PDF: 68 pages extracted via `pypdf` → `reference/PPPA-extracted.txt`. Mandatory rules in BAB 3 (design/function/content), BAB 4 (monitor/security), BAB 6 (MyGovernment alignment).
- LAMPIRAN A: project scope, 12+12 month timeline, modules + microsites list.
- LAMPIRAN T: 75-row tech compliance table extracted via `python-docx` → `reference/LAMPIRAN-T-extracted.txt`. All rows mandatory except "Nilai Tambah".
- SOC (4).xlsx: skeletal pricing sheet, single line-item pointing to LAMPIRAN T.
- Logos: pulled live from `jpph.gov.my` (300/512/mobile PNG) + Jata Negara PNG into `assets/`.
- Design system: **MYDS** (govtechmy/myds) reference baseline. **SPLaSK** (JDN) mandatory eval. PPPA 3.2.2 calls `standard.digital.gov.my` "digalakkan" (recommended).
- No SVG variant of JPPH logo found on official site — PNG only.

## Decisions Locked (2026-05-05)

- **Stack:** Laravel + MySQL ✅
- **Chatbot:** dev fresh (NOT integrate existing JPPH chatbot — build new AI chatbot in scope)
- **Content migration source:** user-supplied scrape of `https://www.jpph.gov.my/v3/ms/`

## Build delivered (1-day prototype)

- **Repo:** `portal-jpph/` (Laravel app inside this project)
- **Stack actually shipped:** Laravel 13.7 · Livewire 4.3 · Filament 5.6 · Breeze 2.4 · Tailwind 4 · Chart.js 4 · MySQL 8.4 (Laragon)
- **Demo accounts:** `super@jpph.demo`, `admin@jpph.demo`, `staff@jpph.demo` (password: `Demo!2026`)
- **Demo refs:** `JPPH/DS/2026/00123` (Duti Setem · diluluskan), `JPPH/PP/2026/00456` (Pinjaman · dihantar bank)

### Routes live (23 routes, all 200)

| Route | Type |
|---|---|
| `/` | Homepage (hero + audience switcher + announcements + 12 microsite tiles + trust strip) |
| `/profil` | Profil Hub (10 numbered cards linking to all profil pages) |
| `/direktori` | Direktori Cawangan (15 branches + filter by negeri + search) |
| `/dashboard-statistik` | Dashboard (4 KPIs + line chart + donut + 2 bar charts, live MySQL) |
| `/microsite/status-duti-setem` | Backend (a) — JPPH/DS/YYYY/NNNNN |
| `/microsite/status-pinjaman-perumahan` | Backend (b) — JPPH/PP/YYYY/NNNNN |
| `/microsite/status-tukar-syarat` | Backend (d) — JPPH/TS/YYYY/NNNNN |
| `/microsite/pengiraan-duti-setem` | Calculator — Akta Setem 1949 progressive slabs |
| `/admin` | Filament panel (CMS Pages/Hebahan/FAQ + read-only Cases ×3) |
| `/login`, `/laman/{slug}` | Breeze + static page reader (13 CMS pages) |
| `/laman/{perutusan-ketua-pengarah,latar-belakang,visi-misi-objektif,peranan-jpph,nilai-prinsip-panduan,perkhidmatan-teras,piagam-pelanggan,carta-organisasi,ketua-pegawai-digital-cdo,logo-jpph,hubungi-kami,dasar-privasi,dasar-keselamatan}` | All 13 CMS-driven pages live, BM/EN switchable |

### Mega-menu navigation

3 grouped dropdowns: **Profil** (Mengenai JPPH × 5 + Pengurusan × 5 + Lihat semua CTA), **Perkhidmatan** (Semakan Status × 3 + Alat & Data × 3), **Hubungi** (Direktori × 3 + Maklumat Tambahan × 3). Mobile collapses to accordion.

### Sembang JPPH chatbot

- Floating FAB on every page
- Welcome message + 4 suggested prompts
- LIKE-search on `faqs` table (BM/EN), keyword fallback
- 20 seeded FAQs covering duti setem, pinjaman, tukar syarat, sewaan, perkhidmatan

### Tests

- 9/9 PHPUnit pass · 12 assertions
- Coverage: case lookup (DS + PP), unknown ref handling, malformed format rejection, IC masking, calculator math (RM500k=9k, RM750k=16.5k, RM1.5M=44k), foreigner flat-rate

### Compliance hits (PPPA Bil.1/2025 + LAMPIRAN T)

- BM (utama) + EN — toggle in nav
- W3C/WCAG: 4 PPPA links top-right (FAQ/Hubungi/Aduan/Peta), OKU mode toggle (high-contrast yellow/black), reduced-motion respect, alt text, focus rings
- Mandatory pautan luar in footer: MyGovernment + Data Terbuka Sektor Awam
- Jata Negara + Logo JPPH on header + footer
- Audit log table populated on Filament edits (Page/Announcement/Faq observers)
- Source code = Govt IPR (open-source stack, no proprietary deps)

## Scrape Ingested

- Source: `https://www.jpph.gov.my/v3/ms/` (homepage, BM)
- Origin: `C:\Users\User\AppData\Local\Temp\skillify-build\` (gstack /skillify build)
- Copied to: `reference/scrape/jpph-homepage.html` (313 KB)
- Parsed:
  - `reference/scrape/sitemap.json` — 49 nav links (full live IA: profil, perkhidmatan teras, status kes microsites, peperiksaan, FAQ, peta laman, dasar privasi, dll.)
  - `reference/scrape/announcements.json` — 2 carousel items (peperiksaan + piagam pelanggan report)
- Tagline: "Perkhidmatan Bernilai Komitmen Kami"
- Backend microsites detected: `jpph-backend.jpph.gov.my/{rpa,query}` — Status Kes Duti Setem / Pinjaman Perumahan / Tukar Syarat, Carian Cawangan / Warga / Negeri.

## Open Items

- TenderAI (Yusra) loop for ePerolehan + lampiran handling — deferred until stage 7+.
- Full content migration (deep crawl of all 49 pages) — defer to Stage 7 build.

## Polish Pass v2 (2026-05-05 PM)

- **Static page redesign** (`resources/views/public/page.blade.php`): reading-progress bar · navy hero w/ orbit-ring icon illustration · per-slug at-a-glance 3-stat strip · prose-jpph body · 2-col sticky right rail (meta · cetak/salin/sembang actions · "Tahukah Anda" tip) · related-pages chip strip · CTA card · decorative wave SVG divider.
- **Conditional diagrams**: visi-misi-objektif → 3 pillar cards (Visi/Misi/Objektif) · nilai-prinsip-panduan → 5-letter pillar tiles (I/A/B/P/K) · carta-organisasi → SVG hierarchy chart (Ketua Pengarah → 5 bahagian) · piagam-pelanggan → 4 KPI cards.
- **`<x-portal.coming-soon-link>` component**: 3 variants (menu / inline / tile) · dim 50% opacity · cursor-help · native `title` tooltip + Alpine hover popup · lock-closed badge · "Akan Datang" / "SOON" pills.
- **Coming-soon items added** (with tooltip "Belum tersedia dalam prototaip ini"): Carian Penilai Bertauliah · Borang Permohonan · ePerolehan JPPH · Tender & Sebut Harga · Sejarah Penilaian Malaysia (profil hub tile) · "Lihat di peta" on direktori cards · ePerolehan in footer Pautan Luar.
- **MyJPPH intranet link**: gold pill in top utility strip (right) → `/login` · gradient card in footer Pautan Luar column · `building-library` icon.
- **Hub polish**: profil-hub + direktori cards now have group-hover gradient glow, gradient icon backplate, gold-dot negeri pill, footer action band on direktori cards, padded numbered cards (01–10).
- **Homepage tile polish**: gradient backplate on icon, hover-scale, gold blur glow, +1 coming-soon ePerolehan tile.
- **Icons added**: lock-closed · building-library · light-bulb · flag · chart-bar · identification · scale · globe-asia · cog-6-tooth.
- **Smoke test**: 22/22 routes 200 (homepage · profil · direktori · 4 microsites · dashboard · login · 13 CMS pages).
