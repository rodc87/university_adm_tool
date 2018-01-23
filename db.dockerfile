FROM mysql:5.6

ADD ./sql/import.sql /docker-entrypoint-initdb.d
EXPOSE 3306
