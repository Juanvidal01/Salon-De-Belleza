# 📘 Manual de Usuario – Sistema de Gestión para Salón de Belleza

---

## 🧴 1. Introducción

El **Sistema de Gestión para Salón de Belleza** es una plataforma web desarrollada en Laravel que permite administrar clientes, servicios, horarios y citas de manera rápida y eficiente. Incluye un panel de administración completo, control de acceso seguro con login, generación de reportes en PDF y Excel, y un gestor integral de citas.

Este manual tiene como objetivo guiar tanto al **usuario final** como al **administrador** en el uso correcto y aprovechamiento máximo de todas las funcionalidades del sistema.

### ✨ Características principales:
- 📊 Dashboard con estadísticas en tiempo real
- 📅 Gestión completa de citas
- 💇‍♀️ Administración de servicios
- 👥 Control de usuarios y clientes
- 🕐 Configuración de horarios de atención
- 📄 Generación de reportes PDF y exportación Excel/CSV

---

## 🔐 2. Acceso al Sistema

### 🔹 Iniciar Sesión

1. **Ingresa a la URL del sistema:**
   ```
   http://localhost:8000
   ```
   > **Nota:** En producción, utiliza el dominio proporcionado por tu organización.

2. El sistema **redirige automáticamente** al formulario de login.

3. **Introduce tus credenciales:**
   - 📧 **Correo electrónico:** Tu email registrado
   - 🔒 **Contraseña:** Tu contraseña personal

4. Haz clic en el botón **"Entrar"**.

### 🔹 Recordarme

Marca la casilla **"Recordarme"** si deseas mantener tu sesión iniciada en este dispositivo. Esto evitará que tengas que iniciar sesión cada vez que accedas al sistema.

> ⚠️ **Advertencia:** No uses esta opción en computadoras compartidas o públicas.

### 🔹 Recuperar Contraseña

Si olvidaste tu contraseña:

1. En la pantalla de login, haz clic en **"¿Olvidaste tu contraseña?"**
2. Ingresa tu correo electrónico registrado
3. Revisa tu bandeja de entrada
4. Sigue el enlace de recuperación recibido
5. Establece una nueva contraseña segura

---

## 🏠 3. Panel de Administración (Dashboard)

Después de iniciar sesión, si cuentas con permisos de **administrador**, serás dirigido al **Panel Administrativo Principal**.

### 📊 Estadísticas del Dashboard

El dashboard muestra información clave en tiempo real:

#### **Tarjetas de Métricas:**
- 📅 **Citas del día:** Cantidad de citas programadas para hoy
- ⏳ **Citas pendientes:** Citas que requieren confirmación
- 👥 **Clientes activos:** Total de clientes registrados en el sistema
- 💰 **Ingresos del mes:** Total de ingresos generados en el mes actual

#### **Secciones Informativas:**
- 📌 **Próximas citas:** Listado de las siguientes citas programadas
- 🔝 **Servicios más solicitados:** Los servicios con mayor demanda
- 🆕 **Clientes recientes:** Últimos clientes registrados

### 🎯 Accesos Rápidos

Desde el dashboard puedes acceder directamente a:

| Módulo | Descripción |
|--------|-------------|
| 📅 **Citas** | Gestión completa de reservaciones |
| 👥 **Usuarios** | Administración de clientes |
| 💇‍♀️ **Servicios** | Catálogo de servicios del salón |
| 🕐 **Horarios** | Configuración de disponibilidad |
| 📊 **Reportes** | Generación de informes y análisis |

---

## 📅 4. Gestión de Citas

El módulo de citas es el corazón del sistema, permitiendo una administración eficiente de todas las reservaciones.

### 🔹 Ver Todas las Citas

1. En el panel lateral o menú principal, selecciona **"Gestionar Citas"** o **"Citas"**
2. Se desplegará un **listado completo** con las siguientes columnas:
   - 📆 **Fecha:** Día de la cita
   - 🕐 **Hora:** Horario programado
   - 👤 **Cliente:** Nombre del cliente
   - 💇‍♀️ **Servicios:** Servicios solicitados
   - 🏷️ **Estado:** Situación actual (Pendiente/Confirmada/Realizada/Cancelada)
   - 💵 **Total:** Monto total de la cita

3. Utiliza los **filtros** disponibles para buscar citas específicas por:
   - Fecha
   - Cliente
   - Estado
   - Servicio

### 🔹 Crear Nueva Cita

Para agendar una nueva cita:

1. Haz clic en el botón **"Nueva Cita"** o **"Crear Cita"**

2. **Completa el formulario:**
   - 👤 **Selecciona el cliente:**
     - Busca en el listado de clientes existentes
     - O crea un nuevo cliente desde esta pantalla

   - 💇‍♀️ **Selecciona los servicios:**
     - Marca uno o varios servicios del catálogo
     - El sistema calcula automáticamente el total
     - Verifica la duración estimada

   - 📅 **Elige fecha y hora:**
     - Utiliza el calendario interactivo
     - Solo se mostrarán horarios disponibles
     - El sistema previene conflictos de horario

   - 📝 **Notas adicionales (opcional):**
     - Agrega observaciones especiales
     - Preferencias del cliente
     - Requerimientos específicos

3. Haz clic en **"Guardar Cita"** o **"Agendar"**

4. Recibirás una **confirmación** de la cita creada

### 🔹 Editar Cita Existente

Para modificar una cita ya agendada:

1. En la lista de citas, localiza la cita que deseas modificar
2. Haz clic en el botón **"Editar"** (icono de lápiz ✏️)
3. Modifica los campos necesarios:
   - Cliente
   - Servicios
   - Fecha u hora
   - Estado
   - Observaciones
4. Haz clic en **"Guardar Cambios"**
5. La cita se actualizará inmediatamente

> 💡 **Tip:** Los cambios en citas confirmadas pueden requerir notificar al cliente.

### 🔹 Cambiar Estado de Cita

Las citas pueden tener diferentes estados según su situación:

| Estado | Descripción | Cuándo usar |
|--------|-------------|-------------|
| ⏳ **Pendiente** | Cita creada pero no confirmada | Al crear la cita inicialmente |
| ✅ **Confirmada** | Cliente confirmó su asistencia | Después de contactar al cliente |
| ✔️ **Realizada** | Servicio completado | Al finalizar la atención |
| ❌ **Cancelada** | Cita cancelada | Cuando el cliente no asistirá |

**Para cambiar el estado:**

1. Localiza la cita en el listado
2. Haz clic en el **selector de estado** o botón de estado
3. Selecciona el nuevo estado
4. Confirma el cambio
5. El sistema actualiza automáticamente las estadísticas

### 🔹 Ver Detalle de Cita

1. Haz clic en cualquier cita del listado
2. Se mostrará una vista detallada con:
   - Información completa del cliente
   - Todos los servicios incluidos
   - Fecha y hora exacta
   - Estado actual
   - Historial de cambios
   - Total a pagar
   - Notas y observaciones

### 🔹 Eliminar Cita

> ⚠️ **Precaución:** Esta acción puede ser irreversible.

1. En la vista de detalle o listado
2. Haz clic en **"Eliminar"** (icono de basura 🗑️)
3. Confirma la eliminación
4. La cita será removida del sistema

---

## 💇‍♀️ 5. Gestión de Servicios

El catálogo de servicios es fundamental para el funcionamiento del salón. Aquí puedes administrar todos los tratamientos y servicios ofrecidos.

### 🔹 Ver Servicios

1. En el menú de administración, selecciona **"Servicios"**
2. Se mostrará el **catálogo completo** de servicios con:
   - 💇‍♀️ **Nombre del servicio**
   - 💵 **Precio**
   - ⏱️ **Duración estimada**
   - 📝 **Descripción**
   - 🏷️ **Estado** (Activo/Inactivo)

### 🔹 Crear Nuevo Servicio

Para añadir un nuevo servicio al catálogo:

1. Haz clic en **"Nuevo Servicio"** o **"Agregar Servicio"**

2. **Completa el formulario:**
   ```
   📝 Nombre del servicio: Corte de cabello dama
   💰 Precio: $25.00
   ⏱️ Duración: 45 minutos
   📄 Descripción: Corte personalizado según preferencias
   🖼️ Imagen (opcional): Sube una foto representativa
   ```

3. Haz clic en **"Guardar Servicio"**

4. El servicio aparecerá inmediatamente en el catálogo

### 🔹 Editar Servicio

1. Localiza el servicio en el listado
2. Haz clic en **"Editar"** (✏️)
3. Modifica los campos necesarios
4. Guarda los cambios

### 🔹 Activar/Desactivar Servicio

En lugar de eliminar servicios, puedes **desactivarlos temporalmente**:

- **Servicio Activo (🟢):** 
  - Visible para agendar citas
  - Aparece en el catálogo público
  
- **Servicio Inactivo (🔴):**
  - No disponible para nuevas citas
  - No se elimina del sistema
  - Se mantiene el historial

**Para cambiar el estado:**

1. Localiza el servicio
2. Haz clic en el **botón de estado** o switch
3. El cambio es inmediato

> 💡 **Tip:** Usa esta función para servicios temporales o de temporada.

### 🔹 Eliminar Servicio

> ⚠️ **Advertencia:** Solo elimina servicios que nunca se han usado. Los servicios con citas asociadas no deberían eliminarse.

1. Haz clic en **"Eliminar"** (🗑️)
2. Confirma la acción
3. El servicio será removido permanentemente

---

## 👥 6. Gestión de Usuarios

Este módulo permite administrar todos los usuarios del sistema, principalmente clientes del salón.

### 🔹 Ver Lista de Usuarios

1. En el menú de administración, selecciona **"Usuarios"** o **"Clientes"**
2. Se mostrará un listado completo con:
   - 👤 **Nombre completo**
   - 📧 **Correo electrónico**
   - 📱 **Teléfono**
   - 📅 **Fecha de registro**
   - 🏷️ **Estado** (Activo/Inactivo)
   - 🎭 **Rol** (Cliente/Administrador)

### 🔹 Crear Nuevo Usuario

1. Haz clic en **"Nuevo Usuario"**

2. **Completa el formulario de registro:**
   ```
   👤 Nombre completo: María Rodríguez
   📧 Email: maria@email.com
   📱 Teléfono: +57 300 123 4567
   🔒 Contraseña: ••••••••
   🎭 Rol: Cliente
   ```

3. Haz clic en **"Guardar Usuario"**

### 🔹 Editar Información de Usuario

Para actualizar datos de un cliente:

1. Localiza el usuario en el listado
2. Haz clic en **"Editar"** (✏️)
3. Modifica los campos permitidos:
   - ✅ Nombre
   - ✅ Email
   - ✅ Teléfono
   - ✅ Estado (Activo/Inactivo)
   - ❌ Contraseña (requiere procedimiento especial)
4. Guarda los cambios

### 🔹 Cambiar Estado del Usuario

Puedes activar o desactivar usuarios:

- **Usuario Activo (🟢):**
  - Puede iniciar sesión
  - Puede agendar citas
  - Recibe notificaciones

- **Usuario Inactivo (🔴):**
  - No puede acceder al sistema
  - No puede crear nuevas citas
  - Se mantiene el historial

**Para cambiar el estado:**

1. Localiza el usuario
2. Usa el botón o switch de **"Estado"**
3. Confirma el cambio

### 🔹 Ver Historial del Cliente

1. Haz clic en el nombre del usuario
2. Se mostrará su perfil completo con:
   - Datos personales
   - Historial de citas
   - Servicios más utilizados
   - Total gastado
   - Última visita

---

## 🕒 7. Gestión de Horarios

La configuración de horarios define la disponibilidad del salón para agendar citas.

### 🔹 Ver Horarios Configurados

1. En el menú de administración, selecciona **"Horarios"**
2. Se mostrará la configuración semanal:
   - 📅 Día de la semana
   - 🕐 Hora de inicio
   - 🕐 Hora de fin
   - 🏷️ Estado (Activo/Inactivo)

### 🔹 Crear Nuevo Horario

Para configurar la disponibilidad de un día:

1. Haz clic en **"Nuevo Horario"** o **"Agregar Horario"**

2. **Completa el formulario:**
   ```
   📅 Día: Lunes
   🕐 Hora inicio: 09:00 AM
   🕐 Hora fin: 06:00 PM
   ⏰ Intervalo de citas: 30 minutos
   ```

3. Haz clic en **"Guardar Horario"**

### 🔹 Configuración de Días Especiales

Para configurar horarios excepcionales (festivos, eventos especiales):

1. Selecciona **"Horarios Especiales"**
2. Indica la fecha específica
3. Configura el horario o márcalo como **"Cerrado"**
4. Guarda la configuración

### 🔹 Bloquear Horarios

Para reservar espacios o bloquear horarios temporalmente:

1. Selecciona el día y horario
2. Haz clic en **"Bloquear"**
3. Indica el motivo (opcional)
4. Confirma el bloqueo

> 💡 **Tip:** Usa esta función para pausas, reuniones o mantenimiento.

### 🔹 Editar Horario

1. Localiza el horario a modificar
2. Haz clic en **"Editar"** (✏️)
3. Ajusta los horarios según sea necesario
4. Guarda los cambios

> ⚠️ **Advertencia:** Cambios en horarios pueden afectar citas ya agendadas.

---

## 📊 8. Reportes (PDF y Excel)

El módulo de reportes te permite generar informes detallados y exportar información para análisis externos.

### 📄 Reporte PDF de Citas por Período

Para generar un reporte imprimible en PDF:

1. En el panel principal, selecciona **"Reportes"**

2. Ubica la sección **"Reporte de Citas"**

3. **Configura el período:**
   ```
   📅 Fecha inicio: 01/11/2025
   📅 Fecha fin: 30/11/2025
   ```

4. Haz clic en **"Generar PDF"** o **"Descargar PDF"**

5. El sistema procesará y descargará un archivo PDF que incluye:
   - 📋 Listado completo de citas del período
   - 👤 Información detallada de cada cliente
   - 📅 Fechas y horarios
   - 💇‍♀️ Servicios realizados
   - 🏷️ Estado de cada cita
   - 💰 Totales y subtotales
   - 📊 Estadísticas del período:
     - Total de citas
     - Ingresos generados
     - Servicios más solicitados
     - Tasa de cancelación

### 📈 Exportación a Excel

Para análisis detallado en hojas de cálculo:

1. En **"Reportes"**, ubica la sección **"Exportar Citas"**

2. Selecciona el formato deseado:

   **Opción A: Exportar a Excel (.xlsx)**
   - Haz clic en **"Exportar Excel"**
   - Se descargará un archivo `.xlsx`
   - Compatible con Microsoft Excel, Google Sheets, LibreOffice

   **Opción B: Exportar a CSV (.csv)**
   - Haz clic en **"Exportar CSV"**
   - Se descargará un archivo `.csv`
   - Compatible con cualquier software de análisis de datos

### 📊 Contenido de las Exportaciones

Los archivos exportados incluyen las siguientes columnas:

| Columna | Descripción |
|---------|-------------|
| **ID** | Identificador único de la cita |
| **Fecha** | Fecha de la cita |
| **Hora** | Hora programada |
| **Cliente** | Nombre completo del cliente |
| **Email** | Correo del cliente |
| **Teléfono** | Contacto del cliente |
| **Servicios** | Lista de servicios solicitados |
| **Estado** | Estado actual de la cita |
| **Total** | Monto total |
| **Creada** | Fecha de creación |

### 📑 Otros Reportes Disponibles

Según la configuración del sistema, también puedes generar:

- 📊 **Reporte de Servicios:** Estadísticas de servicios más solicitados
- 👥 **Reporte de Clientes:** Análisis de clientes frecuentes
- 💰 **Reporte Financiero:** Ingresos por período
- 📅 **Reporte de Ocupación:** Análisis de horarios más demandados

### 💡 Consejos para Reportes

- **Genera reportes mensualmente** para llevar control de tu negocio
- **Usa Excel** para crear gráficos y análisis personalizados
- **Archiva los PDFs** como respaldo documental
- **Compara períodos** para identificar tendencias
- **Revisa la tasa de cancelación** para mejorar confirmaciones

---

## 🛠️ 9. Accesos Rápidos en el Dashboard

El dashboard está diseñado para maximizar tu eficiencia con accesos directos a las funciones más utilizadas.

### 🎯 Tarjetas de Acceso Rápido

Desde el panel principal encontrarás botones de acceso directo:

| Acceso | Función | Icono |
|--------|---------|-------|
| 📅 **Citas** | Ver y gestionar todas las citas | 📅 |
| 👥 **Usuarios** | Administrar clientes | 👤 |
| 💇‍♀️ **Servicios** | Gestionar catálogo de servicios | ✂️ |
| 🕐 **Horarios** | Configurar disponibilidad | ⏰ |
| 📊 **Reportes** | Generar informes y exportaciones | 📈 |

### ⚡ Acciones Rápidas

En el dashboard también puedes realizar acciones inmediatas:

- **Nueva Cita:** Botón destacado para agendar rápidamente
- **Ver Citas de Hoy:** Lista de las citas del día actual
- **Próximas Citas:** Visualización de las siguientes reservaciones
- **Clientes Recientes:** Acceso rápido a últimos registros

### 🔔 Notificaciones y Alertas

El sistema puede mostrar notificaciones importantes:

- 🔴 **Citas pendientes de confirmar**
- 🟡 **Citas próximas (en las siguientes 2 horas)**
- 🟢 **Nuevas reservaciones**
- ⚠️ **Horarios con alta demanda**

---

## 🧰 10. Cerrar Sesión

Para salir del sistema de forma segura:

### Método 1: Desde el Menú de Usuario

1. En la **esquina superior derecha**, haz clic en tu nombre o avatar
2. Se desplegará un menú con opciones
3. Selecciona **"Cerrar Sesión"** o **"Salir"**
4. Serás redirigido a la pantalla de login

### Método 2: Desde el Menú Lateral (si está disponible)

1. En el menú de navegación lateral
2. Busca la opción **"Cerrar Sesión"** (generalmente al final)
3. Haz clic y confirma

### 🔒 Recomendaciones de Seguridad

- ✅ **Siempre cierra sesión** al terminar de usar el sistema
- ✅ **Especialmente importante** en computadoras compartidas
- ✅ **No dejes la sesión abierta** sin supervisión
- ✅ **Usa contraseñas seguras** y cámbialas periódicamente
- ✅ **No compartas tus credenciales** con otros usuarios

---

## 📌 11. Recomendaciones de Uso

Para aprovechar al máximo el sistema, sigue estas mejores prácticas:

### 📋 Gestión Diaria

- ✅ **Revisa las citas pendientes cada día** (al inicio de la jornada)
- ✅ **Actualiza el estado de las citas** en tiempo real
- ✅ **Confirma las citas** con anticipación para reducir cancelaciones
- ✅ **Verifica los horarios** disponibles antes de agendar

### 📊 Análisis y Mejora

- ✅ **Genera reportes mensualmente** para análisis de rendimiento
- ✅ **Monitorea los servicios más solicitados** para optimizar oferta
- ✅ **Revisa la tasa de ocupación** para ajustar horarios
- ✅ **Identifica clientes frecuentes** para programas de fidelización

### 🗂️ Mantenimiento de Información

- ✅ **Mantén actualizada la información de clientes**
  - Verifica teléfonos y emails periódicamente
  - Actualiza preferencias cuando cambien

- ✅ **Actualiza el catálogo de servicios**
  - Ajusta precios según temporada
  - Añade nuevos servicios oportunamente
  - Desactiva servicios fuera de temporada

### 💾 Respaldo y Documentación

- ✅ **Exporta datos regularmente** como respaldo
- ✅ **Descarga reportes mensuales** para archivo
- ✅ **Usa la función de Excel** para análisis externos
- ✅ **Mantén documentación** de procedimientos internos

### 🕐 Gestión de Horarios

- ✅ **Mantén los horarios organizados** y actualizados
- ✅ **Configura horarios especiales** con anticipación
- ✅ **Evita empalmes** verificando disponibilidad
- ✅ **Bloquea espacios** para mantenimiento o eventos especiales
- ✅ **Ajusta intervalos** según duración real de servicios

### 👥 Atención al Cliente

- ✅ **Comunica cambios** de horario con anticipación
- ✅ **Confirma citas** 24 horas antes
- ✅ **Registra preferencias** de clientes en las notas
- ✅ **Mantén actualizado** el estado de cada cita
- ✅ **Utiliza las notas** para recordatorios importantes

---

## 🧑‍💼 12. Roles y Permisos

El sistema maneja diferentes niveles de acceso según el rol del usuario.

### 👨‍💼 Rol: Administrador

**Permisos completos sobre el sistema:**

✅ **Dashboard Completo**
- Visualización de todas las estadísticas
- Acceso a métricas detalladas
- Información financiera

✅ **Gestión de Citas**
- Crear, editar y eliminar citas
- Cambiar estados de citas
- Ver historial completo
- Administrar citas de todos los clientes

✅ **Gestión de Servicios**
- CRUD completo de servicios
- Activar/desactivar servicios
- Configurar precios y duraciones
- Gestionar catálogo completo

✅ **Gestión de Usuarios**
- Crear y editar usuarios
- Activar/desactivar cuentas
- Ver historial de clientes
- Asignar roles

✅ **Gestión de Horarios**
- Configurar horarios de atención
- Crear horarios especiales
- Bloquear espacios
- Ajustar disponibilidad

✅ **Reportes y Exportaciones**
- Generar reportes en PDF
- Exportar datos a Excel/CSV
- Acceso a todas las estadísticas
- Análisis financiero

✅ **Configuración del Sistema**
- Ajustar parámetros generales
- Gestionar notificaciones
- Configurar preferencias

### 👤 Rol: Usuario/Cliente

**Acceso limitado a funciones de cliente:**

✅ **Acceso Permitido:**
- 🔐 Login y registro en el sistema
- 👤 Ver y editar perfil personal
- 📅 Solicitar o crear citas (si está habilitado)
- 📋 Ver historial personal de citas
- 💇‍♀️ Consultar catálogo de servicios
- 📧 Recibir notificaciones de citas

❌ **Acceso Restringido:**
- ❌ Dashboard administrativo
- ❌ Gestión de otros usuarios
- ❌ Configuración de servicios
- ❌ Gestión de horarios
- ❌ Reportes generales
- ❌ Información financiera
- ❌ Exportación de datos

### 🔧 Rol: Empleado (si está implementado)

**Acceso intermedio para personal del salón:**

✅ **Permisos:**
- Ver citas asignadas
- Actualizar estado de citas
- Ver información de clientes
- Consultar servicios
- Acceso limitado al dashboard

❌ **Restricciones:**
- No puede modificar servicios
- No puede gestionar usuarios
- No puede configurar horarios
- Acceso limitado a reportes

### 🔐 Seguridad y Control de Acceso

El sistema implementa:

- **Autenticación obligatoria** para todas las funciones
- **Middleware de roles** que protege rutas sensibles
- **Validación de permisos** en cada acción
- **Registro de actividad** para auditoría
- **Sesiones seguras** con tiempo de expiración
- **Protección CSRF** en todos los formularios

---

## 📝 13. Créditos y Tecnologías

Este sistema ha sido desarrollado utilizando tecnologías modernas y robustas:

### 🛠️ Tecnologías Principales

**Backend:**
- 🟦 **Laravel** (Framework PHP)
  - Versión: 11.x
  - Eloquent ORM para gestión de base de datos
  - Sistema de autenticación integrado
  - Validación y seguridad incorporada

**Frontend:**
- 🎨 **Tailwind CSS** (Framework CSS)
  - Diseño responsive
  - Componentes modernos
  - Personalización flexible

- 📦 **Blade** (Motor de plantillas)
  - Componentes reutilizables
  - Sintaxis limpia y expresiva

**Generación de Reportes:**
- 📄 **DomPDF** (Laravel DomPDF)
  - Generación de PDFs
  - Reportes profesionales
  - Personalización avanzada

- 📊 **Laravel Excel** (Maatwebsite)
  - Exportación a Excel
  - Formato CSV
  - Análisis de datos

### 🗄️ Base de Datos

- **MySQL** / **MariaDB**
  - Relaciones optimizadas
  - Índices para rendimiento
  - Integridad referencial

### 🔧 Herramientas de Desarrollo

- **Composer** - Gestión de dependencias PHP
- **NPM** - Gestión de paquetes JavaScript
- **Git** - Control de versiones
- **Artisan** - CLI de Laravel

### 📚 Librerías Adicionales

- **Laravel Sanctum** - Autenticación API
- **Carbon** - Manipulación de fechas
- **Laravel Mix** - Compilación de assets

### 👨‍💻 Desarrollo

Sistema desarrollado con 💙 por el equipo de desarrollo.

---

## 📞 14. Soporte y Ayuda

### 🆘 ¿Necesitas Ayuda?

Si encuentras algún problema o tienes preguntas:

1. **Consulta este manual** primero
2. **Revisa la sección de problemas comunes** (si está disponible)
3. **Contacta al administrador del sistema**
4. **Reporta errores** al equipo de soporte técnico