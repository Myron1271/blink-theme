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
use function Laravel\Prompts\comment;
use function Laravel\Prompts\warning;
use function Laravel\Prompts\error;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\clear;



class ThemeInstall
{
    public static function install()
    {
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "theme";

        $boldText = "\033[1m";
        $italicText = "\033[3m";
        $underlineText = "\033[4m";

        $reset = "\033[0m";
        $blackForeColor = "\033[30m";
        $redForeColor = "\033[38;2;255;0;0m";
        $greenForeColor = "\033[32m";
        $yellowForeColor = "\033[38;2;255;255;0m";
        $blueForeColor = "\033[38;2;0;120;255m";
        $magentaForeColor = "\033[35m";
        $cyanForeColor = "\033[38;2;0;255;255m";

        $whiteBackColor = "\033[48;5;15m";
        $redBackColor = "\033[41m";
        $greenBackColor = "\033[42m";
        $yellowBackColor = "\033[48;2;255;255;0m";
        $blueBackColor = "\033[44m";
        $magentaBackColor = "\033[45m";
        $cyanBackColor = "\033[46m";

        echo "\n";
        echo "$greenBackColor" . str_repeat(" ", 80) . "$reset\n";
        echo "$boldText Welkom bij de Blink Installer! $reset \n";
        echo "$greenBackColor" . str_repeat(" ", 80) . "$reset\n";

        $baseThemePath = getcwd() . "/wp-content/themes/blink";

        info("$yellowForeColor$boldText Blink (parent) thema wordt geplaatst in:$reset \n$baseThemePath");
        info("$reset De installatie zal automatisch beginnen over$yellowForeColor$boldText 5 seconden $reset, druk op$boldText$blueForeColor $whiteBackColor ENTER $reset om meteen te starten");
        stream_set_blocking(STDIN, false);

        for ($i = 5; $i > 0; $i--) {
            echo "$greenBackColor$blackForeColor$boldText $i... $reset";
            sleep(1);

            $input = fgets(STDIN);
            if ($input !== false) {
                break;
            }
        }

        stream_set_blocking(STDIN, true);
        echo "\n";

        self::recursiveCopy($dir, $baseThemePath);
        echo "\n";
        echo "$greenBackColor" . str_repeat(" ", 80) . "$reset\n";
        echo("$boldText Blink (Parent) Thema installatie voltooid!\n");
        echo "$greenBackColor" . str_repeat(" ", 80) . "$reset\n";
        echo "\n";

        $isWindows = defined("PHP_OS_FAMILY") ? PHP_OS_FAMILY === "Windows" : strtoupper(substr(PHP_OS, 0, 3)) === "WIN";

        if ($isWindows) {
            echo "$reset$boldText$cyanForeColor Wil je een child theme aanmaken?$reset Ja/Nee: ";
            $input = strtolower(trim(readline()));
            $createChild = in_array($input, ["j", "ja", "y", "yes"]);
            echo "\n";
        } else {
            $createChild = confirm("$reset$boldText$cyanForeColor Wil je een child theme aanmaken?$reset", default: false, yes: "Ja", no: "Nee");
        }

        if ($createChild) {
            $siteName = "";

            do {
                if ($isWindows) {
                    echo "$reset$boldText$cyanForeColor Wat is de naam van het Child Theme? (typ $boldText$yellowForeColor'cancel'$reset$boldText$cyanForeColor om over te slaan): $reset";
                    $siteName = trim(readline());
                    echo "\n";

                    if (strtolower($siteName) === 'cancel') {
                        info("$reset$redBackColor$boldText Aanmaak van het child theme overgeslagen!$reset");
                        $siteName = null;
                        break;
                    }
                } else {
                    $siteName = text(
                        label: "$reset$boldText$cyanForeColor Wat is de naam van het Child Theme? (typ $boldText$yellowForeColor'cancel'$reset$cyanForeColor om over te slaan): $reset",
                        validate: function (string $value) {
                            return trim($value) !== "" ? null : "Voer een geldige naam in.";
                        }
                    );

                    if (strtolower($siteName) === 'cancel') {
                        info("$reset$redBackColor$boldText Aanmaak van het child theme overgeslagen!$reset");
                        $siteName = null;
                        break;
                    }
                }

                $childThemePath = getcwd() . "/wp-content/themes/" . strtolower($siteName);

                if (is_dir($childThemePath)) {
                    warning("$yellowForeColor$boldText Een child theme met die naam bestaat al: $reset$childThemePath");
                    $siteName = "";
                }

            } while ($siteName === "" || is_dir($childThemePath));

            if (!is_null($siteName)) {
                mkdir($childThemePath, 0755, true);
                info("$greenForeColor$boldText Child Thema is aangemaakt!: $reset$childThemePath");

                $styleBase = <<<CSS
                /*
                Theme Name: {$siteName}
                Description: Child theme van Blink voor {$siteName}.
                Template: blink
                Version: 1.0.0
                */
                CSS;

                $functionBase = <<<PHP
                <?php 
                add_action('wp_enqueue_scripts', function () {
                    wp_enqueue_style('blink-style', get_template_directory_uri() . '/style.css');
                    wp_enqueue_style('child-style', get_stylesheet_uri(), ['blink-style']);
                });
                PHP;

                file_put_contents($childThemePath . "/style.css", $styleBase . "\n");
                file_put_contents($childThemePath . "/functions.php", $functionBase);
            }

        }
        else {
            echo "$reset$redBackColor$boldText Child Thema Installatie overgeslagen $reset\n";
            echo "\n";
        }

        echo "$greenBackColor" . str_repeat(" ", 80) . "$reset\n";
        echo("$boldText Installatie volledig afgerond!\n");
        echo "$greenBackColor" . str_repeat(" ", 80) . "$reset\n";
        echo "\n";
    }

    private static function recursiveCopy($source, $destination)
    {

        $boldText = "\033[1m";
        $italicText = "\033[3m";
        $underlineText = "\033[4m";

        $reset = "\033[0m";
        $blackForeColor = "\033[30m";
        $redForeColor = "\033[31m";
        $greenForeColor = "\033[32m";
        $yellowForeColor = "\033[38;2;255;255;0m";
        $blueForeColor = "\033[38;2;0;120;255m";
        $magentaForeColor = "\033[35m";
        $cyanForeColor = "\033[36m";

        $whiteBackColor = "\033[48;5;15m";
        $redBackColor = "\033[41m";
        $greenBackColor = "\033[42m";
        $yellowBackColor = "\033[48;2;255;255;0m";
        $blueBackColor = "\033[44m";
        $magentaBackColor = "\033[45m";
        $cyanBackColor = "\033[46m";

        if (!file_exists($source)) return false;
        if (!file_exists($destination)) mkdir($destination, 0755, true);

        $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

        $files = scandir($source);
        foreach ($files as $file) {
            if ($file === "." || $file === "..") continue;

            $srcPath = $source . DIRECTORY_SEPARATOR . $file;
            $destPath = $destination . DIRECTORY_SEPARATOR . $file;

            if (is_dir($srcPath)) {
                self::recursiveCopy($srcPath, $destPath);
                continue;
            }

            if (file_exists($destPath) && md5_file($srcPath) !== md5_file($destPath)) {
                warning("\n$reset$redBackColor$boldText Er is een bestand gevonden $reset$yellowForeColor$boldText$italicText($file)$reset$redBackColor$boldText die anders is dan de zojuist opgehaalde versie, Wil je jouw lokale versie $reset$yellowForeColor$boldText$italicText($file)$reset$redBackColor$boldText overschrijven met de opgehaalde versie?: $reset\n $destPath");

                if ($isWindows) {
                    echo "$yellowForeColor$boldText Overschrijven?$reset Ja/Nee: ";
                    $overwrite = strtolower(trim(readline()));
                    echo "\n";
                } else {
                    $overwrite = confirm("$yellowForeColor$boldText Overschrijven?$reset", default: false, yes: "Ja", no: "Nee");
                }

                if (
                    ($isWindows && !in_array($overwrite, ["j", "ja", "y", "yes"])) || (!$isWindows && !$overwrite)
                ) {
                    echo "$boldText Bestand overgeslagen: $file\n";
                    echo "\n";
                    sleep(1);
                    continue;
                }

                if ($isWindows) {
                    echo "$reset$redForeColor$boldText Weet je het echt zeker dat je $reset$yellowForeColor$boldText$italicText($file)$reset$redForeColor$boldText wilt overschrijven?$reset Ja/Nee: ";
                    $doubleCheck = strtolower(trim(readline()));
                    echo "\n";
                } else {
                    $doubleCheck = confirm("$reset$redForeColor$boldText Weet je het echt zeker dat je $reset$yellowForeColor$boldText$italicText($file)$reset$redForeColor$boldText wilt overschrijven?$reset", default: false, yes: "Ja", no: "Nee");
                }

                if (
                    ($isWindows && !in_array($doubleCheck, ["j", "ja", "y", "yes"])) || (!$isWindows && !$doubleCheck)
                ) {
                    echo "$boldText Bestand overgeslagen: $file\n";
                    echo "\n";
                    sleep(1);
                    continue;
                }
            }
            copy($srcPath, $destPath);
            echo "$greenForeColor Bestand gekopieerd: $reset$file\n";
        }
        return true;
    }
}