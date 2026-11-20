

<!-- local-development:start -->
# Desarrollo local

Puedes abrir este repositorio en VS Code, Antigravity o Sublime Text. El compilador y los servicios necesarios dependen del componente indicado abajo.

## PHP

Usa un runtime PHP aislado compatible con la aplicación. Ejecuta Composer únicamente en la carpeta con `composer.json`; las aplicaciones Laravel antiguas requieren revisar también PHP y dependencias. Configura las credenciales de base de datos localmente.

## Bases de datos

Revisa los scripts de esquema y crea una base de datos de prueba separada. SSMS 20 y pgAdmin 4 son clientes; SQL Server y PostgreSQL son motores distintos. Los scripts SQL Server no se ejecutan directamente en PostgreSQL. Las restauraciones deben hacerse sobre una base de prueba nueva. PostgreSQL 17 y 18 requieren comprobarse por separado.

## Archivos ignorados

`.gitignore` excluye credenciales locales, estado del editor y salidas de las herramientas detectadas. No deja de versionar archivos que ya estaban en Git. Los manifiestos, archivos de bloqueo, recursos fuente y scripts de esquema forman parte del código.
<!-- local-development:end -->

<!-- improvements-20261119:start -->
## Mejoras y verificación — 2026-11-19 (Cierre de bypass de autorización en delete_career, redirecciones seguras y BD por entorno)

- Añadida verificación de sesión obligatoria en `Career::delete_career()` (antes permitía borrar carreras por AJAX sin autenticar) y `return;` tras `redirect("login")` en `inicio.php` y `career.php`.
- Inicializado `$info = array()` antes del bucle en `inicio.php` y añadidas variables de entorno `RSA_DB_*` + driver `mysqli` por defecto en `application/config/database.php`.
- Validación: comprobación automatizada de configuración y guardas de controladores CodeIgniter.
<!-- improvements-20261119:end -->
