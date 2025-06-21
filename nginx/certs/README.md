# 🔐 Local SSL Certificate Guide (Using mkcert)

To enable HTTPS (SSL) locally with `mkcert`, follow the steps below:

---

## 📥 Step 1: Install mkcert

Follow the official GitHub repository to install `mkcert`:  
👉 https://github.com/FiloSottile/mkcert

Installation is **one-time per device** and depends on your operating system.

---

## 🛠️ Step 2: Trust the Local CA

Once `mkcert` is installed, run:

```bash
mkcert -install
```

This installs the local Certificate Authority (CA) into your system trust store.

---

## 🖥️ Step 3: Generate SSL Certificate

Run the following command to generate a certificate for your local domain:

```bash
mkcert host.docker.internal
```

This will create:

- `host.docker.internal.pem`
- `host.docker.internal-key.pem`

Place both files in the `nginx/certs/` folder (or wherever Nginx expects them).

---

## 🌐 Access with HTTPS

You can now visit your local site using:

```
https://host.docker.internal/
```

It will be SSL-enabled and trusted by your browser.

---

## ✅ Notes

- Do **not commit** the `.pem` and `-key.pem` files to Git.
- Certificates are valid only on the system they were generated on.
- Use `mkcert` again on new devices.
