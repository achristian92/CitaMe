# CitaMe - Tu Plataforma de Gestión de Citas Médicas 🏥📅

¡Bienvenido/a a CitaMe! La aplicación web basada en Laravel 8 que simplifica la agendación y gestión de citas médicas. Con CitaMe, puedes organizar tus consultas médicas de manera eficiente, brindando a médicos y pacientes un entorno fácil de usar y completamente personalizado. ¡Vamos a explorar todas las increíbles características que ofrece esta plataforma!

Esto es parte de un curso en Youtube, abajo del todo encontraran el enlace.

## Características Destacadas 🚀

- 📅 **Agendado de Citas:** Pacientes pueden programar citas con médicos seleccionando especialidades, fechas y horas disponibles.
- 👤 **Roles de Usuario:** Cuenta con roles específicos para Administradores, Pacientes y Doctores, cada uno con su propio conjunto de privilegios.
- 🧑‍⚕️ **Panel de Administración:** Los doctores pueden gestionar sus horarios, ver citas pendientes, aceptar, rechazar o cancelar citas, y acceder a su historial de citas.
- 📋 **Registro de Pacientes:** Los doctores pueden agregar nuevos pacientes a su lista y gestionarla fácilmente.
- 🤒 **Notas de Síntomas:** Los pacientes pueden dejar notas detalladas sobre sus síntomas y el tipo de consulta que desean realizar durante la agendación.
- 📊 **Estadísticas y Gráficos:** Los administradores pueden visualizar gráficos de rendimiento por doctores, citas, y más.
- 🔄 **Gestión de Citas:** Pacientes pueden cancelar citas, dejar notas sobre la cancelación o modificar detalles de las citas programadas.
- 📈 **Rendimiento del Sistema:** Administra y optimiza la plataforma con gráficos y estadísticas detalladas.

## Cómo Empezar 🏁

1. **Clona el Repositorio:**
   ```bash
   git clone https://github.com/StevenU21/CitaMe.git
   ```

2. **Instala las Dependencias:**
   ```bash
   composer install
   ```

3. **Configura el Entorno:**
   - Copia el archivo `.env.example` a `.env` y configura tu base de datos y otros detalles.
   - Genera la clave de la aplicación: `php artisan key:generate`

4. **Ejecuta las Migraciones y Semillas:**
   ```bash
   php artisan migrate --seed
   ```

5. **Inicia el Servidor:**
   ```bash
   php artisan serve
   ```

6. **Accede a la Aplicación:**
   - Visita [http://localhost:8000](http://localhost:8000) en tu navegador.

## Enlaces Útiles 🔗

- **Curso en YouTube:** [CitaMe en YouTube](https://www.youtube.com/watch?v=XTwtZfxiIlg&list=PLA2JPb2b8Fg50FoUoycL7czIvwci_uppd&pp=iAQB)
