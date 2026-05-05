<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="/images/jpph-logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'MyJPPH' }} — Portal Warga JPPH</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
:root {
  --navy:        #0A2540;
  --navy-700:    #1E3A5F;
  --navy-800:    #082038;
  --slate:       #64748D;
  --off-white:   #F8FAFC;
  --border:      #E5EDF5;
  --shadow-blue: rgba(10,37,64,.18);
  --shadow-blk:  rgba(0,0,0,0.10);

  --bg:          #F6F8FB;
  --surface:     #ffffff;
  --surface-2:   #F8FAFC;
  --border-2:    #cdd8e5;

  --text:        #0A2540;
  --text-2:      #1E3A5F;
  --text-3:      #5A6B82;
  --text-4:      #94A3B8;

  --brand:       #0A2540;
  --brand-light: #EEF2F7;
  --brand-mid:   #1E3A5F;
  --brand-dark:  #06182A;

  --gold:        #F59E0B;
  --gold-light:  #FEF3C7;
  --gold-dark:   #D97706;

  --success:     #16a34a;
  --success-light:#f0fdf4;
  --success-mid: #16a34a;

  --amber:       #d97706;
  --amber-bg:    #fffbeb;
  --red:         #dc2626;
  --red-bg:      #fef2f2;
  --blue:        #2563eb;
  --blue-bg:     #eff6ff;
  --orange:      #f97316;
  --orange-bg:   #fff7ed;
  --purple:      #7c3aed;
  --purple-bg:   #faf5ff;
  --teal:        #0e7490;
  --teal-bg:     #ecfeff;

  --mono: 'SF Mono', 'Cascadia Code', ui-monospace, 'Courier New', monospace;
  --font: 'Poppins', system-ui, sans-serif;

  --stripe-shadow:    rgba(10,37,64,0.18) 0px 13px 27px -5px, rgba(0,0,0,0.10) 0px 8px 16px -8px;
  --stripe-shadow-sm: rgba(10,37,64,0.12) 0px 8px 18px -6px, rgba(0,0,0,0.06) 0px 4px 10px -4px;

  --sidebar-w: 248px;
  --topbar-h:  56px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html, body { height: 100%; overflow: hidden; }
body {
  font-family: var(--font);
  -webkit-font-smoothing: antialiased;
  background: var(--bg);
  color: var(--text);
  display: flex;
  font-size: 14px;
}

/* SIDEBAR */
.sidebar {
  width: var(--sidebar-w);
  min-width: var(--sidebar-w);
  background: var(--surface);
  border-right: 1px solid var(--border);
  display: flex; flex-direction: column;
  height: 100vh; overflow: hidden; flex-shrink: 0;
}
.sidebar-top {
  padding: 16px 18px 14px;
  border-bottom: 1px solid var(--border);
  flex-shrink: 0;
  display: flex; align-items: center; gap: 10px;
}
.brand-logo { height: 38px; width: auto; flex-shrink: 0; }
.brand-text { display: flex; flex-direction: column; line-height: 1.1; min-width: 0; }
.brand-name { font-size: 15px; font-weight: 800; color: var(--brand); letter-spacing: -0.02em; }
.brand-sub  { font-size: 9.5px; color: var(--text-4); margin-top: 2px; text-transform: uppercase; letter-spacing: 0.06em; }

.sidebar-body { flex: 1; min-height: 0; padding: 8px 0; overflow-y: auto; }

.nav-sec {
  padding: 14px 18px 4px;
  font-size: 10px; font-weight: 700;
  letter-spacing: 0.10em; text-transform: uppercase;
  color: var(--text-4);
}
.nav-a {
  display: flex; align-items: center; gap: 10px;
  padding: 8px 14px; margin: 1px 8px;
  border-radius: 7px;
  font-size: 13.5px; font-weight: 500;
  color: var(--text-3);
  text-decoration: none;
  transition: background 0.1s, color 0.1s;
  white-space: nowrap; overflow: hidden;
  cursor: pointer; border: none; background: none;
  width: calc(100% - 16px); text-align: left;
}
.nav-a:hover { background: var(--bg); color: var(--text-2); }
.nav-a.active {
  background: var(--brand-light);
  color: var(--brand);
  font-weight: 600;
  box-shadow: inset 3px 0 0 var(--gold);
  border-radius: 0 7px 7px 0;
  margin-left: 0; padding-left: 21px;
  width: calc(100% - 8px);
}
.nav-ic { width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; opacity: 0.55; }
.nav-a.active .nav-ic { opacity: 1; color: var(--gold-dark); }

.nav-a.is-disabled { opacity: 0.42; cursor: not-allowed; pointer-events: auto; position: relative; }
.nav-a.is-disabled:hover { opacity: 0.55; background: transparent; color: var(--text-3); }
.nav-a.is-disabled[data-tip]::after {
  content: attr(data-tip);
  position: absolute; left: calc(100% + 8px); top: 50%;
  transform: translateY(-50%);
  background: #0F172A; color: #fff;
  font-size: 11px; font-weight: 500;
  padding: 5px 10px; border-radius: 6px;
  white-space: nowrap;
  box-shadow: 0 4px 12px rgba(0,0,0,0.30);
  opacity: 0; pointer-events: none;
  transition: opacity 150ms ease;
  z-index: 50;
}
.nav-a.is-disabled[data-tip]:hover::after { opacity: 1; }

.sidebar-footer {
  border-top: 1px solid var(--border);
  padding: 10px 14px;
  display: flex; align-items: center; gap: 10px;
  flex-shrink: 0;
}
.sf-avatar {
  width: 34px; height: 34px;
  background: var(--brand); color: var(--gold);
  border-radius: 50%;
  font-size: 12px; font-weight: 700;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; letter-spacing: -0.3px;
}
.sf-name { font-size: 12.5px; font-weight: 600; color: var(--text); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.sf-co   { font-size: 10.5px; color: var(--text-4); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.sf-logout {
  margin-left: auto; flex-shrink: 0;
  background: none; border: none;
  color: var(--text-4); cursor: pointer;
  padding: 6px; border-radius: 6px;
  display: flex; align-items: center;
  transition: color 0.1s, background 0.1s;
}
.sf-logout:hover { color: var(--red); background: var(--red-bg); }

/* MAIN */
.main { flex: 1; display: flex; flex-direction: column; height: 100vh; overflow: hidden; min-width: 0; }

/* TOPBAR */
.topbar {
  height: var(--topbar-h); min-height: var(--topbar-h);
  background: var(--surface);
  border-bottom: 1px solid var(--border);
  padding: 0 28px;
  display: flex; align-items: center; gap: 12px;
  flex-shrink: 0;
}
.topbar-back { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--text-3); text-decoration: none; cursor: pointer; transition: color 0.1s; }
.topbar-back:hover { color: var(--brand); }
.topbar-div { width: 1px; height: 18px; background: var(--border); flex-shrink: 0; }
.topbar-title { font-size: 14.5px; font-weight: 600; color: var(--text); letter-spacing: -0.02em; }
.topbar-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }
.btn-ghost {
  display: flex; align-items: center; justify-content: center;
  width: 34px; height: 34px;
  background: none; border: 1px solid var(--border);
  border-radius: 8px; cursor: pointer;
  color: var(--text-3); text-decoration: none;
  transition: all 0.1s; position: relative;
}
.btn-ghost:hover { background: var(--bg); color: var(--text-2); border-color: var(--border-2); }
.notif-dot {
  position: absolute; top: 7px; right: 7px;
  width: 6px; height: 6px;
  background: var(--red); border-radius: 50%;
  border: 1.5px solid var(--surface);
}
.btn-primary {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 16px;
  background: var(--gold); color: var(--navy);
  font-family: var(--font);
  font-size: 13px; font-weight: 600;
  border: none; border-radius: 6px;
  cursor: pointer; text-decoration: none;
  transition: background 150ms ease, transform 150ms ease;
  white-space: nowrap;
  box-shadow: 0 1px 2px rgba(245,158,11,.25);
}
.btn-primary:hover { background: var(--gold-dark); color: #fff; transform: translateY(-1px); }
.btn-primary:active { transform: translateY(0); }

.btn-secondary {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 14px;
  background: var(--surface); color: var(--brand);
  border: 1px solid var(--border-2);
  font-size: 13px; font-weight: 500;
  border-radius: 6px;
  text-decoration: none;
  transition: all 0.1s;
}
.btn-secondary:hover { background: var(--brand-light); border-color: var(--brand); }

/* TOPBAR USER */
.topbar-user { position: relative; }
.topbar-user-btn {
  display: flex; align-items: center; gap: 10px;
  padding: 4px 10px 4px 12px;
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 999px;
  cursor: pointer;
  transition: all .12s;
}
.topbar-user-btn:hover { background: var(--bg); border-color: var(--border-2); }
.topbar-user-btn:focus { outline: 2px solid var(--gold); outline-offset: 2px; }
.topbar-user-info { display: flex; flex-direction: column; align-items: flex-end; line-height: 1.15; }
.topbar-user-name { font-size: 12.5px; font-weight: 600; color: var(--text); white-space: nowrap; max-width: 160px; overflow: hidden; text-overflow: ellipsis; }
.topbar-user-role { font-size: 10px; color: var(--text-4); text-transform: uppercase; letter-spacing: .06em; margin-top: 1px; }
.topbar-user-avatar {
  width: 32px; height: 32px;
  background: var(--brand); color: var(--gold);
  border-radius: 50%;
  font-size: 11.5px; font-weight: 700;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; letter-spacing: -0.3px;
}
@media (max-width: 640px) { .topbar-user-info { display: none; } }

.topbar-user-menu {
  position: absolute; top: calc(100% + 6px); right: 0;
  min-width: 220px;
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 10px;
  box-shadow: var(--stripe-shadow);
  padding: 6px;
  z-index: 60;
}
.topbar-user-menu-head { padding: 10px 12px 8px; border-bottom: 1px solid var(--border); margin-bottom: 4px; }
.topbar-user-menu-name { font-size: 13px; font-weight: 600; color: var(--text); }
.topbar-user-menu-email { font-size: 11.5px; color: var(--text-4); margin-top: 2px; word-break: break-all; }
.topbar-user-menu-item {
  display: flex; align-items: center; gap: 9px;
  width: 100%;
  padding: 8px 12px;
  background: none; border: none;
  font-family: var(--font);
  font-size: 13px; color: var(--text-2);
  text-align: left; text-decoration: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background .1s, color .1s;
}
.topbar-user-menu-item:hover { background: var(--brand-light); color: var(--brand); }
.topbar-user-menu-item svg { color: var(--text-4); flex-shrink: 0; }
.topbar-user-menu-item:hover svg { color: var(--gold-dark); }
.topbar-user-menu-sep { height: 1px; background: var(--border); margin: 4px 0; }
.topbar-user-menu-danger { color: var(--red); }
.topbar-user-menu-danger:hover { background: var(--red-bg); color: var(--red); }
.topbar-user-menu-danger svg { color: var(--red); }

/* CONTENT */
.main-content { flex: 1; overflow-y: auto; padding: 28px 32px; background: var(--bg); }
::-webkit-scrollbar { width: 4px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: var(--border); border-radius: 2px; }

/* PAGE HEADING */
.pg-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; margin-bottom: 28px; }
.pg-title { font-size: 22px; font-weight: 700; color: var(--text); letter-spacing: -0.03em; line-height: 1.2; }
.pg-sub { font-size: 13px; color: var(--text-3); margin-top: 4px; }

/* KPI CARDS */
.kpi-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
@media (max-width: 1024px) { .kpi-row { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 640px)  { .kpi-row { grid-template-columns: 1fr; } }
.kpi {
  background: var(--surface);
  border: 1px solid var(--border);
  border-top: 2px solid var(--border-2);
  border-radius: 8px;
  padding: 20px 22px 18px;
  box-shadow: var(--stripe-shadow-sm);
  transition: transform 200ms ease-out, box-shadow 200ms ease-out;
}
.kpi:hover { transform: translateY(-2px); box-shadow: var(--stripe-shadow); }
.kpi.accent-brand { border-top-color: var(--success); }
.kpi.accent-amber { border-top-color: var(--gold); }
.kpi.accent-navy  { border-top-color: var(--navy); }
.kpi.accent-red   { border-top-color: var(--red); }
.kpi-lbl { font-size: 10.5px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text-4); margin-bottom: 14px; }
.kpi-val { font-size: 40px; font-weight: 700; letter-spacing: -0.05em; color: var(--text); line-height: 1; margin-bottom: 10px; font-variant-numeric: tabular-nums; }
.kpi-val.v-brand { color: var(--success); }
.kpi-val.v-amber { color: var(--gold-dark); }
.kpi-val.v-navy  { color: var(--navy); }
.kpi-val.v-red   { color: var(--red); }
.kpi-foot { font-size: 11.5px; color: var(--text-4); display: flex; align-items: center; gap: 5px; flex-wrap: wrap; }
.kpi-foot strong { color: var(--text-3); font-weight: 600; }

/* SECTION CARD */
.card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 8px;
  overflow: hidden;
  margin-bottom: 20px;
  box-shadow: var(--stripe-shadow-sm);
}
.card-head { display: flex; align-items: center; padding: 15px 20px; border-bottom: 1px solid var(--border); gap: 10px; }
.card-title { font-size: 13.5px; font-weight: 600; color: var(--text); letter-spacing: -0.01em; flex: 1; }
.card-meta  { font-size: 12px; color: var(--text-4); }
.card-link {
  font-size: 12.5px; font-weight: 500;
  color: var(--gold-dark); text-decoration: none;
  display: flex; align-items: center; gap: 3px;
  transition: color 0.1s;
}
.card-link:hover { color: var(--brand); }

/* DATA TABLE */
.tbl { width: 100%; border-collapse: collapse; font-size: 13.5px; }
.tbl th {
  font-size: 10.5px; font-weight: 700;
  letter-spacing: 0.06em; text-transform: uppercase;
  color: var(--text-4); padding: 10px 16px;
  border-bottom: 1px solid var(--border);
  text-align: left; background: var(--surface-2); white-space: nowrap;
}
.tbl td { padding: 13px 16px; border-bottom: 1px solid var(--border); color: var(--text-2); vertical-align: middle; }
.tbl tr:last-child td { border-bottom: none; }
.tbl tbody tr { transition: background 0.08s; }
.tbl tbody tr:hover td { background: #fafbfc; }

.app-chip { font-family: var(--mono); font-size: 11px; background: var(--bg); border: 1px solid var(--border); color: var(--text-3); padding: 2px 8px; border-radius: 5px; letter-spacing: 0.03em; white-space: nowrap; display: inline-block; }
.prod-name { font-size: 13.5px; font-weight: 500; color: var(--text); line-height: 1.3; }
.prod-ing  { font-size: 11.5px; color: var(--text-4); margin-top: 1px; }

/* STATUS PILLS */
.st { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 500; padding: 3px 9px 3px 7px; border-radius: 6px; white-space: nowrap; line-height: 1.4; }
.st::before { content: ''; width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
.st-ok   { background: var(--success-light); color: var(--success); }
.st-ok::before   { background: var(--success-mid); box-shadow: 0 0 0 2px rgba(22,163,74,.2); }
.st-rev  { background: var(--gold-light); color: var(--gold-dark); }
.st-rev::before  { background: var(--gold); }
.st-rej  { background: var(--red-bg); color: var(--red); }
.st-rej::before  { background: var(--red); }
.st-sub  { background: var(--blue-bg); color: var(--blue); }
.st-sub::before  { background: var(--blue); }
.st-drf  { background: var(--bg); color: var(--text-3); border: 1px solid var(--border); }
.st-drf::before  { background: var(--border-2); }

.tbl-action {
  font-size: 12px; font-weight: 600;
  color: var(--brand); text-decoration: none;
  padding: 4px 10px;
  border: 1px solid var(--border-2); border-radius: 6px;
  background: var(--brand-light);
  display: inline-block; transition: all 0.1s; white-space: nowrap;
}
.tbl-action:hover { background: var(--gold-light); border-color: var(--gold); color: var(--gold-dark); }

/* EMPTY */
.empty { padding: 56px 24px; text-align: center; display: flex; flex-direction: column; align-items: center; }
.empty-icon { width: 44px; height: 44px; background: var(--bg); border: 1px solid var(--border); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 14px; color: var(--text-4); }
.empty-title { font-size: 14px; font-weight: 600; color: var(--text-2); margin-bottom: 5px; }
.empty-sub   { font-size: 13px; color: var(--text-4); margin-bottom: 18px; max-width: 280px; }

input, select, textarea { font-family: var(--font); }
[x-cloak] { display: none !important; }
    </style>
</head>
<body>

@php
    $user = auth()->user();
    $userName = $user?->name ?? 'Pengguna';
    $firstName = explode(' ', $userName)[0];
    $userInitials = strtoupper(substr($userName, 0, 2));
    $userOrg = 'Jabatan Penilaian dan Perkhidmatan Harta';
@endphp

<nav class="sidebar">
    <div class="sidebar-top">
        <img src="/images/jpph-logo.png" alt="JPPH" class="brand-logo">
        <div class="brand-text">
            <span class="brand-name">MyJPPH</span>
            <span class="brand-sub">Portal Warga</span>
        </div>
    </div>

    <div class="sidebar-body">
        <div class="nav-sec">{{ __('Utama') }}</div>
        <a href="{{ route('myjpph.dashboard') }}"
           class="nav-a {{ request()->routeIs('myjpph.dashboard') ? 'active' : '' }}">
            <span class="nav-ic">
                <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h3a1 1 0 001-1v-3a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 001 1h3a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
            </span>
            <span>{{ __('Papan Pemuka') }}</span>
        </a>

        <span class="nav-a is-disabled" data-tip="{{ __('Modul belum tersedia dalam prototaip') }}">
            <span class="nav-ic"><svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg></span>
            <span>{{ __('Kes Penilaian') }}</span>
        </span>

        <span class="nav-a is-disabled" data-tip="{{ __('Modul belum tersedia dalam prototaip') }}">
            <span class="nav-ic"><svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg></span>
            <span>{{ __('Duti Setem') }}</span>
        </span>

        <span class="nav-a is-disabled" data-tip="{{ __('Modul belum tersedia dalam prototaip') }}">
            <span class="nav-ic"><svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h3a1 1 0 001-1v-3a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 001 1h3a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg></span>
            <span>{{ __('Pinjaman Perumahan') }}</span>
        </span>

        <span class="nav-a is-disabled" data-tip="{{ __('Modul belum tersedia dalam prototaip') }}">
            <span class="nav-ic"><svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm4 4a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm-2 3a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1zm0 3a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"/></svg></span>
            <span>{{ __('Tukar Syarat Tanah') }}</span>
        </span>

        <span class="nav-a is-disabled" data-tip="{{ __('Modul belum tersedia dalam prototaip') }}">
            <span class="nav-ic"><svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg></span>
            <span>{{ __('Pengesahan & Audit') }}</span>
        </span>

        <span class="nav-a is-disabled" data-tip="{{ __('Modul belum tersedia dalam prototaip') }}">
            <span class="nav-ic"><svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"/><path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"/><path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"/></svg></span>
            <span>{{ __('Data NAPIC') }}</span>
        </span>

        <div class="nav-sec">{{ __('Akaun') }}</div>
        <a href="{{ route('profile.edit') }}"
           class="nav-a {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <span class="nav-ic">
                <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
            </span>
            <span>{{ __('Profil Saya') }}</span>
        </a>

        <div class="nav-sec">{{ __('Khidmat') }}</div>
        <span class="nav-a is-disabled" data-tip="{{ __('Modul belum tersedia dalam prototaip') }}">
            <span class="nav-ic"><svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg></span>
            <span>{{ __('Bayaran Dalam Talian') }}</span>
        </span>
        <span class="nav-a is-disabled" data-tip="{{ __('Modul belum tersedia dalam prototaip') }}">
            <span class="nav-ic"><svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"/></svg></span>
            <span>{{ __('Aduan & Cadangan') }}</span>
        </span>
        <span class="nav-a is-disabled" data-tip="{{ __('Modul belum tersedia dalam prototaip') }}">
            <span class="nav-ic"><svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg></span>
            <span>{{ __('Temujanji Pelanggan') }}</span>
        </span>
    </div>

    <div class="sidebar-footer">
        <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;min-width:0;flex:1;overflow:hidden;">
            <div class="sf-avatar">{{ $userInitials }}</div>
            <div style="min-width:0;flex:1;overflow:hidden;">
                <div class="sf-name">{{ $userName }}</div>
                <div class="sf-co">{{ $userOrg }}</div>
            </div>
        </a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="sf-logout" title="{{ __('Log Keluar') }}">
                <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/></svg>
            </button>
        </form>
    </div>
</nav>

<div class="main">
    <div class="topbar">
        <span class="topbar-title">{{ $title ?? __('MyJPPH') }}</span>
        <div class="topbar-right">
            <a href="#" class="btn-ghost" title="{{ __('Notifikasi') }}">
                <div class="notif-dot"></div>
                <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/></svg>
            </a>

            <div class="topbar-user" x-data="{ open: false }" @click.outside="open = false">
                <button type="button" class="topbar-user-btn" @click="open = !open" :aria-expanded="open">
                    <div class="topbar-user-info">
                        <div class="topbar-user-name">{{ $userName }}</div>
                        <div class="topbar-user-role">{{ __('Warga JPPH') }}</div>
                    </div>
                    <div class="topbar-user-avatar">{{ $userInitials }}</div>
                    <svg width="11" height="11" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.7" :style="open ? 'transform:rotate(180deg)' : ''" style="transition:transform .15s ease;color:var(--text-4)"><path d="M1 1.5l5 5 5-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>

                <div x-show="open" x-transition.opacity.duration.150ms x-cloak class="topbar-user-menu">
                    <div class="topbar-user-menu-head">
                        <div class="topbar-user-menu-name">{{ $userName }}</div>
                        <div class="topbar-user-menu-email">{{ auth()->user()?->email }}</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="topbar-user-menu-item">
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        {{ __('Profil Saya') }}
                    </a>
                    <a href="{{ route('home') }}" class="topbar-user-menu-item">
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h3a1 1 0 001-1v-3a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 001 1h3a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                        {{ __('Laman Awam') }}
                    </a>
                    <div class="topbar-user-menu-sep"></div>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0">
                        @csrf
                        <button type="submit" class="topbar-user-menu-item topbar-user-menu-danger">
                            <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/></svg>
                            {{ __('Log Keluar') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <main class="main-content">
        {{ $slot }}
    </main>
</div>

</body>
</html>
