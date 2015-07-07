<?php

require_once('class.base.php');

class Artwork extends Base {
    
    public function asArray() {

    }
    
}

class ArtworkDao extends BaseDao {

    public static $ArtworksDatabase = '/var/www/backend/db/artworks_database.xml';
    public static $PersonsDatabase = '/var/www/backend/db/persons_database.xml';

    public function GET($verb, $args) {

        if ($verb == 'yearQuestion') {

            $queryStr = "
				module namespace r = 'http://zorba.io/modules/random';

				declare namespace an = 'http://zorba.io/annotations';
				declare namespace zerr = 'http://zorba.io/errors';

				declare namespace ver = 'http://zorba.io/options/versioning';
				declare option ver:module-version '1.0';

				declare %private variable \$r:errNS as string := 'http://zorba.io/modules/random';
				declare %private variable \$r:INVALID_ARGUMENT as QName := fn:QName(\$r:errNS, 'r:INVALID_ARGUMENT');


				declare function r:seeded-random(
				  \$seed as integer,
				  \$num as integer
				) as integer* external;

				declare %an:nondeterministic function r:random(
				  \$num as integer
				) as integer* external;

				declare %an:nondeterministic function r:random() as integer
				{
				  r:random(1)
				};

				declare function r:seeded-random-between(
				  \$seed as integer,
				  \$lower as integer,
				  \$upper as integer,
				  \$num as integer
				) as integer*
				{
				  if ( \$lower eq \$upper ) then
					\$lower
				  else
					if ( \$lower gt \$upper ) then
					  fn:error(
						\$r:INVALID_ARGUMENT,
						'\$lower must be less than or equal to \$upper',
						(\$lower, \$upper)
					  )
					else
					  for \$i in r:seeded-random( \$seed, \$num )
					  return
						if ( ( \$upper - \$lower ) lt 10000 ) then
						  integer( fn:round( double( \$i mod 10000 ) div 10000 * ( \$upper - \$lower) ) + \$lower )
						else
						  integer( fn:round( double( \$i ) mod ( \$upper - \$lower ) ) + \$lower )
				};
				declare %an:nondeterministic function r:random-between(
				  \$lower as integer,
				  \$upper as integer,
				  \$num as integer) as integer*
				{
				  if ( \$lower eq \$upper ) then
					\$lower
				  else
					if ( \$lower gt \$upper ) then
					  fn:error(
						\$r:INVALID_ARGUMENT,
						'\$lower must be less than or equal to \$upper',
						(\$lower, \$upper)
					  )
					else
					  for \$i in r:random( \$num )
					  return
						if ( ( \$upper - \$lower ) lt 10000 ) then
						  integer( fn:round( double( \$i mod 10000 ) div 10000 * ( \$upper - \$lower) ) + \$lower )
						else
						  integer( fn:round( double( \$i ) mod ( \$upper - \$lower ) ) + \$lower )
				};

				declare %an:nondeterministic function r:random-between(
				  \$lower as integer,
				  \$upper as integer
				) as integer
				{
				  r:random-between(\$lower, \$upper, 1)
				};

				declare %an:nondeterministic function r:uuid() as string external;
				for \$artworks in doc(".ArtworkDao::$ArtworksDatabase.")/artworks,
				  \$persons in doc(".ArtworkDao::$PersonsDatabase.")/persons
				let \$artwork := \$artworks/artwork[matches(year/text(), '^[0-9][0-9][0-9][0-9]\$')]
				let \$rows := count(\$artwork)
				let \$rand0 := r:random-between(\$rows -1)+1
				let \$rand1 := r:random-between(\$rows -1)+1
				let \$rand2 := r:random-between(\$rows -1)+1
				let \$rand3 := r:random-between(\$rows -1)+1
				let \$id := \$artwork[\$rand0]/personID/@ID
				let \$painter := \$persons/person[personID[@ID=\$id]]/name/text()

				return ('{\"question\":\"Aus welchem Jahr stammt dieses Bild?\",\"hint\":\"Das Bild ist von ',\$painter,'.\",\"image\":\"',\$artwork[\$rand0]/thumbnail/text(),'\",\"answers\":{\"rightAnswer\":',\$artwork[\$rand0]/year/text(),',\"wrongAnswer1\":',\$artwork[\$rand1]/year/text(),',\"wrongAnswer2\":',\$artwork[\$rand2]/year/text(),',\"wrongAnswer3\":',\$artwork[\$rand3]/year/text(),'}}')
            ";

            $query = $this->_zorba->compileQuery($queryStr);
            $result = $query->execute();
            $query->destroy();

            return $result;

        }

        return;
    }
}
