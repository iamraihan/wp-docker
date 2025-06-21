# 🐳 Dockerized WordPress (FPM) + Nginx + MySQL + phpMyAdmin

This setup runs a local WordPress development environment using:

- **WordPress (FPM Alpine)**
- **Nginx** as the web server
- **MySQL 8** as the database
- **phpMyAdmin** for DB management
- Optional: Self-signed SSL

---

## 📁 Folder Structure

```
.
├── docker-compose.yml
├── .env
├── nginx/
│   ├── Dockerfile
│   ├── start.sh
│   ├── default.conf
│   └── certs/
│       ├── host.docker.internal.pem
│       └── host.docker.internal-key.pem
├── src/                  # Optional: wp-content mount
```

---

## ⚙️ 1. Setup Instructions

### ✅ Step 1: Clone & Navigate

```bash
git clone https://github.com/iamraihan/wp-docker.git
cd wp-docker
```

### ✅ Step 2: Create a `.env` file

Create a file named `.env` in the root directory with the following:

```dotenv
# Container names
CONTAINER_NAME=myproject
HOSTNAME=localhost

# MySQL config
DATABASE_NAME=wordpress
DATABASE_USER=admin
DATABASE_PASSWORD=adminpass
DATABASE_ROOT_PASSWORD=rootpass
```

### ✅ Step 3: Make `start.sh` Executable

```bash
chmod +x nginx/start.sh
```

### ✅ Step 4: Build & Start Containers

```bash
docker-compose build nginx
docker-compose up -d
```

---

## 🌐 Access URLs

| Service    | URL                          |
| ---------- | ---------------------------- |
| WordPress  | http://localhost             |
| WordPress  | https://host.docker.internal |
| phpMyAdmin | http://localhost:8081        |

---

## 🔧 Useful Commands

- Stop all containers:

  ```bash
  docker-compose down
  ```

- Rebuild after config changes:

  ```bash
  docker-compose build nginx
  docker-compose up -d
  ```

- Check container logs:
  ```bash
  docker logs <container-name>
  ```

---

## 🧪 Troubleshooting

- ❌ **502 Bad Gateway / Connection Reset**

  - Ensure `nginx/start.sh` includes:
    ```bash
    nginx -g 'daemon off;'
    ```
  - Check logs:
    ```bash
    docker logs myproject-nginx
    docker logs myproject-wordpress
    ```

- ❌ **MySQL not ready yet**
  - Wait a few seconds or check health status:
    ```bash
    docker-compose ps
    ```

---

## 🧰 Stack Versions

- WordPress: `wordpress:6.5.2-fpm-alpine`
- Nginx: `nginx:alpine` (custom)
- MySQL: `mysql:8.0`
- phpMyAdmin: `phpmyadmin/phpmyadmin`
- Docker Compose: `v3.8`

---

## 🔐 Optional SSL Setup

To enable HTTPS locally:

1. Place `.pem` and `-key.pem` certs in `nginx/certs/`
2. In `nginx/default.conf`, enable:
   ```nginx
   listen 443 ssl;
   ssl_certificate /etc/nginx/certs/localhost.pem;
   ssl_certificate_key /etc/nginx/certs/localhost-key.pem;
   ```
3. Access via `https://host.docker.internal`

For more details about SSL installation:  
👉 [https://github.com/iamraihan/wp-docker/tree/main/nginx/certs](https://github.com/iamraihan/wp-docker/tree/main/nginx/certs)

---

## ✅ License

MIT – free for personal or commercial use.
