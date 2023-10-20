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

```
TODO
```
