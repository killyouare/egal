# Lumen test task

## Установка

### 1. Варианты загрузки на выбор:

- С помощью git clone:

  ```bash
  git clone https://github.com/killyouare/egal.git
  ```

- Загрузить zip-архив с [github](https://github.com/killyouare/egal). После загрузки распаковать в текущую директорию.

### 2. Настройка

```bash
cd egal/
./inscript
```

Пару раз вводим пароль

Микросервисы доступен по адресам:

http://localhost:80/auth/
http://localhost:80/core/

Тестирование в postman:

- [Все запросы](https://www.postman.com/martian-moon-565933/workspace/egal)
- Добавить в env 
|    Атрибут    | Вводимые данные |
| :-----------: | :-------------: |
|  adminEmail   | admin@admin.com |
| adminPassword |    QWEasd123    |

## Примечания

- Для установки вам необходимы:

  - [git](https://github.com/git-guides/install-git)
  - [docker](https://docs.docker.com/engine/install/)

- Для полного удаления всех контейнеров и образов, введите:

  ```bash
  ./rmscript
  ```

  Пару раз вводим пароль

- Все делается на линуксе.
