# 💇‍♀️ Sistema de Gestión para Salón de Belleza

Aplicación web integral desarrollada con **Laravel** para la gestión completa de un salón de belleza. Incluye administración de servicios, control de horarios, gestión de clientes y sistema de citas con reportería avanzada en PDF y Excel.

## 📋 Tabla de Contenidos

- [Características](#-características)
- [Requisitos del Sistema](#-requisitos-del-sistema)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
- [Uso](#-uso)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Comandos Útiles](#-comandos-útiles)
- [Contribuir](#-contribuir)
- [Licencia](#-licencia)

## ✨ Características

### Autenticación y Seguridad
- Sistema completo de login y registro de usuarios
- Middleware de protección por roles (admin)
- Gestión segura de sesiones

### Panel Administrativo
**Dashboard Interactivo**
- 📊 Estadísticas en tiempo real:
  - Citas programadas para hoy
  - Citas pendientes de confirmación
  - Contador de clientes activos
  - Ingresos mensuales
  - Servicios más populares
  - Registro de clientes recientes

**Módulos de Gestión**
- ✂️ **Servicios**: CRUD completo con función de activar/desactivar
- 👥 **Usuarios**: Administración de clientes y cambio de estados
- 🕐 **Horarios**: Configuración de horarios de atención
- 📅 **Citas**: 
  - Listado completo con filtros
  - Vista detallada de cada cita
  - Relaciones con clientes y servicios

### Sistema de Reportes
- 📄 Generación de reportes en PDF por rango de fechas
- 📊 Exportación de datos a Excel (.xlsx)
- 📋 Exportación a formato CSV
- 🔍 Filtros personalizables

### Interfaz de Usuario
- Diseño responsive con Tailwind CSS
- Componentes Blade reutilizables
- Experiencia de usuario optimizada

## 🔧 Requisitos del Sistema

### Software Requerido
- **PHP** >= 8.2
- **Composer** (última versión)
- **MySQL** / MariaDB 10.3+ (o motor compatible)
- **Node.js** >= 16.x y npm (para compilación de assets)

### Extensiones PHP Requeridas
```
- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath
- Fileinfo
- GD
```

### Paquetes Adicionales
- [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf) - Generación de PDFs
- [maatwebsite/excel](https://laravel-excel.com/) - Exportación Excel/CSV

## 🚀 Instalación

### 1. Clonar el Repositorio

```bash
git clone https://github.com/Juanvidal01/Salon-De-Belleza.git
cd Salon-De-Belleza
```

### 2. Instalar Dependencias PHP

```bash
composer install
```

### 3. Instalar Dependencias Frontend

```bash
npm install
```

### 4. Configurar Variables de Entorno

```bash
cp .env.example .env
```

Edita el archivo `.env` con tu configuración:

```env
APP_NAME="Salón de Belleza"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=salon_de_belleza
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Generar Clave de Aplicación

```bash
php artisan key:generate
```

### 6. Crear Base de Datos

Crea una base de datos en MySQL con el nombre especificado en `.env`:

```sql
CREATE DATABASE salon_de_belleza CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7. Ejecutar Migraciones

```bash
php artisan migrate
```

Para incluir datos de prueba (opcional):

```bash
php artisan db:seed
```

### 8. Compilar Assets

**Modo desarrollo:**
```bash
npm run dev
```

**Modo producción:**
```bash
npm run build
```

### 9. Iniciar Servidor de Desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en: `http://127.0.0.1:8000`

## 🔐 Configuración

### Acceso Administrativo

1. Accede a la ruta raíz `/` que redirige al login
2. Inicia sesión con credenciales de administrador
3. El panel administrativo estará disponible en `/admin/dashboard`

### Middleware de Seguridad

El middleware `admin` protege todas las rutas administrativas. Solo usuarios con rol de administrador pueden acceder al panel.

## 📖 Uso

### Rutas Principales

#### Públicas / Autenticación
```
GET  /              → Redirige al login
GET  /login         → Formulario de inicio de sesión
POST /login         → Procesa login
GET  /register      → Formulario de registro
POST /register      → Procesa registro
POST /logout        → Cerrar sesión
```

#### Panel Administrativo
```
Prefix: /admin
Middleware: admin
Name prefix: admin.*

GET /admin/dashboard  → Dashboard principal
GET /admin/servicios  → Gestión de servicios
GET /admin/usuarios   → Gestión de usuarios
GET /admin/horarios   → Gestión de horarios
GET /admin/citas      → Gestión de citas
```

#### Reportes y Exportaciones
```
GET /admin/reportes
    → Centro de reportes (estadísticas y filtros)

GET /admin/reportes/citas-pdf?fecha_inicio=YYYY-MM-DD&fecha_fin=YYYY-MM-DD
    → Genera PDF con citas del rango especificado

GET /admin/exports/citas/excel
    → Exporta todas las citas a Excel (.xlsx)

GET /admin/exports/citas/csv
    → Exporta todas las citas a CSV
```

### Módulo de Reportes

El módulo de reportes permite:

1. **Visualizar estadísticas globales:**
   - Total de clientes registrados
   - Total de citas agendadas
   - Ingresos totales acumulados

2. **Generar reportes personalizados:**
   - Filtrar citas por rango de fechas
   - Exportar en múltiples formatos
   - Visualizar citas recientes

3. **Análisis de datos:**
   - Servicios más solicitados
   - Tendencias de reservas
   - Comportamiento de clientes

## 📁 Estructura del Proyecto

```
salon-de-belleza/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CitaController.php
│   │   │   ├── ServicioController.php
│   │   │   ├── ReporteController.php
│   │   │   └── ...
│   │   └── Middleware/
│   │       └── CheckAdmin.php
│   └── Models/
│       ├── Cita.php
│       ├── Servicio.php
│       ├── User.php
│       └── ...
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── citas/
│       │   ├── servicios/
│       │   ├── horarios/
│       │   └── usuarios/
│       ├── reportes/
│       │   ├── index.blade.php
│       │   └── citas-pdf.blade.php
│       └── auth/
│           ├── login.blade.php
│           └── register.blade.php
├── routes/
│   └── web.php
├── database/
│   └── migrations/
└── public/
```

## 🛠 Comandos Útiles

### Limpieza de Cachés

```bash
php artisan config:clear    # Limpiar caché de configuración
php artisan cache:clear     # Limpiar caché de aplicación
php artisan route:clear     # Limpiar caché de rutas
php artisan view:clear      # Limpiar caché de vistas
php artisan optimize:clear  # Limpiar todos los cachés
```

### Desarrollo

```bash
php artisan route:list      # Listar todas las rutas
php artisan migrate:fresh   # Recrear base de datos
php artisan test           # Ejecutar pruebas
php artisan tinker         # Consola interactiva
```

### Producción

```bash
php artisan config:cache   # Cachear configuración
php artisan route:cache    # Cachear rutas
php artisan view:cache     # Cachear vistas
php artisan optimize       # Optimizar aplicación
```

## 🤝 Contribuir

Las contribuciones son bienvenidas. Para contribuir:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add: nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto se desarrolla con fines académicos y demostrativos. Puedes adaptarlo y extenderlo según tus necesidades. Si lo utilizas como base para otro proyecto, se agradece la referencia al [repositorio original](https://github.com/Juanvidal01/Salon-De-Belleza).

---

## 👥 Autor

**Juan Vidal-Jhon Victor Lopez**
- GitHub: [@Juanvidal01](https://github.com/Juanvidal01)


---

⭐ Si este proyecto te fue útil, considera darle una estrella en GitHub