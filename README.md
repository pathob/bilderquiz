# Kunstquiz der FU Berlin

## Zusammenfassung

Im Rahmen der Veranstaltung "XML-Technologien" am Institut für Informatik der Freien Universität war ein Projekt anzufertigen, in dem durch die Anwendung verschiedener Technologien der Vorlesungsstoff gefestigt werden sollte.
Für die Umsetzung des Projektes wurde etwa ein Monat Zeit gewährt.
Das Projekt sollte sich am Wettbewerb [Coding Da Vinci](http://codingdavinci.de/) orientieren, allerdings war eine offizielle Teilnahme nicht Pflicht.


## Einleitung + Verwendete Daten

Unsere Gruppe hat sich auf den Projektnamen "Kunstquiz" geeinigt.
Durch das Projekt entstand eine Webanwendung, in dem der Nutzer zwischen 10, 15 oder 20 Fragen auswählen kann und diese dann lösen muss.
Inhalt der Fragen sind Kunstwerke. Der Benutzer soll zwischen vier Antwortmöglichkeiten den richtigen Künstler, der das Werk gemalt hat, bestimmen.
Die Datenbasis für das Projekt sind die [Deutsche Digitale Bibliothek](https://www.deutsche-digitale-bibliothek.de/) und die [DBpedia](http://wiki.dbpedia.org/).

Nachfolgend werden die eingesetzten Technologien genauer vorgestellt.

## Eingesetzte Technologien

### LOD-Endpoint + SPARQL

TODO: Mirco

### XML-Schema

TODO: Tom

### XSLT

TODO: Kim

### XML-Datenbank

TODO: Kim

### REST-API + JQuery

TODO: Patrick + Kim

### Webinterface + semantische Daten

TODO: Ömer

## Setup

Die Installation wird durch den Einsatz eines [Docker](https://www.docker.com/)-Containers stark vereinfacht.
Um diese Webanwendung auszuführen, wird ein Webserver (hier Apache), PHP und Zorba benötigt.
Vor allem die Installation von Zorba ist sehr fehleranfällig, da das Zorba-Paket wegen eines fehlerhaften Versionsvergleiches während der Installation auf einigen Distributionen nicht verwendet werden kann,
und da der enthaltene PHP-API-Wrapper PHP-Funktionen enthält, welche von Apache nicht mehr unterstützt werden.
Diese Besonderheiten und weitere Konfigurationen werden durch den Docker-Container abgenommen.

Um den Docker-Container zu erstellen und die Webanwendung automatisch in den Container einzubinden, werden [`docker`](https://www.docker.com/) und [`docker-compose`](https://docs.docker.com/compose/) benötigt.
Wurden diese installiert, muss der Benutzer, der den Container starten möchte, außerdem der `doocker`-Gruppe hinzugefügt werden.
Außerdem muss mit diesem Repository das `docker-apache-php-zorba` Submodul ausgecheckt werden.
Allgemein kann zum auszecken aller Submodule folgender Befehl verwendet werden.

```
git submodule update --init --recursive
```

Nun kann aus dem `docker`-Verzeichnis heraus der Container gestartet werden.
Dafür müssen nur die beiden nachfolgenden Befehle ausgeführt werden.
Bitte beachten Sie, dass das initiale Aufsetzen eines Containers viel Zeit in Anspruch nehmen kann.

```
docker-compose build
docker-compose up -d
```

Standardmäßig wird der Apache-Webserver aus dem Container an den Port 8081 gebunden.
Dies kann über die Änderung des Ports in der Konfigurationsdatei `docker-compose.yml` angepassst werden.

### Debian Jessie
Sollten Sie Debian Jessie verwenden, führen sie den gesamten Installationsprozess ganz einfach durch folgenden Aufruf auf.
Dafür muss der das Skript jedoch von einem Benutzer aus der `sudoer` Gruppe oder dem Superuser `root` aufgerufen werden.

```
./configure
```

