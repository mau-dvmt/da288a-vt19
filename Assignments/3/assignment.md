# Inlämningsuppgift 3. - Webbapplikation med Laravel, med CI/CD

**OBS - Del 1 av 2** (del 2 publiceras senare)

Den tredje inlämningsuppgiften handlar om att bygga en webbapplikation med **Laravel**. Webbapplikationen ska hantera olika *resurser* (vilka resurser väljer ni själva) samt ha inloggningsfunktionalitet. Ni ska även visa prov på god versionshantering under utvecklandet av webbapplikationen genom `GitFlow`.

## Uppgift 3a.

Denna uppgift är mycket mer öppen än tidigare uppgifter, vilket innebär att ni sjävla får bestämma innehållet i er webbapplikation. Det är helt okej att återanvända det ny byggt på laborationerna och bygga en webbapplikation med resurserna `produkt`, `review` och `store` om man vill det, men det är även välkommet med egna idéer. Följande ska finnas finnas i inlämningsuppgiften.

1. Ni ska använda `GitFlow` i er utvecklingsprocess på ett **korrekt** sätt, se [Lab 2](../../Labs/4/lab.md)
2. Ni ska använda er av minst tre resurser (vilket ska resultera i minst tre `models`)
    - Minst två av resurserna ska ha en relation till varandra. T.ex. en `product` har flera `review`.
3. Varje resurs ska ha en egen `controller`.
4. Ni ska ha följande vyer för var och en av era resurser:
    - **Lista alla exemplar av en resurs (t.ex alla produkter)**
    - **Lista detaljerad information om en resurs (t.ex. en produkt)**
    - Skapa en ny resurs (t.ex. en ny produkt)
    - Redigera en resurs (t.ex. en produkt)
    - Radera en resurs (t.ex. radera en produkt)
    - _De fetstilta vyerna kräver **inte inloggning**_
5. Ni ska även ha en startsida som visar en översikt av webbplatsens syfte och resurser.

I övrigt är uppgiften väldigt öppen, men fokus ska ligga på ett **enkelt och tydligt användargränssnitt**. Använd gärna [Bootstrap](http://getbootstrap.com/) för detta.

### Krav

Följande krav finns på uppgiften:

- Uppgiften ska följa uppgiftsbeskrivningen ovan
- Ni ska använda er av `GitFlow` för versionshantering av webbapplikationen
- Ni ska använda er av `migrations` för att skapa era tabeller
- Ni ska använda er utav `seeds` för att populera era tabeller
- Ni ska använda er utav `controllers` för att hantera logiken för er applikation
- Ni ska använda er utav `models` för att mappar era resurser mot databaser (ORM)
- Ni ska använda er utav `views` för att bygga ert grafiska gränssnitt
- Ni ska använda er utav `authentication` för att skydda vissa vyer (skapa/redigera/radera resurs)
- Ni ska följa PSR-1 & PSR-2 när det gäller hur ni skriver er kod

## Uppgift 3b.

I 3b bygger ni helt smidigt vidare på 3a. Ni ska inte skriva någon ny produktionskod, utan helt enkelt testa koden och driftsätta den. Till er hjälp har ni föreläsning [11](../Lectures/11/lecture.md) och [12](../Lectures/12/lecture.md), samt laborationerna [7](../Labs/7/lecture.md) och [8](../Labs/8/lecture.md).

### Krav

Följande krav finns på uppgiften:

- Ni ska använda er av `GitFlow` för versionshantering av webbapplikationens test- och konfigurationsfiler
- Ni ska beskriva två förslag på refaktoriseringar som ni skulle kunna göra i er kod, samt beskriva varför de är relevanta. Lägg dessa i en fil som heter *refactor.md*
- Ni ska skriva minst tio relevanta tester och kunna redogöra (med hjälp av kommentarer i koden) varför ni valt just dessa tester
- Ni ska använda er av `Azure Pipelines` för att automatisera testning, bygge och driftsättning av er applikation
- Ni ska ha en driftsatt version av er applikation

## Inlämning & deadline
Inlämningen sker genom att ni publicerar er lösning på Github och skickar in adressen till er lösning, samt adressen till er driftsatta webbapplikation, på Canvas. Denna uppgift får göras i team om två, där båda ska kunna redogöra för skriven kod.

Uppgiften ska vara inlämnad senast onsdagen den *12:e juni*, 23.59.
