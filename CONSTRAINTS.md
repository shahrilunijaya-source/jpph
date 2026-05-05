# CONSTRAINTS — Portal JPPH

Locked rules + must-haves derived from PPPA Bil. 1/2025, LAMPIRAN A (latar belakang), LAMPIRAN T (spek teknikal), SOC.

---

## 1. Identity & Branding (PPPA BAB 3.2 + LAMPIRAN A1)

- **Domain:** `gov.my` mandatory.
- **Logo header:** "Portal/Laman Web Rasmi" statement + Jata Persekutuan or official agency logo on every homepage. JPPH = Jata Persekutuan (Federal civil service agency under MOF).
- **Top-right four primary links** (all pages): Soalan Lazim · Hubungi Kami · Aduan dan Maklum Balas · Peta Laman. Same icon set, same position.
- **Two languages:** Bahasa Malaysia (primary) + English (translation). Toggle visible.
- **Colour palette:** ≤ 3 colours. White background recommended.
- **Typography:** Single uniform font/size system across all pages.
- **Icons:** uniform style, ≤ 1 KB each.
- **No content allowed:** third-party advertising (unless MoU + value-add), religious/political/racial issues, govt-image-damaging statements.

## 2. Mandatory Modules / Functions (PPPA 3.3 + LAMPIRAN A para 1.4.4)

Modules to deliver:
- Profil Jabatan · Perkhidmatan Online · Hubungi Kami · Perkhidmatan · Penerbitan · Aktiviti · Maklumat Am · Muat Turun · Pusat Sumber · Sistem Dalaman · Aktiviti Sosial · Sudut IT
- Microsites: Pengiraan Duti Setem, Semakan Status (Pinjaman Perumahan / Duti Setem / Tukar Syarat), Pangkalan Data Loji Jentera Peralatan, Forum Teknikal, Carian Kes Rumit, Akrab, MBJ, Pekip, Upload Data VIS, Sistem Pemantauan Kontrak.

Functional features (PPPA 3.3):
- Site-wide search (every page) + advanced search with prediction.
- FAQ ("Soalan Lazim") page.
- AI Chatbot — JPPH has existing one; integrate.
- Feedback form + auto-acknowledgement w/ reference number.
- User satisfaction survey (post-transaction trigger).
- Hot topics / tag cloud.
- Audience segmentation (rakyat / kerajaan / penyelidik / wartawan / pelajar).
- Hebahan/announcement zone — fallback "Tiada Makluman Terkini".
- Email/SMS subscription for new content matching user's interests.
- Sitemap.
- Mobile version + QR code to mobile.
- e-Penyertaan (e-Information / e-Consultation / e-Decision).
- Open Data datasets (machine-readable, kept current).
- Mandatory external links: **Portal MyGovernment (malaysia.gov.my)** + **Portal Data Terbuka (data.gov.my)**.
- Identiti Digital Nasional (IDN) login support.
- W3C disability accessibility — colour-blind, low-vision (audio), low-hearing (text/graphics for audio), elderly (font-size toggle). WCAG latest.
- Disclaimer · privacy & security policy · copyright notice · client charter · key agency policies.
- Auto-archive content > 1 year (downloadable).
- Content with expiry dates → auto-expire function.

## 3. Mandatory Content (PPPA 3.4)

Maklumat Korporat (Visi/Misi/Fungsi/Carta Org/Perutusan), Mengenai Kami, Hubungi Kami (alamat + telefon + email statik), CDO profile, Maklumat Terkini (pengumuman/berita/aktiviti/keratan akhbar/tender/jawatan kosong), penerbitan downloadable, perkhidmatan teras, e-Permohonan/e-Pembayaran/e-Aduan, saluran perkhidmatan dgn ikon, KPI achievement display, end-to-end services online.

## 4. Tech Stack & Infra (LAMPIRAN T)

- **Platform:** open-source. Laravel + MySQL named explicitly as example. License = unlimited, source delivered in VM.
- **Hosting:** VM in Pusat Data Sektor Awam (PDSA) — JDN. Vendor configures end-to-end until Go-Live.
- **Single Sign-On:** unified across Portal Rasmi + myJPPH + microsites.
- **CMS:** required, role-based (Super Admin + per-bahagian Pentadbir Kandungan), content-only updates without code.
- **Responsive:** desktop, laptop, tablet, smartphone. Cross-browser (Chrome/Edge/Firefox/Safari) + cross-OS (Windows/macOS/iOS/Android).
- **Real-time interactive dashboard** with charts/tables.
- **Mobile app** (existing Gamma listing referenced) follows same module set.
- **Source code = Govt IPR.** Delivered every iteration.
- **AI Chatbot:** build fresh (in scope, not integrate existing). LAMPIRAN A para 1.3.4 mentioned existing chatbot integration — superseded by stakeholder decision 2026-05-05: dev new.

## 5. Security (PPPA 4.6 + LAMPIRAN T)

- **WAF mandatory** — OWASP Top 10 coverage (SQLi, XSS, CSRF, RCE, etc.).
- **TLS:** GPKI / JDN / approved CA digital cert. HTTPS only.
- **Patch hygiene:** OS, DB, CMS core + plugins kept current.
- **Backups + DRP** — built, tested periodically.
- **Pen-test + Risk Assessment** before Go-Live (Penetration Test, Smoke/Stress/Load, Connectivity, End-to-End).
- **Logging:** OS + app + portal logs enabled, retained for forensics.
- **Incident reporting:** to agency CSIRT + NACSA NC4.
- **Data classification:** only official + open data on portal. Rahsia Rasmi via CGSO clearance.
- **Data states:** in-use, in-motion, at-rest all protected per Govt info value.
- **Compliance frameworks:** PPPA Bil.1/2025, MyMIS, MyGIF, MyGIFOSS, DDSA, ICT Outsourcing GP, ICT Hijau GP, SPA (Security Posture Assessment), Surat Pekeliling Am Bil.3/2009.
- **SPLaSK** evaluation criteria (JDN) mandatory pass.

## 6. Performance & SLA (PPPA 4.4 + LAMPIRAN T)

- **Page render < 5 sec.**
- **Click depth ≤ 3** to reach any info/service.
- **Uptime ≥ 95%** in warranty (excluding planned downtime).
- **Help desk SLA:** response 30 min · resolve 8 hr (24/7, not bound to office hours).
- **LAD/penalty** for SLA breach. Performance Bond claimable.

## 7. Project Lifecycle (LAMPIRAN A + T)

- **24-month contract:** 12 months build + 12 months warranty/maintenance.
- **Deliverables:** SRS · system design docs · live portal + intranet · source code · user manual · admin manual · technical docs · test reports · final report.
- **Testing phases:** SIT → UAT → PAT → FAT.
- **Training:** Portal Tech Admin (2d×10), Server/Web/DB tech (2d×10), Programming (3d×15), Content Mgmt (2d×20). 5 AI-based programming IDE licenses for 12 months.
- **Workshops:** 1× BRS workshop (15 pax, vendor-funded).
- **TOT + TOS** to JPPH personnel for self-reliance.
- **Documentation:** 2 hardcopy + 1 editable softcopy. Govt-owned.

## 8. Design System Reference

- **MYDS** (Malaysia Government Design System, GovTech Malaysia, github.com/govtechmy/myds) — recommended baseline. PPPA 3.2.2 references `standard.digital.gov.my` ("digalakkan", not mandatory). Use MYDS tokens/components where compatible with formal navy govt aesthetic.
- **SPLaSK** (JDN evaluation criteria) — mandatory compliance pass.
- **PPPA design rules** above override MYDS where conflict.

## 9. Sources

- `reference/PPPA-Bilangan-1-Tahun-2025-...pdf` (extracted: `reference/PPPA-extracted.txt`)
- `reference/LAMPIRAN_A_-_LATAR_BELAKANG_PROJEK.docx`
- `reference/LAMPIRAN_T-JADUAL_PEMATUHAN_SPESIFIKASI_TEKNIKAL.docx` (extracted: `reference/LAMPIRAN-T-extracted.txt`)
- `reference/SOC (4).xlsx` — minimal: 1× line-item ("Pembangunan Semula Portal Rasmi JPPH"), pricing form pointing at LAMPIRAN T.
- `assets/jpph-logo-512.png` · `jpph-logo-300.png` · `jpph-logo-mobile.png` · `jata-negara.png` (pulled from jpph.gov.my official site).
