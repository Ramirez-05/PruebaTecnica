# Prueba Técnica - Backend en PHP y Frontend en Vue

Este repositorio contiene el desarrollo de una prueba técnica, donde se implementó un backend en PHP puro siguiendo la arquitectura MVC. Además, se aplicaron principios SOLID, específicamente el Principio de Responsabilidad Única (SRP), junto con la inyección de dependencias. Para la autenticación, se utilizó JWT.

También se desarrolló una parte del frontend utilizando Vue.js, proporcionando una interfaz con un **Home** y un **Login**. A través del proceso de autenticación, se pueden obtener los productos correspondientes al cliente autenticado.

## Instalación

Sigue los siguientes pasos para instalar y ejecutar el proyecto correctamente:

### Backend

1. Clonar el repositorio:
   ```sh
   git clone https://github.com/Ramirez-05/PruebaTecnica
   ```

2. Acceder a la carpeta del backend:
   ```sh
   cd aplication
   ```

3. Crear un archivo `.env` en la raíz del proyecto y agregar las credenciales necesarias (estas fueron enviadas por correo).

4. Instalar las dependencias del proyecto:
   ```sh
   composer install
   ```

### Frontend

1. Acceder a la carpeta del frontend:
   ```sh
   cd frontend-app
   ```

2. Instalar las dependencias del proyecto:
   ```sh
   npm install
   ```

3. Ejecutar el proyecto:
   ```sh
   npm run serve
   ```

## Scripts disponibles

### Backend

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
- **Backend:**
  - PHP puro
  - Arquitectura MVC
  - Principios SOLID (SRP)
  - Inyección de dependencias
  - JSON Web Token (JWT) para autenticación

- **Frontend:**
  - Vue.js
  - Manejo de autenticación con JWT
  - Consumo de API para obtener productos


