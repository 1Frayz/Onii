# Onii

Onii - это проект, похожий на Pixiv, предназначенный для художников и любителей искусства. Здесь вы можете загружать и просматривать произведения искусства, классифицированные по тегам.

## Установка

Для установки проекта выполните следующие шаги:

1. Клонируйте репозиторий:
    ```sh
    git clone https://github.com/yourusername/onii.git
    cd onii
    ```

2. Установите зависимости с помощью Composer:
    ```sh
    composer install
    ```

## Требования

- PHP 7.3 или выше
- Composer

## Зависимости

### Основные зависимости

- `codin/dot`: библиотека для работы с dot-notation.

### Разработческие зависимости

- `larapack/dd`: библиотека для удобного дебаггинга.

## Автозагрузка

Проект использует PSR-4 автозагрузку. Пространство имён `App` мапится на директорию `app/`.

```json
"autoload": {
    "psr-4": {
        "App\\": "app/"
    }
}
```

## Запуск проекта

После установки зависимостей и настройки автозагрузки, вы можете запустить проект с помощью встроенного PHP сервера:

```sh
php -S localhost:8000 -t public
```

Затем откройте браузер и перейдите по адресу `http://localhost:8000`, чтобы увидеть приложение в действии.
