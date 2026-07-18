# 🧩 CRM de Gestión de Clientes (Laravel)

Proyecto backend desarrollado con Laravel para la gestión de clientes y tareas comerciales.
El objetivo ha sido construir una aplicación realista trabajando con arquitectura backend, bases de datos y APIs, apoyándome en herramientas de IA como asistente de desarrollo.

---

📸 Capturas
<img width="1746" height="410" alt="image" src="https://github.com/user-attachments/assets/2377f0a3-16be-4067-9b79-7ce172969098" />
<img width="1903" height="519" alt="image" src="https://github.com/user-attachments/assets/6f03a567-3f38-4653-9fd1-d25ce95e4f0a" />
<img width="1906" height="490" alt="image" src="https://github.com/user-attachments/assets/ab33daa2-7491-4623-994f-a5e6cd2333be" />

---

## 🎯 Objetivo del proyecto

Simular un entorno real de desarrollo backend donde:

* Diseñar estructura de datos
* Implementar lógica de negocio
* Construir y consumir una API REST
* Gestionar relaciones entre entidades

---

## 🧠 Funcionalidades implementadas

* Sistema de autenticación de usuarios
* CRUD completo de clientes
* Gestión de tareas asociadas
* Relación entre entidades (clientes ↔ tareas)
* Endpoints API REST
* Interacciones dinámicas con AJAX

---

## 🏗️ Arquitectura

Proyecto basado en el patrón MVC de Laravel:

* **Models:** estructura y relaciones de datos
* **Controllers:** lógica de negocio
* **Routes:** endpoints web y API
* **Middleware:** control de acceso

---

## 🔌 API REST

GET      /clients
GET      /clients/create
POST     /clients
GET      /clients/{id}
GET      /clients/{id}/edit
PUT      /clients/{id}
DELETE   /clients/{id}

---

## 🛠️ Tecnologías

* Laravel (PHP)
* MySQL
* JavaScript
* Bootstrap
* AJAX / JSON

---

## 🤖 Uso de IA en el desarrollo

Este proyecto ha sido desarrollado con apoyo de herramientas de IA como asistente, especialmente para:

* Generación inicial de estructura
* Resolución de errores
* Mejora de código

Todo el código ha sido revisado, entendido y adaptado manualmente.

---

## 💡 Qué he trabajado en este proyecto

* Diseño de base de datos relacional
* Implementación de lógica backend
* Creación y estructuración de API REST
* Integración frontend-backend
* Comprensión de arquitectura en Laravel

---

## ⚠️ Estado del proyecto

Proyecto en desarrollo sin despliegue público actualmente.
Se puede ejecutar en local siguiendo los pasos de instalación.

---

## ⚙️ Instalación

git clone https://github.com/EfrenLG/crm-client-management-laravel.git
cd crm-client-management-laravel

composer install
cp .env.example .env
php artisan key:generate

# Configurar base de datos en .env

php artisan migrate
php artisan serve

---

## 🚀 Próximas mejoras

* Despliegue en entorno real
* Sistema de roles y permisos
* Dashboard con métricas
* Tests automatizados

---

## 👨‍💻 Autor

Efrén Lozano Guerrero
🔗 LinkedIn: https://www.linkedin.com/in/efren-lozano-backend-developer-php/
💻 GitHub: https://github.com/EfrenLG
