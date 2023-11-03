# Procesy Wytwarzania Oprogramowania

Projekt tego laboratorium opiera się na projekcie z poprzedniego semestru z przedmiotu: `Programowanie aplikacji w chmurze obliczeniowej`

# Instrukcja instalacji
1. Rozpakuj projekt

2. Przejdź do katalogu projektu:
```
cd Project/project
```

3. Zainstaluj zależności Composer:
```
composer install
```

4. Skopiuj zawartość pliku `.env.example` do pliku `.env`:
```
cp .env.example .env
```

5. Wygeneruj klucz aplikacji:
```
php artisan key:generate
```

6. Zainstaluj i skonfiguruj narzędzie Sail, które umożliwi uruchomienie kontenerów Dockera (należy wybrać mysql [0]):
```
php artisan sail:install
```

7. Wyczyść zbuforowane dane aplikacji, przed uruchomieniem kontenerów:
```
php artisan optimize:clear
```

8. Należy uruchomić aplikację:
```
./vendor/bin/sail up -d
```

9. Wyczyść już istniejące migracje
```
./vendor/bin/sail artisan migrate:fresh
```

9.5 Moze okazać się potrzeba zmiana uprawnień
```
chmod 777 -R *
```

10. Zamknięcie aplikacji (wewnątrz katalogu z projektem)
```
./vendor/bin/sail down
```

# Temat Projektu

Projekt ma na celu stworzenie aplikacji internetowej, która pozwoli użytkownikom reklamować swoje usługi fryzjerskie. Aplikacja zapewni fryzjerom platformę do tworzenia profili i promowania swoich firm wśród potencjalnych klientów. 

Wymagania funkcjonalne
- Rejestracja i logowanie użytkowników
- Możliwość tworzenia usług fryzjerskich
- Możliwość zarządzania swoimi usługami
- Funkcja wyszukiwania umożliwiająca użytkownikom znalezienie fryzjerów na podstawie lokalizacji.

Wymagania niefunkcjonalne
- Aplikacja powinna być kompatybilna z różnymi przeglądarkami takimi jak Google Chrome, Firefox
- Aplikacja powinna działać niezależnie od systemu operacyjnego
- Dane użytkowników powinny być bezpiecznie przechowywane
- System korzysta z bazy MySQL wewnątrz środowiska Docker.
- System jest wykonany w technologii Laravel

# Testy automatyczne

Testy w Laravelu są tworzone za pomocą `sail` lub `php`:
Docker
```
sail artisan make:test MyTest
```

Local
```
php artisan make:test MyTest
```

Laravel domyślnie tworzy testy w `/tests/Feature` a testy jednostkowe w `/tests/Unit`.
Framework jednak stawia na testy poświęcone `Feature'om`.
W mojej aplikacji testy sprawdzają:
 - CRUD
   - AuthTest.php
 - Routing
   - AuthTest.php
   - GuestTest.php
 - Database
   - AuthTest.php
 - Validation
   - ValidationCreateTest.php
   - ValidationEditTest.php
 - Authorization
   - AuthTest.php
   - GuestTest.php
 - Authentication
   - AuthTest.php
   - GuestTest.php

Aby wykonać testy należy wydać polecenie
```
➜  my-app git:(main) ✗ sail artisan test
   PASS  Tests\Unit\ExampleTest
  ✓ that true is true

   PASS  Tests\Feature\AuthTest
  ✓ authenticated user can create offert                                 0.84s
  ✓ unauthenticated user can create offert                               0.01s
  ✓ authenticated user can store offert                                  0.03s
  ✓ unauthenticated user can store offert                                0.01s
  ✓ authenticated user can edit offert                                   0.02s
  ✓ unauthenticated user can edit offert                                 0.01s
  ✓ authenticated user can update offert                                 0.01s
  ✓ unauthenticated user can update offert                               0.01s
  ✓ authenticated user can access menage                                 0.01s
  ✓ unauthenticated user can access menage                               0.01s
  ✓ authenticated user can delete offert                                 0.01s
  ✓ unauthenticated user can delete offert                               0.01s
  ✓ authenticated user can logout                                        0.01s
  ✓ unauthenticated user can logout                                      0.01s

   PASS  Tests\Feature\ExampleTest
  ✓ the application returns a successful response                        0.02s

   PASS  Tests\Feature\GuestTest
  ✓ guest user can access register                                       0.01s
  ✓ authenticated user can access register                               0.01s
  ✓ guest user can access login                                          0.01s
  ✓ authenticated user can access login                                  0.01s

   PASS  Tests\Feature\ValidationCreateTest
  ✓ authenticated user cannot create offert without name                 0.02s
  ✓ authenticated user cannot create offert without surname              0.02s
  ✓ authenticated user cannot create offert without voivodeship          0.01s
  ✓ authenticated user cannot create offert without city                 0.01s
  ✓ authenticated user cannot create offert without profession           0.02s
  ✓ authenticated user cannot create offert without workplace            0.01s

   PASS  Tests\Feature\ValidationEditTest
  ✓ authenticated user cannot edit offert without name                   0.03s
  ✓ authenticated user cannot edit offert without surname                0.02s
  ✓ authenticated user cannot edit offert without voivodeship            0.02s
  ✓ authenticated user cannot edit offert without city                   0.02s
  ✓ authenticated user cannot edit offert without profession             0.02s
  ✓ authenticated user cannot edit offert without workplace              0.02s

  Tests:    32 passed (59 assertions)
  Duration: 1.34s
```

