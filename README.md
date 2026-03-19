# FileStock - Файловый репозиторий

Веб-приложение для хранения и управления файлами.

## Технологии

- **Backend**: PHP 8.x + SQLite
- **Frontend**: HTML5, Native JS, CSS (Skeleton)
- **Deployment**: Docker

## Требования

- Docker
- Docker Compose

## Установка и запуск

### Development

```bash
docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d --build
```

Локальные папки монтируются напрямую:

- `backend/db` → `/db`
- `backend/uploads` → `/uploads`
- `frontend/src` → `/usr/share/nginx/html`

### Production

```bash
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build
```

Данные хранятся в Docker volumes:

- `database`
- `uploads`

### Остановка

```bash
docker-compose down
```

Приложение будет доступно по адресу: [http://localhost:8080](http://localhost:8080)

## Документация

- [Описание](./docs/README.md)
- [API](./docs/api.md)
- [Архитектура](./docs/architecture.md)
- [База данных](./docs/database.md)
- [Функциональность](./docs/features.md)
- [Роли и права](./docs/roles.md)