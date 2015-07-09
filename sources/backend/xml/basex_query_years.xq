import module namespace file = "http://expath.org/ns/file";
for $artworks in doc("../db/artworks_database.xml")/artworks,
  $persons in doc("../db/persons_database.xml")/persons
let $artwork := $artworks/artwork[matches(year/text(), '^[0-9][0-9][0-9][0-9]$')]
let $rows := count($artwork)
let $rand0 := random:integer($rows -1)+1
let $rand1 := random:integer($rows -1)+1
let $rand2 := random:integer($rows -1)+1
let $rand3 := random:integer($rows -1)+1
let $id := $artwork[$rand0]/personID/@ID
let $painter := $persons/person[personID[@ID=$id]]/name/text()

return ('{"question":"Aus welchem Jahr stammt dieses Bild?","hint":"Das Bild ist von ',$painter,'.","image":"',$artwork[$rand0]/thumbnail/text(),'","answers":{"rightAnswer":',$artwork[$rand0]/year/text(),',"wrongAnswer1":',$artwork[$rand1]/year/text(),',"wrongAnswer2":',$artwork[$rand2]/year/text(),',"wrongAnswer3":',$artwork[$rand3]/year/text(),'}}')
