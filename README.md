# Prueba Técnica - Backend en PHP

Este repositorio contiene el desarrollo de una prueba técnica, donde se implementó un backend en PHP puro siguiendo la arquitectura MVC. Además, se aplicaron principios SOLID, específicamente el Principio de Responsabilidad Única (SRP), junto con la inyección de dependencias. Para la autenticación, se utilizó JWT.

## Instalación

Sigue los siguientes pasos para instalar y ejecutar el proyecto correctamente:

1. Clonar el repositorio:
   ```sh
   git clone https://github.com/Ramirez-05/PruebaTecnica
   ```

2. Acceder a la carpeta del proyecto:
   ```sh
   cd aplication
   ```

3. Crear un archivo `.env` en la raíz del proyecto y agregar las credenciales necesarias (estas fueron enviadas por correo).

4. Instalar las dependencias del proyecto:
   ```sh
   composer install
   ```

## Scripts disponibles

Dentro del proyecto existen algunos scripts útiles para la gestión y ejecución del backend:

- **Verificar conexión a la base de datos:**
  ```sh
  composer connection
  ```

- **Ejecutar el proyecto:**
  ```sh
  composer start
  ```

- **Servir el proyecto:**
  ```sh
  composer serve
  ```

## Tecnologías utilizadas
- PHP puro
- Arquitectura MVC
- Principios SOLID (SRP)
- Inyección de dependencias
- JSON Web Token (JWT) para autenticación


