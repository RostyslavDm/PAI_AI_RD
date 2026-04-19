# PAI_AI_RD
Repozytorium zadań z przedmiotu programowanie aplikacji internetowych.

Grupa: AI  
Student: Rostyslav Dmytrovskyi

# Kalkulator Kredytowy

Repozytorium przedstawia kolejne etapy rozbudowy aplikacji kalkulatora kredytowego –
od prostego skryptu PHP do aplikacji opartej na frameworku Laravel z bazą danych.

---

## Zadanie 1 – Prosty kalkulator PHP

Podstawowa aplikacja kalkulatora kredytowego napisana w czystym PHP.
Oblicza ratę miesięczną i całkowitą kwotę kredytu na podstawie:
- kwoty kredytu
- oprocentowania rocznego
- okresu spłaty (w latach)

Zawiera walidację danych wejściowych oraz wyświetlanie błędów i informacji.

---

## Zadanie 2 – Dodanie stylów CSS

Rozbudowa zadania 1 o warstwę wizualną.
Dodano gotowy szablon CSS z serwisu
[Templatemo](https://templatemo.com/tm-605-xmas-countdown),
który nadaje aplikacji nowoczesny, ciemny wygląd.

---

## Zadanie 3 – Przejście na Smarty


Logika aplikacji została oddzielona od warstwy widoku przy użyciu
silnika szablonów **Smarty**.

Podział odpowiedzialności:
| Plik                  | Odpowiedzialność             |
|-----------------------|------------------------------|
| `calc.php`            | Logika i walidacja           |
| `templates/main.html` | Bazowy layout strony         |
| `calc.html`           | Szablon formularza i wyników |

---

## Zadanie 4 – Przejście na Laravel

Przepisanie aplikacji z użyciem frameworka **Laravel 10**.
Smarty zastąpiono silnikiem szablonów **Blade**.

Podział według architektury MVC:
| Element           | Plik                                      |
|-------------------|-------------------------------------------|
| Kontroler         | `app/Http/Controllers/CalcController.php` |
| Widok główny      | `resources/views/layouts/main.blade.php`  |
| Widok kalkulatora | `resources/views/calc.blade.php`          |
| Routing           | `routes/web.php`                          |
| Style             | `public/css/`                             |

### Uruchomienie
```bash
cd zadanie4
composer install
php artisan serve
```
Aplikacja dostępna pod adresem: http://localhost:8000

---

## Zadanie 5 – Logowanie bez bazy danych

Rozbudowa zadania 4 o system logowania z dwoma rolami użytkowników.
Dane użytkowników przechowywane są bezpośrednio w kodzie (bez bazy danych).
Stan logowania przechowywany jest w sesji PHP.

### Dane logowania
| Login         | Hasło    | Rola  |
|---------------|----------|-------|
| admin         | admin123 | admin |
| user          | user123  | user  |

### Różnice między rolami
| Funkcja                  | Użytkownik | Administrator |
|--------------------------|------------|---------------|
| Oprocentowanie 2%, 4%    | ✅         | ✅           |
| Oprocentowanie 5%, 7%    | ❌         | ✅           |
| Okres spłaty maks 10 lat | ✅         | ❌           |
| Dowolny okres spłaty     | ❌         | ✅           |

### Nowe pliki
| Plik                                      | Odpowiedzialność        |
|-------------------------------------------|-------------------------|
| `app/Http/Controllers/AuthController.php` | Logowanie i wylogowanie |
| `resources/views/login.blade.php`         | Formularz logowania     |

### Uruchomienie
```bash
cd zadanie5
composer install
php artisan serve
```

---

## Zadanie 6 – Logowanie z bazą danych

Rozbudowa zadania 5 – użytkownicy przeniesieni z kodu do bazy danych **MySQL**.
Hasła przechowywane są w postaci zahashowanej (bcrypt).

### Wymagania
- PHP 8.2+
- Composer
- MySQL (np. XAMPP)

### Instalacja
**1. Zainstaluj zależności**
```bash
cd zadanie6
composer install
```

**2. Skonfiguruj środowisko**

Otwórz `.env` i ustaw:
```env
DB_DATABASE=zadanie6
DB_USERNAME=root
DB_PASSWORD=
```

**3. Utwórz bazę danych**

Otwórz phpMyAdmin (http://localhost/phpmyadmin)
i utwórz nową bazę danych o nazwie: `zadanie6`, kodowanie: utf8mb4_unicode_ci

**4. Uruchom migracje i seeder**
```bash
php artisan migrate
php artisan db:seed
```

**5. Uruchom serwer**
```bash
php artisan serve
```
Aplikacja dostępna pod adresem: http://localhost:8000

### Dane logowania
| Login         | Hasło    | Rola  |
|---------------|----------|-------|
| Administrator | admin123 | admin |
| Użytkownik    | user123  | user  |

### Różnice między rolami
| Funkcja                  | Użytkownik | Administrator |
|--------------------------|------------|---------------|
| Oprocentowanie 2%, 4%    | ✅         | ✅           |
| Oprocentowanie 5%, 7%    | ❌         | ✅           |
| Okres spłaty maks 10 lat | ✅         | ❌           |
| Dowolny okres spłaty     | ❌         | ✅           |

---

## Technologie

| Technologia      | Użycie                       |
|------------------|------------------------------|
| PHP 8.2          | Język backendowy             |
| Laravel 10       | Framework (zadanie 4–6)      |
| Smarty           | Silnik szablonów (zadanie 3) |
| MySQL            | Baza danych (zadanie 6)      |
| Blade            | Silnik szablonów Laravel     |
| CSS / Templatemo | Warstwa wizualna             |