

# Project Titel

Blink Composer Package

## Beschrijving

Dit is de POC voor het ontwikkelen van een versiebeheersysteem voor Blink.
In deze POC wordt [Composer](https://getcomposer.org/) gebruikt om van het Blink thema een Composer Package te maken, 
die vervolgens geüpdate en opgehaald kan worden.

***Let op**: deze installatie gaat ervan uit dat er al een Wordpress Develop Environment is opgezet en dat Composer is geïnstalleerd!*

* Link voor het opzetten van WordPress: [Local WordPress Setup](https://jetpack.com/resources/wordpress-localhost/).
* Link voor het installeren van Composer: [Composer Installation](https://kinsta.com/blog/install-composer/).

## Getting Started

### Dependencies

* laravel/prompts: ^0.3.5,
* symfony/filesystem: "^7.2
* PHP v8+
* WSL for Windows **(Niet noodzakelijk)**

### Installatie

Deze Github repository wordt als Composer Package geïnstalleerd in een (nieuw) Wordpress project waarin je wilt ontwikkelen met Blink.

**Voor de installatie van Blink zijn de volgende stappen nodig:**
1. Open de terminal/console binnen het huidige project en run de volgende commando: `composer init`.
**Dit zal de volgende vragen stellen:**
2. **Package Name:** Ik raad aan deze naming convention te gebruiken:
`jouw naam of bedrijf/naam van het project`,
dus bijvoorbeeld: `microsoft/new-project`
3. **Description [] :** Beschrijf hier het project, *(niet verplicht)*.
4. **Author [user, email]:** Deze wordt automatisch ingevuld met jouw git gegevens. Als deze leeg is, kun je deze invullen met jouw gegevens.
5. **Minimum Stability:** Deze stap kan overgeslagen worden met *(ENTER)*.
6. **Package Type:** Vul hier `project` in.
7. **License:** Deze stap kan overgeslagen worden met *(ENTER)*.
8. **Define Dependencies:** Deze stap is niet nodig, *(no).* 
9. **Define Dev Dependencies:** Deze stap is niet nodig, *(no).* 
10. **Add PSR-4 Autoload:** Deze stap is niet nodig, *(no).* 
11.  **Confirm Generation?** *Yes/ENTER*

Als je de stappen correct heb gevolgd zal nu een composer.json gegenereerd worden, met deze code erin:

    {
        "name": "jouw naam of bedrijf/project-naam",  
        "type": "project",  
        "require": {},  
    }

Om de composer.json compleet te maken, moeten we nog **twee** stukjes code toevoegen, deze zijn:

    "repositories": [  
        {  
            "type": "vcs",  
            "url": "https://github.com/Myron1271/blink-theme.git" 
      }  
    ],

De link in de `"url"` verwijst naar de Git repository van het Blink Composer Package. Voor deze POC is mijn Github account gebruikt. Als de repository wordt verplaatst, moet deze link worden aangepast.

Tot slot moet de code worden toegevoegd die het script uitvoert om nieuwe versies van Blink op te halen en oudere versies bij te werken. Deze code is:

    "scripts": {  
        "install-blink": "Eyetractive\\BlinkTheme\\ThemeInstall::install"  
    }

Dit is dan hoe uiteindelijk de composer.json eruit zal moeten zien:

    {
        "name": "jouw naam of bedrijf/project-naam",
        "type": "project",
        "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/Myron1271/blink-theme.git"
            }
        ],
        "require": {},
        "scripts": {
            "install-blink": "Eyetractive\\BlinkTheme\\ThemeInstall::install"
        }
    }

Als dit allemaal succesvol gedaan zullen er twee commando's gedraaid moeten worden: om de Blink Composer Package binnen te halen.

Deze zijn:

    composer require eyetractive/blink-theme 

Na het uitvoeren van dit commando wordt er een `vendor` map aangemaakt met daarin de Blink Composer package.
Daarnaast wordt de package toegevoegd aan de `composer.json`, onder het kopje `require` met:.

    "require": {
            "eyetractive/blink-theme": "^1.0"
        },

Tot slot hoeft nu alleen het script nog uitgevoerd te worden en is de installatie voltooid. Het commando daarvoor is:

    composer run-script install-blink

Dit commando haalt nu het Blink thema op uit de `vendor` map en plaatst het in de map `wp-content/themes/`.

Er wordt daarnaast gevraagd of er een child theme aangemaakt moet worden. Als je hiervoor kiest, wordt er een extra map aangemaakt in `wp-content/themes/`, met daarin de benodigde `style.css` en `functions.php` die Wordpress nodig heeft.

***Let op**: vergeet niet om het thema te activeren in Wordpress*

### Uitvoering programma
Wanneer de Blink Composer Package is opgezet, kunnen we de volgende commando’s gebruiken om Blink up to date te houden.

Na elke update aan de Blink Composer Package moet in het Wordpress project de volgende commando’s worden uitgevoerd:
Om de nieuwe versie van Blink op te halen:

    composer update

Voor het updaten en kopiëren van de nieuwe versie van Blink naar de `wp-content/themes` map:

    composer run-script install-blink

Het Blink thema is dan nu geüpdate met de laatste versie.

### Updates uitbrengen

Voor het updaten van het Blink thema wordt we eveneens  gebruikt gemaakt van deze [blink-theme Repository](https://github.com/Myron1271/blink-theme).

Het uitbrengen van updates verloopt als volgt:
1. Een nieuw component wordt aangemaakt in een Wordpress project. Dit component moet nu worden toegevoegd aan het Blink thema, zodat anderen het kunnen gebruiken.
2. Dit component wordt vervolgens handmatig naar het Blink thema gekopieerd, waarna de wijzigingen worden gecommit en gepusht naar deze GitHub repository van [blink-theme](https://github.com/Myron1271/blink-theme).

(***Let op**: **dit component moet niet in de `vendor` map worden geplaatst, maar moet in het blink-theme project worden toegevoegd van deze repository [blink-theme](https://github.com/Myron1271/blink-theme)!**)

3. In de GitHub-repository moet nu een nieuwe release worden aangemaakt met een unieke tag. Voor deze tag gebruiken we [Semantic Versioning](https://nl.wikipedia.org/wiki/Software_versioning) (Voorbeeld: 1.0.0).

4. Wanneer dit is gedaan, moeten dezelfde stappen worden gevolgd als bij:
**"Uitvoering programma"**.

### Extra informatie

Zoals beschreven bij de dependencies wordt WSL (Windows Subsystem for Linux) vermeld. Deze dependency is echter niet noodzakelijk.

[WSL](https://learn.microsoft.com/en-us/windows/wsl/about) is een functie van Windows waarmee je een Linux-omgeving kunt draaien op Windows, zonder dat je hiervoor een aparte virtuele machine hoeft te gebruiken.
De code van het ThemeInstall-script bevat namelijk commando’s en functies die momenteel niet volledig door Windows worden ondersteund. 

Hiervoor zijn wel alternatieven geschreven, maar de volledige werking en beoogde uitvoering van de installatie werkt het best met WSL.
Dit betekent dat als je het script ook op Windows wilt gebruiken, WSL geïnstalleerd moet worden.

Voor de installatie, zie:
[Installatie WSL](https://learn.microsoft.com/en-us/windows/wsl/install)


## Auteurs

[Myron Seelen LinkedIn](https://www.linkedin.com/in/myron-seelen/)

## Versies

*Check releases tab voor version history:*
[Versies](https://github.com/Myron1271/blink-theme/releases).



