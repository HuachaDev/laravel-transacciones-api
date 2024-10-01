# LARAVEL-TRANSACCIONES-API

## Descripción del Proyecto

**LARAVEL-TRANSACCIONES-API** es una api desarrollado en Laravel que permite gestionar cuentas y procesar transacciones financieras de manera eficiente. Este proyecto está diseñado para facilitar operaciones comunes como depósitos, retiros y transferencias entre cuentas.

### Funcionalidades

- **Depósitos:** Facilita la adición de fondos a las cuentas.
- **Retiros:** Permite a los usuarios retirar dinero de sus cuentas.
- **Transferencias:** Posibilita transferencias de dinero entre diferentes cuentas, con reglas y comisiones .

### Tecnologías Utilizadas

- **Laravel V 10.48.22:**
- **PHP V8.1.6:** 
- **MySQL:**

### Importación de la Base de Datos

Antes de utilizar la api, es necesario importar la base de datos `transaccionesDB`. Adjunto en el proyecto o
php artisan migrate  

## Endpoints

- **Listar Cuentas**: 
  - **Método**: `GET`
  - **Ruta**: `/cuentas`
  - **Ejemplo de Respuesta**:
    ```json
    [
      { "id": 1, "saldo": 5000, "titularCuenta": "John Doe" },
      { "id": 2, "saldo": 200, "titularCuenta": "Jane Smith" }
    ]
    ```

- **Procesar Depósito**: 
  - **Método**: `POST`
  - **Ruta**: `api/cuentas/{id}/depositar`
  - **Ejemplo de Solicitud**:
    ```json
    { "monto": 1000 }
    ```

- **Procesar Retiro**: 
  - **Método**: `POST`
  - **Ruta**: `api/cuentas/{id}/retirar`
  - **Ejemplo de Solicitud**:
    ```json
    { "monto": 200 }
    ```

- **Procesar Transferencia**: 
  - **Método**: `POST`
  - **Ruta**: `api/cuentas/{id}/transferir`
  - **Ejemplo de Solicitud**:
    ```json
    { "cuentaDestinoId": 2, "monto": 500 }
    ```

- **Ver Detalle de Cuenta**: 
  - **Método**: `GET`
  - **Ruta**: `api/cuentas/{id}/`
  - **Ejemplo de Respuesta**:
    ```json
    { "id": 1, "saldo": 5000, "historialTransacciones": [...] }
    ```


1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/HuachaDev/laravel-transacciones-api.git
   cd LARAVEL-TRANSACCIONES-API
    ```

2. **Instalar las dependencias**:
    ```bash 
    composer install
     ```    
3. **Copiar  y editar archivo**:
    ```bash 
    cp .env.example .env
    
    Editar
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=transaccionesDB
    DB_USERNAME=root
    DB_PASSWORD=
     ```    
  
2. **Levantar el servidor local**:
    ```bash 
       php artisan serve
     ```  
