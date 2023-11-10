# Procesy Wytwarzania Oprogramowania

Projekt tego laboratorium opiera się na projekcie z poprzedniego semestru z przedmiotu: `Programowanie aplikacji w chmurze obliczeniowej`

# Środowisko

PHP 8.1.2-1ubuntu2.14 (cli)
Docker version 24.0.5
Ubuntu 22.04.3 LTS
Composer version 2.6.5

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

5. Zainstaluj i skonfiguruj narzędzie Sail, które umożliwi uruchomienie kontenerów Dockera (należy wybrać mysql [0]):
```
php artisan sail:install
```

6. Wyczyść zbuforowane dane aplikacji, przed uruchomieniem kontenerów:
```
php artisan optimize:clear
```

7. Należy uruchomić aplikację:
```
./vendor/bin/sail up -d
```
Na adresie localhost powinna działać aplikacja
Następne 2 operacje można wykonać ręcznie przeklikując się przez aplikację na localhost,
albo skorzystać z poleceń w krokach 8 i 9.

8. Wyczyść już istniejące migracje
```
./vendor/bin/sail artisan migrate:fresh
```

8.5 Moze okazać się potrzebna zmiana uprawnień
```
chmod 777 -R *
```

9. Generowanie klucza aplikacji
```
./vendor/bin/sail artisan key:generate
```

10. Podłączenie storage, niezbędne dla zdjęć profilowych
```
./vendor/bin/sail artisan storage:link
```

11. Zamknięcie aplikacji (wewnątrz katalogu z projektem)
```
./vendor/bin/sail down
```

# Temat Projektu

Projekt ma na celu stworzenie aplikacji internetowej, która pozwoli użytkownikom reklamować swoje usługi fryzjerskie, barberskie, kosmetyczne. Aplikacja zapewni fryzjerom platformę do tworzenia profili i promowania swoich firm wśród potencjalnych klientów. 

Wymagania funkcjonalne
- Rejestracja i logowanie użytkowników
- Możliwość tworzenia ofert fryzjerskich
- Możliwość zarządzania swoimi ofertami
- Funkcja wyszukiwania umożliwiająca użytkownikom znalezienie fryzjerów na podstawie miasta.

Wymagania niefunkcjonalne
- Aplikacja powinna być kompatybilna z różnymi przeglądarkami takimi jak Google Chrome, Firefox
- Aplikacja powinna działać niezależnie od systemu operacyjnego
- Dane użytkowników powinny być bezpiecznie przechowywane
- System korzysta z bazy MySQL wewnątrz środowiska Docker.
- System jest wykonany w technologii Laravel

# Testy automatyczne

Testy w Laravelu są tworzone za pomocą `sail` lub `php` (`sail` wykonuje dokłanie te same zapytania tyle, że już bezpośrednio w kontenerze):

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
➜  my-app git:(main) sail artisan test
```
```
   PASS  Tests\Unit\ExampleTest
  ✓ that true is true                                                    0.01s

   PASS  Tests\Feature\AuthTest
  ✓ authenticated user can access create offert                          3.28s
  ✓ unauthenticated user can access create offert                        0.02s
  ✓ authenticated user can store offert                                  0.09s
  ✓ unauthenticated user can store offert                                0.02s
  ✓ authenticated user can access edit offert                            0.03s
  ✓ unauthenticated user can access edit offert                          0.02s
  ✓ authenticated user can update offert                                 0.04s
  ✓ unauthenticated user can access update offert                        0.02s
  ✓ authenticated user can access manage                                 0.03s
  ✓ unauthenticated user can access menage                               0.02s
  ✓ authenticated user can delete offert                                 0.05s
  ✓ unauthenticated user can delete offert                               0.02s
  ✓ authenticated user can logout                                        0.03s
  ✓ unauthenticated user can logout                                      0.02s

   PASS  Tests\Feature\ExampleTest
  ✓ the application returns a successful response                        0.04s

   PASS  Tests\Feature\GuestTest
  ✓ guest user can access register                                       0.02s
  ✓ authenticated user can access register                               0.03s
  ✓ guest user can access login                                          0.02s
  ✓ authenticated user can access login                                  0.03s

   PASS  Tests\Feature\StorageTest
  ✓ delete offert deletes profile picture                                0.07s

   PASS  Tests\Feature\ValidationCreateTest
  ✓ authenticated user cannot create offert without first name           0.04s
  ✓ authenticated user cannot create offert without last name            0.04s
  ✓ authenticated user cannot create offert without city                 0.04s
  ✓ authenticated user cannot create offert without professions          0.04s
  ✓ authenticated user cannot create offert without workplaces           0.03s

   PASS  Tests\Feature\ValidationEditTest
  ✓ authenticated user cannot edit offert without name                   0.06s
  ✓ authenticated user cannot edit offert without surname                0.05s
  ✓ authenticated user cannot edit offert without city                   0.05s
  ✓ authenticated user cannot edit offert without profession             0.06s
  ✓ authenticated user cannot edit offert without workplace              0.06s

  Tests:    31 passed (57 assertions)
  Duration: 4.53s
```

