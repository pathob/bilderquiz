# Sources

Die Sources aus dem Master werden alle 2 Minuten auf dem Test-Webserver aktualisiert:

URL: http://bilderquiz.hobusch.net/

## Frontend

Das Basisverzeichnis wird durch die `.htaccess`-Datei auf den Ordner `frontend` weitergeleitet (einzige Ausnahme bilden Anfragen auf das `api`-Verzeichnis, siehe Backend).

## Backend

### REST API

Alles, was an `webserver/api/` gesendet wird, wird an die REST API übergeben. Unterstützt werden die üblichen Requests (`GET`, `PUT`, `POST`, `DELETE`).

Die GET-Anfrage `webserver/api/quiz/find/bla/blubb` wird an die Methode `GET` des Quiz-Objekts (Klasse `Quiz` in `class.quiz.php`) mit dem Parametern `verb` (hier "find") und `args` (hier Array mit "bla" und "blubb") übergeben.
Dort kann für die verschiedenen Verben eigene Logik implementiert werden.
Werden nach der Entität nur Zahlen (ID's) übergeben, entfällt das Verb.

Siehe http://bilderquiz.hobusch.net/api/quiz/bla
