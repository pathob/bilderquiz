# Backend

### Implemenetierung

## Voraussetzungen

Checkt das Submodule im `/docker/` Verzeichnis mit aus (`git submodule update --init --recursive`).

Um die Implementierung des Backends zu testen, wird der XML-Query-Prozessor Zorba benötigt. Am
einfachsten lässt sich dieser unter Linux mit dem Docker-Image (siehe `/docker/` aufsetzen.
Installiert euch Docker (https://docs.docker.com/installation/ubuntulinux/) und Docker-Compose
(https://docs.docker.com/compose/install/), fügt euren Benutzer zur `docker`-Gruppe hinzu, wechselt
in das `/docker/` Verzeichnis hier im Repo und führt folgende Befehle aus:

```
docker-compose build apache
docker-compose up -d apache
```

Fertig - nun könnt ihr den Quellcode aus `/sources/` über
[http://localhost:13370]()http://localhost:13370 ausführen. Eure Änderungen am Code sind automatisch
auch im Docker-Container vorhanden.

## Technische Dokumentation



