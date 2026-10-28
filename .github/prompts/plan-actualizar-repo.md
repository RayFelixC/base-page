# Plan: Preparar un repositorio para GitHub (plantilla de actualización)

> **Cómo usar este documento:** guía para llevar cualquier proyecto (Laravel o similar) de
> "como está en local" a "listo para publicar en GitHub y usarlo en portafolio".
> Se creó replicando el proceso hecho en `base-page` (2026).
> Copia esta checklist a `.github/prompts/plan-<nuevo-proyecto>.md` y ve marcando cada paso
> solo cuando el usuario diga que está **terminado** (no con "ok" ni "sigue").

---

## Fase 0 — Preparación (antes de tocar nada)

- [ ] **Auditoría de seguridad (bloqueante):**
  - `git status` / `git ls-files` → verificar que **no hay `.env`** trackeado.
  - Buscar `APP_KEY` o secretos en el historial (`git log -p -- .env`, `git grep` en commits).
  - Si hay secretos en el historial → limpiar antes de hacer el repo público (BFG/filter-repo).
- [ ] **Decidir package manager:** el que tenga su lockfile trackeado manda
  (en base-page: `package-lock.json` → **npm**). Nunca mezclar con pnpm/yarn.
- [ ] Crear el doc de plan en `.github/prompts/plan-<tema>.md` (como este).
- [ ] Workflow de un paso a la vez: ejecuto → reporto → espero "terminado".

## Fase 1 — Estructura del repo

- [ ] Si la app vive en un subdirectorio (ej. `web/`), **moverla a la raíz** del repo.
  - ⚠️ Primero corregir el `.gitignore` (ver Fase 6): si ignora cosas que están trackeadas
    (`phpunit.xml`, `composer.lock`, `public/index.php`, `/storage/framework/views`…),
    el commit de reestructuración las **borra sin querer**.
  - Verificar con `git status` que los renames aparecen (no deletes + adds).
- [ ] Verificar que la app arranca después del move: `php artisan route:list` + `view:cache`.

## Fase 2 — UI en inglés

- [ ] Inventario con grep (español: Inicio, derechos reservados, Logo de, Inicializando, …).
- [ ] Cambiar SOLO texto visible: footer, navbar, `alt=`, `console.log`, textos de landing.
- [ ] **No tocar** comentarios (`{{-- --}}`, `//`, `/* */`) salvo petición explícita.
- [ ] No tocar `storage/framework/views` (caché) ni `public/js/app.js` compilado (se regenera).
- [ ] Verificar: `php artisan view:cache` OK + escaneo final de acentos (`[áéíóúñ]`) → 0 resultados.

## Fase 3 — Landing / contenido nuevo (React en base-page)

- [ ] Crear componente en `resources/js/components/` (auto-monta en su `#app-root`).
- [ ] `app.js`: requerir el nuevo; dejar el de ejemplo **comentado**, no borrado.
- [ ] Vista Blade: `#app-root` nuevo; `#example` viejo comentado en `{{-- --}}`.
- [ ] Quitar enlaces redundantes de la navbar (botón Home) — preservando comentarios salvo orden.
- [ ] Verificar: `view:cache` + `route:list` + `Example.js` sigue existiendo.

## Fase 4 — Limpieza de dependencias ("desinstalar lo que no haga falta")

- [ ] Auditar **uso real** de cada dependencia (grep de require/import en el código).
  - Ejemplo base-page: `browser-sync` solo en bloque **comentado** → fuera.
- [ ] Quitar de `package.json` + regenerar lockfile con el package manager correcto.
- [ ] `node_modules` contaminado (síntomas: `node_modules/.pnpm` + `.ignored_*` + raras):
  ```powershell
  cmd /c "rd /s /q node_modules"     # NO Remove-Item, las junctions de pnpm sobreviven
  Remove-Item pnpm-lock.yaml -ErrorAction SilentlyContinue
  npm ci
  ```
- [ ] ⚠️ **Nunca usar `pnpm dev`/`pnpm install`** en un repo npm: rompe el árbol otra vez.

## Fase 5 — Reconstruir assets (build)

- [ ] `npm run prod` y verificar `public/js/app.js`, `public/css/app.css`, `mix-manifest.json`.
- [ ] Verificar que el bundle contiene lo nuevo y ya NO contiene lo viejo (grep de strings).
- [ ] **Error típico Node 22+ con laravel-mix 6:** `require is not defined in ES module scope`
  (en `yargs/yargs`) → `laravel-mix@6` hace `require('yargs/yargs')` y yargs 17 tiene
  `type: module`. **Fix mínimo comprobado** en `package.json`:
  ```json
  "overrides": { "yargs": "^18.2.0" }
  ```
  (yargs 18 sí se puede requerir desde Node ≥20/22/26; compila limpio).
- [ ] **Error `Cannot read properties of undefined (reading 'tap')`** → node_modules mezclado
  (pnpm/npm). Volver a Fase 4.
- [ ] Probar también `npm run development` (lo que usará el día a día).

## Fase 6 — .gitignore

- [ ] Corregir líneas que ignoren archivos **trackeados**:
  `git ls-files -i -c --exclude-standard` → debe devolver **vacío**.
- [ ] Confirmar ignorados: `.env`, `vendor/`, `node_modules/`, `.phpunit.result.cache`,
  `.playwright-mcp/`.
- [ ] Confirmar trackeados: `.env.example`, `composer.lock`, `phpunit.xml`,
  `public/index.php`, `public/.htaccess`.
- [ ] Eliminar líneas muertas (carpetas que nunca existieron / nombres ajenos).
- [ ] `git status` limpio de restos.

## Fase 7 — README profesional

- [ ] Idioma: **español** (decisión del usuario), aspecto profesional de entrada al repo.
- [ ] Secciones: título + logo, características, capturas (placeholder si faltan), stack en
  tabla (versiones leídas de los manifests), requisitos (**indicar npm si aplica**),
  instalación paso a paso, uso + comandos, estructura, tutorial breve, licencia, autor.
- [ ] Verificar que las rutas de imágenes del README existan.

## Fase 8 — LICENSE + metadatos

- [ ] `LICENSE` MIT en raíz (`Copyright (c) <año> <autor>`).
- [ ] README enlaza `[MIT](LICENSE)`.
- [ ] `composer.json`: `name`, `description`, `keywords`, `authors` (NO inventar emails),
  `license` (ojo: `name` entra en el hash de `composer.lock` → `composer update --lock`
  solo reescribe 1 línea, sin tocar dependencias) → `composer validate` debe decir "is valid".
- [ ] `package.json`: `name`, `description`, `author`, `license`.

## Fase 9 — CI (GitHub Actions)

- [ ] `.github/workflows/ci.yml` con 2 jobs:
  - **tests**: matriz PHP (mínimo del composer + versión local), `composer install`,
    `cp .env.example .env`, `key:generate`, `php artisan test`.
  - **assets**: matriz Node LTS (20, 22), `npm ci`, `npm run prod`.
  - Triggers: `push`/`pull_request` a la rama principal.
- [ ] **Baseline local** antes: `php artisan test` debe pasar.
- [ ] Validar YAML (en Laravel: `symfony/yaml` de vendor con `php -r`).
- [ ] El workflow solo se puede verificar real **después del push**.

## Fase 10 — Favicons + SEO (si hay páginas públicas)

> Obligatorio: leer `~/.config/opencode/rules/seo.md` ANTES de tocar `<head>` público.

- [ ] Set de favicons en `public/imgs/favicons/` (o `img/`, consistente):
  `favicon.svg` + `favicon.ico` + PNGs (96/32/16) + `apple-touch-icon.png` (180) +
  `site.webmanifest` + 2 icons PWA (192/512). **NO duplicar pares**
  (`android-chrome-*` vs `web-app-manifest-*` → quedarse con los que use el manifest).
- [ ] **SVG:** comprobar `xmlns="http://www.w3.org/2000/svg"` (un `http://w3.org` a secas
  hace que el navegador no lo dibuje) y `width`/`height` con `viewBox`.
- [ ] `.ico` → **conservarlo** (Safari no soporta SVG; fallback universal).
- [ ] `site.webmanifest`: reemplazar placeholders (`MyWebSite`/`MySite`) por el nombre real;
  icons con rutas absolutas verificadas (200).
- [ ] `<head>` público: `title` ~60 + `meta description` ~155 + `canonical` + `theme-color` +
  Open Graph + Twitter Card. `og:image` solo si `public/og-image.png` existe (no inventar).
- [ ] `<head>` admin/privado: `noindex, nofollow`.
- [ ] Navbars/README apuntando a la ruta nueva del logo (grep `/img/`, `/imgs/`).
- [ ] Logo personal → sustituir por placeholder genérico (marca abstracta tipo "layers",
  **no** silueta de avatar: parece foto de perfil).
- [ ] Verificación: `view:cache` + GET de cada asset (200) + head renderizado por HTTP +
  screenshot de navbar.

## Fase 11 — robots.txt y sitemap.xml

- [ ] `robots.txt`: política de bots de IA según indique el usuario (**preguntar, no decidir**:
  permitir todo / bloquear bots de IA) + línea `Sitemap:`.
- [ ] `sitemap.xml`: solo si el usuario lo pide / saber el dominio.
- [ ] **Dominio real desconocido** (template) → placeholder `[DOMINIO]` en canonical, og:url,
  sitemap y robots; documentar en README la sección **"Antes de ir a producción"** con la
  lista de reemplazos pendientes.
- [ ] Reportar siempre la lista completa de `[PENDIENTE]`.

## Fase 12 — Commits y push

- [ ] **Un commit por paso terminado** (o agrupado cuando el usuario lo pida).
- [ ] Antes de commitear: marcar el paso como terminado en este plan/checkbox.
- [ ] `git status` → separar: (a) lo mío, (b) cambios del usuario → **preguntar con menú**,
  (c) mixtos → van completos y mencionarlos.
- [ ] Estilo de mensaje: inglés, tipo `Add CI workflow, MIT license, favicon set…`.
- [ ] Si falla con `Permission denied` en `.git/objects` → es bloqueo transitorio de
  Windows/antivirus; **reintentar** (el add fallido no commitea nada).
- [ ] **Push solo con aprobación explícita** del usuario.

---

## Lecciones rápidas (trampas encontradas en base-page)

| Síntoma | Causa | Fix |
|---|---|---|
| `webpack` no encontrado / bins faltantes | `node_modules` instalado por pnpm en repo npm | `rd /s /q node_modules` + `npm ci` |
| `require is not defined in ES module scope` (yargs) | laravel-mix 6 + Node 22+ | `"overrides": {"yargs": "^18.2.0"}` |
| `Cannot read properties of undefined (reading 'tap')` | árbol npm+pnpm mezclado | reinstalar limpio (Fase 4) |
| Favicon SVG no se ve | `xmlns` mal escrito o sin `width`/`height` | corregir namespace + tamaño |
| Favicon correcto pero no cambia | caché de favicon del navegador | probar en incógnito / `?v=N` |
| Logo roto tras mover carpeta | rutas `asset()` sin actualizar | grep `/ruta-vieja/` en todo el repo |
| Archivos trackeados desaparecen en un commit | `.gitignore` los excluía | corregir `.gitignore` ANTES del move |
