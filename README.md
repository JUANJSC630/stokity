# Stokity - Sistema POS para Inventario y Ventas

<p align="center">
  <img src="public/img/AdminLTEFullLogo.png" alt="Stokity Logo" width="200">
</p>

## Acerca del Proyecto

Stokity es un sistema POS (Point of Sale) diseñado para la gestión eficiente de inventario y ventas. Construido con Laravel 10, el sistema proporciona una solución completa para negocios que necesitan administrar productos, sucursales, usuarios, clientes, ventas e inventario en una plataforma intuitiva y robusta.

### Características Principales

- **Gestión de Inventario**: Control completo de stock, productos, categorías y movimientos de inventario.
- **Punto de Venta**: Interfaz rápida e intuitiva para procesar ventas y emitir recibos.
- **Administración de Usuarios**: Sistema de roles y permisos para controlar el acceso a diferentes funciones.
- **Gestión de Sucursales**: Administración de múltiples ubicaciones de negocio.
- **Reportes y Estadísticas**: Informes detallados sobre ventas, inventario y rendimiento.
- **Facturación Electrónica**: Integración planificada con Factus para emisión de comprobantes electrónicos.

## Tecnologías

El proyecto utiliza las siguientes tecnologías:

- **Backend**: Laravel 10
- **Frontend**: HTML, CSS, JavaScript, Vite
- **Base de Datos**: MySQL/PostgreSQL
- **Autenticación**: Laravel Auth
- **UI Framework**: AdminLTE

## Requisitos del Sistema

- PHP >= 8.1
- Composer
- Node.js y NPM
- MySQL o PostgreSQL
- Extensiones PHP requeridas por Laravel 10

## Instalación

1. Clonar el repositorio:
   ```
   git clone https://github.com/JUANJSC630/stokity.git
   cd stokity
   ```

2. Instalar dependencias PHP:
   ```
   composer install
   ```

3. Instalar dependencias JavaScript:
   ```
   yarn install
   ```

4. Configuración del entorno:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

5. Configurar la base de datos en el archivo `.env`

6. Ejecutar migraciones:
   ```
   php artisan migrate
   ```

7. Ejecutar seeders (opcional):
   ```
   php artisan db:seed
   ```

8. Compilar assets:
   ```
   yarn build
   ```

9. Iniciar servidor de desarrollo:
   ```
   yarn dev
   ```

## Uso

Acceda a la aplicación a través de la URL proporcionada por `yarn dev`, generalmente `http://localhost:8000`.

### Funcionalidades Planificadas

- **Integración con Factus**: Para emisión de facturas electrónicas cumpliendo con normativas fiscales.
- **Aplicación Móvil**: Para administración remota y consulta de estadísticas.
- **Integraciones con Pasarelas de Pago**: Para procesar pagos con tarjeta y otros métodos electrónicos.
- **Módulo de CRM**: Para gestión de relaciones con clientes.

## Contribución

Las contribuciones son bienvenidas. Por favor, siga los siguientes pasos para contribuir:

1. Hacer fork del proyecto
2. Crear una rama para su funcionalidad (`git checkout -b feature/AmazingFeature`)
3. Commit de los cambios (`git commit -m 'Agregar funcionalidad X'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## Licencia

Este proyecto está licenciado bajo [MIT License](LICENSE).

## Contacto

Para preguntas o soporte, por favor contactar al equipo de desarrollo.

---

&copy; 2025 Stokity - Todos los derechos reservados.
