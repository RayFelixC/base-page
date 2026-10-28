# Base Laravel Page

<img src="public/img/logo.svg" alt="Base Laravel Page logo" width="120">

Plantilla base para desarrollar páginas y aplicaciones web modernas con **Laravel 10**, **Bootstrap 5** y **React 17**. Incluye autenticación lista para usar, UI responsiva y una landing de ejemplo montada en React — todo sobre una base limpia y escalable.

> Creado por **Ray Felix**.

---

## ✨ Características

- **Laravel 10 + PHP 8.1** — routing, Eloquent ORM, plantillas Blade y autenticación de API con Sanctum.
- **Autenticación completa** — login, registro, recuperación de contraseña y verificación de email vía Laravel UI.
- **Bootstrap 5 + Sass** — UI responsiva (mobile-first) con variables SCSS personalizables y Bootstrap Icons.
- **React 17 integrado** — monta componentes interactivos en cualquier vista Blade con JSX y Laravel Mix.
- **Landing de ejemplo** — componente `Landing.js` (hero, features y call-to-action) que sirve de punto de partida.

## 📸 Capturas

> *Próximamente: capturas de la landing y del panel de administración.*

## 🛠️ Stack tecnológico

| Tecnología | Versión |
|---|---|
| PHP | ^8.1 |
| Laravel | ^10.0 |
| Bootstrap | ^5.3 |
| React / ReactDOM | ^17.0.2 |
| Laravel Mix | ^6 |
| Sass | ^1.x |

## 📋 Requisitos

- PHP 8.1 o superior
- Composer
- Node.js 18+ y **npm** (el proyecto usa `package-lock.json`)

## 🚀 Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/RayFelixC/base-page.git
cd base-page

# 2. Dependencias de PHP
composer install

# 3. Configuración
cp .env.example .env
php artisan key:generate

# 4. Base de datos (configura tus credenciales en .env antes)
php artisan migrate

# 5. Dependencias de JS y assets compilados
npm ci
npm run prod
```

## ▶️ Uso

```bash
php artisan serve
```

Visita `http://localhost:8000`. La landing de ejemplo se monta automáticamente en el `#app-root` de `resources/views/web/home.blade.php`.

### Comandos de assets

| Comando | Descripción |
|---|---|
| `npm run dev` | Compilación de desarrollo |
| `npm run watch` | Compilación con recarga automática |
| `npm run prod` | Compilación optimizada para producción |

## 📂 Estructura

```
app/Http/Controllers/     Controladores web, API y de autenticación
resources/js/             JavaScript de la app (React, bootstrap, scripts)
  └── components/         Componentes React (Landing.js, Example.js)
resources/sass/           Estilos SCSS (variables, bootstrap, styles)
resources/views/          Plantillas Blade (web/ y admin/)
routes/                   Definición de rutas
public/                   Assets compilados y favicon
```

## 🧩 Cómo usar los componentes React

1. Crea tu componente en `resources/js/components/MiComponente.js` (usa `Landing.js` como referencia).
2. Agrégalo en `resources/js/app.js`:
   ```js
   require('./components/MiComponente');
   ```
3. Añade el punto de montaje en tu vista Blade:
   ```blade
   <div id="mi-componente"></div>
   ```
4. Compila con `npm run dev` (o `npm run watch` durante el desarrollo).

El componente `Example.js` queda incluido pero deshabilitado como referencia extra.

## 📄 Licencia

Este proyecto se publica bajo la licencia [MIT](LICENSE).

---

**Ray Felix** — [GitHub](https://github.com/RayFelixC)
