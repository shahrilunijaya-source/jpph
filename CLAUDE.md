# Portal-JPPH — Build Instructions

**Project:** JPPH govt portal (tender + prototype build)
**Design profile:** Navy (govt formal)
**Default model:** Sonnet. Use Opus for `/plan-eng-review` + `/cso`.

---

## Start Here (every new session)

1. Read `reference/PPPA-Bil-1-2025.pdf` — mandatory govt portal rules
2. Read `reference/LAMPIRAN_A_-_LATAR_BELAKANG_PROJEK.docx` — scope + purpose
3. Read `reference/LAMPIRAN_T-JADUAL_PEMATUHAN_SPESIFIKASI_TEKNIKAL.docx` — feature checklist
4. Read `reference/SOC (4).xlsx` — compliance matrix
5. Check current stage in `STATE.md` (create if missing)
6. Resume from current stage

---

## Workflow Stages

### Stage 0 — Inputs & Constraints
| Step | Action |
|------|--------|
| 0a | Read PPPA PDF — extract mandatory rules |
| 0b | Read LAMPIRAN A — scope, audience, purpose |
| 0c | Read LAMPIRAN T — feature checklist |
| 0d | Read SOC xlsx — compliance matrix |
| 0e | Pull JPPH logo from `jpph.gov.my` (SVG/PNG) → `assets/` |
| 0f | Check if PPPA mandates MyGovUEA / GA-IDS design system |
| 0g | Output: `CONSTRAINTS.md` (rules + must-haves + tech stack) |

### Stage 1 — Scope
| Step | Skill |
|------|-------|
| 1a | `superpowers:brainstorming` — pin user, wedge, edge cases |
| 1b | Write spec to `SPEC.md` |

### Stage 2 — Reference Design
| Step | Skill |
|------|-------|
| 2a | `/extract-design https://jpph.gov.my` — tokens, colors, fonts |
| 2b | `/extract-design <2-3 reference govt portals>` — compare patterns |

### Stage 3 — Design System
| Step | Skill |
|------|-------|
| 3a | `/design-consultation` — build from extract + PPPA |
| 3b | `/awesome-design-md` — pull pattern reference if needed |
| 3c | Output: `DESIGN.md` (locked tokens + components) |

### Stage 4 — Plan
| Step | Skill |
|------|-------|
| 4a | `claude-mem:make-plan` — phased plan |
| 4b | `/plan-ceo-review` — challenge scope |
| 4c | `/plan-design-review` — score design dimensions |
| 4d | `/plan-eng-review` — lock architecture |

### Stage 5 — Visual Variants
| Step | Skill |
|------|-------|
| 5a | `/design-shotgun` — 3-5 variants |
| 5b | Pick winner |

### Stage 6 — HTML Mockup
| Step | Skill |
|------|-------|
| 6a | `/design-html` — production HTML/CSS |
| 6b | Approve mockup before code |

### Stage 7 — Build
| Step | Skill |
|------|-------|
| 7a | `claude-mem:do` OR `superpowers:executing-plans` — phased build |
| 7b | TDD via `superpowers:test-driven-development` |

### Stage 8 — QA
| Step | Skill |
|------|-------|
| 8a | `/qa` — test + fix loop |
| 8b | `/design-review` — visual polish |
| 8c | **PPPA compliance pass** — match SOC xlsx row by row |
| 8d | `/cso` — security audit (govt portal required) |

### Stage 9 — Performance
| Step | Skill |
|------|-------|
| 9a | `/benchmark` — Web Vitals baseline |
| 9b | `/health` — code quality score |

### Stage 10 — Ship
| Step | Skill |
|------|-------|
| 10a | `/review` — pre-landing PR review |
| 10b | `/ship` — PR creation |
| 10c | `/land-and-deploy` — merge + deploy |
| 10d | `/canary` — post-deploy monitor |

---

## Rules

- **Read before edit.** Always read file before modifying.
- **Logo:** source SVG from official site, not screenshot.
- **PPPA non-negotiable.** Every stage check against PDF.
- **Tender link:** loop TenderAI (Yusra) for ePerolehan + lampiran handling.
- **Update `STATE.md`** after each stage so next session resumes cleanly.

---

## Reference Files

| File | Purpose |
|------|---------|
| `reference/PPPA-Bil-1-2025.pdf` | Govt portal mandatory rules |
| `reference/LAMPIRAN_A_-_LATAR_BELAKANG_PROJEK.docx` | Project scope |
| `reference/LAMPIRAN_T-JADUAL_PEMATUHAN_SPESIFIKASI_TEKNIKAL.docx` | Tech specs checklist |
| `reference/SOC (4).xlsx` | Scope of compliance |

---

## Output Files (created during workflow)

| File | Stage | Purpose |
|------|-------|---------|
| `CONSTRAINTS.md` | 0 | Locked rules + must-haves |
| `SPEC.md` | 1 | Scope + user/wedge |
| `DESIGN.md` | 3 | Design system |
| `PLAN.md` | 4 | Phased build plan |
| `STATE.md` | continuous | Current stage + progress |
