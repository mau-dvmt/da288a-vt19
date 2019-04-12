# Laboration 2: Grundläggande molntjänster

## Förberedelser

Inför labben är det bra om du installerat Docker och Git.

### Windowsanvändare: Installera Bash

Om du kör Windows, kan du komma att behöva installera en Bash-terminal. Det enklaste sättet är att dra ner [Git för Windows](https://git-scm.com/download/win), som även innehåller Git Bash. Om du kör macOS eller en Linux-variant har du redan Bash installerat. De kommandon som beskrivs nedan körs i Bash-skalet, som du som kör Windows hittar i startmenyn under namnet *Git Bash*.

### PHP och Composer

Du kommer att använda PHP och Composer som du [installerade förra veckan](../1/lab.md). Om du inte har dem installerade - gör det.

### Bash

Om du kör Windows, kan du komma att behöva installera en Bash-terminal. Det enklaste sättet är att dra ner [Git för Windows](https://git-scm.com/download/win), som även innehåller *Git Bash*. Om du kör macOS eller en Linux-variant har du redan Bash installerat. De kommandon som beskrivs nedan körs i Bash-skalet, som du som kör Windows hittar i startmenyn under namnet *Git Bash*.

När du nedan ser anvisningar om att skriva saker i terminalen eller Bash, ska du skippa det inledande $- eller #-tecknet. Det innebär att

```bash
$ ls
```

betyder att du bara skriver *ls* i terminalen och trycker enter. För Windows-användare översätts "terminalfönstret" enklast med "Git Bash", som du hittar i startmenyn.

### Installera Git

Verktyget *Git* används för att versionshantera kod. Vi kommer i den här laborationen att använda det för att skicka kod till Azure.

#### Windows

Ladda ner [installationsfilen](https://git-scm.com/download/win) och kör den. Installationen är ganska rättfram.

#### macOS

Det bästa sättet att installera Git på är med verktyget *Homebrew*, som är en pakethanterare för macOS. Öppna upp ett terminalfönster och kör följande kommando:

```bash
$ ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
$ brew doctor
```

Homebrew kommer nu att installeras tillsammans med några trevliga utvecklingsverktyg. Låt det köra klart, och kör sedan

```bash
$ brew install git
```

#### Ubuntu

Öppna ett terminalfönster och skriv följande:

```bash
$ sudo apt-get install git
```

### Installera Docker

#### Windows

##### Windows 10 Enterprise och Professional

Ladda ner [Docker för Windows](https://download.docker.com/win/stable/Docker%20for%20Windows%20Installer.exe) och installera programmet. Du kan behöva starta om datorn efter att installationen är klar. Starta sedan *Docker for Windows* från startmenyn. Om du får problem, ta en titt på [dokumentationen](https://docs.docker.com/docker-for-windows/install/).

##### Windows 8 och Windows 10 Home och Educational

Windows 8 och 10 Home saknar den Hyper-V-funktionalitet som behövs för att kunna virtualisera Linux. För att lösa detta kan du istället för vanliga Docker använda [Docker Toolbox](https://docs.docker.com/toolbox/overview/). Installationen torde vara ganska rättfram, men om du stöter på problem, titta på [dokumentationen](https://docs.docker.com/toolbox/toolbox_install_windows/).

#### macOS

Börja med att ladda ner [installationsfilen från Docker](https://hub.docker.com/editions/community/docker-ce-desktop-mac). Av någon anledning måste man som Mac-användare skapa ett konto för att kunna ladda ner installationsfilen. Gör det. Installera programmet och kör *Docker.app* när installationen är klar.

#### Ubuntu

Öppna en terminal och kör följande kommando för att uppdatera dina repositories:

```bash
$ sudo apt-get update
```

Installera mjukvara som krävs för att köra Docker:

```bash
$ sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common
```

För att kunna installera Docker måste vi först installera en nyckel så att Ubuntu kan verifiera utgivaren av Docker. Kör följande i terminalen:

```bash
$ curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
```

Nu sätter vi upp Docker-repositoryt:

```bash
$ sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"
```

Slutligen installerar vi Docker så här:

```bash
$ sudo apt-get update
$ sudo apt-get install docker-ce docker-ce-cli containerd.io
```


### Testa installationerna

#### Git

Öppna ett terminalfönster och skriv

```bash
$ git version
```

Om du får upp en text i stil med nedanstående, är allt okej:

```
git version 2.17.1
```

#### Docker

Öppna terminalen och kör

```bash
$ docker ps
```

Detta kommandot lista alla installerade containers. Du har inga installerade än, men du ska få upp en text i stil med

```
CONTAINER ID        IMAGE                       COMMAND                  CREATED             STATUS              PORTS                    NAMES
```

Ser du detta, är du färdig med dina installationer

### Fanken! Jag får inte det att fungera!

Om du inte får igång Docker på din dator är det bättre att hoppa över till en av dina kursare och köra lite gammal hederlig parprogrammering. Det är bättre att du kommer igång än att du sitter och sliter håret med verktygen. Vi kan titta på installationen efter att du är klar med labben.

## Provkör Docker

Så där! Nu är vi snart igång! Börja med att skapa en katalog där vi kan arbeta. Vi kommer i instruktionerna att arbeta från terminalen, men du kan även skapa katalogen via Utforskaren, Finder eller vad ditt operativsystem erbjuder.

Skapa en katalog genom att skriva

```bash
$ mkdir dockertest
```

Du har nu en katalog, *dockertest*, som ligger i din hemkatalog. Gå in i den genom att skriva

```bash
$ cd dockertest
```
Vi kommer att göra allt i den här katalogen, och du kan glatt ta bort den efter att labben är slut.

### Ladda ner en Docker-image

Vi ska ladda ner en enkel Docker-image som heter *busybox*. Det är en liten image, som ger dig en liten container där du kan köra Bash. Alldeles lagom för att testa! Ladda hem *busybox*-imagen genom att skriva

```bash
$ docker pull busybox
```

> Om du får ett felmeddelande i stil med *permission denied* på macOS eller Windows, säkerställ att Docker verkligen kör. Om du får samma felmeddelande under Linux, kör dina Docker-kommandon med *sudo*.

Säkerställ att imagen laddades ned genom att skriva och verifiera svaret:

```bash
$ docker images
REPOSITORY              TAG                 IMAGE ID            CREATED             VIRTUAL SIZE
busybox                 latest              af2f74c517aa        10 days ago         1.2 MB
```

Varje image identifieras med ett **Image ID**. Ditt kommer inte att se ut precis som i exemplet ovan. Vi kan senare använda id-numret för att ta bort imagen.

### Kör imagen i en container

Vi kör nu containern genom att skriva

```bash
$ docker run busybox
```

Kommandot betyder att du ber Docker att köra en container med imagen med namnet *busybox*.

Om allt fungerar kommer inget att hända. Nästan. Imagen körs, men avslutar direkt. För att se att den faktiskt gör något, testa att skriva ut något. Så här, ungefär:

```bash
$ docker run busybox echo "Hallå Docker!"
```

När containern skapas och körs kommer den att köra Bash-kommandot `echo "Hallå Docker!"`. Du kommer därför att se en enkel utskrift i terminalen:

```
Hallå Docker!
```

Det går utmärkt att interagera lite med din nya container. Det gör du genom att säga till den att du vill starta den i interaktivt läge med hjälp av växeln **-it**:

```bash
$ docker run -it busybox sh
```

Det sista kommandot betyder att vi vill att Busybox ska ge oss ett terminalskal att arbeta med. Du kan leka runt lite här genom att exempelvis titta på vad som finns i imagen genom att skriva

```bash
# ls
bin   dev   etc   home  proc  root  sys   tmp   usr   var
```

Det du ser är en lista över alla kataloger och filer som finns i rotkatalogen på Busybox-imagen. Avsluta din container-session genom att skriva

```bash
# exit
```

### Ta bort imagen

Vi är trötta på den här imagen och vill ta bort den. Gör det genom att skriva

```bash
$ docker container prune
$ docker image rm xxxx
```

Textsträngen *xxxx* är de fyra första tecknen i **Image ID** som vi fick fram när vi körde `docker images`, så i exemplet ovan hade de motsvarats av *af2f*.

## Din första egna Docker-image

Nu är det dags att skapa och köra din alldeles egna Docker-image. Vi kommer att köra en image som kör PHP med webbservern Apache. Det första vi gör är att skapa en applikation som vi kan köra. Ordet *applikation* här är väldigt liberalt använt: det är bara en enda php-fil!

### Applikationen

Börja med att skapa en katalog *src* och gå in i den genom att skriva

```bash
$ mkdir src
$ cd src
```
Skapa en fil *index.php* här med kommandot *touch*:

```bash
$ touch index.php
```

Öppna filen med valfri texteditor och fyll i följande:

```html
<!DOCTYPE html>
<html>
<head>
  <title>Hello, Docker!</title>
</head>
<body>
  <h1>Hallå Docker, nu är jag här!</h1>
</body>
</html>
```

Spara filen och klappa dig på axeln: du har precis skapat grunden till en webbplats!

### Dockerfile

Nu ska vi skapa en Dockerfile, som vi kan använda för att skapa images. Börja med att gå tillbaka till katalogen *dockertest* och skapa en tom Docker-fil genom att skriva

```bash
$ cd ..
$ touch Dockerfile
```

Var noga med mellanslag och stora/små bokstäver, annars blir det inte rättt.

Öppna upp *Dockerfile* med en textredigerare och fyll i:

```dockerfile
FROM php:7.2-apache
COPY src/ /var/www/html
EXPOSE 80
```

Det här betyder att vi låter vår Dockerimage bygga vidare på PHP:s officiella 7.2-Dockerimage med Apache. Vi kopierar även över vår enorma applikation till imagens */var/www/html*, vilket är den plats där Apache som förval letar efter filer att serva. Slutligen säger vi till imagen att lyssna efter inkommande trafik på port 80, vilken är den port som HTTP som standard lyssnar på. Mer än så här behövs inte - just nu i alla fall.

### Bygg din Docker-image

Nu bygger vi vår Dockeriamge genom att köra 

```bash
$ docker build -t hello-docker .
```

Det som händer här är att vi säger till Docker att bygga en image med namnet *hello-docker*, baserat på Dockerfilen som finns i den här katalogen (på Unix-språk, som Bash använder, betyder ```.``` *här* eller *hit*). Nu drar Docker ner alla images som vår image kommer att bygga på. Det tar en kort stund, men görs bara en gång.

### Kör din image i en container

Nu kör vi vår Dockerimage genom att skriva

```bash
$ docker run hello-docker
```

Testa att öppna en webbläsare och gå till adressen [http://localhost:80](). Fungerar det? Om inte - ingen fara, vi kommer till det nu direkt! Men först dödar vi containern genom att trycka *ctrl+c*.

#### Portmappning

Om din port 80 är upptagen med annat eller av någon annan anledning inte fungerar, kan du använda portmappning för att vidare befordra trafik från en port till en annan. Vi testar:

```bash
$ docker run -p 8000:80 hello-docker
```

Testa nu att öppna webbläsaren och gå till [http://localhost:8000]() och se om det fungerar. Avsluta med *ctrl+c*.

#### Volymer

Om du nu gör en förändring i din *src/index.php* kommer du att se att du inte ser någon förändring när du laddar om sidan i webbläsaren. Detta beror på att du har kopierat in filen när du byggde din image. Vi kan istället använda oss av *volymer*, vilka är platser där vi kan spara och dela data - exempelvis mellan två containers eller en container och värdsystemet. Det är precis det vi vill göra nu - du ändrar filen från värdsystemet, medan containern sköter servandet av den. Vi anger vår *src*-katalog som en volym som mappas mot containerns */var/www/html* genom att skriva så här:

```bash
$ docker run -p 8000:80 -v $PWD/src/:/var/www/html hello-docker
```
Kommandot `$PWD` betyder *print working directory*, vilket pekar på den katalog som du just nu står i. Testa nu att gå in på webbsidan [http://localhost:8000](). Gör sedan en ändring i filen *src/index.php*, spara filen och ladda om sidan. Nu ska förändringen synas.

Om du har dålig fantasi och inte vill fundera ut någon spännande ändring, kan du använda den här.

```html
<!DOCTYPE html>
<html>
<head>
  <title>Hello, Docker!</title>
</head>
<body>
  <h1>Hallå Docker, nu är jag här!</h1>
  <p>Asså, shiiiiit vad fett det är med Docker, mannen!</p>
</body>
</html>
```

#### Frikopplade sessioner

Fram till nu har vi varit tvugna att hålla terminalen upptagen för att containern ska köra. Vi har också fått använda *ctrl+c* för att döda den. Det är ju ett helt barockt sätt att arbeta. Så kan vi inte ha det! Som tur är kan vin använda oss av *detached sessions* för att frikoppla våra Docker-sessioner från terminalen. Vi gör det genom att skriva

```bash
$ docker run -p 8000:80 -v $PWD/src/:/var/www/html -d --name nice-site hello-docker
```

Genom att ange `-d` frikopplar vi sessionen, och genom att ange `--name nice-site` kan vi kontrollera precis den här containern fastän den är frikopplad. Testa att gå in på [http://localhost:8000]() igen och se om du kommer åt sidan. När du sedan vill avsluta sessionen och containern, skriver du följande:

```bash
$ docker stop nice-site
nice-site
```

## Flercontainerapplikationer

De flesta riktiga applikationer kör på flera olika servrar, och det kan vi så klart emulera med Docker. Vi gör det genom att bygga ut vårt projekt så att de måste byggas med Composer och ger det en enkel databaskoppling.

### Skapa ett Composer-projekt

I [förra labben](../1/lab.md) skapade du ett Composer-projekt. Gör samma sak här. Ställ dig i katalogen *dockertest* och skriv

```bash
$ composer init
```

Du ska ange ett enda beroende: mjukvaran *catfan/medoo*. Välj den senaste versionen. När du är klar, ska du INTE installera dina beroenden, det gör vi med Composer i en container snart.

### Installation med Composer

När vi driftsätter vår applikation kommer vi att behöva köra en `composer install` på vårt projekt, men vi vill helst inte behålla Composer i vår driftmiljö. Hur gör vi det? Enkelt: vi använder oss av en ny container, som får i uppgift att köra `composer install`, spara resultatet i vår volym, och sedan avslutas. Vi kan sedan använda vår befintliga container för att serva filerna. För det här behöver vi inte ens skapa en Dockerfil, vi kan helt enkelt köra en befintlig container:

```bash
$ docker pull composer
$ docker run --rm -it --tty -v $PWD:/app composer install
```

Composer-containern kommer nu att köra `composer install` i den aktuella katalogen. Notera att /app i Composer-containern i själva verket pekar på den katalog som vi är i just nu. Detta gör att vi kommer att få en ny fil i katalogen *dockertest*, samt en ny katalog *vendor*. Den senare måste vi skicka med till vår Docker-miljö, så när vi startar upp vår Dockerimage igen behöver vi göra en mindre förändring:


```bash
$ docker run -p 8000:80 -v $PWD/src/:/var/www/html -v $PWD/vendor/:/var/www/vendor hello-docker
```

### Container med MySQL

Vi kan också sätta upp en container med MySQL så att vi kan använda en databas. Här är det väldigt viktigt att använda en volym, annars kan vi inte komma åt data mellan sessionerna, eftersom den inte sparas i imagen. Starta en MySQL-container genom att skriva

```bash
$ docker pull mysql:8.0
$ docker run mysql:8.0
error: database is uninitialized and password option is not specified 
  You need to specify one of MYSQL_ROOT_PASSWORD, MYSQL_ALLOW_EMPTY_PASSWORD and MYSQL_RANDOM_ROOT_PASSWORD
```

Felmeddelandena visar på två saker:
* Vi måste initialisera databasen
* Vi måste ange en massa inloggningsuppgifter

Vi gör detta genom att bygga ut kommandot lite:

```bash
$ docker run --name mysql-docker -e MYSQL_ROOT_PASSWORD=supersecret -d mysql:8.0
```

Notera att det här inte är något bra sätt att hantera lösenord på, men för oss duger det bra just nu.

Det som händer nu är att din MySQL-container skapar en databas. Vi vill förstås ha den i en egen volym, som vi skapar så här:

```bash
$ mkdir database
$ docker run --name mysql-docker -e MYSQL_ROOT_PASSWORD=supersecret -v $PWD/database/:/var/lib/mysql -d mysql:8.0
```

Vi kan också skicka med en fil med information om hur databasen ska se ut. Skapa en fil i *database* som heter *init.sql*.

```bash
$ cd database
$ touch init.sql
```

Öppna sedan filen i en textredigerare och skriv följande:

```sql
CREATE DATABASE IF NOT EXISTS dockertest;
USE dockertest;
CREATE TABLE IF NOT EXISTS table (id INT NOT NULL AUTO_INCREMENT);
```

Skicka med filen till containern genom att skriva

```bash
$ cd ..
$ docker run --name mysql-docker -e MYSQL_ROOT_PASSWORD=supersecret -v $PWD/database/:/var/lib/mysql -v $PWD/init.sql:/data/init.sql -d mysql:8.0 init-file /data/init.sql
```

Nu har vi en container som kör en databas som är uppe och snurrar. Vad vi nu saknar är lite inloggningsuppgifter och annat, och det bör också skrivas in. Usch, nu blir det mycket... Det hade varit gött om vi kunnat automatisera det här på något sätt. Därför:

### Docker Compose

Docker Compose är ett verktyg för att hantera applikationer som består av flera containers. Vi kommer att göra en applikation som består av de tre containers som vi arbetat med ovan: en installationscontainer, en databascontainer och en webbserver. Vi börjar med att skapa filen *docker-compose.yml*:

```bash
$ touch docker-compose.yml
```

Öppna upp filen i en textredigerare.


*docker-compose.yml* är en textfil som skrivs i språket YAML, som påminner lite om JSON. Vi börjar med att ange vilken version av Docker Compose vi vill använda. Den senaste heter 3.1, och det låter ju lovande. Skriv följande

```yaml
version: "3.1"
```

Därefter definierar vi upp våra tre tjänster *mysql*, *composer* och *web*:

```yaml
version: "3.1"
services:
    mysql:
    composer:
    web:
```

#### Webbservern

Det är dags att börja fylla ut våra tjänster, och vi börjar med den som är enklast: webbservern.

```yaml
version: "3.1"
services:
    mysql:
    composer:
    web:
        restart: "yes"
        build: .
        ports:
         - "8000:80"
        container_name: "nice-site"
        volumes:
         - ./src:/var/www/html
         - ./vendor:/var/www/vendor
```

Vi har nu berättat för Docker Compose att vår web-container ska byggas från Dockerfilen som finns i den här katalogen (med hjälp av `.`) och att den ska exponera port 80, till vilken vi vidarebefordrar anrop från porten 8000 i värdsystemet. Vi berättar också att containern ska heta *nice-site* och att den ska montera *src/* och *vendor/* som volymer. Slutligen säger vi till Docker att starta om containern om den stängs av.

#### Composer

Vi går vidare och tittar på Composer:


```yaml
version: "3.1"
services:
    mysql:
    composer:
        restart: "no"
        image: composer
        command: install
        volumes:
         - .:/app
    web:
        restart: "yes"
        build: .
        ports:
         - "8000:80"
        container_name: "nice-site"
        volumes:
         - ./src:/var/www/html
         - ./vendor:/var/www/vendor
```

När Composer-containern körs, körs den bara en gång (tack vare `restart: "no"`). Den sätter upp alla beroenden i nuvarande katalog (som ju är vår volym) och stängs sedan av igen.

#### MySQL

Slutligen tar vi och bygger upp vår MySQL-service.


```yaml
version: "3.1"
services:
    mysql:
        image: mysql:8.0
        container_name: "mysql-docker"
        command: --init-file /data/init.sql
        environment:
         - MYSQL_ROOT_PASSWORD=supersecret
         - MYSQL_DATABASE=dockertest
         - MYSQL_USER=dockeruser
         - MYSQL_PASSWORD=notreallysecret
        ports:
         - "33060:3306"
        volumes:
         - ./database:/var/lib/mysql
         - ./init.sql:/data/init.sql
    composer:
        restart: "no"
        image: composer
        command: install
        volumes:
         - .:/app
    web:
        build: .
        ports:
         - "8000:80"
        container_name: "nice-site"
        volumes:
         - ./src/:/var/www/html
         - ./vendor/:/var/www/vendor
```

Här har vi definierat en MySQL-server baserad på version 8.0 som vi kallar för *mysql-docker*. När den startas upp körs initieringsfilen */data/init.sql*, som vid behov skapar en databas och en väldigt enkel tabell. Vi anger även vilka uppgifter som behövs för att logga in på MySQL-servern under direktivet *environment*. MySQL-servern lyssnar på port 3306, och vi låter värdsystemet vidarebefordra alla anrop till port 33060 hit. Sammantaget innebär detta att du anropar MySQL på *localhost:33060* med användaruppgifterna *dockeruser/notreallysecret*.

#### Kör Docker Compose

Slutligen ska vi testa att köra igång våra containers. Vi skriver följande kommandon:

```bash
$ docker container prune
$ docker-compose up -d
```

Nu kommer Docker Compose att spinna upp tre stycken containers. Säkerställ att de fungerar genom att gå in på [http://localhost:8000](http://localhost:8000).

Avsluta genom att skriva

```bash
$ docker-compose down
```

## Azure

När labben släpptes hade vi inte fått tillgång till våra Azure-konton än. Om du är på labben - smit fram till Johan, så tittar vi på det tillsammans. Om du är hemma: ta en titt på [Deploy to an Azure Web App for Containers](https://docs.microsoft.com/en-us/azure/devops/pipelines/apps/cd/deploy-docker-webapp?view=azure-devops).
