<?php
// OUDE EERSTE VERSIE ZONDER CHILD THEME INSTALLER
//namespace Eyetractive\BlinkTheme;
//require "vendor/autoload.php";
//
//use Symfony\Component\Filesystem\Filesystem;
//use function Laravel\Prompts\info;
//use function Laravel\Prompts\progress;
//use function Laravel\Prompts\text;
//use function Laravel\Prompts\clear;
//
//class ThemeInstall
//{
//    public static function install()
//    {
//        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "theme";
//
//        clear();
//
//        info("Welcome to the blink-theme installer\nplease verify the theme path:");
//
//        /* FUNCTIE WERKT NIET OP WINDOWS (ALLEEN LINUX EN MACOS)
//        $path = text(
//            label: "Wordpress theme directory",
//            default: getcwd() . "/wp-content/themes/Blink", // Dit is wat je misschien plaats van Blink de naam van de website wilt noemen?
//            validate:  fn (string $value) => match (is_dir($value)) {
//                false => "This is not a valid directory",
//                default => null
//            }
//        );*/
//
//        // ALTERNATIEF VOOR WINDOWS
//        $path = getcwd() . "/wp-content/themes/Blink";
//
//        if (!is_dir($path)) {
//            info("Theme directory does not exist. Creating it now...");
//            mkdir($path, 0755, true);
//        }
//
//
//        self::recursiveCopy($dir, $path);
//
//        info("Finished copying theme files");
//    }
//
//    private static function recursiveCopy($source, $destination)
//    {
//        if (!file_exists($source)) {
//            return false;
//        }
//
//        if (is_dir($source)) {
//            if (!file_exists($destination)) {
//                mkdir($destination, 0755, true);
//            }
//
//            $files = scandir($source);
//            foreach ($files as $file) {
//                if ($file === "." || $file === "..") {
//                    continue;
//                }
//
//                $srcPath = $source . DIRECTORY_SEPARATOR . $file;
//                $destPath = $destination . DIRECTORY_SEPARATOR . $file;
//
//                if (is_dir($srcPath)) {
//                    self::recursiveCopy($srcPath, $destPath);
//                    continue;
//                }
//                // CHECKED OF DE BESTANDEN AL BESTAAN EN CHECKED VOOR VERSCHILLEN TUSSEN DEZE BESTANDEN
//                if (file_exists($destPath) && md5_file($srcPath) !== md5_file($destPath)) {
//                    echo "Bestand bestaat en is aangepast: $destPath\n";
//                    $overwrite = strtolower(readline("Overschrijven? (yes/no): "));
//                    if ($overwrite !== "y") {
//                        echo "Bestand overgeslagen: $file\n";
//                        continue;
//                    }
//                    // DUBBEL CHECKED VOOR HET OVERSCHRIJVEN VAN DE BESTANDEN
//                    $doubleCheck = strtolower(readline("Weet je het echt zeker dat het bestand wilt overschrijven? (yes/no): "));
//                    if ($doubleCheck !== "y") {
//                        echo "Bestand overgeslagen: $file\n";
//                        continue;
//                    }
//                }
//                // LAAT ALLE GEKOPIEERDE BESTANDEN ZIEN
//                copy($srcPath, $destPath);
//                echo "Bestand gekopieerd: $file\n";
//            }
//        } else {
//            copy($source, $destination);
//        }
//        return true;
//    }
//}

// INSTALLATIE MET CHILD THEME (OUDER VERSIE)
// (BEVAT GEEN STIJL MOGELIJKHEDEN BIJ MAC OF WINDOWS MET WSL)
// WERKT ZOWEL OP WINDOWS ALS MAC HEEFT GEEN WINDOWS WSL INSTALLATIE NODIG
/*namespace Eyetractive\BlinkTheme;
require "vendor/autoload.php";

use Symfony\Component\Filesystem\Filesystem;
use function Laravel\Prompts\info;
use function Laravel\Prompts\clear;

class ThemeInstall
{
    public static function install()
    {
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "theme";
        $themePath = getcwd() . "/wp-content/themes/Blink";

        clear();
        info("Welkom bij de Blink-theme installer");

        // Stap 1: Installeer of update Blink
        if (!is_dir($themePath)) {
            info("Blink theme directory bestaat nog niet. Deze wordt nu aangemaakt...");
            mkdir($themePath, 0755, true);
        }

        self::recursiveCopy($dir, $themePath);
        info("Blink is succesvol geïnstalleerd of geüpdatet.\n");

        // Stap 2: Vraag of er een child theme moet worden aangemaakt
        $makeChild = strtolower(readline("Wil je een child theme aanmaken? (y/n): "));

        if ($makeChild === "y") {
            $siteName = readline("Wat is de naam van de website (voor het child theme)? ");
            $childThemeSlug = strtolower(str_replace(" ", "-", $siteName));
            $childThemePath = getcwd() . "/wp-content/themes/{$childThemeSlug}";

            if (!is_dir($childThemePath)) {
                mkdir($childThemePath, 0755, true);
                info("Child theme directory aangemaakt: $childThemePath");
            }

            // Lege bestanden aanmaken
            file_put_contents($childThemePath . "/style.css", "");
            file_put_contents($childThemePath . "/functions.php", "");
            echo "Lege style.css en functions.php aangemaakt in {$childThemeSlug}\n";
        } else {
            echo "⏭ Child theme stap overgeslagen.\n";
        }

        info("Installatie voltooid.");
    }

    private static function recursiveCopy($source, $destination)
    {
        if (!file_exists($source)) {
            return false;
        }

        if (is_dir($source)) {
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $files = scandir($source);
            foreach ($files as $file) {
                if ($file === "." || $file === "..") {
                    continue;
                }

                $srcPath = $source . DIRECTORY_SEPARATOR . $file;
                $destPath = $destination . DIRECTORY_SEPARATOR . $file;

                if (is_dir($srcPath)) {
                    self::recursiveCopy($srcPath, $destPath);
                    continue;
                }

                if (file_exists($destPath) && md5_file($srcPath) !== md5_file($destPath)) {
                    echo "⚠ Bestand bestaat en is aangepast: $destPath\n";
                    $overwrite = strtolower(readline("Overschrijven? (y/n): "));
                    if ($overwrite !== "y") {
                        echo "⏭ Bestand overgeslagen: $file\n";
                        continue;
                    }

                    $doubleCheck = strtolower(readline("Weet je het zeker dat je dit bestand wilt overschrijven? (y/n): "));
                    if ($doubleCheck !== "y") {
                        echo "⏭ Bestand overgeslagen: $file\n";
                        continue;
                    }
                }

                copy($srcPath, $destPath);
                echo "Bestand gekopieerd: $file\n";
            }
        } else {
            copy($source, $destination);
        }

        return true;
    }
}*/

// VERSIE WERKT ALLEEN OP MAC VOOR WINDOWS IS WSL INSTALLATIE NODIG (composer run-script install-blink)
// MOET DAN GERUNT WORDEN IN DE LINUX ENVIROMENT (wsl -d Ubuntu)
/*namespace Eyetractive\BlinkTheme;
require "vendor/autoload.php";

use Symfony\Component\Filesystem\Filesystem;
use function Laravel\Prompts\info;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\clear;

class ThemeInstall
{
    public static function install()
    {
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "theme";
        clear();

        info("Welcome to the blink-theme installer!");

        // Stap 1 – KOPIEER CORE THEME NAAR blink map
        $baseThemePath = getcwd() . "/wp-content/themes/blink";

        info("Blink (parent theme) wordt geplaatst in: $baseThemePath");
        self::recursiveCopy($dir, $baseThemePath);
        info("Blink theme installatie voltooid.\n");

        // Stap 2 – VRAAG OF EEN CHILD THEME AANGEMAAKT MOET WORDEN
        $createChild = confirm("Wil je een child theme aanmaken?", default: false);

        if ($createChild) {
            $siteName = text(
                label: "Wat is de naam van de website, waarvoor we een Child Theme zullen ontwikkelen?",
                validate: fn(string $value) => trim($value) !== "" ? null : "Voer een geldige naam in."
            );

            $childThemePath = getcwd() . "/wp-content/themes/" . strtolower($siteName);

            if (!is_dir($childThemePath)) {
                mkdir($childThemePath, 0755, true);
                info("Child theme aangemaakt in: $childThemePath");

                file_put_contents($childThemePath . "/style.css", "");
                file_put_contents($childThemePath . "/functions.php", "");

                info("style.css en functions.php gegenereerd.");
            } else {
                info("Child theme '$childThemePath' bestaat al — bestanden worden niet overschreven.");
            }
        }

        info("Installatie volledig afgerond.");
    }

    private static function recursiveCopy($source, $destination)
    {
        if (!file_exists($source)) return false;
        if (!file_exists($destination)) mkdir($destination, 0755, true);

        $files = scandir($source);
        foreach ($files as $file) {
            if ($file === "." || $file === "..") continue;

            $srcPath = $source . DIRECTORY_SEPARATOR . $file;
            $destPath = $destination . DIRECTORY_SEPARATOR . $file;

            if (is_dir($srcPath)) {
                self::recursiveCopy($srcPath, $destPath);
                continue;
            }

            // Check of bestand bestaat én gewijzigd is
            if (file_exists($destPath) && md5_file($srcPath) !== md5_file($destPath)) {
                echo "Bestand bestaat en is aangepast: $destPath\n";
                $overwrite = strtolower(readline("Overschrijven? (y/n): "));
                if ($overwrite !== "y") {
                    echo "Bestand overgeslagen: $file\n";
                    continue;
                }

                $doubleCheck = strtolower(readline("Weet je het echt zeker dat je '$file' wilt overschrijven? (y/n): "));
                if ($doubleCheck !== "y") {
                    echo "Bestand overgeslagen: $file\n";
                    continue;
                }
            }

            copy($srcPath, $destPath);
            echo "Bestand gekopieerd: $file\n";
        }

        return true;
    }
}*/

// FIX VOOR ZOWEL WINDOWS ALS MAC, WINDOWS HOEFT HIER GEEN WSL TE INSTALLEREN, MAAR HEEFT DAN NIET HELAAS NIET DE STIJL MOGELIJKHEDEN.
namespace Eyetractive\BlinkTheme;
require "vendor/autoload.php";

use Symfony\Component\Filesystem\Filesystem;
use function Laravel\Prompts\info;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\clear;

class ThemeInstall
{
    public static function install()
    {
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "theme";
        clear();

        info("Welcome to the blink-theme installer!");

        // Stap 1 – KOPIEER CORE THEME NAAR blink map
        $baseThemePath = getcwd() . "/wp-content/themes/blink";

        info("Blink (parent theme) wordt geplaatst in: $baseThemePath");
        self::recursiveCopy($dir, $baseThemePath);
        info("Blink theme installatie voltooid.\n");

        // Detecteer het besturingssysteem
        $isWindows = defined("PHP_OS_FAMILY") ? PHP_OS_FAMILY === "Windows" : strtoupper(substr(PHP_OS, 0, 3)) === "WIN";

        // Stap 2 – VRAAG OF EEN CHILD THEME AANGEMAAKT MOET WORDEN
        if ($isWindows) {
            echo "Wil je een child theme aanmaken? (Ja(j)/Nee(n)): ";
            $input = strtolower(trim(readline()));
            $createChild = $input === "j" || $input === "ja";
        } else {
            $createChild = confirm("Wil je een child theme aanmaken?", default: false, yes: "Ja", no: "Nee");
        }

        if ($createChild) {
            if ($isWindows) {
                echo "Wat is de naam van de website, waarvoor we een Child Theme zullen ontwikkelen?: ";
                $siteName = trim(readline());
                while ($siteName === "") {
                    echo "Voer een geldige naam in: ";
                    $siteName = trim(readline());
                }
            } else {
                $siteName = text(
                    label: "Wat is de naam van de website, waarvoor we een Child Theme zullen ontwikkelen?",
                    validate: fn(string $value) => trim($value) !== "" ? null : "Voer een geldige naam in."
                );
            }

            $childThemePath = getcwd() . "/wp-content/themes/" . strtolower($siteName);

            if (!is_dir($childThemePath)) {
                mkdir($childThemePath, 0755, true);
                info("Child theme aangemaakt in: $childThemePath");

                file_put_contents($childThemePath . "/style.css", "");
                file_put_contents($childThemePath . "/functions.php", "");

                info("style.css en functions.php gegenereerd.");
            } else {
                info("Child theme '$childThemePath' bestaat al — bestanden worden niet overschreven.");
            }
        }

        info("Installatie volledig afgerond.");
    }

    private static function recursiveCopy($source, $destination)
    {
        if (!file_exists($source)) return false;
        if (!file_exists($destination)) mkdir($destination, 0755, true);

        $files = scandir($source);
        foreach ($files as $file) {
            if ($file === "." || $file === "..") continue;

            $srcPath = $source . DIRECTORY_SEPARATOR . $file;
            $destPath = $destination . DIRECTORY_SEPARATOR . $file;

            if (is_dir($srcPath)) {
                self::recursiveCop
                ($srcPath, $destPath);
                continue;
            }

            // Check of bestand bestaat én gewijzigd is
            if (file_exists($destPath) && md5_file($srcPath) !== md5_file($destPath)) {
                echo "Bestand bestaat en is aangepast: $destPath\n";
                echo "Overschrijven? (Ja(j)/Nee(n)): ";
                $overwrite = strtolower(trim(readline()));
                if ($overwrite !== "j" || $overwrite !== "ja") {
                    echo "Bestand overgeslagen: $file\n";
                    continue;
                }

                echo "Weet je het echt zeker dat je '$file' wilt overschrijven? (Ja(j)/Nee(n)): ";
                $doubleCheck = strtolower(trim(readline()));
                if ($doubleCheck !== "ja" || $doubleCheck !== "ja") {
                    echo "Bestand overgeslagen: $file\n";
                    continue;
                }
            }

            copy($srcPath, $destPath);
            echo "Bestand gekopieerd: $file\n";
        }

        return true;
    }
}