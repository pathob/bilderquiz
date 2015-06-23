# Zorba installieren (Debian / Ubuntu)

## Quellen:

* http://www.zorba.io/documentation/3.0/zorba/build/configure_zorba/
* http://www.zorba.io/documentation/3.0/zorba/build/build_and_install/
* http://www.zorba.io/documentation/latest/zorba/install/php_ubuntu_tutorial

## Apache2 und PHP installieren:

```
sudo apt-get install apache2 php5 php5-dev libapache2-mod-php5 php5-curl php5-gd \
php5-idn php-pear php5-imagick php5-imap php5-mcrypt php5-memcache php5-ps \
php5-pspell php5-recode php5-snmp php5-tidy php5-xmlrpc php5-xsl php5-common -y
```

## Zorba installieren:

In gewünschtes Verzeichnis wechseln, z.B. `/opt` und dann:

```
apt-get update; \
sudo apt-get install build-essential cmake libxml2-dev libicu-dev uuid-dev \
libxerces-c3.1 libxerces-c-dev libicu-dev curl -y; \
wget https://github.com/28msec/zorba/releases/download/3.0/zorba-3.0.tar.gz; \
tar -xzf zorba-3.0.tar.gz; \
rm zorba-3.0.tar.gz; \
cd zorba-3.0; \
mkdir build; \
cd build; \
cmake ..
```
