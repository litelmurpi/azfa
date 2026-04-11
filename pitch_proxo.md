# UrbanInsight AI — Pitch Deck
## Web Development Category | Team Jamsuy
### 5-Minute Presentation Script + Slide Content

> **Pitching Date:** April 12, 2026 (09:00 – 11:30 GMT+8)
> **Format:** 5 min presentation + 10 min Q&A | All in English

---

## SLIDE 1 — TITLE (10 seconds)

### 🏙️ UrbanInsight AI
**From *Seeing the Problem* to *Recommending the Solution***

- **Team:** Jamsuy
- **Category:** Web Development — Smart, Inclusive, and Sustainable Cities
- **Members:**
  1. Muchhammad Gassa Sandy Revaldy Aji — Universitas Mercu Buana Yogyakarta
  2. Bintang A'araf Stevan Putra — Universitas Sebelas Maret
  3. Yudistira Azfa Dani Wibowo — Universitas Amikom Yogyakarta

> 🎤 *Script:* "Good morning everyone. We are Team Jamsuy, and today we present UrbanInsight AI — a prescriptive WebGIS platform for sustainable urban planning."

---

## SLIDE 2 — THE PROBLEM (40 seconds)

### 🔥 3 Urban Crises Growing Every Year

| Crisis | Impact |
|---|---|
| 🌡️ **Urban Heat Islands** | Cities are 1–7°C hotter than surrounding areas → health risks, higher energy consumption |
| 🌊 **Flood Risk** | Low drainage + high imperviousness → recurring devastating floods |
| 🌳 **Green Inequality** | Dense, lower-income neighborhoods have the *least* green space but the *greatest* need |

### The Gap
> Existing tools (inaRISK, Google Earth Engine) are **descriptive** — they show *what is happening*.
> But they **never answer**: *"Where should we act, and which actions deliver the greatest impact?"*

> 🎤 *Script:* "Indonesian cities face three interconnected crises: extreme urban heat, recurring floods, and unequal access to green space. Current tools like inaRISK and Google Earth Engine only *describe* these problems — they show what's happening but never tell planners *where to act* and *what action delivers the greatest impact*. UrbanInsight AI fills this gap."

---

## SLIDE 3 — OUR SOLUTION (50 seconds)

### 🤖 UrbanInsight AI: Prescriptive Analytics for Urban Planning

**We don't just visualize problems — we recommend optimal solutions.**

4 integrated AI modules:

| Module | What It Does |
|---|---|
| 🌡️ **Heat Prediction** | Predicts Land Surface Temperature (LST) per 100m grid cell using building density, green density, and real-time weather data |
| 🌊 **Flood Scoring** | Computes flood probability (0–100) based on precipitation, soil moisture, water proximity, and imperviousness |
| 🌳 **Green Equity Index** | Quantifies green space access inequality — identifies *Green Deserts* |
| 🌲 **RL Tree Placement** *(Flagship)* | Greedy Reinforcement Learning Agent optimally places trees to maximize heat reduction (35%), flood mitigation (30%), and green equity (25%) — all under realistic budget constraints |

> 🎤 *Script:* "UrbanInsight AI uses four integrated modules. First, it *predicts* surface temperature per grid cell. Second, it *scores* flood risk. Third, it *identifies* Green Deserts — areas with the least green coverage but the greatest need. And finally — our flagship feature — a Reinforcement Learning agent that *recommends exactly where to plant trees* for maximum multi-objective impact under a realistic budget. This is prescriptive analytics — a new paradigm for Indonesian urban planning."

---

## SLIDE 4 — HOW IT WORKS / ARCHITECTURE (40 seconds)

### ⚙️ Technical Architecture

```
┌─────────────────────────────────────────────────────────┐
│                     FRONTEND                             │
│   React 19 + Vite  ·  MapLibre GL JS  ·  Framer Motion │
│   TailwindCSS 4    ·  Recharts        ·  GSAP          │
└─────────────────────────┬───────────────────────────────┘
                          │ HTTP (Axios)
┌─────────────────────────▼───────────────────────────────┐
│                     BACKEND                              │
│           FastAPI (Python 3.10) + Uvicorn                │
│                                                          │
│  ┌──────────────┐  ┌──────────────┐  ┌───────────────┐  │
│  │  grid.py     │  │ rl_engine.py │  │ endpoints.py  │  │
│  │  Microclimate│  │ Greedy RL    │  │ simulation.py │  │
│  │  Synthesis   │  │ Agent        │  │               │  │
│  └──────┬───────┘  └──────┬───────┘  └───────────────┘  │
│         └─────────────────┼──────────────────────────┐   │
│  ┌────────────────────────▼──────────────────────────┤   │
│  │           External Data Sources                    │   │
│  │  Open-Meteo · OSM/Nominatim · WorldPop TIF        │   │
│  │  GHSL Building TIF · ESA WorldCover TIF           │   │
│  └───────────────────────────────────────────────────┘   │
└──────────────────────────────────────────────────────────┘
```

### Real-Time Data Pipeline
- **Weather data** fetched live from Open-Meteo API
- **Geospatial data** from OSM Overpass + high-res TIF files (WorldPop, GHSL, ESA WorldCover)
- **In-memory TTL cache** reduces redundant API calls

> 🎤 *Script:* "Our architecture is a React 19 frontend communicating with a FastAPI Python backend. The backend fetches real-time weather data from Open-Meteo, population data from WorldPop, building density from GHSL, and land cover from ESA WorldCover — all at 100-meter resolution. An in-memory TTL cache ensures fast response times. The grid synthesis module processes all this data, and the RL engine runs the tree placement optimization."

---

## SLIDE 5 — RL ALGORITHM DEEP DIVE (40 seconds)

### 🧠 The RL Tree Placement Algorithm

**At each step, the Greedy RL Agent selects the cell with the highest multi-objective reward:**

```
reward = 0.35 × |ΔT|/1.5 + 0.30 × |ΔFlood|/11 + 0.25 × ΔEquity/8 − 0.10 × green_density
```

**Per-tree impact:**
| Metric | Effect on Planted Cell | Neighbor Effect |
|---|---|---|
| 🌡️ Heat | −0.5 to −1.5°C | −0.05°C |
| 🌊 Flood | −3 to −11% | — |
| 🌳 Equity | +2 to +8 pts | +0.5 pts |

**Key Innovation:** Multi-objective optimization under budget constraint — the agent balances *three competing objectives* simultaneously, finding the Pareto-optimal placement strategy.

> 🎤 *Script:* "Here's how the RL agent works. At each step, it evaluates every cell in the grid and selects the one with the highest multi-objective reward — balancing heat reduction at 35% weight, flood mitigation at 30%, green equity improvement at 25%, and cost penalty at 10%. Each tree planted reduces temperature by up to 1.5 degrees, flood risk by up to 11 percent, and improves equity by up to 8 points — with spillover effects on neighboring cells. This is the first WebGIS platform in Indonesia that uses RL for prescriptive urban optimization."

---

## SLIDE 6 — KEY FEATURES & DEMO (50 seconds)

### ✨ Platform Features

| Feature | Description |
|---|---|
| 🗺️ **Interactive Map Explorer** | Multi-layer grid map powered by MapLibre GL JS — toggle between Heat, Flood, Equity, and Population layers |
| 🔍 **City Search** | Search *any* Indonesian city — automatic boundary polygon clipping via Nominatim |
| 🌲 **RL Simulation** | Real-time tree placement animation with budget slider and before/after comparison |
| 📊 **Analytics Dashboard** | Radar charts, distribution graphs, and city-level KPIs via Recharts |
| 📱 **Fully Responsive** | Desktop-optimized with tablet and mobile support (floating bottom bar, hamburger menu) |

### Live Demo Highlights
1. **Search "Surabaya"** → watch the city load with 100m grid cells
2. **Toggle layers** → see Heat (red), Flood (blue), Equity (green), Population
3. **Run simulation** → watch the RL agent plant 50 trees in real-time
4. **Compare Baseline** → toggle before/after to see projected impact

> 🎤 *Script:* "Let me walk you through the key features. The map explorer lets you search any Indonesian city and visualize four layers — heat, flood risk, green equity, and population density — all at 100-meter resolution. The RL simulation lets you set a budget and watch the AI agent plant trees in real-time. And the Compare Baseline toggle instantly shows the projected impact — before and after. The analytics dashboard provides city-level statistical breakdown. The entire platform is responsive across desktop, tablet, and mobile."

---

## SLIDE 7 — UNIQUENESS & INNOVATION (30 seconds)

### 🏆 What Makes Us Unique

| Aspect | UrbanInsight AI | Existing Tools |
|---|---|---|
| **Analysis Type** | ✅ Prescriptive (recommends actions) | ❌ Descriptive only (shows data) |
| **Scope** | ✅ 3-in-1 (Heat + Flood + Equity) | ❌ Single module |
| **AI Engine** | ✅ Multi-objective RL optimization | ❌ No ML/RL |
| **Data** | ✅ Real-time API pipeline | ❌ Static datasets |
| **Resolution** | ✅ 100m grid intelligence | ❌ Coarse analysis |

### Innovation
> **New paradigm:** From *"seeing the problem"* → *"recommending the solution"*
> First platform in Indonesia's urban planning ecosystem to use Reinforcement Learning for prescriptive, multi-objective optimization.

> 🎤 *Script:* "What makes us unique? We are the only platform that combines heat, flood, and green equity analysis with AI-driven recommendations. Unlike existing tools that are purely descriptive, UrbanInsight AI is prescriptive. We use real-time data, not static datasets. And our 100-meter grid resolution enables high-granularity analysis. This is a genuine leap from descriptive to prescriptive analytics in Indonesia's urban planning ecosystem."

---

## SLIDE 8 — IMPACT & TARGET USERS (30 seconds)

### 🎯 Who Benefits

| Stakeholder | Benefit |
|---|---|
| 🏛️ **Urban Planners (BAPPEDA)** | Data-driven spatial planning — allocate greening budgets where they matter most |
| 🏢 **Environmental Agency** | Identify Green Deserts and prioritize interventions |
| 📋 **Policy Makers** | Real-time city condition dashboard for evidence-based decisions |
| 🎓 **Academics & Researchers** | Replicable geospatial datasets and models |
| 📰 **NGOs & Journalists** | Transparent visual data for environmental advocacy |

> 🎤 *Script:* "Our primary users are urban planners at BAPPEDA who need to make data-driven decisions about where to allocate greening budgets. Environmental agencies can identify Green Deserts. Policy makers get real-time dashboards. And academics get replicable models. Every tree planted is scientifically optimized for maximum ecological impact."

---

## SLIDE 9 — CLOSING (20 seconds)

### 🌍 UrbanInsight AI
**From *Seeing* to *Solving***

> *"Where should we act, and which actions deliver the greatest impact?"*
> **UrbanInsight AI answers this question.**

- 🔗 **Repository:** [github.com/litelmurpi/web-gis-proxo](https://github.com/litelmurpi/web-gis-proxo)
- 📧 **Team Jamsuy**

### Thank You 🙏

> 🎤 *Script:* "UrbanInsight AI represents a new paradigm — going from seeing urban problems to solving them with AI. Thank you for your time. We're ready for your questions."

---

## 📝 Q&A PREPARATION NOTES

### Anticipated Questions & Answers

**Q1: Why a Greedy RL agent instead of Deep RL (DQN, PPO)?**
> A: A greedy agent is computationally lightweight and runs in-browser in real-time. For the current problem structure (discrete grid cells, immediate rewards), greedy optimization finds near-optimal solutions without the training overhead of deep RL. We plan to explore DQN in v2 for more complex multi-step planning.

**Q2: How accurate are the climate models?**
> A: We use a deterministic formula calibrated from peer-reviewed literature (Rizwan et al. 2008, Oke 1982). The LST formula combines real-time temperature from Open-Meteo with building density (GHSL) and green density (ESA WorldCover) — each coefficient is derived from urban climate studies. This is a simplified transition model — not a full biophysical simulation — but it provides actionable approximations.

**Q3: What is the grid resolution and why 100m?**
> A: 100m × 100m cells. This was chosen as the optimal balance between computational feasibility and analytical granularity. Finer grids (10m) would be computationally expensive for real-time web use; coarser grids (1km) would lose intra-neighborhood detail.

**Q4: Can it work for cities outside Indonesia?**
> A: The architecture is city-agnostic — Open-Meteo and OSM data are global. However, current TIF files (WorldPop, GHSL, ESA WorldCover) are Indonesia-specific. Adding global TIF data would extend coverage worldwide.

**Q5: What are the limitations?**
> A: (1) No real-time IoT sensor integration (planned for v2). (2) No user authentication system. (3) Simplified climate model — not full biophysical simulation. (4) 100m resolution means some intra-grid detail is lost. (5) Primary demo city is Surabaya — other cities' accuracy depends on OSM data availability.

**Q6: How does the Compare Baseline feature work?**
> A: After the RL simulation completes, the backend returns a full `grid_after` GeoJSON with modified LST, flood scores, and equity scores. The frontend toggles the MapLibre data source between the original grid and the post-simulation grid. MapLibre's data-driven styling automatically re-renders colors based on the new property values.

**Q7: What data sources do you use and how do you handle latency?**
> A: We use Open-Meteo (weather), OSM/Nominatim (geocoding & boundaries), WorldPop (population), GHSL (building density), and ESA WorldCover (land cover). Latency is managed by an in-memory TTL cache (Geocoder: 24h, Weather: 10min, OSM: 1h). The `/simulate/quick` endpoint reuses cached grids to skip the data fetch step.

**Q8: What is the tech stack and why these choices?**
> A: Frontend: React 19 + Vite 7 for fast development, MapLibre GL JS for open-source high-performance WebGIS, TailwindCSS 4 for responsive styling, Framer Motion for UI animations, and Recharts for analytics. Backend: FastAPI for async API performance, GeoPandas + Shapely for geospatial operations, NumPy for vectorized climate calculations, and Rasterio for TIF file sampling.

**Q9: How is green equity calculated?**
> A: EquityScore = green_density × 100 + (1 − building_density) × 20. Higher scores mean better access to green space. Areas with high building density and low green density are flagged as "Green Deserts" — priority targets for greening intervention.

**Q10: What's on the v2 roadmap?**
> A: (1) Supabase PostgreSQL + PostGIS for persistent data storage. (2) Real-time IoT sensor integration. (3) Deep RL agent (DQN/PPO). (4) User authentication. (5) Native mobile application. (6) Full biophysical climate simulation.

---

## ⏱️ TIMING GUIDE (Total: ~5 minutes)

| Slide | Content | Duration |
|---|---|---|
| 1 | Title | ~10 sec |
| 2 | Problem | ~40 sec |
| 3 | Solution | ~50 sec |
| 4 | Architecture | ~40 sec |
| 5 | RL Algorithm | ~40 sec |
| 6 | Features & Demo | ~50 sec |
| 7 | Uniqueness | ~30 sec |
| 8 | Impact | ~30 sec |
| 9 | Closing | ~20 sec |
| | **Total** | **~5 min** |
