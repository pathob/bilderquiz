# Controller

## REST API

Alles, was an `webserver/api/` gesendet wird, wird an die REST API �bergeben. Unterst�tzt werden die �blichen Requests (GET, PUT, POST, DELETE).

Die GET-Anfrage `webserver/api/quiz/find/bla/blubb` wird an die Methode `GET` des Quiz-Objekts (Klasse `Quiz` in `class.quiz.php`) mit dem Parametern `verb` (hier "find") und `args` (hier Array mit "bla" und "blubb") �bergeben.
Dort kann f�r die verschiedenen Verben eigene Logik implementiert werden.
Werden nach der Entit�t nur Zahlen (ID's) �bergeben, entf�llt das Verb.

Siehe http://bilderquiz.hobusch.net/api/quiz/bla
